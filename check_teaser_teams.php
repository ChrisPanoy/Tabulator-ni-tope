<?php
require_once 'config/database.php';
$stmt = $pdo->query("SELECT team_id, file_type FROM tab_submissions WHERE file_type = 'teaser'");
print_r($stmt->fetchAll());

$stmt_teams = $pdo->query("SELECT id, team_name FROM tab_teams");
print_r($stmt_teams->fetchAll());
?>
