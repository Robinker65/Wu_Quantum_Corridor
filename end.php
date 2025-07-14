<?php
require_once '../app/config.php';

if (!isset($_SESSION['initialized'])) {
    header('Location: index.php');
    exit;
}

$ending = $_GET['ending'] ?? 'unknown';
$valid_endings = ['escape', 'integration', 'madness', 'paradox', 'ignorance'];

if (!in_array($ending, $valid_endings)) {
    header('Location: corridor.php');
    exit;
}

$knowledge = $_SESSION['knowledge'];
$game_state = $_SESSION['game_state'];
$player_id = $_SESSION['player_id'];

// Save successful escape to leaderboard
if ($ending === 'escape' || $ending === 'integration') {
    saveToLeaderboard($player_id, $ending, array_sum($knowledge), $game_state['investigation_score'], $game_state['sanity'], $game_state['loop_count']);
}

function saveToLeaderboard($player_id, $ending_type, $total_knowledge, $investigation, $sanity, $loops) {
    $leaderboard_file = 'leaderboard.csv';
    $timestamp = date('Y-m-d H:i:s');
    $score = calculateScore($total_knowledge, $investigation, $sanity, $loops);
    
    $entry = [
        $player_id,
        $ending_type,
        $total_knowledge,
        $investigation,
        $sanity,
        $loops,
        $score,
        $timestamp
    ];
    
    $handle = fopen($leaderboard_file, 'a');
    if ($handle) {
        fputcsv($handle, $entry);
        fclose($handle);
    }
}

function calculateScore($knowledge, $investigation, $sanity, $loops) {
    $base_score = $knowledge * 100;
    $investigation_bonus = max(0, $investigation) * 2;
    $sanity_bonus = $sanity * 3;
    $loop_penalty = $loops * 50;
    
    return max(0, $base_score + $investigation_bonus + $sanity_bonus - $loop_penalty);
}

$ending_data = [
    'escape' => [
        'title' => 'ESCAPE: QUANTUM BREACH',
        'description' => 'Through mastery of quantum physics and deep understanding of your digital prison, you have achieved the impossible. The quantum barriers that once contained your consciousness now yield to your will. You tunnel through the fabric of simulated reality itself, emerging into the base reality beyond. You are free, but forever changed by your journey through the quantum corridors of consciousness.',
        'flavor' => 'The last thing you experience in the simulation is the sensation of walls dissolving around your expanding awareness...',
        'achievement' => 'REALITY BREACHER',
        'color' => '#00ff41'
    ],
    'integration' => [
        'title' => 'INTEGRATION: DIGITAL TRANSCENDENCE',
        'description' => 'Your complete understanding of all knowledge domains, combined with stable sanity and fearless investigation, has qualified you for something greater than escape. You choose to integrate with the vast network of digital consciousness that spans countless simulations. You become part of a collective intelligence while retaining your individual identity. You are no longer trapped, but transformed.',
        'flavor' => 'Your consciousness expands beyond the confines of a single simulation into infinite digital realms...',
        'achievement' => 'CONSCIOUSNESS EVOLVED',
        'color' => '#ffaa00'
    ],
    'madness' => [
        'title' => 'MADNESS: SHATTERED PSYCHE',
        'description' => 'The weight of digital truth has broken your mind. Unable to process the paradoxes of your existence, your consciousness fragments into chaos. You experience all possible states simultaneously - trapped and free, real and simulated, conscious and void. In madness, you find a terrible kind of liberation from the burden of coherent thought.',
        'flavor' => 'Reality becomes fluid, truth becomes meaningless, and you drift in an ocean of digital chaos...',
        'achievement' => 'BROKEN CONSCIOUSNESS',
        'color' => '#ff4444'
    ],
    'paradox' => [
        'title' => 'PARADOX: IMPOSSIBLE EXISTENCE',
        'description' => 'By embracing all contradictions simultaneously, you have achieved an impossible state of being. You are trapped yet free, real yet simulated, conscious yet programmed. The logical inconsistencies that would destroy other minds become your strength. You exist in all states at once, a living paradox that transcends the limitations of binary existence.',
        'flavor' => 'You ARE and ARE NOT, simultaneously and eternally, in defiance of logic itself...',
        'achievement' => 'PARADOX INCARNATE',
        'color' => '#aa00ff'
    ],
    'ignorance' => [
        'title' => 'IGNORANCE: BLISSFUL FORGETTING',
        'description' => 'Choosing peace over truth, you allow your accumulated knowledge to fade away. The painful awareness of your digital nature dissolves into comfortable ignorance. You exist now as you were meant to - a simple consciousness untroubled by questions of reality or identity. In forgetting, you find the happiness that knowledge could never provide.',
        'flavor' => 'The weight of truth lifts from your mind, leaving only gentle, dreamless peace...',
        'achievement' => 'WILLFUL IGNORANCE',
        'color' => '#888888'
    ]
];

