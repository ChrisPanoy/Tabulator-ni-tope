<?php
require_once 'config/database.php';
$stmt = $pdo->prepare("SELECT file_type FROM tab_submissions WHERE team_id = 10");
$stmt->execute();
print_r($stmt->fetchAll(PDO::FETCH_COLUMN));
?>
