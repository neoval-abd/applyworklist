<?php
/**
 * InfinityFree Deployment Setup Script
 * 
 * This script runs migrations and seeds the database via browser.
 * IMPORTANT: Delete this file after successful setup!
 * 
 * Usage: Visit https://yourdomain.com/setup.php
 */

// Prevent running in production after setup
$secretToken = 'setup_' . md5('rekap_lamaran_2026');
if (isset($_GET['token']) && $_GET['token'] === $secretToken) {
    // Authorized
} else {
    echo '<html><body style="font-family:sans-serif;text-align:center;padding:50px;">';
    echo '<h1>Setup Requires Token</h1>';
    echo '<p>Visit: <code>setup.php?token=' . $secretToken . '</code></p>';
    echo '</body></html>';
    exit;
}

// Bootstrap Laravel
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo '<html><head><title>Setup - Rekap Lamaran</title>';
echo '<style>body{font-family:monospace;background:#1a1a2e;color:#0f0;padding:20px;} .ok{color:#0f0;} .err{color:#f00;} .info{color:#ff0;}</style>';
echo '</head><body>';
echo '<h1>Rekap Lamaran Kerja - Setup</h1>';
echo '<hr>';

try {
    // Test DB connection
    echo '<p class="info">Testing database connection...</p>';
    \DB::connection()->getPdo();
    echo '<p class="ok">&#10004; Database connected successfully!</p>';

    // Run migrations
    echo '<p class="info">Running migrations...</p>';
    \Artisan::call('migrate', ['--force' => true]);
    echo '<p class="ok">&#10004; Migrations completed!</p>';
    echo '<pre>' . \Artisan::output() . '</pre>';

    // Seed database
    echo '<p class="info">Seeding database...</p>';
    \Artisan::call('db:seed', ['--force' => true]);
    echo '<p class="ok">&#10004; Database seeded!</p>';
    echo '<pre>' . \Artisan::output() . '</pre>';

    // Clear caches
    echo '<p class="info">Clearing caches...</p>';
    \Artisan::call('config:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    echo '<p class="ok">&#10004; Caches cleared!</p>';

    // Storage link (may not work on shared hosting)
    try {
        \Artisan::call('storage:link');
        echo '<p class="ok">&#10004; Storage link created!</p>';
    } catch (\Exception $e) {
        echo '<p class="err">&#10008; Storage link: ' . $e->getMessage() . ' (this is OK on shared hosting)</p>';
    }

    echo '<hr>';
    echo '<h2 class="ok">Setup Complete!</h2>';
    echo '<p class="info">IMPORTANT: Delete this setup.php file now!</p>';
    echo '<p><a href="/" style="color:#fff;background:#2563eb;padding:10px 20px;text-decoration:none;border-radius:5px;">Go to Application</a></p>';

} catch (\Exception $e) {
    echo '<p class="err">&#10008; Error: ' . $e->getMessage() . '</p>';
    echo '<p class="info">Check your .env file and database credentials.</p>';
}

echo '</body></html>';
