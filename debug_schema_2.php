<?php
require_once 'config/database.php';
$stmt = $pdo->query("DESCRIBE tab_submissions");
print_r($stmt->fetchAll());
?>
