<?php
// Silence deprecation warnings and disable error display on Vercel to prevent headers-already-sent errors.
ini_set('display_errors', '0');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

// Check if we're running on Vercel
if (isset($_ENV['VERCEL'])) {
    require __DIR__ . '/../public/index.php';
} else {
    require __DIR__ . '/index.php';
}
