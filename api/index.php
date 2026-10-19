<?php

// Pastikan direktori writable di /tmp untuk serverless Vercel
$tmpDirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/cache',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($tmpDirs as $dir) {
    if (! is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Inisialisasi file SQLite di /tmp jika berjalan di Vercel
$tmpDb = '/tmp/database.sqlite';
$sourceDb = dirname(__DIR__).'/database/database.sqlite';

if (! file_exists($tmpDb)) {
    if (file_exists($sourceDb) && filesize($sourceDb) > 0) {
        @copy($sourceDb, $tmpDb);
    } else {
        @touch($tmpDb);
    }
}

require __DIR__.'/../public/index.php';
