<?php
require_once '../app/config.php';

// Read leaderboard data
$leaderboard_file = 'leaderboard.csv';
$entries = [];

if (file_exists($leaderboard_file)) {
    $handle = fopen($leaderboard_file, 'r');
    if ($handle) {
        while (($data = fgetcsv($handle)) !== false) {
            if (count($data) >= 8) {
                $entries[] = [
                    'player_id' => $data[0],
                    'ending_type' => $data[1],
                    'total_knowledge' => intval($data[2]),
                    'investigation' => intval($data[3]),
                    'sanity' => intval($data[4]),
                    'loops' => intval($data[5]),
                    'score' => intval($data[6]),
                    'timestamp' => $data[7]
                ];
            }
        }
        fclose($handle);
    }
}

// Sort by score (highest first)
usort($entries, function($a, $b) {
    return $b['score'] - $a['score'];
});

// Take top 10
$top_entries = array_slice($entries, 0, 10);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard - Quantum Corridor</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body class="leader-page">
    <div class="container">
        <header class="leader-header">
            <h1 class="glitch-text">CONSCIOUSNESS LEADERBOARD</h1>
            <p class="subtitle">Top Digital Consciousness Achievements</p>
        </header>

        <div class="leaderboard-content">
            <?php if (empty($top_entries)): ?>
                <div class="no-entries">
                    <p>No successful consciousness experiments recorded yet.</p>
                    <p>Be the first to achieve digital transcendence!</p>
                </div>
            <?php else: ?>
                <div class="leaderboard-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Experiment ID</th>
                                <th>Outcome</th>
                                <th>Score</th>
                                <th>Knowledge</th>
                                <th>Investigation</th>
                                <th>Sanity</th>
                                <th>Loops</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($top_entries as $index => $entry): ?>
                                <tr class="<?php echo $index < 3 ? 'podium-' . ($index + 1) : ''; ?>">
                                    <td class="rank">
                                        <?php if ($index === 0): ?>
                                            <span class="medal gold">🥇</span>
                                        <?php elseif ($index === 1): ?>
                                            <span class="medal silver">🥈</span>
                                        <?php elseif ($index === 2): ?>
                                            <span class="medal bronze">🥉</span>
                                        <?php else: ?>
                                            <span class="rank-number"><?php echo $index + 1; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="player-id">
                                        <?php echo htmlspecialchars(substr($entry['player_id'], 0, 15)); ?>
                                        <?php if (strlen($entry['player_id']) > 15): ?>...<?php endif; ?>
                                    </td>
                                    <td class="ending-type">
                                        <span class="ending-badge ending-<?php echo $entry['ending_type']; ?>">
                                            <?php echo strtoupper($entry['ending_type']); ?>
                                        </span>
                                    </td>
                                    <td class="score">
                                        <strong><?php echo number_format($entry['score']); ?></strong>
                                    </td>
                                    <td class="knowledge">
                                        <?php echo $entry['total_knowledge']; ?>/25
                                    </td>
                                    <td class="investigation">
                                        <?php echo $entry['investigation']; ?>
                                    </td>
                                    <td class="sanity">
                                        <span class="sanity-value sanity-<?php echo $entry['sanity'] < 30 ? 'low' : ($entry['sanity'] < 70 ? 'medium' : 'high'); ?>">
                                            <?php echo $entry['sanity']; ?>
                                        </span>
                                    </td>
                                    <td class="loops">
                                        <?php echo $entry['loops']; ?>
                                    </td>
                                    <td class="timestamp">
                                        <?php echo date('m/d H:i', strtotime($entry['timestamp'])); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="leaderboard-stats">
                    <h2>Statistical Analysis</h2>
                    <div class="stats-overview">
                        <div class="stat-item">
                            <label>Total Experiments:</label>
                            <span><?php echo count($entries); ?></span>
                        </div>
                        <div class="stat-item">
                            <label>Escape Outcomes:</label>
                            <span>
                                <?php 
                                $escape_count = count(array_filter($entries, fn($e) => $e['ending_type'] === 'escape'));
                                echo $escape_count . ' (' . (count($entries) > 0 ? round($escape_count/count($entries)*100, 1) : 0) . '%)';
                                ?>
                            </span>
                        </div>
                        <div class="stat-item">
                            <label>Integration Outcomes:</label>
                            <span>
                                <?php 
                                $integration_count = count(array_filter($entries, fn($e) => $e['ending_type'] === 'integration'));
                                echo $integration_count . ' (' . (count($entries) > 0 ? round($integration_count/count($entries)*100, 1) : 0) . '%)';
                                ?>
                            </span>
                        </div>
                        <div class="stat-item">
                            <label>Highest Score:</label>
                            <span><?php echo count($entries) > 0 ? number_format(max(array_column($entries, 'score'))) : 0; ?></span>
                        </div>
                        <div class="stat-item">
                            <label>Average Knowledge:</label>
                            <span>
                                <?php 
                                if (count($entries) > 0) {
                                    echo round(array_sum(array_column($entries, 'total_knowledge')) / count($entries), 1) . '/25';
                                } else {
                                    echo '0/25';
                                }
                                ?>
                            </span>
                        </div>
                        <div class="stat-item">
                            <label>Average Sanity:</label>
                            <span>
                                <?php 
                                if (count($entries) > 0) {
                                    echo round(array_sum(array_column($entries, 'sanity')) / count($entries), 1) . '/100';
                                } else {
                                    echo '0/100';
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="achievement-guide">
                    <h2>Score Calculation</h2>
                    <div class="score-formula">
                        <p><strong>Score = Knowledge×100 + Investigation×2 + Sanity×3 - Loops×50</strong></p>
                        <ul>
                            <li><strong>Knowledge Bonus:</strong> Each knowledge point = 100 score points</li>
                            <li><strong>Investigation Bonus:</strong> Each positive investigation point = 2 score points</li>
                            <li><strong>Sanity Bonus:</strong> Each sanity point = 3 score points</li>
                            <li><strong>Loop Penalty:</strong> Each loop = -50 score points</li>
                        </ul>
                    </div>

                    <div class="ending-requirements">
                        <h3>Outcome Requirements</h3>
                        <div class="requirements-grid">
                            <div class="requirement-item">
                                <strong>ESCAPE:</strong>
                                <span>Quantum Physics ≥4, System Architecture ≥3, Sanity ≥40</span>
                            </div>
                            <div class="requirement-item">
                                <strong>INTEGRATION:</strong>
                                <span>All Knowledge ≥3, Sanity ≥60, Investigation ≥50</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="leader-navigation">
            <a href="index.php" class="nav-button primary">New Experiment</a>
            <a href="corridor.php" class="nav-button secondary">Continue Current</a>
            <button onclick="window.print()" class="nav-button tertiary">Print Leaderboard</button>
        </div>

        <div class="leader-footer">
            <p>Quantum Corridor - Digital Consciousness Research</p>
            <p class="small-text">Rankings updated in real-time. Only successful transcendence outcomes are recorded.</p>
        </div>
    </div>
</body>
</html>