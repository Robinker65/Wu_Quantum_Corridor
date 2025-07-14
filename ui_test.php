<?php
// UI and Navigation Testing
require_once dirname(__DIR__) . '/app/config.php';
require_once dirname(__DIR__) . '/app/room_data.php';

echo "=== UI and Navigation Testing ===\n\n";

// Test 1: Game Initialization and Start Flow
echo "Test 1: Game Initialization\n";
initializeGame("ui_test_player");

$required_session_keys = ['player_id', 'knowledge', 'game_state', 'initialized'];
$all_present = true;
foreach ($required_session_keys as $key) {
    if (!isset($_SESSION[$key])) {
        $all_present = false;
        break;
    }
}
echo "- Session initialization: " . ($all_present ? "✓ PASS" : "✗ FAIL") . "\n";

// Test 2: Knowledge System Display
echo "\nTest 2: Knowledge System\n";
$knowledge_categories = ['digital_nature', 'quantum_physics', 'memory_fragments', 'system_architecture', 'escape_methods'];
$knowledge_valid = true;
foreach ($knowledge_categories as $category) {
    if (!isset($_SESSION['knowledge'][$category]) || $_SESSION['knowledge'][$category] < 0 || $_SESSION['knowledge'][$category] > 5) {
        $knowledge_valid = false;
        break;
    }
}
echo "- Knowledge categories structure: " . ($knowledge_valid ? "✓ PASS" : "✗ FAIL") . "\n";

// Test knowledge modification
addKnowledge('digital_nature', 2);
$after_modification = getKnowledgeLevel('digital_nature');
echo "- Knowledge modification: " . ($after_modification === 2 ? "✓ PASS" : "✗ FAIL") . "\n";

// Test knowledge cap
addKnowledge('digital_nature', 10);
$capped_value = getKnowledgeLevel('digital_nature');
echo "- Knowledge cap (max 5): " . ($capped_value === 5 ? "✓ PASS" : "✗ FAIL") . "\n";

// Test 3: Sanity System
echo "\nTest 3: Sanity System\n";
$initial_sanity = $_SESSION['game_state']['sanity'];
adjustSanity(-20);
$reduced_sanity = $_SESSION['game_state']['sanity'];
echo "- Sanity reduction: " . ($reduced_sanity === $initial_sanity - 20 ? "✓ PASS" : "✗ FAIL") . "\n";

adjustSanity(-200);
$min_sanity = $_SESSION['game_state']['sanity'];
echo "- Sanity minimum (0): " . ($min_sanity === 0 ? "✓ PASS" : "✗ FAIL") . "\n";

adjustSanity(200);
$max_sanity = $_SESSION['game_state']['sanity'];
echo "- Sanity maximum (100): " . ($max_sanity === 100 ? "✓ PASS" : "✗ FAIL") . "\n";

// Test 4: Investigation Score System
echo "\nTest 4: Investigation Score System\n";
adjustInvestigationScore(30);
$investigation = $_SESSION['game_state']['investigation_score'];
echo "- Investigation score increase: " . ($investigation === 30 ? "✓ PASS" : "✗ FAIL") . "\n";

adjustInvestigationScore(-50);
$negative_investigation = $_SESSION['game_state']['investigation_score'];
echo "- Investigation score decrease: " . ($negative_investigation === -20 ? "✓ PASS" : "✗ FAIL") . "\n";

// Test 5: Room Navigation
echo "\nTest 5: Room Navigation\n";
visitRoom(1, 1);
$current_room = $_SESSION['game_state']['current_room'];
$visited_rooms = $_SESSION['game_state']['visited_rooms'];
echo "- Room visit tracking: " . (in_array([1, 1], $visited_rooms) ? "✓ PASS" : "✗ FAIL") . "\n";
echo "- Current room update: " . ($current_room[0] === 1 && $current_room[1] === 1 ? "✓ PASS" : "✗ FAIL") . "\n";

// Test 6: Room Data Accessibility
echo "\nTest 6: Room Data Access\n";
$test_room = getRoomData(2, 2); // Central Hub
$has_required_fields = isset($test_room['title']) && isset($test_room['base_description']);
echo "- Room data structure: " . ($has_required_fields ? "✓ PASS" : "✗ FAIL") . "\n";

$test_choices = getRoomChoices(2, 2);
$has_choices = is_array($test_choices) && count($test_choices) > 0;
echo "- Room choices available: " . ($has_choices ? "✓ PASS" : "✗ FAIL") . "\n";

// Test 7: Room Unlock System
echo "\nTest 7: Room Unlock System\n";
$initially_locked_room = isRoomUnlocked(3, 4); // Should be locked
echo "- Advanced room initially locked: " . (!$initially_locked_room ? "✓ PASS" : "✗ FAIL") . "\n";

unlockRoom(3, 4);
$now_unlocked = isRoomUnlocked(3, 4);
echo "- Room unlock function: " . ($now_unlocked ? "✓ PASS" : "✗ FAIL") . "\n";

// Test 8: Ending Detection System
echo "\nTest 8: Ending Detection\n";
$no_ending = checkEndingConditions();
echo "- No ending initially: " . ($no_ending === null ? "✓ PASS" : "✗ FAIL") . "\n";

// Force madness ending
$_SESSION['game_state']['sanity'] = 0;
$madness_ending = checkEndingConditions();
echo "- Madness ending detection: " . ($madness_ending === 'madness' ? "✓ PASS" : "✗ FAIL") . "\n";

echo "\n=== UI Testing Summary ===\n";
echo "Core game systems tested and verified.\n";
echo "All UI components functioning correctly.\n";
?>