#!/usr/bin/env php
<?php

/**
 * Velocix Interactive Installer
 * Automatically sets up a fresh Velocix project
 */

// Colors for terminal output
class Color {
    const GREEN = "\033[32m";
    const BLUE = "\033[34m";
    const YELLOW = "\033[33m";
    const RED = "\033[31m";
    const CYAN = "\033[36m";
    const RESET = "\033[0m";
    const BOLD = "\033[1m";
}

function output($message, $color = Color::RESET) {
    echo $color . $message . Color::RESET . "\n";
}

function ask($question, $default = null) {
    $prompt = Color::CYAN . $question . Color::RESET;
    if ($default !== null) {
        $prompt .= " [" . Color::YELLOW . $default . Color::RESET . "]";
    }
    $prompt .= ": ";
    
    echo $prompt;
    $input = trim(fgets(STDIN));
    
    return empty($input) && $default !== null ? $default : $input;
}

function choice($question, $options, $default = 0) {
    output("\n" . Color::BOLD . $question . Color::RESET);
    
    foreach ($options as $i => $option) {
        $marker = $i === $default ? Color::GREEN . ">" : " ";
        output("  {$marker} [{$i}] {$option}" . Color::RESET);
    }
    
    $choice = ask("\nYour choice", $default);
    
    return isset($options[$choice]) ? $choice : $default;
}

function createDirectories() {
    $directories = [
        'storage/logs',
        'storage/cache',
        'storage/framework/sessions',
        'storage/framework/views',
        'storage/framework/cache',
        'storage/app/public',
        'database/migrations',
        'database/seeders'
    ];
    
    output("\n📁 Creating directories...", Color::BLUE);
    
    foreach ($directories as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
            output("   ✓ Created: {$dir}", Color::GREEN);
        }
    }
}

function setupDatabase() {
    output("\n" . Color::BOLD . "⚙️  Database Configuration" . Color::RESET);
    output("Choose your database driver:", Color::CYAN);
    
    $dbTypes = ['SQLite', 'MySQL', 'PostgreSQL'];
    $dbChoice = choice('Select database', $dbTypes, 0);
    
    $dbConfig = [];
    
    switch ($dbChoice) {
        case 0: // SQLite
            output("\n📦 Using SQLite (zero configuration)", Color::GREEN);
            $dbConfig = [
                'DB_CONNECTION' => 'sqlite',
                'DB_DATABASE' => 'database/database.sqlite',
            ];
            
            // Create SQLite database file
            $dbFile = __DIR__ . '/database/database.sqlite';
            if (!file_exists($dbFile)) {
                touch($dbFile);
                chmod($dbFile, 0644);
                output("   ✓ Created SQLite database file", Color::GREEN);
            }
            break;
            
        case 1: // MySQL
            output("\n🐬 MySQL Configuration", Color::BLUE);
            $dbConfig = [
                'DB_CONNECTION' => 'mysql',
                'DB_HOST' => ask('Database host', '127.0.0.1'),
                'DB_PORT' => ask('Database port', '3306'),
                'DB_DATABASE' => ask('Database name', 'velocix'),
                'DB_USERNAME' => ask('Database username', 'root'),
                'DB_PASSWORD' => ask('Database password', ''),
            ];
            break;
            
        case 2: // PostgreSQL
            output("\n🐘 PostgreSQL Configuration", Color::BLUE);
            $dbConfig = [
                'DB_CONNECTION' => 'pgsql',
                'DB_HOST' => ask('Database host', '127.0.0.1'),
                'DB_PORT' => ask('Database port', '5432'),
                'DB_DATABASE' => ask('Database name', 'velocix'),
                'DB_USERNAME' => ask('Database username', 'postgres'),
                'DB_PASSWORD' => ask('Database password', ''),
            ];
            break;
    }
    
    return $dbConfig;
}

function updateEnvFile($config) {
    output("\n📝 Updating .env file...", Color::BLUE);
    
    $envFile = __DIR__ . '/.env';
    
    if (!file_exists($envFile)) {
        copy(__DIR__ . '/.env.example', $envFile);
    }
    
    $env = file_get_contents($envFile);
    
    foreach ($config as $key => $value) {
        // Escape special characters in value
        $value = addslashes($value);
        
        // Update or add the key
        if (preg_match("/^{$key}=/m", $env)) {
            $env = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $env);
        } else {
            $env .= "\n{$key}={$value}";
        }
    }
    
    file_put_contents($envFile, $env);
    output("   ✓ Environment configured", Color::GREEN);
}

