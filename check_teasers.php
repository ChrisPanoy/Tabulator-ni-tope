<?php
require_once 'config/database.php';
$stmt = $pdo->query("SELECT * FROM tab_submissions WHERE file_type = 'teaser'");
print_r($stmt->fetchAll());
?>
