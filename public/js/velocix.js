/**
 * VELOCIX SPA ROUTER - Smooth & Fast
 * Version: 2.0 - No Console Logs
 */

class VelocixRouter {
    constructor(options = {}) {
        this.options = {
            containerSelector: '[data-velocix-content]',
            linkSelector: 'a[data-velocix-link]',
            formSelector: 'form[data-velocix-form]',
            transitionDuration: 100,
            debug: false,
            ...options
        };

        this.container = null;
        this.currentUrl = window.location.href;
        this.isNavigating = false;
        this.cache = new Map();
        
        this.init();
    }

    init() {
        this.container = document.querySelector(this.options.containerSelector);
        
        if (!this.container) {
            return;
        }

        this.attachEventListeners();
        this.handlePopState();
        
        history.replaceState({ 
            url: this.currentUrl,
            title: document.title 
        }, '', this.currentUrl);
    }

    attachEventListeners() {
        // Intercept ALL internal links automatically
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            
            if (!link) return;
            
            // Check if it's an internal link that should be intercepted
            if (this.shouldIntercept(link)) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation(); // Stop ALL other listeners
                this.navigate(link.href);
                return false;
            }
        }, true); // Use capture phase to run BEFORE other listeners

        document.addEventListener('submit', (e) => {
            const form = e.target.closest(this.options.formSelector);
            
            if (form) {
                e.preventDefault();
                this.submitForm(form);
            }
        });
    }

    shouldIntercept(link) {
        // Don't intercept if:
        if (!link.href) return false;
        
        const href = link.getAttribute('href') || '';
        
        // Skip special protocols
        if (href.startsWith('#') ||
            href.startsWith('javascript:') ||
            href.startsWith('mailto:') ||
            href.startsWith('tel:')) {
            return false;
        }
        
        // Skip if has these attributes
        if (link.hasAttribute('download') || 
            link.hasAttribute('target') ||
            link.hasAttribute('data-no-spa') || 
            link.hasAttribute('data-velocix-disabled')) {
            return false;
        }

        try {
            const url = new URL(link.href);
            
            // Only intercept same-origin links
            return url.origin === window.location.origin;
        } catch (e) {
            return false;
        }
    }

    async navigate(url, pushState = true) {
        if (this.isNavigating || url === this.currentUrl) {
            return;
        }

        this.isNavigating = true;

        try {
            this.emit('beforeNavigate', { url });

            // Fetch sambil fade out (parallel)
            const [html] = await Promise.all([
                this.fetchPage(url),
                this.fadeOut()
            ]);

            this.updateContent(html);

            if (pushState) {
                history.pushState({ 
                    url, 
                    title: document.title 
                }, '', url);
            }

            this.currentUrl = url;

            await this.fadeIn();

            // Scroll smooth tapi tidak blocking
            requestAnimationFrame(() => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            this.emit('afterNavigate', { url, html });

        } catch (error) {
            // Fallback to normal navigation
            window.location.href = url;
        } finally {
            this.isNavigating = false;
        }
    }

    async fetchPage(url) {
        if (this.cache.has(url)) {
            return this.cache.get(url);
        }

        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-Velocix-SPA': 'true',
                'Accept': 'text/html, application/json'
            },
            credentials: 'same-origin'
        });

        if (!response.ok) {
            throw new Error(`HTTP ${response.status}`);
        }

        const contentType = response.headers.get('content-type');

        if (contentType && contentType.includes('application/json')) {
            const data = await response.json();
            
            if (data.html) {
                this.updateTitle(data.title);
                this.cache.set(url, data.html);
                return data.html;
            }
            
            throw new Error('Invalid JSON response');
        }

        const html = await response.text();
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');

        const newContainer = doc.querySelector(this.options.containerSelector);
        
        if (!newContainer) {
            throw new Error('Container not found in response');
        }

        const content = newContainer.innerHTML;

        const title = doc.querySelector('title');
        if (title) {
            this.updateTitle(title.textContent);
        }

        this.cache.set(url, content);

        return content;
    }

    updateContent(html) {
        this.container.innerHTML = html;
        this.executeScripts();
        this.emit('contentUpdated', { html });
    }

    executeScripts() {
        const scripts = this.container.querySelectorAll('script');
        
        scripts.forEach(oldScript => {
            const newScript = document.createElement('script');
            
            Array.from(oldScript.attributes).forEach(attr => {
                newScript.setAttribute(attr.name, attr.value);
            });
            
            newScript.textContent = oldScript.textContent;
            oldScript.parentNode.replaceChild(newScript, oldScript);
        });
    }

    updateTitle(title) {
        if (title) {
            document.title = title;
        }
    }

    async fadeOut() {
        this.container.style.transition = `opacity ${this.options.transitionDuration}ms ease-out`;
        this.container.style.opacity = '0';
        
        return new Promise(resolve => {
            setTimeout(resolve, this.options.transitionDuration);
        });
    }

    async fadeIn() {
        // Force reflow
        this.container.offsetHeight;
        
        this.container.style.opacity = '1';
        
        return new Promise(resolve => {
            setTimeout(() => {
                this.container.style.transition = '';
                resolve();
            }, this.options.transitionDuration);
        });
    }

    async submitForm(form) {
        try {
            this.emit('beforeSubmit', { form });

            const formData = new FormData(form);
            const method = (form.method || 'POST').toUpperCase();
            const action = form.action || window.location.href;

            const response = await fetch(action, {
                method,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-Velocix-SPA': 'true',
                    'Accept': 'application/json'
                },
                body: formData,
                credentials: 'same-origin'
            });

            const data = await response.json();

            if (!response.ok) {
                this.emit('submitError', { form, data, response });
                return;
            }

            this.emit('afterSubmit', { form, data, response });

            if (data.redirect) {
                this.navigate(data.redirect);
            } else if (data.html) {
                await this.fadeOut();
                this.updateContent(data.html);
                await this.fadeIn();
            }

        } catch (error) {
            this.emit('submitError', { form, error });
        }
    }

    handlePopState() {
        window.addEventListener('popstate', (e) => {
            if (e.state && e.state.url) {
                this.navigate(e.state.url, false);
            }
        });
    }

    clearCache() {
        this.cache.clear();
    }

    prefetch(url) {
        if (!this.cache.has(url)) {
            this.fetchPage(url).catch(() => {});
        }
    }

    emit(eventName, detail = {}) {
        const event = new CustomEvent(`velocix:${eventName}`, {
            detail,
            bubbles: true,
            cancelable: true
        });

        window.dispatchEvent(event);
    }
}

// Auto-initialize
let velocixRouter;

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        velocixRouter = new VelocixRouter({
            debug: false
        });
    });
} else {
    velocixRouter = new VelocixRouter({
        debug: false
    });
}

window.VelocixRouter = VelocixRouter;
window.velocix = velocixRouter;

// Prefetch on hover (optional)
document.addEventListener('mouseover', (e) => {
    const link = e.target.closest('a[data-velocix-link][data-velocix-prefetch]');
    
    if (link && velocixRouter) {
        velocixRouter.prefetch(link.href);
    }
});