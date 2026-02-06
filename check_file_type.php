<?php
require_once 'config/database.php';
$stmt = $pdo->query("DESCRIBE tab_submissions 'file_type'");
print_r($stmt->fetch());
?>
