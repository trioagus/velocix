# Velocix Framework

<p align="center">
  <strong>⚡ Lightning-fast PHP Framework with Built-in SPA Support</strong>
</p>

<p align="center">
  <a href="https://packagist.org/packages/trioagus/velocix-framework"><img src="https://img.shields.io/packagist/v/trioagus/velocix-framework.svg" alt="Latest Version"></a>
  <a href="https://packagist.org/packages/trioagus/velocix-framework"><img src="https://img.shields.io/packagist/dt/trioagus/velocix-framework?cache=300" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/trioagus/velocix-framework"><img src="https://img.shields.io/packagist/l/trioagus/velocix-framework" alt="License"></a>
  <a href="https://packagist.org/packages/trioagus/velocix-framework"><img src="https://img.shields.io/packagist/php-v/trioagus/velocix-framework" alt="PHP Version"></a>
</p>

---

## About Velocix

Velocix is a modern PHP framework designed for building fast, scalable web applications with a focus on developer experience and performance.

### Why Velocix?

- 🚀 **Lightning Fast** - Optimized routing with minimal overhead
- 🎨 **Modern Architecture** - Clean, modular design following best practices
- 🔐 **Secure by Default** - XSS protection, CSRF tokens, prepared statements
- 💾 **Powerful ORM** - Elegant database interactions with query builder
- 🎭 **Blade-like Templates** - Intuitive Velocix templating engine
- 🌐 **SPA Ready** - Built-in JavaScript router for seamless navigation
- 📦 **DI Container** - Powerful dependency injection
- ✅ **Form Validation** - Comprehensive validation rules
- 🔄 **Middleware Pipeline** - Clean request/response handling
- 📝 **PSR-4 Logger** - Standard logging interface
- 🎯 **Beautiful Errors** - Clean error pages for dev and production

## Installation

```bash
composer require trioagus/velocix-framework
```

Or create a new project with the starter kit:

```bash
composer create-project velocix/velocix my-app
cd my-app
php velocix serve
```

## Quick Example

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Velocix\Foundation\Application;
use Velocix\Http\Request;

$app = new Application(__DIR__);

$router = $app->router();

$router->get('/', function(Request $request) {
    return 'Hello, Velocix!';
});

$router->get('/users/{id}', 'UserController@show');

$app->run();
```

## Core Components

### Routing

```php
// Basic routes
$router->get('/posts', 'PostController@index');
$router->post('/posts', 'PostController@store');
$router->put('/posts/{id}', 'PostController@update');
$router->delete('/posts/{id}', 'PostController@destroy');

// Route groups
$router->group(['prefix' => 'api', 'middleware' => AuthMiddleware::class], function($router) {
    $router->get('/profile', 'ProfileController@show');
});
```

### Database & ORM

```php
use App\Models\User;

// Query builder
$users = User::where('active', true)
    ->orderBy('created_at', 'desc')
    ->limit(10)
    ->get();

// Create
$user = User::create([
    'name' => 'John Doe',
    'email' => 'john@example.com'
]);

// Update
$user->update(['name' => 'Jane Doe']);

// Delete
$user->delete();

// Relationships
$user = User::find(1);
$posts = $user->posts(); // One-to-Many
$profile = $user->profile(); // One-to-One
$roles = $user->roles(); // Many-to-Many
```

### Authentication

```php
use Velocix\Auth\Auth;

// Login
if (Auth::attempt(['email' => $email, 'password' => $password])) {
    // Success
}

// Check authentication
if (Auth::check()) {
    $user = Auth::user();
}

// Logout
Auth::logout();
```

### Validation

```php
use Velocix\Validation\Validator;

$validator = Validator::make($request->all(), [
    'name' => 'required|min:3|max:255',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|min:6|confirmed',
]);

if ($validator->fails()) {
    return response()->json(['errors' => $validator->errors()], 422);
}
```

## Requirements

- PHP 8.0 or higher
- PDO extension
- JSON extension
- Mbstring extension

## Documentation

- **Starter Kit:** [github.com/trioagus/velocix](https://github.com/trioagus/velocix)
- **Full Docs:** [velocix.dev/docs](https://velocix.dev/docs) *(coming soon)*
- **API Reference:** [velocix.dev/api](https://velocix.dev/api) *(coming soon)*

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Security

If you discover any security issues, please email pribadiagus321@gmail.com instead of using the issue tracker.

## License

The Velocix framework is open-sourced software licensed under the [MIT license](LICENSE).

## Credits

Created and maintained by **Trio Agus Susanto**

- Email: pribadiagus321@gmail.com
- GitHub: [@trioagus](https://github.com/trioagus)

## Support

- 🐛 Issues: [GitHub Issues](https://github.com/trioagus/velocix-framework/issues)
- 💬 Discussions: [GitHub Discussions](https://github.com/trioagus/velocix-framework/discussions)

---

<p align="center">
  <strong>⚡ Built with Velocix - Fast, Modern, Powerful</strong>
</p>