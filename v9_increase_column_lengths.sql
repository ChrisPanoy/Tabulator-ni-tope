-- v9: Increase column lengths to support longer criteria names and categories
-- This fixes "Data too long for column" errors

-- Increase criteria_name length to support longer criteria descriptions
ALTER TABLE tab_criteria MODIFY criteria_name VARCHAR(255) NOT NULL;

-- Increase category length in criteria table
ALTER TABLE tab_criteria MODIFY category VARCHAR(255) DEFAULT 'General';

-- Increase category_name length in rubric categories table
ALTER TABLE tab_rubric_categories MODIFY category_name VARCHAR(255) NOT NULL;
