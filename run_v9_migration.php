<?php
/**
 * Database Migration Runner for Live Server
 * Run this file once on the live server to apply v9 migration
 * URL: https://your-domain.com/src_tabulator/run_v9_migration.php
 */

require_once 'config/database.php';

// Security: Remove this file after running or add authentication
$migration_password = "tabulator2026"; // Change this!

if (!isset($_GET['password']) || $_GET['password'] !== $migration_password) {
    die("Unauthorized. Add ?password=YOUR_PASSWORD to the URL");
}

echo "<h2>Running v9 Migration: Increase Column Lengths</h2>";
echo "<pre>";

try {
    echo "Starting migration...\n\n";
    
    // Check current column lengths
    echo "Checking current column definitions...\n";
    $result = $pdo->query("SHOW COLUMNS FROM tab_criteria LIKE 'criteria_name'")->fetch();
    echo "Current tab_criteria.criteria_name: " . $result['Type'] . "\n";
    
    $result = $pdo->query("SHOW COLUMNS FROM tab_criteria LIKE 'category'")->fetch();
    echo "Current tab_criteria.category: " . $result['Type'] . "\n";
    
    $result = $pdo->query("SHOW COLUMNS FROM tab_rubric_categories LIKE 'category_name'")->fetch();
    echo "Current tab_rubric_categories.category_name: " . $result['Type'] . "\n\n";
    
    // Apply migrations
    echo "Applying migrations...\n";
    
    echo "1. Updating tab_criteria.criteria_name to VARCHAR(255)...\n";
    $pdo->exec("ALTER TABLE tab_criteria MODIFY criteria_name VARCHAR(255) NOT NULL");
    echo "   ✓ Success\n";
    
    echo "2. Updating tab_criteria.category to VARCHAR(255)...\n";
    $pdo->exec("ALTER TABLE tab_criteria MODIFY category VARCHAR(255) DEFAULT 'General'");
    echo "   ✓ Success\n";
    
    echo "3. Updating tab_rubric_categories.category_name to VARCHAR(255)...\n";
    $pdo->exec("ALTER TABLE tab_rubric_categories MODIFY category_name VARCHAR(255) NOT NULL");
    echo "   ✓ Success\n\n";
    
    // Verify changes
    echo "Verifying changes...\n";
    $result = $pdo->query("SHOW COLUMNS FROM tab_criteria LIKE 'criteria_name'")->fetch();
    echo "New tab_criteria.criteria_name: " . $result['Type'] . "\n";
    
    $result = $pdo->query("SHOW COLUMNS FROM tab_criteria LIKE 'category'")->fetch();
    echo "New tab_criteria.category: " . $result['Type'] . "\n";
    
    $result = $pdo->query("SHOW COLUMNS FROM tab_rubric_categories LIKE 'category_name'")->fetch();
    echo "New tab_rubric_categories.category_name: " . $result['Type'] . "\n\n";
    
    echo "========================================\n";
    echo "✓ Migration completed successfully!\n";
    echo "========================================\n\n";
    echo "You can now add criteria with names up to 255 characters.\n";
    echo "\n<strong style='color: red;'>IMPORTANT: Delete this file (run_v9_migration.php) after successful migration!</strong>\n";
    
} catch (PDOException $e) {
    echo "\n❌ Error during migration:\n";
    echo $e->getMessage() . "\n";
    echo "\nStack trace:\n";
    echo $e->getTraceAsString();
}

echo "</pre>";
?>
