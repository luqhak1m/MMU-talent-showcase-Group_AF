<?php

# Import necessary MODEL files
require_once __DIR__ . '/../Model/LeaderboardModel.php';

class LeaderboardController {
    private $leaderboardModel;

    public function __construct($pdo) {
        $this->leaderboardModel = new LeaderboardModel($pdo);
    }

    /**
     * Fetches and displays talents for the leaderboard,
     * separating top 3 and remaining talents.
     */
    public function viewLeaderboard() {
        $selectedCategory = $_GET['category'] ?? null; // Get selected category from URL

        $allTalents = $this->leaderboardModel->getTalentsForLeaderboard($selectedCategory);

        $top3Talents = array_slice($allTalents, 0, 3);
        $remainingTalents = array_slice($allTalents, 3);

        // Define all possible categories for the filter dropdown
        $categories = [
            'Music', 'Art', 'Filmmaking', 'Videography', 
            'Photography', 'Animation', 'Voiceover', 'Writing', 'Other' // Added 'Writing' and 'Other' as examples
        ];

        // Pass data to the view
        require_once __DIR__ . '/../View/leaderboard.php';
    }
}