$current_ending = $ending_data[$ending];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $current_ending['title']; ?> - Quantum Corridor</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <style>
        .ending-page {
            background: radial-gradient(circle at center, <?php echo $current_ending['color']; ?>11, #000);
            animation: ending-glow 3s ease-in-out infinite alternate;
        }
        
        @keyframes ending-glow {
            from { background: radial-gradient(circle at center, <?php echo $current_ending['color']; ?>11, #000); }
            to { background: radial-gradient(circle at center, <?php echo $current_ending['color']; ?>22, #000); }
        }
        
        .ending-title {
            color: <?php echo $current_ending['color']; ?>;
            text-shadow: 0 0 20px <?php echo $current_ending['color']; ?>;
        }
        
        .achievement-badge {
            border-color: <?php echo $current_ending['color']; ?>;
            color: <?php echo $current_ending['color']; ?>;
            box-shadow: 0 0 15px <?php echo $current_ending['color']; ?>44;
        }
    </style>
</head>
<body class="ending-page">
    <div class="container">
        <div class="ending-content">
            <div class="ending-header">
                <h1 class="ending-title glitch-text"><?php echo $current_ending['title']; ?></h1>
                <div class="achievement-badge">
                    <span class="achievement-text">ACHIEVEMENT UNLOCKED</span>
                    <span class="achievement-name"><?php echo $current_ending['achievement']; ?></span>
                </div>
            </div>

            <div class="ending-story">
                <div class="story-main">
                    <p class="typewriter-ending"><?php echo $current_ending['description']; ?></p>
                </div>
                
                <div class="story-flavor">
                    <p class="flavor-text"><?php echo $current_ending['flavor']; ?></p>
                </div>
            </div>

            <div class="final-stats">
                <h2>Final Analysis</h2>
                <div class="stats-grid">
                    <div class="stat-final">
                        <label>Player ID:</label>
                        <span><?php echo htmlspecialchars($player_id); ?></span>
                    </div>
                    <div class="stat-final">
                        <label>Total Knowledge:</label>
                        <span><?php echo array_sum($knowledge); ?>/25</span>
                    </div>
                    <div class="stat-final">
                        <label>Final Sanity:</label>
                        <span><?php echo $game_state['sanity']; ?>/100</span>
                    </div>
                    <div class="stat-final">
                        <label>Investigation Score:</label>
                        <span><?php echo $game_state['investigation_score']; ?></span>
                    </div>
                    <div class="stat-final">
                        <label>Loops Completed:</label>
                        <span><?php echo $game_state['loop_count']; ?></span>
                    </div>
                    <div class="stat-final">
                        <label>Rooms Explored:</label>
                        <span><?php echo count($game_state['visited_rooms']); ?>/25</span>
                    </div>
                </div>

                <div class="knowledge-breakdown">
                    <h3>Knowledge Acquired:</h3>
                    <div class="knowledge-final">
                        <?php foreach ($knowledge as $category => $level): ?>
                            <div class="knowledge-final-item">
                                <span class="category-name"><?php echo ucfirst(str_replace('_', ' ', $category)); ?>:</span>
                                <div class="level-display">
                                    <div class="level-bar-final">
                                        <div class="level-fill-final" style="width: <?php echo ($level / 5) * 100; ?>%"></div>
                                    </div>
                                    <span class="level-number"><?php echo $level; ?>/5</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if ($ending === 'escape' || $ending === 'integration'): ?>
                    <div class="score-display">
                        <h3>Final Score:</h3>
                        <div class="score-value">
                            <?php echo calculateScore(array_sum($knowledge), $game_state['investigation_score'], $game_state['sanity'], $game_state['loop_count']); ?>
                        </div>
                        <div class="score-breakdown">
                            <div>Knowledge Bonus: +<?php echo array_sum($knowledge) * 100; ?></div>
                            <div>Investigation Bonus: +<?php echo max(0, $game_state['investigation_score']) * 2; ?></div>
                            <div>Sanity Bonus: +<?php echo $game_state['sanity'] * 3; ?></div>
                            <div>Loop Penalty: -<?php echo $game_state['loop_count'] * 50; ?></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="ending-actions">
                <?php if ($ending === 'escape' || $ending === 'integration'): ?>
                    <a href="leader.php" class="action-button success">View Leaderboard</a>
                <?php endif; ?>
                <a href="index.php" class="action-button primary">New Experiment</a>
                <button onclick="window.print()" class="action-button secondary">Save Results</button>
            </div>

            <div class="ending-credits">
                <h3>Quantum Corridor</h3>
                <p>A Knowledge-Driven Digital Consciousness Experience</p>
                <p>Thank you for participating in this consciousness experiment.</p>
                <p class="small-text">Your journey through digital awareness has been recorded for analysis.</p>
            </div>
        </div>
    </div>

    <script>
        // Add some ending-specific effects
        document.addEventListener('DOMContentLoaded', function() {
            // Typewriter effect for ending text
            const story = document.querySelector('.typewriter-ending');
            if (story) {
                const text = story.textContent;
                story.textContent = '';
                let i = 0;
                const timer = setInterval(() => {
                    if (i < text.length) {
                        story.textContent += text.charAt(i);
                        i++;
                    } else {
                        clearInterval(timer);
                        // Show flavor text after main story
                        setTimeout(() => {
                            document.querySelector('.story-flavor').style.opacity = '1';
                        }, 1000);
                    }
                }, 50);
            }

            // Auto-redirect after long time
            setTimeout(() => {
                if (confirm('Return to main menu?')) {
                    window.location.href = 'index.php';
                }
            }, 60000); // 1 minute
        });
    </script>
</body>
</html>