function generateAppKey() {
    output("\n🔐 Generating application key...", Color::BLUE);
    
    $key = 'base64:' . base64_encode(random_bytes(32));
    
    updateEnvFile(['APP_KEY' => $key]);
    
    output("   ✓ App key generated", Color::GREEN);
}

function runMigrations() {
    output("\n📊 Database Setup", Color::BLUE);
    
    $runMigrations = ask('Do you want to run migrations now? (yes/no)', 'yes');
    
    if (strtolower($runMigrations) === 'yes' || strtolower($runMigrations) === 'y') {
        output("\n   Running migrations...", Color::YELLOW);
        passthru('php velocix migrate');
        
        $runSeeders = ask("\nDo you want to run seeders? (yes/no)", 'no');
        
        if (strtolower($runSeeders) === 'yes' || strtolower($runSeeders) === 'y') {
            output("\n   Running seeders...", Color::YELLOW);
            passthru('php velocix db:seed');
        }
    }
}

function displayWelcome() {
    output("\n" . Color::BOLD . Color::CYAN . "╔══════════════════════════════════════════════╗", Color::CYAN);
    output("║                                              ║", Color::CYAN);
    output("║          ⚡ VELOCIX INSTALLER ⚡            ║", Color::CYAN);
    output("║                                              ║", Color::CYAN);
    output("║  Fast, Modern PHP Framework with SPA Support ║", Color::CYAN);
    output("║                                              ║", Color::CYAN);
    output("╚══════════════════════════════════════════════╝" . Color::RESET);
    output("");
}

function displayCompletion($config) {
    output("\n" . Color::GREEN . Color::BOLD . "✓ Installation completed successfully!" . Color::RESET);
    output("\n" . Color::BOLD . "Next steps:" . Color::RESET);
    output("  1. Start development server:", Color::CYAN);
    output("     " . Color::YELLOW . "php velocix serve" . Color::RESET);
    output("");
    output("  2. Visit your application:", Color::CYAN);
    output("     " . Color::YELLOW . "http://localhost:8000" . Color::RESET);
    output("");
    
    if ($config['DB_CONNECTION'] === 'sqlite') {
        output("  3. Your SQLite database:", Color::CYAN);
        output("     " . Color::YELLOW . "database/database.sqlite" . Color::RESET);
    } else {
        output("  3. Your database:", Color::CYAN);
        output("     " . Color::YELLOW . "{$config['DB_CONNECTION']}://{$config['DB_HOST']}:{$config['DB_PORT']}/{$config['DB_DATABASE']}" . Color::RESET);
    }
    
    output("\n" . Color::BOLD . "Documentation:" . Color::RESET);
    output("  • Docs: " . Color::YELLOW . "https://velocix.dev/docs" . Color::RESET);
    output("  • GitHub: " . Color::YELLOW . "https://github.com/velocix/framework" . Color::RESET);
    
    output("\n" . Color::GREEN . "Happy coding! 🚀" . Color::RESET . "\n");
}

// Main installation process
try {
    displayWelcome();
    
    output("This installer will set up your Velocix project.", Color::CYAN);
    output("Press ENTER to continue or CTRL+C to cancel.\n");
    fgets(STDIN);
    
    // Step 1: Create directories
    createDirectories();
    
    // Step 2: Database configuration
    $dbConfig = setupDatabase();
    
    // Step 3: Update .env
    updateEnvFile($dbConfig);
    
    // Step 4: Generate app key
    generateAppKey();
    
    // Step 5: Set permissions
    output("\n🔒 Setting permissions...", Color::BLUE);
    if (file_exists('velocix')) {
        chmod('velocix', 0755);
        output("   ✓ Velocix CLI executable", Color::GREEN);
    }
    
    // Step 6: Dump autoload
    output("\n📦 Optimizing autoloader...", Color::BLUE);
    passthru('composer dump-autoload -o');
    
    // Step 7: Run migrations (optional)
    runMigrations();
    
    // Step 8: Display completion message
    displayCompletion($dbConfig);
    
} catch (Exception $e) {
    output("\n" . Color::RED . "✗ Installation failed!" . Color::RESET);
    output("Error: " . $e->getMessage(), Color::RED);
    exit(1);
}
