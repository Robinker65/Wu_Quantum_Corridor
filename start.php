<?php
require_once '../app/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['player_id'])) {
    $player_id = trim($_POST['player_id']);
    
    if (empty($player_id)) {
        header('Location: index.php?error=empty_id');
        exit;
    }
    
    initializeGame($player_id);
    header('Location: corridor.php');
    exit;
} else {
    header('Location: index.php');
    exit;
}
?>