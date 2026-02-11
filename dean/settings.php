<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
require_once '../components/ui.php';
requireRole('dean');

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_title'])) {
        $new_title = sanitize($_POST['system_title']);
        
        if (!empty($new_title)) {
            $stmt = $pdo->prepare("UPDATE tab_settings SET setting_value = ? WHERE setting_key = 'system_title'");
            if ($stmt->execute([$new_title])) {
                $message = "System title updated successfully!";
            } else {
                $error = "Failed to update title.";
            }
        } else {
            $error = "Title cannot be empty.";
        }
    }
}

$system_title = get_system_title($pdo);

render_head("System Settings");
render_navbar($_SESSION['full_name'], 'dean', '../', "System Settings");
?>

<div class="container" style="margin-top: 3rem; padding-bottom: 5rem;">
    <div class="page-header" style="margin-bottom: 3rem;">
        <div>
            <h1 style="font-size: 2.25rem; letter-spacing: -0.02em;">System Settings</h1>
            <p style="color: var(--text-light); margin-top: 0.5rem; font-size: 1.1rem;">Manage global system configurations and branding.</p>
        </div>
    </div>

    <?php if($message): ?>
        <div class="alert alert-success animate-fade-in" style="margin-bottom: 2rem; border-left: 4px solid var(--success);">
            <strong>Success:</strong> <?= $message ?>
        </div>
    <?php endif; ?>
    <?php if($error): ?>
        <div class="alert alert-danger animate-fade-in" style="margin-bottom: 2rem; border-left: 4px solid var(--danger);">
            <strong>Error:</strong> <?= $error ?>
        </div>
    <?php endif; ?>

    <div class="card primary-top animate-fade-in" style="max-width: 600px; padding: 2.5rem;">
        <div style="margin-bottom: 2.5rem;">
            <h3 style="margin: 0; font-size: 1.5rem; letter-spacing: -0.01em;">General Branding</h3>
            <p style="color: var(--text-light); font-size: 0.875rem; margin-top: 0.25rem;">This title will appear on the login page and throughout the system.</p>
        </div>

        <form method="POST">
            <input type="hidden" name="update_title" value="1">
            <div class="form-group">
                <label class="form-label" style="font-weight: 700; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.05em; color: var(--text-light);">System Event Title</label>
                <input type="text" name="system_title" class="form-control" value="<?= htmlspecialchars($system_title) ?>" required style="height: 52px; border-radius: var(--radius-md);">
                <p style="font-size: 0.75rem; color: var(--text-light); mt-2;">Example: 3rd Research Colloquium, Annual ICT Fest 2024, etc.</p>
            </div>
            
            <button type="submit" class="btn btn-primary" style="padding: 0 2.5rem; height: 50px; font-weight: 700; border-radius: var(--radius-md); box-shadow: var(--shadow-sm); width: 100%; margin-top: 1rem;">
                Save Configuration
            </button>
        </form>
    </div>
</div>

<?php render_footer(); ?>
