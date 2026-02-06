<?php
require_once 'config/database.php';
$stmt = $pdo->query("SELECT DISTINCT category FROM tab_criteria");
print_r($stmt->fetchAll(PDO::FETCH_COLUMN));
?>
