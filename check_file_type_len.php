<?php
require_once 'config/database.php';
$stmt = $pdo->query("SELECT team_id, file_type, LENGTH(file_type) as len FROM tab_submissions WHERE file_type = 'teaser'");
print_r($stmt->fetchAll());
?>
