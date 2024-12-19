<?php

// Define constants for database connection settings if not already defined
if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');        // Database host (localhost)
}

if (!defined('DB_NAME')) {
    define('DB_NAME', 'wisata_sindangkasih');  // Database name
}

if (!defined('DB_USER')) {
    define('DB_USER', 'root');             // Username (default for MAMP is 'root')
}

if (!defined('DB_PASS')) {
    define('DB_PASS', 'root');             // Password (default for MAMP is 'root')
}

// Set the default timezone
date_default_timezone_set('Asia/Jakarta');  // Set to your preferred timezone

// Define base URLs if not already defined
if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://localhost:8888/desa-wisata/');
}

if (!defined('ADMIN_BASE_URL')) {
    define('ADMIN_BASE_URL', 'http://localhost:8888/desa-wisata/admin');
}

// You can add other configuration variables here as needed

?>
