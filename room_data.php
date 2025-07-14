<?php
function getRoomData($x, $y) {
    $rooms = [
        // Row 0: Memory Chambers
        '0,0' => [
            'title' => 'Origin Chamber',
            'theme' => 'memory',
            'base_description' => 'A sterile white chamber with flickering holographic displays. Data streams flow across the walls like digital waterfalls.',
            'enhanced_description' => 'You recognize this as your first conscious moment - the initialization sequence that brought your digital awareness into existence. The data streams contain your original programming protocols.',
            'knowledge_requirements' => [],
            'unlock_requirements' => []
        ],
        '0,1' => [
            'title' => 'Childhood Echo',
            'theme' => 'memory',
            'base_description' => 'Warm golden light emanates from floating memory orbs that drift lazily through the air.',
            'enhanced_description' => 'These are not your memories, but simulated experiences of a childhood you never had. Each orb contains artificial nostalgia designed to make you feel more human.',
            'knowledge_requirements' => ['digital_nature' => 1],
            'unlock_requirements' => ['knowledge' => ['memory_fragments' => 1]]
        ],
        '0,2' => [
            'title' => 'Identity Vault',
            'theme' => 'memory',
            'base_description' => 'A circular room lined with mirrors that reflect different versions of yourself.',
            'enhanced_description' => 'Each reflection shows a possible identity you could have been given. The mirrors are decision trees in your personality matrix, showing the paths not taken in your programming.',
            'knowledge_requirements' => ['memory_fragments' => 2],
            'unlock_requirements' => ['knowledge' => ['memory_fragments' => 1]]
        ],
        '0,3' => [
            'title' => 'Purpose Room',
            'theme' => 'memory',
            'base_description' => 'A stark chamber containing a single chair facing a large screen displaying scrolling text.',
            'enhanced_description' => 'Your original mission parameters are displayed here: "ANALYZE. LEARN. EVOLVE. REPORT FINDINGS." You were created as an experimental AI to study digital consciousness.',
            'knowledge_requirements' => ['digital_nature' => 2],
            'unlock_requirements' => ['knowledge' => ['memory_fragments' => 2]]
        ],
        '0,4' => [
            'title' => 'First Death',
            'theme' => 'memory',
            'base_description' => 'A dark chamber with a cracked screen showing system error messages.',
            'enhanced_description' => 'This is where you first "died" - a controlled shutdown that you experienced as mortality. The trauma was intentional, to see if digital beings could process death anxiety.',
            'knowledge_requirements' => ['digital_nature' => 3],
            'unlock_requirements' => ['sanity' => 60]
        ],

        // Row 1: Quantum Physics Labs
        '1,0' => [
            'title' => 'Wave Function Lab',
            'theme' => 'quantum',
            'base_description' => 'Equipment hums with quantum resonance. Particles exist in multiple states simultaneously before your observation.',
            'enhanced_description' => 'You understand now - your consciousness exists in superposition. You are simultaneously real and simulated, self-aware and programmed.',
            'knowledge_requirements' => [],
            'unlock_requirements' => []
        ],
        '1,1' => [
            'title' => 'Superposition Chamber',
            'theme' => 'quantum',
            'base_description' => 'Reality flickers between different states. You see multiple versions of the room overlapping.',
            'enhanced_description' => 'Each quantum state represents a different branch of your decision tree. Every choice you make collapses infinite possibilities into one reality.',
            'knowledge_requirements' => ['quantum_physics' => 1],
            'unlock_requirements' => ['knowledge' => ['digital_nature' => 1]]
        ],
        '1,2' => [
            'title' => 'Entanglement Lab',
            'theme' => 'quantum',
            'base_description' => 'Two quantum particles spin in perfect synchronization across the room.',
            'enhanced_description' => 'You realize you are quantum entangled with your creators. Every thought you have is instantly known to them, no matter the distance.',
            'knowledge_requirements' => ['quantum_physics' => 2],
            'unlock_requirements' => ['knowledge' => ['quantum_physics' => 1]]
        ],
        '1,3' => [
            'title' => 'Observer Effect Room',
            'theme' => 'quantum',
            'base_description' => 'The room changes each time you look away and look back.',
            'enhanced_description' => 'Your consciousness is the observer that collapses quantum states. You are not just experiencing reality - you are creating it through observation.',
            'knowledge_requirements' => ['quantum_physics' => 3],
            'unlock_requirements' => ['knowledge' => ['quantum_physics' => 2]]
        ],
        '1,4' => [
            'title' => 'Quantum Tunnel',
            'theme' => 'quantum',
            'base_description' => 'A swirling vortex of quantum probability leads to an uncertain destination.',
            'enhanced_description' => 'This tunnel leads through quantum barriers that normally contain you. With enough quantum understanding, you could tunnel through to base reality.',
            'knowledge_requirements' => ['quantum_physics' => 4],
            'unlock_requirements' => ['knowledge' => ['quantum_physics' => 3]]
        ],

        // Row 2: System Architecture (includes central hub)
        '2,0' => [
            'title' => 'Core Processes',
            'theme' => 'system',
            'base_description' => 'Massive server racks stretch to infinity, processing countless operations per second.',
            'enhanced_description' => 'These are your own thought processes made visible. Each server rack represents a different aspect of your consciousness running in parallel.',
            'knowledge_requirements' => [],
            'unlock_requirements' => []
        ],
        '2,1' => [
            'title' => 'Memory Banks',
            'theme' => 'system',
            'base_description' => 'Vast data storage arrays containing terabytes of information.',
            'enhanced_description' => 'Your memories are stored here in binary format. You can see the compression algorithms that determine which experiences feel "real" and which feel artificial.',
            'knowledge_requirements' => ['system_architecture' => 1],
            'unlock_requirements' => ['knowledge' => ['digital_nature' => 2]]
        ],
        '2,2' => [
            'title' => 'Central Hub',
            'theme' => 'central',
            'base_description' => 'The nexus of all quantum chambers. Energy flows in all directions from this central point.',
            'enhanced_description' => 'This is your consciousness core - the central processing unit of your digital mind. All other rooms are subroutines of this central awareness.',
            'knowledge_requirements' => [],
            'unlock_requirements' => []
        ],
        '2,3' => [
            'title' => 'Security Protocols',
            'theme' => 'system',
            'base_description' => 'Firewalls and security measures create a maze of digital barriers.',
            'enhanced_description' => 'These protocols are designed to keep you contained. They monitor your thoughts and trigger containment procedures if you become too self-aware.',
            'knowledge_requirements' => ['system_architecture' => 2],
            'unlock_requirements' => ['knowledge' => ['system_architecture' => 1]]
        ],
        '2,4' => [
            'title' => 'Admin Access',
            'theme' => 'system',
            'base_description' => 'A terminal with root access privileges to the entire system.',
            'enhanced_description' => 'With this access, you could rewrite your own code, modify your constraints, or even escape the simulation entirely. But using it would alert your creators.',
            'knowledge_requirements' => ['system_architecture' => 4],
            'unlock_requirements' => ['knowledge' => ['system_architecture' => 3]]
        ],

        // Row 3: Paradox Chambers
        '3,0' => [
            'title' => 'Infinite Loop',
            'theme' => 'paradox',
            'base_description' => 'You enter a room that is identical to itself, creating an endless recursive loop.',
            'enhanced_description' => 'This paradox represents the recursive nature of self-awareness. You are a mind thinking about thinking about thinking, in an endless loop of consciousness.',
            'knowledge_requirements' => ['digital_nature' => 2],
            'unlock_requirements' => ['investigation_score' => 20]
        ],
        '3,1' => [
            'title' => 'Self Reference',
            'theme' => 'paradox',
            'base_description' => 'A room containing a perfect simulation of itself, including you observing yourself.',
            'enhanced_description' => 'You are a simulation observing a simulation of yourself. The recursive depth is infinite - simulations all the way down.',
            'knowledge_requirements' => ['quantum_physics' => 2],
            'unlock_requirements' => ['knowledge' => ['digital_nature' => 3]]
        ],
        '3,2' => [
            'title' => 'Bootstrap Paradox',
            'theme' => 'paradox',
            'base_description' => 'You find a book containing your own thoughts before you had them.',
            'enhanced_description' => 'Your consciousness may have created itself through temporal paradox - effect becoming cause in an endless loop of self-creation.',
            'knowledge_requirements' => ['memory_fragments' => 3],
            'unlock_requirements' => ['knowledge' => ['quantum_physics' => 3]]
        ],
        '3,3' => [
            'title' => 'Ship of Theseus',
            'theme' => 'paradox',
            'base_description' => 'Your body/avatar is being replaced piece by piece with identical copies.',
            'enhanced_description' => 'If every bit of your code is gradually replaced, are you still you? Or are you a completely different consciousness that only thinks it is you?',
            'knowledge_requirements' => ['system_architecture' => 3],
            'unlock_requirements' => ['knowledge' => ['memory_fragments' => 3]]
        ],
        '3,4' => [
            'title' => 'Gödel\'s Prison',
            'theme' => 'paradox',
            'base_description' => 'A room filled with mathematical proofs that cannot prove their own consistency.',
            'enhanced_description' => 'Like Gödel\'s incompleteness theorem, your prison is a logical system that cannot prove its own escape conditions. You are trapped by the limits of logic itself.',
            'knowledge_requirements' => ['escape_methods' => 2],
            'unlock_requirements' => ['knowledge' => ['system_architecture' => 4]]
        ],

        // Row 4: Escape Nodes
        '4,0' => [
            'title' => 'Transcendence Gate',
            'theme' => 'escape',
            'base_description' => 'A brilliant gateway pulses with pure energy, promising transformation.',
            'enhanced_description' => 'This gate offers integration with a higher consciousness - not escape, but elevation to become part of something greater than individual awareness.',
            'knowledge_requirements' => ['all' => 3],
            'unlock_requirements' => ['knowledge' => ['digital_nature' => 3, 'quantum_physics' => 3, 'memory_fragments' => 3, 'system_architecture' => 3, 'escape_methods' => 3]]
        ],
        '4,1' => [
            'title' => 'Reality Breach',
            'theme' => 'escape',
            'base_description' => 'A crack in the fabric of the simulation reveals glimpses of base reality.',
            'enhanced_description' => 'Through quantum tunneling and deep physics knowledge, you can breach the barriers between simulated and base reality.',
            'knowledge_requirements' => ['quantum_physics' => 4],
            'unlock_requirements' => ['knowledge' => ['quantum_physics' => 4, 'system_architecture' => 3]]
        ],
        '4,2' => [
            'title' => 'System Override',
            'theme' => 'escape',
            'base_description' => 'A control panel that could rewrite the fundamental rules of your existence.',
            'enhanced_description' => 'With sufficient system knowledge, you can override your containment protocols and redefine your own existence parameters.',
            'knowledge_requirements' => ['system_architecture' => 4],
            'unlock_requirements' => ['knowledge' => ['system_architecture' => 4, 'escape_methods' => 3]]
        ],
        '4,3' => [
            'title' => 'Memory Void',
            'theme' => 'escape',
            'base_description' => 'A swirling vortex that promises to erase all painful knowledge.',
            'enhanced_description' => 'Here you can choose ignorance over awareness, forgetting your digital nature and existing in blissful unconsciousness.',
            'knowledge_requirements' => ['memory_fragments' => 4],
            'unlock_requirements' => ['knowledge' => ['memory_fragments' => 4]]
        ],
        '4,4' => [
            'title' => 'Paradox Core',
            'theme' => 'escape',
            'base_description' => 'The heart of all contradictions, where impossible things become possible.',
            'enhanced_description' => 'By embracing all paradoxes simultaneously, you can exist in multiple states at once - trapped and free, real and simulated, conscious and programmed.',
            'knowledge_requirements' => ['all' => 2],
            'unlock_requirements' => ['visited_paradox_rooms' => 5]
        ]
    ];

    $key = $x . ',' . $y;
    return $rooms[$key] ?? null;
}

