<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
// Admin Email Composer with SMTP, Brevo, and Constant Contact linking, including feature toggles and customization

// Add a menu item for the Email Composer
function wavify_add_email_composer_menu() {
    add_menu_page(
        'Email Composer',
        'Email Composer',
        'manage_options',
        'wavify_email_composer',
        'wavify_render_email_composer_page',
        '',
        110
    );
}
add_action('admin_menu', 'wavify_add_email_composer_menu');

// Render the Email Composer Page
function wavify_render_email_composer_page() {
    ?>
    <div class="wrap">
        <h1>Email Composer Settings</h1>

        <!__ Feature Toggle __>
        <h2>Enable Email Composer</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('wavify_email_composer_settings_group');
            do_settings_sections('wavify_email_composer');
            ?>
            <label for="enable_email_composer">Enable Composer:</label>
            <input type="checkbox" name="enable_email_composer" value="1" <?php checked(1, get_option('enable_email_composer'), true); ?> />
            <br><br>

            <!__ SMTP Configuration __>
            <h2>SMTP Settings</h2>
            <label for="smtp_host">SMTP Host:</label>
            <input type="text" name="smtp_host" value="<?php echo get_option('smtp_host'); ?>" /><br>
            <label for="smtp_port">SMTP Port:</label>
            <input type="text" name="smtp_port" value="<?php echo get_option('smtp_port'); ?>" /><br>
            <label for="smtp_user">SMTP Username:</label>
            <input type="text" name="smtp_user" value="<?php echo get_option('smtp_user'); ?>" /><br>
            <label for="smtp_pass">SMTP Password:</label>
            <input type="password" name="smtp_pass" value="<?php echo get_option('smtp_pass'); ?>" /><br>

            <!__ Brevo/Constant Contact Configuration __>
            <h2>Email Marketing Integration</h2>
            <label for="brevo_api_key">Brevo API Key:</label>
            <input type="text" name="brevo_api_key" value="<?php echo get_option('brevo_api_key'); ?>" /><br>
            <label for="constant_contact_api_key">Constant Contact API Key:</label>
            <input type="text" name="constant_contact_api_key" value="<?php echo get_option('constant_contact_api_key'); ?>" /><br>

            <!__ Analytics Section __>
            <h2>Analytics and Troubleshooting</h2>
            <p>Monitor your email sending performance:</p>
            <!__ Placeholder for future analytics like delivery rate, bounce rate, open rate __>
            <div id="email_analytics">
                <p>Open Rate: 45%</p>
                <p>Bounce Rate: 3%</p>
                <p>Delivery Rate: 97%</p>
                <p>Click Rate: 15%</p>
            </div>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register settings for the Email Composer
function wavify_register_email_composer_settings() {
    register_setting('wavify_email_composer_settings_group', 'enable_email_composer');
    register_setting('wavify_email_composer_settings_group', 'smtp_host');
    register_setting('wavify_email_composer_settings_group', 'smtp_port');
    register_setting('wavify_email_composer_settings_group', 'smtp_user');
    register_setting('wavify_email_composer_settings_group', 'smtp_pass');
    register_setting('wavify_email_composer_settings_group', 'brevo_api_key');
    register_setting('wavify_email_composer_settings_group', 'constant_contact_api_key');

    add_settings_section('wavify_email_composer_section', 'Email Composer Settings', null, 'wavify_email_composer');
}
add_action('admin_init', 'wavify_register_email_composer_settings');

?>
