<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
// Register custom admin menus and submenus for Wavify Plugin
function wavify_register_admin_menus() {
    // Main Admin Menu
    add_menu_page(
        'Wavify Plugin',           // Page title
        'Wavify',                  // Menu title
        'manage_options',          // Capability
        'wavify_plugin',           // Menu slug
        'wavify_dashboard_page',   // Callback function
        'dashicons_playlist_audio', // Icon
        2                          // Position
    );

    // Submenu for Dashboard
    add_submenu_page(
        'wavify_plugin',           // Parent slug
        'Admin Dashboard',         // Page title
        'Dashboard',               // Menu title
        'manage_options',          // Capability
        'wavify_dashboard',        // Menu slug
        'wavify_dashboard_page'    // Callback function
    );

    // Submenu for Payment Settings
    add_submenu_page(
        'wavify_plugin',           // Parent slug
        'Payment Settings',        // Page title
        'Payment Settings',        // Menu title
        'manage_options',          // Capability
        'wavify_payment_settings', // Menu slug
        'wavify_payment_settings_page' // Callback function
    );

    // Submenu for Feature Toggles
    add_submenu_page(
        'wavify_plugin',           // Parent slug
        'Feature Toggles',         // Page title
        'Feature Toggles',         // Menu title
        'manage_options',          // Capability
        'wavify_feature_toggles',  // Menu slug
        'wavify_feature_toggles_page'  // Callback function
    );
}
add_action('admin_menu', 'wavify_register_admin_menus');

// Callback function for the dashboard page
function wavify_dashboard_page() {
    echo esc_html('<h1>Wavify Plugin Dashboard</h1>';
    echo esc_html('<p>Manage submissions, view analytics, and control settings for the Wavify Plugin.</p>';
}

// Callback function for the payment settings page
function wavify_payment_settings_page() {
    echo esc_html('<h1>Payment Settings</h1>';
    echo esc_html('<form method="post" action="options.php">';
    settings_fields('wavify_payment_settings_group');
    do_settings_sections('wavify_payment_settings');
    submit_button();
    echo esc_html('</form>';
}

// Callback function for the feature toggles page
function wavify_feature_toggles_page() {
    echo esc_html('<h1>Feature Toggles</h1>';
    echo esc_html('<form method="post" action="options.php">';
    settings_fields('wavify_feature_toggle_group');
    do_settings_sections('wavify_feature_toggles');
    submit_button();
    echo esc_html('</form>';
}
?>
