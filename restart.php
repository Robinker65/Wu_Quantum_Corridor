<?php
require_once '../app/config.php';

// Clear all session data
session_destroy();

// Start a new session
session_start();

// Redirect back to the login page
header('Location: index.php');
exit;
?>