<?php
/**
 * Composer Installer for InfinityFree
 * Downloads and runs composer install on the server.
 * DELETE this file after use!
 * 
 * Usage: Visit https://yourdomain.com/install-composer.php?token=setup_8e2b19e78ff70b8d98c86f64b10a6557
 */

$secretToken = 'setup_' . md5('rekap_lamaran_2026');
if (!isset($_GET['token']) || $_GET['token'] !== $secretToken) {
    die('Unauthorized. Use: install-composer.php?token=' . $secretToken);
}

set_time_limit(300);
ini_set('memory_limit', '256M');

echo '<html><head><title>Composer Install</title>';
echo '<style>body{font-family:monospace;background:#1a1a2e;color:#0f0;padding:20px;} .ok{color:#0f0;} .err{color:#f00;} .info{color:#ff0;} pre{background:#111;padding:10px;overflow:auto;max-height:400px;}</style>';
echo '</head><body>';
echo '<h1>Composer Installer - Rekap Lamaran</h1><hr>';

// Determine project root (one level up from public/)
$projectRoot = dirname(__DIR__);
echo "<p class='info'>Project root: {$projectRoot}</p>";

// Step 1: Download composer.phar
echo '<p class="info">Step 1: Downloading Composer...</p>';
$composerPath = $projectRoot . '/composer.phar';

if (!file_exists($composerPath)) {
    $composerUrl = 'https://getcomposer.org/installer';
    $installerContent = @file_get_contents($composerUrl);
    
    if ($installerContent === false) {
        // Try alternative: direct download
        echo '<p class="info">Trying direct download...</p>';
        $composerPhar = @file_get_contents('https://getcomposer.org/composer-stable.phar');
        if ($composerPhar === false) {
            echo '<p class="err">Failed to download Composer. Trying cURL...</p>';
            $ch = curl_init('https://getcomposer.org/composer-stable.phar');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $composerPhar = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($composerPhar === false || $httpCode != 200) {
                echo '<p class="err">All download methods failed!</p>';
                echo '<p class="err">You need to upload the vendor/ folder manually.</p>';
                echo '</body></html>';
                exit;
            }
        }
        file_put_contents($composerPath, $composerPhar);
        echo '<p class="ok">Composer downloaded directly!</p>';
    } else {
        // Run the installer
        file_put_contents($projectRoot . '/composer-setup.php', $installerContent);
        echo '<p class="info">Running Composer installer...</p>';
        
        ob_start();
        include $projectRoot . '/composer-setup.php';
        $output = ob_get_clean();
        echo "<pre>{$output}</pre>";
        
        @unlink($projectRoot . '/composer-setup.php');
    }
} else {
    echo '<p class="ok">Composer already exists!</p>';
}

// Step 2: Run composer install
echo '<p class="info">Step 2: Running composer install...</p>';

// Method 1: Try using proc_open
$command = 'php ' . escapeshellarg($composerPath) . ' install --no-dev --optimize-autoloader --no-interaction --working-dir=' . escapeshellarg($projectRoot) . ' 2>&1';
echo "<p class='info'>Command: {$command}</p>";

$descriptors = [
    0 => ['pipe', 'r'],
    1 => ['pipe', 'w'],
    2 => ['pipe', 'w'],
];

$process = @proc_open($command, $descriptors, $pipes, $projectRoot);

if (is_resource($process)) {
    fclose($pipes[0]);
    $output = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    $errors = stream_get_contents($pipes[2]);
    fclose($pipes[2]);
    $exitCode = proc_close($process);
    
    echo '<pre>' . htmlspecialchars($output) . '</pre>';
    if ($errors) {
        echo '<pre class="err">' . htmlspecialchars($errors) . '</pre>';
    }
    
    if ($exitCode === 0) {
        echo '<p class="ok">&#10004; Composer install completed successfully!</p>';
    } else {
        echo '<p class="err">Exit code: ' . $exitCode . '</p>';
        echo '<p class="info">Trying alternative method...</p>';
    }
} else {
    echo '<p class="err">proc_open failed. Trying alternative...</p>';
    
    // Method 2: Try shell_exec
    $output = @shell_exec($command);
    if ($output) {
        echo '<pre>' . htmlspecialchars($output) . '</pre>';
        echo '<p class="ok">Composer install completed via shell_exec!</p>';
    } else {
        // Method 3: Try passthru
        echo '<p class="info">Trying passthru...</p>';
        ob_start();
        @passthru($command, $exitCode);
        $output = ob_get_clean();
        echo '<pre>' . htmlspecialchars($output) . '</pre>';
        
        if ($exitCode === 0) {
            echo '<p class="ok">Composer install completed via passthru!</p>';
        } else {
            echo '<p class="err">All methods failed.</p>';
            echo '<p class="info">Please upload the vendor/ folder from your local machine instead.</p>';
            echo '<p class="info">Location: C:\\Apache24\\htdocs\\applyworklist\\vendor\\</p>';
        }
    }
}

// Verify vendor exists
if (file_exists($projectRoot . '/vendor/autoload.php')) {
    echo '<hr><h2 class="ok">&#10004; vendor/autoload.php exists - Dependencies installed!</h2>';
    echo '<p class="info">Next step: <a href="/setup.php?token=' . $secretToken . '" style="color:#fff;background:#2563eb;padding:8px 16px;text-decoration:none;border-radius:5px;">Run Database Setup</a></p>';
} else {
    echo '<hr><h2 class="err">&#10008; vendor/autoload.php NOT found</h2>';
    echo '<p class="info">You need to upload the vendor/ folder manually.</p>';
    echo '<p class="info">On your PC: C:\\Apache24\\htdocs\\applyworklist\\vendor\\</p>';
    echo '<p class="info">Upload to: htdocs/vendor/ on InfinityFree</p>';
}

echo '<p class="err"><strong>IMPORTANT: Delete this file (install-composer.php) after use!</strong></p>';
echo '</body></html>';
