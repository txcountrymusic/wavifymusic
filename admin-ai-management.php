<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
// Admin AI Management with AI Recommendations and SEO Enhancements

// Add a menu item for AI Management with tabs
function wavify_add_ai_menu() {
    add_menu_page(
        'AI Management',
        'AI Management',
        'manage_options',
        'wavify_ai_management',
        'wavify_render_ai_management_page',
        '',
        110
    );
}
add_action('admin_menu', 'wavify_add_ai_menu');

// Render the AI Management Page with tabs
function wavify_render_ai_management_page() {
    ?>
    <div class="wrap">
        <h1>AI Management</h1>

        <!__ Tabbed Navigation __>
        <h2 class="nav_tab_wrapper">
            <a href="?page=wavify_ai_management&tab=general" class="nav_tab <?php echo wavify_get_active_tab('general'); ?>">General Settings</a>
            <a href="?page=wavify_ai_management&tab=music_recommendations" class="nav_tab <?php echo wavify_get_active_tab('music_recommendations'); ?>">AI Music Recommendations</a>
            <a href="?page=wavify_ai_management&tab=seo" class="nav_tab <?php echo wavify_get_active_tab('seo'); ?>">AI SEO Enhancements</a>
        </h2>

        <div class="tab_content">
            <?php
if (!check_admin_referer('secure_action', 'secure_nonce_field')) { die('Security check'); }
            $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
            
            if ($active_tab == 'general') {
                wavify_render_general_settings();
            } elseif ($active_tab == 'music_recommendations') {
                wavify_render_ai_music_recommendations();
            } elseif ($active_tab == 'seo') {
                wavify_render_ai_seo_enhancements();
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

// Link AI Music Recommendations
function wavify_render_ai_music_recommendations() {
    echo esc_html("<h2>AI Music Recommendations</h2>";
    ai_generate_music_recommendations(); // Call the function from 'music_recommendations.php'
}

// Link AI SEO Enhancements
function wavify_render_ai_seo_enhancements() {
    echo esc_html("<h2>AI SEO Enhancements</h2>";
    generateSeoMeta(); // Call the function from 'ai_seo_enhancements.php'
}
?>
