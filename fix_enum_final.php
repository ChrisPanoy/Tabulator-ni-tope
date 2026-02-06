<?php
require_once 'config/database.php';

try {
    echo "Updating tab_submissions file_type enum...\n";
    // Add 'imrad' to the ENUM
    $pdo->exec("ALTER TABLE tab_submissions MODIFY COLUMN file_type ENUM('emrad', 'imrad', 'poster', 'brochure', 'teaser') NOT NULL");
    
    echo "Converting existing 'emrad' records to 'imrad'...\n";
    $pdo->exec("UPDATE tab_submissions SET file_type = 'imrad' WHERE file_type = 'emrad'");
    
    echo "Cleaning up enum to remove 'emrad'...\n";
    $pdo->exec("ALTER TABLE tab_submissions MODIFY COLUMN file_type ENUM('imrad', 'poster', 'brochure', 'teaser') NOT NULL");
    
    echo "Cleaning up any failed entries (empty strings)...\n";
    $pdo->exec("DELETE FROM tab_submissions WHERE file_type = ''");

    echo "Success.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
