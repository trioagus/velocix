<?php

namespace Velocix;

use Velocix\Support\ServiceProvider;

class Application
{
    protected $basePath;
    protected $bindings = [];
    protected $instances = [];
    protected $aliases = [];
    protected $serviceProviders = [];
    protected $loadedProviders = [];
    protected $booted = false;

    public function __construct($basePath = null)
    {
        if ($basePath) {
            $this->setBasePath($basePath);
        }

        $this->registerBaseBindings();
        $this->registerBaseServiceProviders();
    }

    /**
     * Set the base path for the application
     */
    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');
        return $this;
    }

    /**
     * Get the base path of the application
     */
    public function basePath($path = '')
    {
        return $this->basePath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }

    /**
     * Register the basic bindings into the container
     */
    protected function registerBaseBindings()
    {
        static::setInstance($this);

        $this->instance('app', $this);
        $this->instance(Application::class, $this);
    }

    /**
     * Register all of the base service providers
     */
    protected function registerBaseServiceProviders()
    {
        // Core service providers can be registered here
        // Example: $this->register(new EventServiceProvider($this));
    }

    /**
     * Register a service provider with the application
     *
     * @param ServiceProvider|string $provider
     * @return ServiceProvider
     */
    public function register($provider)
    {
        // If provider is a string, instantiate it
        if (is_string($provider)) {
            $provider = new $provider($this);
        }

        // Check if provider is already registered
        $providerName = get_class($provider);
        
        if (isset($this->loadedProviders[$providerName])) {
            return $provider;
        }

        // Register the provider
        $provider->register();

        // Mark as loaded
        $this->loadedProviders[$providerName] = true;
        $this->serviceProviders[] = $provider;

        // If app is already booted, boot the provider immediately
        if ($this->booted) {
            $this->bootProvider($provider);
        }

        return $provider;
    }

    /**
     * Register an array of service providers
     */
    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            $this->register($provider);
        }
    }

    /**
     * Boot the application's service providers
     */
    public function boot()
    {
        if ($this->booted) {
            return;
        }

        // Boot all registered providers
        foreach ($this->serviceProviders as $provider) {
            $this->bootProvider($provider);
        }

        $this->booted = true;
    }

    /**
     * Boot the given service provider
     */
    protected function bootProvider(ServiceProvider $provider)
    {
        if (method_exists($provider, 'boot')) {
            $provider->boot();
        }
    }

    /**
     * Register a binding with the container
     */
    public function bind($abstract, $concrete = null, $shared = false)
    {
        // Remove existing instance if it exists
        unset($this->instances[$abstract]);

        // If no concrete type was given, we will simply set the concrete type to the
        // abstract type. This will allow concrete type to be registered as shared
        // without being forced to state their classes in both of the parameters.
        if (is_null($concrete)) {
            $concrete = $abstract;
        }

        $this->bindings[$abstract] = compact('concrete', 'shared');
    }

    /**
     * Register a shared binding in the container
     */
    public function singleton($abstract, $concrete = null)
    {
        $this->bind($abstract, $concrete, true);
    }

    /**
     * Register an existing instance as shared in the container
     */
    public function instance($abstract, $instance)
    {
        $this->instances[$abstract] = $instance;
        return $instance;
    }

    /**
     * Resolve the given type from the container
     */
    public function make($abstract, array $parameters = [])
    {
        // If an instance of the type is currently being managed as a singleton,
        // we'll just return an existing instance instead of instantiating new
        // instances so the developer can keep using the same objects instance.
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        $concrete = $this->getConcrete($abstract);

        // If the concrete type is actually a Closure, we will just execute it and
        // hand back the results of the functions, which allows functions to be
        // used as resolvers for more fine-tuned resolution of these objects.
        if ($concrete instanceof \Closure) {
            $object = $concrete($this, $parameters);
        } else {
            $object = $this->build($concrete);
        }

        // If the requested type is registered as a singleton we'll cache the instance
        if ($this->isShared($abstract)) {
            $this->instances[$abstract] = $object;
        }

        return $object;
    }

    /**
     * Get the concrete type for a given abstract
     */
    protected function getConcrete($abstract)
    {
        if (isset($this->bindings[$abstract])) {
            return $this->bindings[$abstract]['concrete'];
        }

        return $abstract;
    }

    /**
     * Determine if a given type is shared
     */
    protected function isShared($abstract)
    {
        return isset($this->bindings[$abstract]['shared']) &&
               $this->bindings[$abstract]['shared'] === true;
    }

    /**
     * Instantiate a concrete instance of the given type
     */
    public function build($concrete)
    {
        // If the concrete type is actually a Closure, execute it
        if ($concrete instanceof \Closure) {
            return $concrete($this);
        }

        try {
            $reflector = new \ReflectionClass($concrete);
        } catch (\ReflectionException $e) {
            throw new \Exception("Target class [{$concrete}] does not exist.", 0, $e);
        }

        // If the type is not instantiable, throw exception
        if (!$reflector->isInstantiable()) {
            throw new \Exception("Target [{$concrete}] is not instantiable.");
        }

        $constructor = $reflector->getConstructor();

        // If there are no constructors, return new instance
        if (is_null($constructor)) {
            return new $concrete;
        }

        $dependencies = $constructor->getParameters();

        // Resolve all dependencies
        $instances = $this->resolveDependencies($dependencies);

        return $reflector->newInstanceArgs($instances);
    }

    /**
     * Resolve all of the dependencies from the ReflectionParameters
     */
    protected function resolveDependencies(array $dependencies)
    {
        $results = [];

        foreach ($dependencies as $dependency) {
            // If dependency has a type hint, resolve it
            if ($dependency->getType() && !$dependency->getType()->isBuiltin()) {
                $results[] = $this->make($dependency->getType()->getName());
            } elseif ($dependency->isDefaultValueAvailable()) {
                $results[] = $dependency->getDefaultValue();
            } else {
                throw new \Exception("Unresolvable dependency [{$dependency->getName()}]");
            }
        }

        return $results;
    }

    /**
     * Set the globally available instance of the container
     */
    public static function setInstance($container = null)
    {
        static $instance;
        return $instance = $container;
    }

    /**
     * Get the globally available instance of the container
     */
    public static function getInstance()
    {
        return static::setInstance();
    }

    /**
     * Determine if the application has booted
     */
    public function isBooted()
    {
        return $this->booted;
    }

    /**
     * Get all registered service providers
     */
    public function getProviders()
    {
        return $this->serviceProviders;
    }
}