<?php
require_once 'config/database.php';
$stmt = $pdo->query("SELECT DISTINCT file_type FROM tab_submissions");
print_r($stmt->fetchAll(PDO::FETCH_COLUMN));
?>
