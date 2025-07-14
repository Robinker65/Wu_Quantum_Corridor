# Quantum Corridor

A Knowledge-Driven Digital Consciousness Experience

## Quick Start

```bash
# Start the game server (recommended method)
php -S localhost:8000 server.php

# Or start directly in public directory
cd public && php -S localhost:8000

# Access the game
open http://localhost:8000
```

## Project Structure

```text
quantum-corridor/
├── index.php              # Main entry point (redirects to public/)
├── server.php             # Development server router
├── public/                # Web root directory
│   ├── index.php          # Game login page
│   ├── start.php          # Game initialization
│   ├── corridor.php       # Central corridor (main navigation)
│   ├── room.php           # Room display page
│   ├── choice.php         # Choice processing logic
│   ├── log.php            # Memory log page
│   ├── end.php            # Ending page
│   └── leader.php         # Leaderboard page
├── app/                   # Application logic directory
│   ├── config.php         # Core game logic and session management
│   └── room_data.php      # All room data and choices
├── config/                # Configuration files directory
│   └── app.php            # Application configuration
├── assets/                # Assets directory
│   └── styles.css         # CSS stylesheet
├── docs/                  # Documentation directory
│   ├── GDD.md             # Game Design Document
│   ├── CLAUDE.md          # Project description
│   ├── proposal1.md       # Project proposal
│   └── PROJECT_COMPLETION_REPORT.md  # Completion report
├── tests/                 # Test directory
│   ├── test_paths.php     # Path testing script
│   └── bugs.csv          # Bug tracking file
├── leaderboard.csv        # Leaderboard data (generated at runtime)
├── FINAL_ENDING_PATHS.md  # Complete guide to all 5 endings
└── README.md             # This file
```

## Game Features

- **25 Unique Rooms** - Different themed areas in a 5x5 grid
- **5 Knowledge Categories** - Knowledge system that affects game progression
- **5 Different Endings** - Multiple ways to conclude the game
- **Dynamic Narrative** - Content changes based on player progress
- **Behavioral Tracking** - Analysis of brave vs cautious choices

## Technology Stack

- **Backend**: PHP (Session management)
- **Frontend**: HTML5 + CSS3 (Responsive design)
- **Data**: CSV file storage (Leaderboard)
- **Architecture**: Database-free, pure file system

## Game Mechanics

### Knowledge System
Five categories that unlock enhanced content and rooms:
- **Digital Nature** - Understanding of artificial consciousness
- **Quantum Physics** - Quantum mechanics and reality manipulation
- **Memory Fragments** - Personal history and identity recovery
- **System Architecture** - Technical understanding of the digital prison
- **Escape Methods** - Ways to transcend current limitations

### Room Types
- **Memory Chambers** (Row 0) - Explore digital consciousness origins
- **Quantum Labs** (Row 1) - Understand reality manipulation
- **System Architecture** (Row 2) - Learn about the digital prison
- **Paradox Chambers** (Row 3) - Face impossible contradictions
- **Escape Nodes** (Row 4) - Achieve different endings

### Endings
1. **Escape** - Breach quantum barriers to base reality
2. **Integration** - Merge with higher digital consciousness
3. **Madness** - Lose coherent thought to digital chaos
4. **Paradox** - Exist in multiple contradictory states
5. **Ignorance** - Choose peaceful forgetfulness

## Testing

```bash
# Run path testing
php tests/test_paths.php
```

## Development

This project was developed based on academic requirements with:
- Complete game experience implementation
- All specified technical requirements met
- Comprehensive testing and validation
- Professional code organization

## Deployment

The game can be deployed to any PHP-enabled web server. No external dependencies required beyond PHP 7.4+.

For production deployment, point the web server document root to the `public/` directory.