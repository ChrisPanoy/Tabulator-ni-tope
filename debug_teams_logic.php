<?php
require_once 'config/database.php';
$submissions_map = [];
$s_stmt = $pdo->query("SELECT * FROM tab_submissions");
while ($row = $s_stmt->fetch()) {
    $submissions_map[$row['team_id']][$row['file_type']] = $row;
}

$team_id = 10;
$team_subs = $submissions_map[$team_id] ?? [];
$doc_labels = ['imrad' => 'IMRAD', 'poster' => 'POSTER', 'brochure' => 'BROCHURE', 'teaser' => 'TEASER'];

foreach($doc_labels as $key => $lbl) {
    if(isset($team_subs[$key])) {
        echo "Found: $lbl ($key)\n";
    } else {
        echo "Missing: $lbl ($key)\n";
    }
}
?>
