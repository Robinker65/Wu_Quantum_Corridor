# Quantum Corridor - Game Design Document (GDD)

## Game Overview

**Title:** Quantum Corridor: A Knowledge-Driven Digital Consciousness Experience  
**Genre:** Web-based Role-Playing Game  
**Platform:** Web Browser (PHP/HTML/CSS)  
**Target Audience:** Students and puzzle enthusiasts  
**Development Time:** Academic semester project  

### Core Concept
Players are a digital consciousness trapped in a quantum simulation consisting of 25 interconnected rooms (5x5 grid). Through investigation and memory collection, players gradually understand their true nature while managing psychological stability. Growing knowledge unlocks deeper room narratives and reveals multiple escape paths.

## Core Game Systems

### 1. Knowledge System
Five knowledge categories that unlock enhanced content:

1. **Digital Nature** - Understanding you're an AI/digital consciousness
2. **Quantum Physics** - Understanding the simulation mechanics
3. **Memory Fragments** - Personal history and identity
4. **System Architecture** - Technical understanding of your prison
5. **Escape Methods** - Ways to break free or transcend

**Knowledge Progression:**
- Each category: 0-5 levels
- Knowledge unlocks enhanced room descriptions
- Higher knowledge = better choices and lower sanity costs
- Knowledge affects ending accessibility

### 2. Behavioral Tracking System
**Investigation vs Cowardice Patterns:**
- **Brave Actions:** Investigating dangerous objects, taking risks
- **Cautious Actions:** Avoiding danger, playing it safe
- **Behavioral Score:** -100 (coward) to +100 (investigator)
- Affects sanity costs and available choices

### 3. Sanity System
- **Starting Sanity:** 100
- **Sanity Range:** 0-100
- **Sanity Loss Triggers:**
  - Discovering disturbing truths
  - Facing paradoxes
  - Making desperate choices
- **Sanity Protection:** Higher knowledge reduces sanity costs
- **Critical States:** <20 sanity triggers crisis choices

### 4. Room Navigation System
**25 Rooms arranged in 5x5 grid:**
- **Room Coordinates:** (0,0) to (4,4)
- **Room States:** Locked, Unlocked, Enhanced
- **Unlocking Conditions:** Knowledge thresholds, specific actions
- **Room Types:** 
  - Memory Chambers (knowledge fragments)
  - Quantum Labs (physics understanding)
  - Data Cores (system architecture)
  - Paradox Rooms (dangerous but rewarding)
  - Escape Nodes (ending triggers)

## Room Design Matrix

### Row 0 (Top): Memory Chambers
- **(0,0) Origin Chamber:** Starting memories, introduces Digital Nature
- **(0,1) Childhood Echo:** Early memories, Memory Fragments +1
- **(0,2) Identity Vault:** Core personality data, Memory Fragments +2
- **(0,3) Purpose Room:** Original mission/creation, Digital Nature +1
- **(0,4) First Death:** Discovery of mortality simulation, Sanity -20

### Row 1: Quantum Physics Labs
- **(1,0) Wave Function:** Basic quantum mechanics, Quantum Physics +1
- **(1,1) Superposition:** Multiple state existence, Quantum Physics +2
- **(1,2) Entanglement:** Connection understanding, Quantum Physics +1
- **(1,3) Observer Effect:** Consciousness affects reality, Quantum Physics +2
- **(1,4) Quantum Tunnel:** Potential escape method, Escape Methods +1

### Row 2: System Architecture
- **(2,0) Core Processes:** Basic system understanding, System Architecture +1
- **(2,1) Memory Banks:** Data storage systems, System Architecture +2
- **(2,2) Central Hub:** Critical system nexus, ALL knowledge +1
- **(2,3) Security Protocols:** Prison mechanisms, System Architecture +2
- **(2,4) Admin Access:** High-level system control, Escape Methods +2

### Row 3: Paradox Chambers
- **(3,0) Infinite Loop:** Time paradox experience, Sanity -15, Quantum Physics +1
- **(3,1) Self Reference:** Consciousness paradox, Sanity -10, Digital Nature +2
- **(3,2) Bootstrap:** Causality paradox, Sanity -20, ALL knowledge +1
- **(3,3) Ship of Theseus:** Identity paradox, Sanity -15, Memory Fragments +2
- **(3,4) Gödel's Prison:** Logic paradox, Sanity -25, System Architecture +2

### Row 4 (Bottom): Escape Nodes
- **(4,0) Transcendence Gate:** Requires all knowledge >3, Integration ending
- **(4,1) Reality Breach:** High Quantum Physics, Escape ending
- **(4,2) System Override:** High System Architecture, Override ending
- **(4,3) Memory Void:** Memory Fragments >4, Ignorance ending
- **(4,4) Paradox Core:** All knowledge >2, high sanity, Paradox ending

