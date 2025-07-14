<?php
session_start();

function initializeGame($player_id = null) {
    if ($player_id) {
        srand(crc32($player_id));
    }
    
    $_SESSION['player_id'] = $player_id ?: 'anonymous_' . time();
    $_SESSION['knowledge'] = [
        'digital_nature' => 0,
        'quantum_physics' => 0,
        'memory_fragments' => 0,
        'system_architecture' => 0,
        'escape_methods' => 0
    ];
    
    $_SESSION['game_state'] = [
        'sanity' => 100,
        'investigation_score' => 0,
        'current_room' => [2, 2],
        'visited_rooms' => [[2, 2]],
        'unlocked_rooms' => [[2, 2], [1, 2], [3, 2], [2, 1], [2, 3], [1, 0], [2, 0], [0, 0]],
        'loop_count' => 0,
        'fragments_collected' => []
    ];
    
    $_SESSION['initialized'] = true;
}

function getKnowledgeLevel($category) {
    return $_SESSION['knowledge'][$category] ?? 0;
}

function addKnowledge($category, $amount) {
    if (isset($_SESSION['knowledge'][$category])) {
        $_SESSION['knowledge'][$category] = min(5, $_SESSION['knowledge'][$category] + $amount);
    }
}

function adjustSanity($amount) {
    $_SESSION['game_state']['sanity'] = max(0, min(100, $_SESSION['game_state']['sanity'] + $amount));
}

function adjustInvestigationScore($amount) {
    $_SESSION['game_state']['investigation_score'] = max(-100, min(100, $_SESSION['game_state']['investigation_score'] + $amount));
}

function isRoomUnlocked($x, $y) {
    return in_array([$x, $y], $_SESSION['game_state']['unlocked_rooms']);
}

function unlockRoom($x, $y) {
    if (!isRoomUnlocked($x, $y)) {
        $_SESSION['game_state']['unlocked_rooms'][] = [$x, $y];
    }
}

function visitRoom($x, $y) {
    $_SESSION['game_state']['current_room'] = [$x, $y];
    if (!in_array([$x, $y], $_SESSION['game_state']['visited_rooms'])) {
        $_SESSION['game_state']['visited_rooms'][] = [$x, $y];
    }
}

function checkEndingConditions() {
    $knowledge = $_SESSION['knowledge'];
    $sanity = $_SESSION['game_state']['sanity'];
    $investigation = $_SESSION['game_state']['investigation_score'];
    $visited = $_SESSION['game_state']['visited_rooms'];
    
    if ($sanity <= 0) {
        return 'madness';
    }
    
    if ($knowledge['quantum_physics'] >= 4 && $knowledge['system_architecture'] >= 3 && $sanity >= 40) {
        return 'escape';
    }
    
    
    $paradox_rooms = [[3,0], [3,1], [3,2], [3,3], [3,4]];
    $visited_paradox = 0;
    foreach ($paradox_rooms as $room) {
        if (in_array($room, $visited)) $visited_paradox++;
    }
    
    if (min($knowledge) >= 2 && $sanity >= 30 && $visited_paradox >= 5) {
        return 'paradox';
    }
    
    if ($knowledge['memory_fragments'] >= 4 && max(array_diff_key($knowledge, ['memory_fragments' => 0])) <= 1) {
        return 'ignorance';
    }
    
    return null;
}
?>