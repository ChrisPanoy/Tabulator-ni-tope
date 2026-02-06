<?php
require_once 'config/database.php';
$stmt = $pdo->query("SHOW CREATE TABLE tab_submissions");
print_r($stmt->fetch());
?>
