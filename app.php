<?php
// Application configuration

// Define base paths
define('APP_ROOT', dirname(__DIR__));
define('PUBLIC_PATH', APP_ROOT . '/public');
define('APP_PATH', APP_ROOT . '/app');
define('ASSETS_PATH', APP_ROOT . '/assets');
define('DOCS_PATH', APP_ROOT . '/docs');
define('TESTS_PATH', APP_ROOT . '/tests');

// Define URLs (for use in templates)
define('BASE_URL', '/');
define('ASSETS_URL', BASE_URL . 'assets/');

// Game configuration
define('GAME_TITLE', 'Quantum Corridor');
define('GAME_SUBTITLE', 'A Knowledge-Driven Digital Consciousness Experience');

// Session configuration
ini_set('session.gc_maxlifetime', 3600); // 1 hour
session_set_cookie_params(3600);
?>