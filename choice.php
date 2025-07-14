<?php
require_once '../app/config.php';
require_once '../app/room_data.php';

if (!isset($_SESSION['initialized'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: corridor.php');
    exit;
}

$room_x = intval($_POST['room_x'] ?? 0);
$room_y = intval($_POST['room_y'] ?? 0);
$choice_index = intval($_POST['choice_index'] ?? -1);

$choices = getRoomChoices($room_x, $room_y);

if ($choice_index < 0 || $choice_index >= count($choices)) {
    header('Location: room.php?x=' . $room_x . '&y=' . $room_y . '&error=invalid_choice');
    exit;
}

$selected_choice = $choices[$choice_index];

// Apply choice effects
if (isset($selected_choice['effects'])) {
    foreach ($selected_choice['effects'] as $effect => $value) {
        switch ($effect) {
            case 'sanity':
                // Reduce sanity cost for brave players with high investigation score
                $investigation = $_SESSION['game_state']['investigation_score'];
                if ($value < 0 && $investigation > 50) {
                    $value = intval($value * 0.7); // 30% reduction in sanity cost
                }
                adjustSanity($value);
                break;
                
            case 'investigation_score':
                adjustInvestigationScore($value);
                break;
                
            case 'trigger_ending':
                header('Location: end.php?ending=' . $value);
                exit;
                
            case 'all_knowledge':
                foreach ($_SESSION['knowledge'] as $category => $current) {
                    addKnowledge($category, $value);
                }
                break;
                
            default:
                if (isset($_SESSION['knowledge'][$effect])) {
                    addKnowledge($effect, $value);
                }
                break;
        }
    }
}

// Apply investigation points
if (isset($selected_choice['investigation_points'])) {
    adjustInvestigationScore($selected_choice['investigation_points']);
}

// Check for room unlocks based on new knowledge state
checkAndUnlockRooms();

// Increment loop count if returning to central hub
if ($room_x == 2 && $room_y == 2) {
    $_SESSION['game_state']['loop_count']++;
}

// Check ending conditions after choice effects
$ending = checkEndingConditions();
if ($ending) {
    header('Location: end.php?ending=' . $ending);
    exit;
}

// Return to corridor or room based on context
header('Location: corridor.php?choice_made=1');
exit;

function checkAndUnlockRooms() {
    $knowledge = $_SESSION['knowledge'];
    $investigation = $_SESSION['game_state']['investigation_score'];
    $sanity = $_SESSION['game_state']['sanity'];
    
    // Memory Chambers unlocking
    if ($knowledge['memory_fragments'] >= 1) {
        unlockRoom(0, 1); // Childhood Echo
    }
    if ($knowledge['digital_nature'] >= 1) {
        unlockRoom(0, 2); // Identity Vault
    }
    if ($knowledge['memory_fragments'] >= 2) {
        unlockRoom(0, 3); // Purpose Room
    }
    if ($sanity >= 60 && $knowledge['digital_nature'] >= 3) {
        unlockRoom(0, 4); // First Death
    }
    
    // Quantum Labs unlocking
    if ($knowledge['digital_nature'] >= 1) {
        unlockRoom(1, 1); // Superposition Chamber
    }
    if ($knowledge['quantum_physics'] >= 1) {
        unlockRoom(1, 2); // Entanglement Lab
    }
    if ($knowledge['quantum_physics'] >= 2) {
        unlockRoom(1, 3); // Observer Effect Room
    }
    if ($knowledge['quantum_physics'] >= 3) {
        unlockRoom(1, 4); // Quantum Tunnel
    }
    
    // System Architecture unlocking
    if ($knowledge['digital_nature'] >= 2) {
        unlockRoom(2, 1); // Memory Banks
    }
    if ($knowledge['system_architecture'] >= 1) {
        unlockRoom(2, 3); // Security Protocols
    }
    if ($knowledge['system_architecture'] >= 3) {
        unlockRoom(2, 4); // Admin Access
    }
    
    // Paradox Chambers unlocking (require courage)
    if ($investigation >= 20) {
        unlockRoom(3, 0); // Infinite Loop
    }
    if ($knowledge['digital_nature'] >= 3) {
        unlockRoom(3, 1); // Self Reference
    }
    if ($knowledge['quantum_physics'] >= 3) {
        unlockRoom(3, 2); // Bootstrap Paradox
    }
    if ($knowledge['memory_fragments'] >= 3) {
        unlockRoom(3, 3); // Ship of Theseus
    }
    if ($knowledge['system_architecture'] >= 4) {
        unlockRoom(3, 4); // Gödel's Prison
    }
    
    // Escape Nodes unlocking
    if (min($knowledge) >= 3) {
        unlockRoom(4, 0); // Transcendence Gate
    }
    if ($knowledge['quantum_physics'] >= 4 && $knowledge['system_architecture'] >= 3) {
        unlockRoom(4, 1); // Reality Breach
    }
    if ($knowledge['system_architecture'] >= 4 && $knowledge['escape_methods'] >= 3) {
        unlockRoom(4, 2); // System Override
    }
    if ($knowledge['memory_fragments'] >= 4) {
        unlockRoom(4, 3); // Memory Void
    }
    
    // Paradox Core requires visiting all paradox rooms
    $paradox_rooms = [[3,0], [3,1], [3,2], [3,3], [3,4]];
    $visited_paradox = 0;
    foreach ($paradox_rooms as $room) {
        if (in_array($room, $_SESSION['game_state']['visited_rooms'])) {
            $visited_paradox++;
        }
    }
    if ($visited_paradox >= 5 && min($knowledge) >= 2) {
        unlockRoom(4, 4); // Paradox Core
    }
}
?>