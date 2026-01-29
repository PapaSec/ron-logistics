<?php
// Clear config cache
@unlink(__DIR__ . '/../bootstrap/cache/config.php');

// Clear route cache
@unlink(__DIR__ . '/../bootstrap/cache/routes-v7.php');

// Clear compiled views
array_map('unlink', glob(__DIR__ . '/../storage/framework/views/*.php'));

echo "✅ Cache cleared!";