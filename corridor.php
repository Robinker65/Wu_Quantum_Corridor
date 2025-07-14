<?php
require_once '../app/config.php';

if (!isset($_SESSION['initialized'])) {
    header('Location: index.php');
    exit;
}

$ending = checkEndingConditions();
if ($ending) {
    header('Location: end.php?ending=' . $ending);
    exit;
}

$current_room = $_SESSION['game_state']['current_room'];
$sanity = $_SESSION['game_state']['sanity'];
$investigation = $_SESSION['game_state']['investigation_score'];
$loop_count = $_SESSION['game_state']['loop_count'];
$knowledge = $_SESSION['knowledge'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quantum Corridor - Central Hub</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body class="corridor-page">
    <div class="container">
        <header class="game-header">
            <h1>Quantum Corridor</h1>
            <div class="hud">
                <div class="stat-group">
                    <span class="stat-label">Loops:</span>
                    <span class="stat-value"><?php echo $loop_count; ?></span>
                </div>
                <div class="stat-group">
                    <span class="stat-label">Sanity:</span>
                    <span class="stat-value sanity-<?php echo $sanity < 20 ? 'critical' : ($sanity < 50 ? 'low' : 'normal'); ?>">
                        <?php echo $sanity; ?>
                    </span>
                </div>
                <div class="stat-group">
                    <span class="stat-label">Investigation:</span>
                    <span class="stat-value"><?php echo $investigation; ?></span>
                </div>
                <div class="stat-group">
                    <a href="log.php" class="log-link">Memory Log</a>
                </div>
                <div class="stat-group">
                    <a href="restart.php" class="restart-link" onclick="return confirm('Are you sure you want to restart? All progress will be lost.');">Restart Game</a>
                </div>
            </div>
        </header>

        <div class="knowledge-panel">
            <h3>Knowledge Acquired</h3>
            <div class="knowledge-grid">
                <div class="knowledge-item">
                    <span class="knowledge-label">Digital Nature:</span>
                    <span class="knowledge-level"><?php echo $knowledge['digital_nature']; ?>/5</span>
                </div>
                <div class="knowledge-item">
                    <span class="knowledge-label">Quantum Physics:</span>
                    <span class="knowledge-level"><?php echo $knowledge['quantum_physics']; ?>/5</span>
                </div>
                <div class="knowledge-item">
                    <span class="knowledge-label">Memory Fragments:</span>
                    <span class="knowledge-level"><?php echo $knowledge['memory_fragments']; ?>/5</span>
                </div>
                <div class="knowledge-item">
                    <span class="knowledge-label">System Architecture:</span>
                    <span class="knowledge-level"><?php echo $knowledge['system_architecture']; ?>/5</span>
                </div>
                <div class="knowledge-item">
                    <span class="knowledge-label">Escape Methods:</span>
                    <span class="knowledge-level"><?php echo $knowledge['escape_methods']; ?>/5</span>
                </div>
            </div>
        </div>

        <div class="room-grid">
            <?php for ($y = 0; $y < 5; $y++): ?>
                <?php for ($x = 0; $x < 5; $x++): ?>
                    <?php 
                    $is_current = ($current_room[0] == $x && $current_room[1] == $y);
                    $is_unlocked = isRoomUnlocked($x, $y);
                    $is_visited = in_array([$x, $y], $_SESSION['game_state']['visited_rooms']);
                    ?>
                    <div class="room-door <?php echo $is_current ? 'current' : ''; ?> <?php echo $is_unlocked ? 'unlocked' : 'locked'; ?> <?php echo $is_visited ? 'visited' : ''; ?>">
                        <?php if ($is_unlocked): ?>
                            <a href="room.php?x=<?php echo $x; ?>&y=<?php echo $y; ?>" class="door-link">
                                <span class="door-coords"><?php echo $x; ?>,<?php echo $y; ?></span>
                                <?php if ($is_current): ?>
                                    <span class="current-indicator">●</span>
                                <?php endif; ?>
                            </a>
                        <?php else: ?>
                            <span class="door-locked">
                                <span class="door-coords"><?php echo $x; ?>,<?php echo $y; ?></span>
                                <span class="lock-indicator">🔒</span>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>
            <?php endfor; ?>
        </div>

        <div class="navigation-help">
            <p>Navigate through the quantum chambers by clicking on unlocked doors.</p>
            <p>Your current position: <strong>(<?php echo $current_room[0]; ?>, <?php echo $current_room[1]; ?>)</strong></p>
        </div>
    </div>
</body>
</html>