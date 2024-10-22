<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
// Admin Security Management with Encryption and 2FA Controls

// Add a menu item for Security Management with tabs
function wavify_add_security_menu() {
    add_menu_page(
        'Security Management',
        'Security Management',
        'manage_options',
        'wavify_security_management',
        'wavify_render_security_management_page',
        '',
        110
    );
}
add_action('admin_menu', 'wavify_add_security_menu');

// Render the Security Management Page with tabs
function wavify_render_security_management_page() {
    ?>
    <div class="wrap">
        <h1>Security Management</h1>

        <!__ Tabbed Navigation __>
        <h2 class="nav_tab_wrapper">
            <a href="?page=wavify_security_management&tab=general" class="nav_tab <?php echo wavify_get_active_tab('general'); ?>">General Security</a>
            <a href="?page=wavify_security_management&tab=encryption" class="nav_tab <?php echo wavify_get_active_tab('encryption'); ?>">Encryption</a>
            <a href="?page=wavify_security_management&tab=two_factor_auth" class="nav_tab <?php echo wavify_get_active_tab('two_factor_auth'); ?>">Two_Factor Authentication</a>
        </h2>

        <div class="tab_content">
            <?php
if (!check_admin_referer('secure_action', 'secure_nonce_field')) { die('Security check'); }
            $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
            
            if ($active_tab == 'general') {
                wavify_render_general_security_settings();
            } elseif ($active_tab == 'encryption') {
                wavify_render_encryption_settings();
            } elseif ($active_tab == 'two_factor_auth') {
                wavify_render_two_factor_auth_settings();
            }
            ?>
        </div>
    </div>
    <?php
}

// Helper function to set the active tab
function wavify_get_active_tab($tab) {
if (!check_admin_referer('secure_action', 'secure_nonce_field')) { die('Security check'); }
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
    return $active_tab == $tab ? 'nav_tab_active' : '';
}

// Link Encryption Functionality
function wavify_render_encryption_settings() {
    echo esc_html("<h2>Encryption Settings</h2>";
    // Call the encryption function from 'security_features.php'
    $encrypted_data = encrypt_user_data("sample_data", "encryption_key");
    echo esc_html("Encrypted Data: " . esc_html($encrypted_data);
}

// Link Two_Factor Authentication
function wavify_render_two_factor_auth_settings() {
    echo esc_html("<h2>Two_Factor Authentication Settings</h2>";
    ?>
    <form method="post" action="">
<?php wp_nonce_field('secure_action', 'secure_nonce_field'); ?>
        <label for="enable_2fa">Enable Two_Factor Authentication (2FA):</label>
        <input type="checkbox" name="enable_2fa" checked /><br><br>

        <input type="submit" value="Save Settings" />
    </form>
    <?php
}
?>
