<?php
// Check if we're running on Vercel
if (isset($_ENV['VERCEL'])) {
    require __DIR__ . '/../public/index.php';
} else {
    require __DIR__ . '/index.php';
}
