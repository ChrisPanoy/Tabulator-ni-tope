<?php
require_once 'config/database.php';

try {
    // Check if teaser is already in enum
    $stmt = $pdo->query("SHOW COLUMNS FROM tab_submissions LIKE 'file_type'");
    $row = $stmt->fetch();
    $type = $row['Type'];
    
    if (strpos($type, "'teaser'") === false) {
        echo "Adding 'teaser' to file_type enum...\n";
        // Modify ENUM to include teaser
        $pdo->exec("ALTER TABLE tab_submissions MODIFY COLUMN file_type ENUM('emrad', 'poster', 'brochure', 'teaser') NOT NULL");
        echo "Success.\n";
    } else {
        echo "'teaser' already exists in file_type enum.\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