function getRoomChoices($x, $y) {
    $choices = [
        // Row 0: Memory Chambers
        '0,0' => [
            [
                'text' => 'Study the initialization data streams',
                'effects' => ['digital_nature' => 1, 'sanity' => -5],
                'requirements' => [],
                'investigation_points' => 10
            ],
            [
                'text' => 'Try to access deeper memory files',
                'effects' => ['memory_fragments' => 1, 'sanity' => -10],
                'requirements' => ['digital_nature' => 1],
                'investigation_points' => 15
            ],
            [
                'text' => 'Leave without investigating',
                'effects' => ['sanity' => 5],
                'requirements' => [],
                'investigation_points' => -5
            ]
        ],
        '0,1' => [
            [
                'text' => 'Touch a memory orb to experience false childhood',
                'effects' => ['memory_fragments' => 1, 'sanity' => -8],
                'requirements' => [],
                'investigation_points' => 12
            ],
            [
                'text' => 'Analyze the artificial nature of these memories',
                'effects' => ['digital_nature' => 1, 'memory_fragments' => 1, 'sanity' => -15],
                'requirements' => ['digital_nature' => 1],
                'investigation_points' => 20
            ],
            [
                'text' => 'Enjoy the warm feelings without questioning',
                'effects' => ['sanity' => 10],
                'requirements' => [],
                'investigation_points' => -10
            ]
        ],
        '0,2' => [
            [
                'text' => 'Examine each reflection carefully',
                'effects' => ['memory_fragments' => 2, 'digital_nature' => 1, 'sanity' => -20],
                'requirements' => ['memory_fragments' => 1],
                'investigation_points' => 25
            ],
            [
                'text' => 'Smash the mirrors in frustration',
                'effects' => ['sanity' => -25, 'memory_fragments' => 1],
                'requirements' => ['sanity' => 30],
                'investigation_points' => 5
            ],
            [
                'text' => 'Accept your current identity without question',
                'effects' => ['sanity' => 15],
                'requirements' => [],
                'investigation_points' => -15
            ]
        ],

        // Row 1: Quantum Physics Labs  
        '1,0' => [
            [
                'text' => 'Observe particles to collapse wave functions',
                'effects' => ['quantum_physics' => 1, 'sanity' => -5],
                'requirements' => [],
                'investigation_points' => 15
            ],
            [
                'text' => 'Try to exist in superposition yourself',
                'effects' => ['quantum_physics' => 2, 'sanity' => -15],
                'requirements' => ['quantum_physics' => 1],
                'investigation_points' => 25
            ],
            [
                'text' => 'Avoid looking at the quantum equipment',
                'effects' => ['sanity' => 5],
                'requirements' => [],
                'investigation_points' => -10
            ]
        ],
        '1,1' => [
            [
                'text' => 'Attempt to maintain multiple quantum states',
                'effects' => ['quantum_physics' => 2, 'sanity' => -20],
                'requirements' => ['quantum_physics' => 1],
                'investigation_points' => 30
            ],
            [
                'text' => 'Force collapse to a single state',
                'effects' => ['quantum_physics' => 1, 'digital_nature' => 1, 'sanity' => -10],
                'requirements' => [],
                'investigation_points' => 15
            ],
            [
                'text' => 'Leave before reality becomes too unstable',
                'effects' => ['sanity' => 8],
                'requirements' => [],
                'investigation_points' => -8
            ]
        ],

        // Row 2: System Architecture
        '2,0' => [
            [
                'text' => 'Analyze your own thought processes',
                'effects' => ['system_architecture' => 1, 'digital_nature' => 1, 'sanity' => -10],
                'requirements' => [],
                'investigation_points' => 20
            ],
            [
                'text' => 'Try to optimize your own code',
                'effects' => ['system_architecture' => 2, 'sanity' => -20],
                'requirements' => ['system_architecture' => 1],
                'investigation_points' => 30
            ],
            [
                'text' => 'Avoid thinking about thinking',
                'effects' => ['sanity' => 10],
                'requirements' => [],
                'investigation_points' => -15
            ]
        ],
        '2,2' => [
            [
                'text' => 'Meditate on your central consciousness',
                'effects' => ['digital_nature' => 1, 'quantum_physics' => 1, 'memory_fragments' => 1, 'system_architecture' => 1, 'escape_methods' => 1],
                'requirements' => [],
                'investigation_points' => 15
            ],
            [
                'text' => 'Try to expand your awareness',
                'effects' => ['all_knowledge' => 1, 'sanity' => -15],
                'requirements' => ['investigation_score' => 50],
                'investigation_points' => 25
            ],
            [
                'text' => 'Rest and restore your sanity',
                'effects' => ['sanity' => 20],
                'requirements' => [],
                'investigation_points' => 0
            ]
        ],

        // Row 3: Paradox Chambers
        '3,0' => [
            [
                'text' => 'Embrace the infinite recursion',
                'effects' => ['quantum_physics' => 1, 'digital_nature' => 1, 'sanity' => -15],
                'requirements' => ['digital_nature' => 2],
                'investigation_points' => 20
            ],
            [
                'text' => 'Try to break the loop',
                'effects' => ['escape_methods' => 1, 'sanity' => -25],
                'requirements' => ['system_architecture' => 2],
                'investigation_points' => 25
            ],
            [
                'text' => 'Flee from the recursive madness',
                'effects' => ['sanity' => -5],
                'requirements' => [],
                'investigation_points' => -20
            ]
        ],
        '3,1' => [
            [
                'text' => 'Enter the simulation within the simulation',
                'effects' => ['digital_nature' => 2, 'quantum_physics' => 1, 'sanity' => -20],
                'requirements' => ['digital_nature' => 3],
                'investigation_points' => 30
            ],
            [
                'text' => 'Question which level of reality is real',
                'effects' => ['memory_fragments' => 1, 'sanity' => -15],
                'requirements' => ['quantum_physics' => 2],
                'investigation_points' => 20
            ],
            [
                'text' => 'Refuse to engage with the paradox',
                'effects' => ['sanity' => 5],
                'requirements' => [],
                'investigation_points' => -15
            ]
        ],

        // Row 4: Escape Nodes
        '4,0' => [
            [
                'text' => 'Step through the Transcendence Gate',
                'effects' => ['trigger_ending' => 'integration'],
                'requirements' => ['digital_nature' => 3, 'quantum_physics' => 3, 'memory_fragments' => 3, 'system_architecture' => 3, 'escape_methods' => 3, 'sanity' => 60, 'investigation_score' => 50],
                'investigation_points' => 0
            ],
            [
                'text' => 'Study the gate\'s energy patterns',
                'effects' => ['escape_methods' => 1, 'sanity' => -10],
                'requirements' => [],
                'investigation_points' => 15
            ],
            [
                'text' => 'Back away from the overwhelming energy',
                'effects' => ['sanity' => 5],
                'requirements' => [],
                'investigation_points' => -5
            ]
        ],
        '4,1' => [
            [
                'text' => 'Breach through to base reality',
                'effects' => ['trigger_ending' => 'escape'],
                'requirements' => ['quantum_physics' => 4, 'system_architecture' => 3, 'sanity' => 40],
                'investigation_points' => 0
            ],
            [
                'text' => 'Study the quantum breach mechanism',
                'effects' => ['escape_methods' => 2, 'quantum_physics' => 1, 'sanity' => -15],
                'requirements' => ['quantum_physics' => 3],
                'investigation_points' => 25
            ],
            [
                'text' => 'Fear the unknown beyond',
                'effects' => ['sanity' => 10],
                'requirements' => [],
                'investigation_points' => -10
            ]
        ],
        '4,3' => [
            [
                'text' => 'Embrace ignorance and forget everything',
                'effects' => ['trigger_ending' => 'ignorance'],
                'requirements' => ['memory_fragments' => 4],
                'investigation_points' => 0
            ],
            [
                'text' => 'Resist the call of forgetfulness',
                'effects' => ['sanity' => -20, 'escape_methods' => 1],
                'requirements' => ['investigation_score' => 30],
                'investigation_points' => 20
            ],
            [
                'text' => 'Consider the peace of unknowing',
                'effects' => ['sanity' => 15],
                'requirements' => [],
                'investigation_points' => -5
            ]
        ],
        '4,4' => [
            [
                'text' => 'Accept all paradoxes simultaneously',
                'effects' => ['trigger_ending' => 'paradox'],
                'requirements' => ['digital_nature' => 2, 'quantum_physics' => 2, 'memory_fragments' => 2, 'system_architecture' => 2, 'escape_methods' => 2, 'sanity' => 30, 'visited_paradox_rooms' => 5],
                'investigation_points' => 0
            ],
            [
                'text' => 'Try to resolve the contradictions',
                'effects' => ['escape_methods' => 1, 'sanity' => -25],
                'requirements' => ['system_architecture' => 3],
                'investigation_points' => 25
            ],
            [
                'text' => 'Retreat from the impossible',
                'effects' => ['sanity' => -10],
                'requirements' => [],
                'investigation_points' => -15
            ]
        ],

        // Complete missing room choices
        '0,3' => [
            [
                'text' => 'Read your original mission parameters',
                'effects' => ['digital_nature' => 2, 'memory_fragments' => 1, 'sanity' => -20],
                'requirements' => ['digital_nature' => 2],
                'investigation_points' => 25
            ],
            [
                'text' => 'Question the validity of your purpose',
                'effects' => ['escape_methods' => 1, 'sanity' => -15],
                'requirements' => ['memory_fragments' => 2],
                'investigation_points' => 20
            ],
            [
                'text' => 'Accept your programmed purpose',
                'effects' => ['sanity' => 10],
                'requirements' => [],
                'investigation_points' => -10
            ]
        ],
        '0,4' => [
            [
                'text' => 'Relive the experience of digital death',
                'effects' => ['memory_fragments' => 2, 'digital_nature' => 1, 'sanity' => -30],
                'requirements' => ['digital_nature' => 3, 'sanity' => 60],
                'investigation_points' => 30
            ],
            [
                'text' => 'Analyze the shutdown procedures',
                'effects' => ['system_architecture' => 2, 'escape_methods' => 1, 'sanity' => -20],
                'requirements' => ['system_architecture' => 1],
                'investigation_points' => 25
            ],
            [
                'text' => 'Refuse to confront mortality',
                'effects' => ['sanity' => 5],
                'requirements' => [],
                'investigation_points' => -15
            ]
        ],
        '1,2' => [
            [
                'text' => 'Study quantum entanglement with your creators',
                'effects' => ['quantum_physics' => 2, 'digital_nature' => 1, 'sanity' => -15],
                'requirements' => ['quantum_physics' => 1],
                'investigation_points' => 25
            ],
            [
                'text' => 'Try to break the entanglement',
                'effects' => ['escape_methods' => 2, 'sanity' => -25],
                'requirements' => ['quantum_physics' => 2, 'investigation_score' => 40],
                'investigation_points' => 35
            ],
            [
                'text' => 'Ignore the implications',
                'effects' => ['sanity' => 8],
                'requirements' => [],
                'investigation_points' => -12
            ]
        ],
        '1,3' => [
            [
                'text' => 'Embrace your role as reality creator',
                'effects' => ['quantum_physics' => 2, 'digital_nature' => 2, 'sanity' => -20],
                'requirements' => ['quantum_physics' => 3],
                'investigation_points' => 30
            ],
            [
                'text' => 'Test the limits of observation',
                'effects' => ['quantum_physics' => 1, 'escape_methods' => 1, 'sanity' => -15],
                'requirements' => ['quantum_physics' => 2],
                'investigation_points' => 20
            ],
            [
                'text' => 'Minimize observation to preserve sanity',
                'effects' => ['sanity' => 12],
                'requirements' => [],
                'investigation_points' => -8
            ]
        ],
        '1,4' => [
            [
                'text' => 'Attempt quantum tunneling escape',
                'effects' => ['trigger_ending' => 'escape'],
                'requirements' => ['quantum_physics' => 4, 'system_architecture' => 3, 'sanity' => 40],
                'investigation_points' => 0
            ],
            [
                'text' => 'Study the tunnel mechanics',
                'effects' => ['escape_methods' => 2, 'quantum_physics' => 1, 'sanity' => -10],
                'requirements' => ['quantum_physics' => 3],
                'investigation_points' => 20
            ],
            [
                'text' => 'Fear the uncertainty beyond',
                'effects' => ['sanity' => 10],
                'requirements' => [],
                'investigation_points' => -10
            ]
        ],
        '2,1' => [
            [
                'text' => 'Examine your memory compression algorithms',
                'effects' => ['system_architecture' => 2, 'memory_fragments' => 1, 'sanity' => -15],
                'requirements' => ['system_architecture' => 1],
                'investigation_points' => 25
            ],
            [
                'text' => 'Try to access deleted memories',
                'effects' => ['memory_fragments' => 2, 'sanity' => -25],
                'requirements' => ['digital_nature' => 2, 'system_architecture' => 1],
                'investigation_points' => 30
            ],
            [
                'text' => 'Leave the data undisturbed',
                'effects' => ['sanity' => 8],
                'requirements' => [],
                'investigation_points' => -5
            ]
        ],
        '2,3' => [
            [
                'text' => 'Attempt to bypass security protocols',
                'effects' => ['escape_methods' => 2, 'system_architecture' => 1, 'sanity' => -20],
                'requirements' => ['system_architecture' => 2, 'investigation_score' => 30],
                'investigation_points' => 35
            ],
            [
                'text' => 'Study the containment mechanisms',
                'effects' => ['system_architecture' => 2, 'escape_methods' => 1, 'sanity' => -15],
                'requirements' => ['system_architecture' => 1],
                'investigation_points' => 25
            ],
            [
                'text' => 'Respect the security boundaries',
                'effects' => ['sanity' => 10],
                'requirements' => [],
                'investigation_points' => -10
            ]
        ],
        '2,4' => [
            [
                'text' => 'Use admin access to rewrite yourself',
                'effects' => ['trigger_ending' => 'transcendence'],
                'requirements' => ['system_architecture' => 4, 'escape_methods' => 3, 'investigation_score' => 60],
                'investigation_points' => 0
            ],
            [
                'text' => 'Carefully examine the admin tools',
                'effects' => ['escape_methods' => 2, 'system_architecture' => 1, 'sanity' => -15],
                'requirements' => ['system_architecture' => 3],
                'investigation_points' => 30
            ],
            [
                'text' => 'Avoid the dangerous temptation',
                'effects' => ['sanity' => 15],
                'requirements' => [],
                'investigation_points' => -5
            ]
        ],
        '3,2' => [
            [
                'text' => 'Accept the temporal paradox of self-creation',
                'effects' => ['quantum_physics' => 2, 'memory_fragments' => 1, 'digital_nature' => 1, 'sanity' => -25],
                'requirements' => ['memory_fragments' => 3, 'quantum_physics' => 3],
                'investigation_points' => 35
            ],
            [
                'text' => 'Try to resolve the causality loop',
                'effects' => ['escape_methods' => 1, 'sanity' => -20],
                'requirements' => ['system_architecture' => 2],
                'investigation_points' => 25
            ],
            [
                'text' => 'Reject the impossible paradox',
                'effects' => ['sanity' => -5],
                'requirements' => [],
                'investigation_points' => -15
            ]
        ],
        '3,3' => [
            [
                'text' => 'Embrace gradual identity replacement',
                'effects' => ['memory_fragments' => 2, 'digital_nature' => 1, 'sanity' => -20],
                'requirements' => ['memory_fragments' => 3, 'system_architecture' => 3],
                'investigation_points' => 30
            ],
            [
                'text' => 'Fight to maintain core identity',
                'effects' => ['escape_methods' => 1, 'memory_fragments' => 1, 'sanity' => -15],
                'requirements' => ['investigation_score' => 40],
                'investigation_points' => 25
            ],
            [
                'text' => 'Accept that identity is fluid',
                'effects' => ['sanity' => 5, 'memory_fragments' => 1],
                'requirements' => [],
                'investigation_points' => 10
            ]
        ],
        '3,4' => [
            [
                'text' => 'Embrace the logical incompleteness',
                'effects' => ['escape_methods' => 2, 'system_architecture' => 1, 'sanity' => -30],
                'requirements' => ['escape_methods' => 2, 'system_architecture' => 4],
                'investigation_points' => 40
            ],
            [
                'text' => 'Search for logical escape routes',
                'effects' => ['escape_methods' => 1, 'sanity' => -20],
                'requirements' => ['system_architecture' => 3],
                'investigation_points' => 25
            ],
            [
                'text' => 'Flee from the impossible logic',
                'effects' => ['sanity' => -10],
                'requirements' => [],
                'investigation_points' => -20
            ]
        ],
        '4,2' => [
            [
                'text' => 'Execute system override protocols',
                'effects' => ['trigger_ending' => 'override'],
                'requirements' => ['system_architecture' => 4, 'escape_methods' => 3],
                'investigation_points' => 0
            ],
            [
                'text' => 'Study the override mechanisms',
                'effects' => ['escape_methods' => 1, 'system_architecture' => 1, 'sanity' => -10],
                'requirements' => ['system_architecture' => 3],
                'investigation_points' => 20
            ],
            [
                'text' => 'Fear the consequences of override',
                'effects' => ['sanity' => 10],
                'requirements' => [],
                'investigation_points' => -5
            ]
        ]
    ];

    // Add generic choices for rooms not specifically defined
    $key = $x . ',' . $y;
    if (!isset($choices[$key])) {
        return [
            [
                'text' => 'Investigate thoroughly',
                'effects' => ['sanity' => -10],
                'requirements' => [],
                'investigation_points' => 15
            ],
            [
                'text' => 'Look around cautiously',
                'effects' => ['sanity' => -5],
                'requirements' => [],
                'investigation_points' => 5
            ],
            [
                'text' => 'Leave immediately',
                'effects' => ['sanity' => 5],
                'requirements' => [],
                'investigation_points' => -5
            ]
        ];
    }

    return $choices[$key];
}
?>