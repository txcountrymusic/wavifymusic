<?php check_admin_referer('wavify_nonce_action', 'wavify_nonce_name'); ?>
<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
// admin_customization.php

// Load saved customization settings
$theme = get_option('site_theme', 'light');  // Default to light mode
$profile_layout = get_option('profile_layout', 'default');
$streaming_layout = get_option('streaming_layout', 'full');

// Handle form submission for updates
if ($_POST['save_customization']) {
<?php wp_nonce_field('secure_action', 'secure_nonce_field'); ?>
    update_option('site_theme', $_POST['theme']);
    update_option('profile_layout', $_POST['profile_layout']);
    update_option('streaming_layout', $_POST['streaming_layout']);
    echo esc_html('Customization settings saved.';
}

// HTML for customization settings form
?>

<form method="POST">
<?php wp_nonce_field('wavify_nonce_action', 'wavify_nonce_name'); ?>
    <label for="theme">Select Theme:</label>
    <select name="theme" id="theme">
        <option value="light" <?php echo ($theme == 'light') ? 'selected' : ''; ?>>Light</option>
        <option value="dark" <?php echo ($theme == 'dark') ? 'selected' : ''; ?>>Dark</option>
    </select>
    
    <label for="profile_layout">Profile Layout:</label>
    <select name="profile_layout" id="profile_layout">
        <option value="default" <?php echo ($profile_layout == 'default') ? 'selected' : ''; ?>>Default</option>
        <option value="minimal" <?php echo ($profile_layout == 'minimal') ? 'selected' : ''; ?>>Minimal</option>
        <option value="full" <?php echo ($profile_layout == 'full') ? 'selected' : ''; ?>>Full</option>
    </select>

    <label for="streaming_layout">Streaming Layout:</label>
    <select name="streaming_layout" id="streaming_layout">
        <option value="default" <?php echo ($streaming_layout == 'default') ? 'selected' : ''; ?>>Default</option>
        <option value="compact" <?php echo ($streaming_layout == 'compact') ? 'selected' : ''; ?>>Compact</option>
        <option value="full" <?php echo ($streaming_layout == 'full') ? 'selected' : ''; ?>>Full</option>
    </select>

    <button type="submit" name="save_customization">Save Customizations</button>
</form>
