<?php
require_once 'config/database.php';
$stmt = $pdo->query("SHOW COLUMNS FROM tab_submissions LIKE 'file_type'");
print_r($stmt->fetch());
?>
