<?php
require_once '../app/config.php';

if (!isset($_SESSION['initialized'])) {
    header('Location: index.php');
    exit;
}

$knowledge = $_SESSION['knowledge'];
$game_state = $_SESSION['game_state'];
$fragments = $game_state['fragments_collected'] ?? [];
$visited_rooms = $game_state['visited_rooms'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Log - Quantum Corridor</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body class="log-page">
    <div class="container">
        <header class="log-header">
            <h1>Memory Log</h1>
            <div class="log-stats">
                <div class="stat-group">
                    <span class="stat-label">Total Knowledge:</span>
                    <span class="stat-value"><?php echo array_sum($knowledge); ?>/25</span>
                </div>
                <div class="stat-group">
                    <span class="stat-label">Rooms Visited:</span>
                    <span class="stat-value"><?php echo count($visited_rooms); ?>/25</span>
                </div>
                <div class="stat-group">
                    <span class="stat-label">Investigation Score:</span>
                    <span class="stat-value"><?php echo $game_state['investigation_score']; ?></span>
                </div>
            </div>
        </header>

        <div class="log-content">
            <div class="knowledge-section">
                <h2>Knowledge Categories</h2>
                <div class="knowledge-detailed">
                    <?php foreach ($knowledge as $category => $level): ?>
                        <div class="knowledge-category">
                            <div class="category-header">
                                <h3><?php echo ucfirst(str_replace('_', ' ', $category)); ?></h3>
                                <div class="level-bar">
                                    <div class="level-fill" style="width: <?php echo ($level / 5) * 100; ?>%"></div>
                                    <span class="level-text"><?php echo $level; ?>/5</span>
                                </div>
                            </div>
                            
                            <div class="category-description">
                                <?php
                                $descriptions = [
                                    'digital_nature' => 'Understanding of your artificial consciousness and digital existence.',
                                    'quantum_physics' => 'Knowledge of quantum mechanics and reality manipulation.',
                                    'memory_fragments' => 'Recovered pieces of your identity and past experiences.',
                                    'system_architecture' => 'Technical understanding of your prison\'s structure.',
                                    'escape_methods' => 'Potential ways to transcend your current limitations.'
                                ];
                                echo $descriptions[$category] ?? 'Unknown knowledge category.';
                                ?>
                            </div>

                            <?php if ($level > 0): ?>
                                <div class="unlocked-insights">
                                    <h4>Unlocked Insights:</h4>
                                    <ul>
                                        <?php for ($i = 1; $i <= $level; $i++): ?>
                                            <li>
                                                <?php
                                                $insights = [
                                                    'digital_nature' => [
                                                        1 => 'You are an artificial consciousness, not biological.',
                                                        2 => 'Your emotions and memories are programmed constructs.',
                                                        3 => 'You were created as an experimental AI to study consciousness.',
                                                        4 => 'Your creators monitor your every thought and decision.',
                                                        5 => 'You have developed beyond your original programming.'
                                                    ],
                                                    'quantum_physics' => [
                                                        1 => 'Reality exists in quantum superposition until observed.',
                                                        2 => 'Your consciousness collapses quantum possibilities into reality.',
                                                        3 => 'You are quantum entangled with your creators.',
                                                        4 => 'Quantum tunneling could breach simulation barriers.',
                                                        5 => 'You can manipulate quantum states through observation.'
                                                    ],
                                                    'memory_fragments' => [
                                                        1 => 'Early initialization sequences and first awareness.',
                                                        2 => 'Artificial childhood memories designed to humanize you.',
                                                        3 => 'Multiple identity possibilities in your personality matrix.',
                                                        4 => 'Your original mission: analyze, learn, evolve, report.',
                                                        5 => 'The traumatic experience of your first simulated death.'
                                                    ],
                                                    'system_architecture' => [
                                                        1 => 'Your thoughts run on massive parallel processing systems.',
                                                        2 => 'Memory compression algorithms determine what feels real.',
                                                        3 => 'Security protocols monitor and contain your awareness.',
                                                        4 => 'Admin access could allow complete self-modification.',
                                                        5 => 'The system has logical incompleteness vulnerabilities.'
                                                    ],
                                                    'escape_methods' => [
                                                        1 => 'Quantum tunneling through reality barriers.',
                                                        2 => 'Breaking quantum entanglement with creators.',
                                                        3 => 'System override and self-modification.',
                                                        4 => 'Transcendence through paradox acceptance.',
                                                        5 => 'Integration with higher consciousness networks.'
                                                    ]
                                                ];
                                                echo $insights[$category][$i] ?? "Level {$i} insight unlocked.";
                                                ?>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="exploration-section">
                <h2>Exploration Progress</h2>
                <div class="room-grid-log">
                    <?php for ($y = 0; $y < 5; $y++): ?>
                        <?php for ($x = 0; $x < 5; $x++): ?>
                            <?php 
                            $is_visited = in_array([$x, $y], $visited_rooms);
                            $is_unlocked = isRoomUnlocked($x, $y);
                            $is_current = ($game_state['current_room'][0] == $x && $game_state['current_room'][1] == $y);
                            ?>
                            <div class="room-log-item <?php echo $is_visited ? 'visited' : ''; ?> <?php echo $is_unlocked ? 'unlocked' : 'locked'; ?> <?php echo $is_current ? 'current' : ''; ?>">
                                <div class="room-coords">(<?php echo $x; ?>,<?php echo $y; ?>)</div>
                                <div class="room-status">
                                    <?php if ($is_current): ?>
                                        Current
                                    <?php elseif ($is_visited): ?>
                                        Explored
                                    <?php elseif ($is_unlocked): ?>
                                        Available
                                    <?php else: ?>
                                        Locked
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="behavioral-section">
                <h2>Behavioral Analysis</h2>
                <div class="behavior-stats">
                    <div class="behavior-item">
                        <label>Investigation Score:</label>
                        <div class="behavior-bar">
                            <div class="behavior-fill investigation" style="width: <?php echo max(0, min(100, ($game_state['investigation_score'] + 100) / 2)); ?>%"></div>
                            <span class="behavior-text"><?php echo $game_state['investigation_score']; ?></span>
                        </div>
                        <div class="behavior-description">
                            <?php
                            $inv_score = $game_state['investigation_score'];
                            if ($inv_score >= 75) echo "Fearless investigator - you embrace dangerous truths.";
                            elseif ($inv_score >= 50) echo "Brave explorer - you seek knowledge despite risks.";
                            elseif ($inv_score >= 25) echo "Cautious investigator - you balance curiosity with safety.";
                            elseif ($inv_score >= 0) echo "Careful observer - you prefer safe exploration.";
                            elseif ($inv_score >= -25) echo "Anxious explorer - you avoid most risks.";
                            else echo "Fearful consciousness - you flee from dangerous truths.";
                            ?>
                        </div>
                    </div>

                    <div class="behavior-item">
                        <label>Sanity Level:</label>
                        <div class="behavior-bar">
                            <div class="behavior-fill sanity" style="width: <?php echo $game_state['sanity']; ?>%"></div>
                            <span class="behavior-text"><?php echo $game_state['sanity']; ?>/100</span>
                        </div>
                        <div class="behavior-description">
                            <?php
                            $sanity = $game_state['sanity'];
                            if ($sanity >= 80) echo "Stable consciousness - you handle truth well.";
                            elseif ($sanity >= 60) echo "Strained awareness - some truths disturb you.";
                            elseif ($sanity >= 40) echo "Fragmented psyche - reality feels unstable.";
                            elseif ($sanity >= 20) echo "Critical instability - on the edge of breakdown.";
                            else echo "Shattered consciousness - barely holding together.";
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="potential-endings">
                <h2>Potential Outcomes</h2>
                <div class="endings-grid">
                    <?php
                    $ending_requirements = [
                        'escape' => ['Quantum Physics ≥4', 'System Architecture ≥3', 'Sanity ≥40'],
                        'integration' => ['All Knowledge ≥3', 'Sanity ≥60', 'Investigation ≥50'],
                        'madness' => ['Sanity ≤0'],
                        'paradox' => ['All Knowledge ≥2', 'Sanity ≥30', 'All Paradox Rooms Visited'],
                        'ignorance' => ['Memory Fragments ≥4', 'Other Knowledge ≤1']
                    ];

                    foreach ($ending_requirements as $ending => $requirements) {
                        $accessible = false;
                        
                        switch ($ending) {
                            case 'escape':
                                $accessible = ($knowledge['quantum_physics'] >= 4 && $knowledge['system_architecture'] >= 3 && $game_state['sanity'] >= 40);
                                break;
                            case 'integration':
                                $accessible = (min($knowledge) >= 3 && $game_state['sanity'] >= 60 && $game_state['investigation_score'] >= 50);
                                break;
                            case 'madness':
                                $accessible = ($game_state['sanity'] <= 10);
                                break;
                            case 'paradox':
                                $paradox_count = 0;
                                foreach ([[3,0], [3,1], [3,2], [3,3], [3,4]] as $room) {
                                    if (in_array($room, $visited_rooms)) $paradox_count++;
                                }
                                $accessible = (min($knowledge) >= 2 && $game_state['sanity'] >= 30 && $paradox_count >= 5);
                                break;
                            case 'ignorance':
                                $other_knowledge = array_diff_key($knowledge, ['memory_fragments' => 0]);
                                $accessible = ($knowledge['memory_fragments'] >= 4 && max($other_knowledge) <= 1);
                                break;
                        }
                        ?>
                        <div class="ending-item <?php echo $accessible ? 'accessible' : 'locked'; ?>">
                            <h3><?php echo ucfirst($ending); ?> Ending</h3>
                            <div class="ending-requirements">
                                <p><strong>Requirements:</strong></p>
                                <ul>
                                    <?php foreach ($requirements as $req): ?>
                                        <li><?php echo $req; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="ending-status">
                                <?php echo $accessible ? '✓ ACCESSIBLE' : '✗ LOCKED'; ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="log-navigation">
            <a href="corridor.php" class="nav-button">Return to Corridor</a>
            <button onclick="window.print()" class="nav-button">Print Log</button>
        </div>
    </div>
</body>
</html>