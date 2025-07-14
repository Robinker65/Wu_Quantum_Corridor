<?php
require_once '../app/config.php';
require_once '../app/room_data.php';

if (!isset($_SESSION['initialized'])) {
    header('Location: index.php');
    exit;
}

$x = intval($_GET['x'] ?? 0);
$y = intval($_GET['y'] ?? 0);

if ($x < 0 || $x > 4 || $y < 0 || $y > 4) {
    header('Location: corridor.php');
    exit;
}

if (!isRoomUnlocked($x, $y)) {
    header('Location: corridor.php?error=locked');
    exit;
}

visitRoom($x, $y);

$ending = checkEndingConditions();
if ($ending) {
    header('Location: end.php?ending=' . $ending);
    exit;
}

$room_data = getRoomData($x, $y);
$choices = getRoomChoices($x, $y);
$knowledge = $_SESSION['knowledge'];
$sanity = $_SESSION['game_state']['sanity'];

// Determine which description to show based on knowledge
$description = $room_data['base_description'];
$can_see_enhanced = true;

if (isset($room_data['knowledge_requirements'])) {
    foreach ($room_data['knowledge_requirements'] as $req_category => $req_level) {
        if ($req_category === 'all') {
            $can_see_enhanced = min($knowledge) >= $req_level;
        } else {
            if ($knowledge[$req_category] < $req_level) {
                $can_see_enhanced = false;
                break;
            }
        }
    }
}

if ($can_see_enhanced && isset($room_data['enhanced_description'])) {
    $description = $room_data['enhanced_description'];
}

// Filter choices based on requirements
$available_choices = [];
foreach ($choices as $choice) {
    $can_choose = true;
    
    if (isset($choice['requirements'])) {
        foreach ($choice['requirements'] as $req_type => $req_value) {
            switch ($req_type) {
                case 'sanity':
                    if ($sanity < $req_value) $can_choose = false;
                    break;
                case 'investigation_score':
                    if ($_SESSION['game_state']['investigation_score'] < $req_value) $can_choose = false;
                    break;
                case 'visited_paradox_rooms':
                    $paradox_rooms = [[3,0], [3,1], [3,2], [3,3], [3,4]];
                    $visited_paradox = 0;
                    foreach ($paradox_rooms as $room) {
                        if (in_array($room, $_SESSION['game_state']['visited_rooms'])) $visited_paradox++;
                    }
                    if ($visited_paradox < $req_value) $can_choose = false;
                    break;
                default:
                    if (isset($knowledge[$req_type]) && $knowledge[$req_type] < $req_value) {
                        $can_choose = false;
                    }
                    break;
            }
        }
    }
    
    if ($can_choose) {
        $available_choices[] = $choice;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($room_data['title']); ?> - Quantum Corridor</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body class="room-page">
    <div class="container">
        <header class="room-header">
            <div class="room-title">
                <h1 class="<?php echo $can_see_enhanced ? 'enhanced' : ''; ?>">
                    <?php echo htmlspecialchars($room_data['title']); ?>
                </h1>
                <div class="room-coordinates">Coordinates: (<?php echo $x; ?>, <?php echo $y; ?>)</div>
            </div>
            
            <div class="room-stats">
                <div class="stat-group">
                    <span class="stat-label">Sanity:</span>
                    <span class="stat-value sanity-<?php echo $sanity < 20 ? 'critical' : ($sanity < 50 ? 'low' : 'normal'); ?>">
                        <?php echo $sanity; ?>
                    </span>
                </div>
                <a href="corridor.php" class="back-link">Return to Corridor</a>
                <a href="restart.php" class="restart-link" onclick="return confirm('Are you sure you want to restart? All progress will be lost.');">Restart Game</a>
            </div>
        </header>

        <div class="room-content">
            <div class="room-description <?php echo $can_see_enhanced ? 'enhanced' : 'basic'; ?>">
                <p class="typewriter"><?php echo htmlspecialchars($description); ?></p>
            </div>

            <div class="choices-container">
                <h3>Available Actions:</h3>
                <form action="choice.php" method="POST" class="choices-form">
                    <input type="hidden" name="room_x" value="<?php echo $x; ?>">
                    <input type="hidden" name="room_y" value="<?php echo $y; ?>">
                    
                    <?php foreach ($available_choices as $index => $choice): ?>
                        <div class="choice-option">
                            <button type="submit" name="choice_index" value="<?php echo $index; ?>" class="choice-btn">
                                <?php echo htmlspecialchars($choice['text']); ?>
                                
                                <?php if (isset($choice['effects'])): ?>
                                    <div class="choice-effects">
                                        <?php foreach ($choice['effects'] as $effect => $value): ?>
                                            <?php if ($effect === 'sanity'): ?>
                                                <span class="effect <?php echo $value < 0 ? 'negative' : 'positive'; ?>">
                                                    Sanity: <?php echo $value > 0 ? '+' : ''; ?><?php echo $value; ?>
                                                </span>
                                            <?php elseif ($effect === 'trigger_ending'): ?>
                                                <span class="effect ending">
                                                    ENDING: <?php echo strtoupper($value); ?>
                                                </span>
                                            <?php elseif (isset($knowledge[$effect])): ?>
                                                <span class="effect positive">
                                                    <?php echo ucfirst(str_replace('_', ' ', $effect)); ?>: +<?php echo $value; ?>
                                                </span>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        
                                        <?php if (isset($choice['investigation_points'])): ?>
                                            <span class="effect <?php echo $choice['investigation_points'] < 0 ? 'negative' : 'positive'; ?>">
                                                Investigation: <?php echo $choice['investigation_points'] > 0 ? '+' : ''; ?><?php echo $choice['investigation_points']; ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </button>
                        </div>
                    <?php endforeach; ?>
                    
                    <?php if (empty($available_choices)): ?>
                        <p class="no-choices">No actions available. Your current state prevents any meaningful interaction with this room.</p>
                        <a href="corridor.php" class="back-link-large">Return to Corridor</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <div class="room-knowledge-panel">
            <h4>Room Analysis</h4>
            <div class="knowledge-hints">
                <?php if (!$can_see_enhanced && !empty($room_data['knowledge_requirements'])): ?>
                    <p class="hint">Enhanced information available with more knowledge:</p>
                    <ul>
                        <?php foreach ($room_data['knowledge_requirements'] as $req_category => $req_level): ?>
                            <li>
                                <?php echo ucfirst(str_replace('_', ' ', $req_category)); ?>: 
                                <?php echo $knowledge[$req_category] ?? 0; ?>/<?php echo $req_level; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="enhanced-indicator">Enhanced information unlocked</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>