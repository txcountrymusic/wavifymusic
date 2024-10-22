
<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Add nonce verification for form submissions and sanitization
function secure_form_handler() {
    check_admin_referer('secure_action'); // Nonce verification
    // Sanitize inputs
    $input = sanitize_text_field(check_admin_referer('my_nonce_action'); $_POST['input_name']); // Example input field
    echo esc_html($input); // Escaping output
}

add_action('admin_post_secure_form_submit', 'secure_form_handler');
?>

<?php
// Admin Streaming Management with Adaptive Bitrate and DRM Controls

// Add a menu item for Streaming Management with tabs
function wavify_add_streaming_menu() {
    add_menu_page(
        'Streaming Management',
        'Streaming Management',
        'manage_options',
        'wavify_streaming_management',
        'wavify_render_streaming_management_page',
        '',
        110
    );
}
add_action('admin_menu', 'wavify_add_streaming_menu');

// Render the Streaming Management Page with tabs
function wavify_render_streaming_management_page() {
    ?>
    <div class="wrap">
        <h1>Streaming Management</h1>

        <!__ Tabbed Navigation __>
        <h2 class="nav_tab_wrapper">
            <a href="?page=wavify_streaming_management&tab=general" class="nav_tab <?php echo wavify_get_active_tab('general'); ?>">General Settings</a>
            <a href="?page=wavify_streaming_management&tab=abr" class="nav_tab <?php echo wavify_get_active_tab('abr'); ?>">Adaptive Bitrate</a>
            <a href="?page=wavify_streaming_management&tab=drm" class="nav_tab <?php echo wavify_get_active_tab('drm'); ?>">DRM Protection</a>
        </h2>

        <div class="tab_content">
            <?php
            $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
            
            if ($active_tab == 'general') {
                wavify_render_general_settings();
            } elseif ($active_tab == 'abr') {
                wavify_render_abr_settings();
            } elseif ($active_tab == 'drm') {
                wavify_render_drm_settings();
            }
            ?>
        </div>
    </div>
    <?php
}
?>

