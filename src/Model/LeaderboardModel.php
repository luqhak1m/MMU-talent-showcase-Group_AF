<?php

require_once __DIR__ . '/../../config/database.php';

class LeaderboardModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Fetches talents ordered by likes, with optional category filtering.
     * Joins with User and Profile tables to get username and profile picture.
     *
     * @param string|null $category Optional category to filter by.
     * @return array An array of talent data, including username and profile picture.
     */
    public function getTalentsForLeaderboard(?string $category = null): array {
        $params = [];
        $sql = "SELECT 
                    t.TalentID, 
                    t.TalentTitle, 
                    t.TalentDescription, 
                    t.Price, 
                    t.Content, 
                    t.TalentLikes, 
                    t.Category,
                    u.Username,
                    p.ProfilePicture
                FROM Talent t
                JOIN User u ON t.UserID = u.UserID
                LEFT JOIN Profile p ON u.UserID = p.UserID"; 

        $whereClauses = [];
        if ($category && $category !== '') {
            $whereClauses[] = "t.Category = ?";
            $params[] = $category;
        }

        if (!empty($whereClauses)) {
            $sql .= " WHERE " . implode(" AND ", $whereClauses);
        }

        $sql .= " ORDER BY t.TalentLikes DESC, t.TalentTitle ASC"; // Order by likes, then title for consistent tie-breaking

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
