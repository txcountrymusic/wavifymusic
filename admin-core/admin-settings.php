<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
// Add a menu item for Payment API Settings
function wavify_add_payment_settings_menu() {
    add_menu_page(
        'Payment API Settings',
        'Payment Settings',
        'manage_options',
        'wavify_payment_settings',
        'wavify_render_payment_settings_page',
        '',
        110
    );
}
add_action('admin_menu', 'wavify_add_payment_settings_menu');

// Render the Payment API Settings page
function wavify_render_payment_settings_page() {
    ?>
    <div class="wrap">
        <h1>Payment API Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('wavify_payment_settings_group');
            do_settings_sections('wavify_payment_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings for the Payment API Keys
function wavify_register_payment_settings() {
    register_setting('wavify_payment_settings_group', 'google_pay_merchant_id');
    register_setting('wavify_payment_settings_group', 'apple_pay_merchant_id');
    register_setting('wavify_payment_settings_group', 'paypal_client_id');
    register_setting('wavify_payment_settings_group', 'square_access_token');

    add_settings_section('wavify_payment_settings_section', 'Enter Payment API Keys', null, 'wavify_payment_settings');

    add_settings_field('google_pay_merchant_id', 'Google Pay Merchant ID', 'wavify_google_pay_field', 'wavify_payment_settings', 'wavify_payment_settings_section');
    add_settings_field('apple_pay_merchant_id', 'Apple Pay Merchant ID', 'wavify_apple_pay_field', 'wavify_payment_settings', 'wavify_payment_settings_section');
    add_settings_field('paypal_client_id', 'PayPal Client ID', 'wavify_paypal_field', 'wavify_payment_settings', 'wavify_payment_settings_section');
    add_settings_field('square_access_token', 'Square Access Token', 'wavify_square_field', 'wavify_payment_settings', 'wavify_payment_settings_section');
}
add_action('admin_init', 'wavify_register_payment_settings');

// Callback functions to render input fields for each API key
function wavify_google_pay_field() {
    $google_pay_merchant_id = get_option('google_pay_merchant_id');
    echo esc_html('<input type="text" name="google_pay_merchant_id" value="' . esc_attr($google_pay_merchant_id) . '" />';
}

function wavify_apple_pay_field() {
    $apple_pay_merchant_id = get_option('apple_pay_merchant_id');
    echo esc_html('<input type="text" name="apple_pay_merchant_id" value="' . esc_attr($apple_pay_merchant_id) . '" />';
}

function wavify_paypal_field() {
    $paypal_client_id = get_option('paypal_client_id');
    echo esc_html('<input type="text" name="paypal_client_id" value="' . esc_attr($paypal_client_id) . '" />';
}

function wavify_square_field() {
    $square_access_token = get_option('square_access_token');
    echo esc_html('<input type="text" name="square_access_token" value="' . esc_attr($square_access_token) . '" />';
}
?>
