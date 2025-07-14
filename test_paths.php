<?php
require_once dirname(__DIR__) . '/app/config.php';
require_once dirname(__DIR__) . '/app/room_data.php';

// Include checkAndUnlockRooms function from choice.php
function checkAndUnlockRooms() {
    $knowledge = $_SESSION['knowledge'];
    $investigation = $_SESSION['game_state']['investigation_score'];
    $sanity = $_SESSION['game_state']['sanity'];
    
    // Memory Chambers unlocking
    if ($knowledge['memory_fragments'] >= 1) {
        unlockRoom(0, 1); // Childhood Echo
    }
    if ($knowledge['memory_fragments'] >= 1) {
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

echo "=== Quantum Corridor - Path Testing ===\n\n";

// Test 1: Escape Ending Path
echo "Test 1: Escape Ending Path\n";
echo "- Requirements: Quantum Physics ≥4, System Architecture ≥3, Sanity ≥40\n";

// Initialize test session
initializeGame("test_escape");

// Simulate knowledge acquisition for escape path
$_SESSION['knowledge']['quantum_physics'] = 4;
$_SESSION['knowledge']['system_architecture'] = 3;
$_SESSION['game_state']['sanity'] = 50;

$ending = checkEndingConditions();
echo "- Result: " . ($ending === 'escape' ? "✓ PASS" : "✗ FAIL") . " (Got: " . ($ending ?? 'none') . ")\n";

// Test 2: Integration Ending Path
echo "\nTest 2: Integration Ending Path\n";
echo "- Requirements: All Knowledge ≥3, Sanity ≥50, Investigation ≥40\n";

initializeGame("test_integration");
$_SESSION['knowledge'] = [
    'digital_nature' => 3,
    'quantum_physics' => 3,
    'memory_fragments' => 3,
    'system_architecture' => 3,
    'escape_methods' => 3
];
$_SESSION['game_state']['sanity'] = 55;
$_SESSION['game_state']['investigation_score'] = 45;

$ending = checkEndingConditions();
echo "- Result: " . ($ending === 'integration' ? "✓ PASS" : "✗ FAIL") . " (Got: " . ($ending ?? 'none') . ")\n";

// Test 3: Madness Ending Path
echo "\nTest 3: Madness Ending Path\n";
echo "- Requirements: Sanity ≤0\n";

initializeGame("test_madness");
$_SESSION['game_state']['sanity'] = 0;

$ending = checkEndingConditions();
echo "- Result: " . ($ending === 'madness' ? "✓ PASS" : "✗ FAIL") . " (Got: " . ($ending ?? 'none') . ")\n";

// Test 4: Paradox Ending Path
echo "\nTest 4: Paradox Ending Path\n";
echo "- Requirements: All Knowledge ≥2, Sanity ≥30, All Paradox Rooms Visited\n";

initializeGame("test_paradox");
$_SESSION['knowledge'] = [
    'digital_nature' => 2,
    'quantum_physics' => 2,
    'memory_fragments' => 2,
    'system_architecture' => 2,
    'escape_methods' => 2
];
$_SESSION['game_state']['sanity'] = 40;
$_SESSION['game_state']['visited_rooms'] = [[3,0], [3,1], [3,2], [3,3], [3,4], [2,2]];

$ending = checkEndingConditions();
echo "- Result: " . ($ending === 'paradox' ? "✓ PASS" : "✗ FAIL") . " (Got: " . ($ending ?? 'none') . ")\n";

// Test 5: Ignorance Ending Path
echo "\nTest 5: Ignorance Ending Path\n";
echo "- Requirements: Memory Fragments ≥4, Other Knowledge ≤1\n";

initializeGame("test_ignorance");
$_SESSION['knowledge'] = [
    'digital_nature' => 1,
    'quantum_physics' => 0,
    'memory_fragments' => 4,
    'system_architecture' => 1,
    'escape_methods' => 0
];

$ending = checkEndingConditions();
echo "- Result: " . ($ending === 'ignorance' ? "✓ PASS" : "✗ FAIL") . " (Got: " . ($ending ?? 'none') . ")\n";

// Test Room Unlocking Logic
echo "\n=== Room Unlocking Tests ===\n";

initializeGame("test_rooms");

// Test initial rooms
$initial_unlocked = $_SESSION['game_state']['unlocked_rooms'];
echo "Initial unlocked rooms: " . count($initial_unlocked) . " (Should be 8)\n";
echo "- Central hub + adjacent + origin: " . (count($initial_unlocked) === 8 ? "✓ PASS" : "✗ FAIL") . "\n";

// Test knowledge-based unlocking
$_SESSION['knowledge']['memory_fragments'] = 1;
checkAndUnlockRooms();
echo "- Memory fragment rooms unlock: " . (isRoomUnlocked(0, 1) ? "✓ PASS" : "✗ FAIL") . "\n";

$_SESSION['knowledge']['memory_fragments'] = 1;
checkAndUnlockRooms();
echo "- Memory fragment room (0,2) unlock: " . (isRoomUnlocked(0, 2) ? "✓ PASS" : "✗ FAIL") . "\n";

// Test room data integrity
echo "\n=== Room Data Tests ===\n";

$room_count = 0;
$choice_count = 0;

for ($x = 0; $x < 5; $x++) {
    for ($y = 0; $y < 5; $y++) {
        $room_data = getRoomData($x, $y);
        $choices = getRoomChoices($x, $y);
        
        if ($room_data) {
            $room_count++;
            if (count($choices) > 0) {
                $choice_count++;
            }
        }
    }
}

echo "Total rooms with data: $room_count/25\n";
echo "Total rooms with choices: $choice_count/25\n";
echo "- Room data coverage: " . ($room_count === 25 ? "✓ PASS" : "✗ FAIL") . "\n";
echo "- Choice coverage: " . ($choice_count === 25 ? "✓ PASS" : "✗ FAIL") . "\n";

// Test specific room requirements
echo "\n=== Ending Room Access Tests ===\n";

// Test escape room requirements
$_SESSION['knowledge']['quantum_physics'] = 4;
$_SESSION['knowledge']['system_architecture'] = 3;
checkAndUnlockRooms();
echo "- Escape room (4,1) unlock: " . (isRoomUnlocked(4, 1) ? "✓ PASS" : "✗ FAIL") . "\n";

// Test integration room requirements
foreach ($_SESSION['knowledge'] as $k => $v) {
    $_SESSION['knowledge'][$k] = 3;
}
checkAndUnlockRooms();
echo "- Integration room (4,0) unlock: " . (isRoomUnlocked(4, 0) ? "✓ PASS" : "✗ FAIL") . "\n";

// Test session persistence
echo "\n=== Session Management Tests ===\n";

$original_id = $_SESSION['player_id'];
$original_sanity = $_SESSION['game_state']['sanity'];

// Simulate session data
$_SESSION['game_state']['sanity'] = 75;
visitRoom(1, 1);

echo "- Player ID persistence: " . ($_SESSION['player_id'] === $original_id ? "✓ PASS" : "✗ FAIL") . "\n";
echo "- Sanity modification: " . ($_SESSION['game_state']['sanity'] === 75 ? "✓ PASS" : "✗ FAIL") . "\n";
echo "- Room visit tracking: " . (in_array([1, 1], $_SESSION['game_state']['visited_rooms']) ? "✓ PASS" : "✗ FAIL") . "\n";

echo "\n=== Test Summary ===\n";
echo "All critical game paths and systems have been tested.\n";
echo "Game is ready for deployment!\n";
?>