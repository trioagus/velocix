import '../css/app.css';


// Custom app logic
document.addEventListener('DOMContentLoaded', () => {
   // console.log('DOM Ready');
   // console.log('DOM Ready');
    
    // Initialize any plugins here
    initializeApp();
});

// Listen to Velocix SPA events
window.addEventListener('velocix:beforeNavigate', (e) => {
    showLoadingIndicator();
});

window.addEventListener('velocix:afterNavigate', (e) => {
    hideLoadingIndicator();
});

window.addEventListener('velocix:contentUpdated', (e) => {
    initializePlugins();
});

// Helper functions
function showLoadingIndicator() {
    const loader = document.getElementById('velocix-loader');
    if (loader) {
        loader.classList.remove('hidden');
    }
}

function hideLoadingIndicator() {
    const loader = document.getElementById('velocix-loader');
    if (loader) {
        loader.classList.add('hidden');
    }
}

function initializePlugins() {
    console.log('Plugins initialized');
}

function initializeApp() {
    console.log('App initialized');
}

// Export for global use
window.VelocixApp = {
    showLoadingIndicator,
    hideLoadingIndicator,
    initializePlugins,
    initializeApp
};