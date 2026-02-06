<?php
require_once 'config/database.php';
$stmt = $pdo->query("SELECT id, team_name FROM tab_teams");
print_r($stmt->fetchAll());
?>