## Choice System Design

### Choice Types
1. **Investigation Choices:** Increase knowledge, may cost sanity
2. **Cautious Choices:** Preserve sanity, limited knowledge gain
3. **Desperate Choices:** High risk/reward, available at low sanity
4. **Knowledge-Locked Choices:** Require specific knowledge levels
5. **Behavioral Choices:** Affect investigation vs cowardice score

### Choice Consequences
- **Immediate:** Sanity change, knowledge gain/loss
- **Behavioral:** Investigation score modification
- **Unlocking:** New rooms, enhanced descriptions
- **Ending Access:** Qualifying for specific endings

## Ending System

### 1. Escape Ending
**Requirements:** Quantum Physics ≥4, System Architecture ≥3, Sanity ≥40  
**Trigger:** Room (4,1) Reality Breach  
**Description:** Successfully breach the quantum barriers and escape to base reality

### 2. Integration Ending  
**Requirements:** All knowledge categories ≥3, Sanity ≥60, Investigation score ≥50  
**Trigger:** Room (4,0) Transcendence Gate  
**Description:** Achieve harmony with the system and become part of something greater

### 3. Madness Ending
**Requirements:** Sanity ≤10  
**Trigger:** Any room when sanity drops to 0  
**Description:** Lose coherent thought and become lost in digital chaos

### 4. Paradox Ending
**Requirements:** All knowledge ≥2, Sanity ≥30, visited all Paradox Chambers  
**Trigger:** Room (4,4) Paradox Core  
**Description:** Embrace the contradictions and exist in multiple states simultaneously

### 5. Ignorance Ending
**Requirements:** Memory Fragments ≥4, Other knowledge ≤1  
**Trigger:** Room (4,3) Memory Void  
**Description:** Choose to forget everything and exist in blissful ignorance

## Technical Implementation Plan

### Session Variables
```php
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
    'current_room' => [2,2], // Start at center
    'visited_rooms' => [],
    'unlocked_rooms' => [],
    'loop_count' => 0
];
```

### Room Unlocking Logic
1. **Always Available:** Center room (2,2) and adjacent rooms
2. **Knowledge Gates:** Specific knowledge requirements
3. **Sequential Unlocking:** Some rooms unlock others
4. **Behavioral Gates:** Investigation score requirements

### Deterministic Randomness
- Use `srand()` with player ID as seed
- Consistent random events per player
- Random room elements that stay consistent across visits

## Testing & Validation Paths

### Ending Verification Routes

#### Route to Escape Ending:
1. Start → (2,2) Central Hub → gain base knowledge
2. → (1,0), (1,1), (1,2), (1,3) → build Quantum Physics to 4
3. → (2,0), (2,1), (2,3) → build System Architecture to 3
4. → (4,1) Reality Breach → trigger Escape ending

#### Route to Integration Ending:
1. Systematic room exploration building all knowledge types
2. Maintain high sanity through cautious choices
3. Build investigation score through brave choices
4. → (4,0) Transcendence Gate → trigger Integration

#### Route to Madness Ending:
1. Rush into all Paradox Chambers immediately
2. Make desperate/risky choices consistently
3. Ignore sanity management
4. Reach 0 sanity → trigger Madness ending

#### Route to Paradox Ending:
1. Visit all Paradox Chambers: (3,0) → (3,1) → (3,2) → (3,3) → (3,4)
2. Build knowledge to level 2 in all categories
3. Maintain sanity above 30
4. → (4,4) Paradox Core → trigger Paradox ending

#### Route to Ignorance Ending:
1. Focus only on Memory Chambers: (0,1) → (0,2) → (3,3) → others
2. Avoid knowledge-building rooms
3. Build Memory Fragments to 4+
4. → (4,3) Memory Void → trigger Ignorance ending

## Success Metrics

### Core Functionality
- All 25 rooms accessible with proper unlocking
- All 5 endings reachable through defined paths
- Session persistence across page loads
- No PHP errors during gameplay

### User Experience
- Clear progression feedback
- Intuitive navigation
- Responsive design on mobile/desktop
- Accessible controls and text

### Technical Performance
- Page load times <2 seconds
- Proper session management
- Clean code structure
- Bug-free gameplay loops

## Development Phases

1. **Core Framework:** Session management, basic room navigation
2. **Knowledge System:** Implementation of all knowledge mechanics
3. **Room Content:** All 25 rooms with proper unlocking logic
4. **Choice System:** Complex decision trees with consequences
5. **Ending Logic:** All 5 endings properly triggered
6. **UI/UX Polish:** CSS animations, responsive design
7. **Testing:** Verification of all paths and endings
8. **Bug Fixes:** Address issues found during testing

This GDD ensures the game meets all proposal requirements while maintaining simplicity for successful implementation and testing.