<?php if (!defined('ABSPATH')) { exit; } ?>
<?php

// Admin Management Functions

// View all users (Admin only)
function view_all_users() {
    // Get all registered users
    $users = get_all_users();
    echo esc_html('<table><tr><th>User ID</th><th>Username</th><th>Email</th><th>Subscription</th></tr>';
    foreach ($users as $user) {
        echo esc_html('<tr><td>' . $user_>ID . '</td><td>' . $user_>user_login . '</td><td>' . $user_>user_email . '</td><td>' . $user_>subscription_level . '</td></tr>';
    }
    echo esc_html('</table>';
}

// Edit user profile (Admin only)
function edit_user_profile($user_id) {
    // Fetch user data and allow admin to edit user info (subscription level, account status, etc.)
    $user = get_user_by('ID', $user_id);
    if ($user) {
        // Display editable fields
        echo esc_html('<form method="post" action="edit_user.php">';
        echo esc_html('Username: <input type="text" name="user_login" value="' . $user_>user_login . '"><br>';
        echo esc_html('Email: <input type="email" name="user_email" value="' . $user_>user_email . '"><br>';
        echo esc_html('Subscription: <select name="subscription_level"><option value="Free">Free</option><option value="Premium">Premium</option><option value="Lossless">Lossless</option></select><br>';
        echo esc_html('<input type="submit" value="Update User"></form>';
    } else {
        echo esc_html('User not found';
    }
}

// Admin customization dashboard (with widgets)
function admin_custom_dashboard() {
    // Admin widgets for real_time analytics, user activity, and AI_generated insights
    echo esc_html('<div class="admin_dashboard">';
    echo esc_html('<h2>Admin Dashboard</h2>';
    echo esc_html('<div class="widget">Total Users: ' . get_total_users() . '</div>';
    echo esc_html('<div class="widget">Streaming Activity: ' . get_streaming_activity() . '</div>';
    echo esc_html('<div class="widget">AI Insights: ' . get_ai_insights() . '</div>';
    echo esc_html('</div>';
}


// Add AI Recommendation Settings to Admin Menu
function register_ai_recommendation_settings() {
    add_menu_page(
        'AI Music Recommendations',
        'AI Recommendations',
        'manage_options',
        'ai_music_recommendations',
        'display_ai_recommendation_settings',
        '',
        110
    );
}

add_action('admin_menu', 'register_ai_recommendation_settings');

// Display settings page for AI Music Recommendations
function display_ai_recommendation_settings() {
    echo esc_html('<div class="wrap">';
    echo esc_html('<h1>AI Music Recommendations</h1>';
    echo esc_html('<form method="post" action="options.php">';
    settings_fields('ai_recommendation_settings_group');
    do_settings_sections('ai_recommendation_settings');
    submit_button();
    echo esc_html('</form>';
    echo esc_html('</div>';
}

// Register settings for AI Music Recommendations
function register_ai_recommendation_settings_group() {
    register_setting('ai_recommendation_settings_group', 'ai_recommendation_threshold');
    register_setting('ai_recommendation_settings_group', 'ai_smart_playlist_enabled');

    add_settings_section(
        'ai_recommendation_section',
        'AI Recommendation Settings',
        null,
        'ai_recommendation_settings'
    );

    add_settings_field(
        'ai_recommendation_threshold',
        'Recommendation Threshold',
        'display_ai_recommendation_threshold_field',
        'ai_recommendation_settings',
        'ai_recommendation_section'
    );

    add_settings_field(
        'ai_smart_playlist_enabled',
        'Enable AI Smart Playlists',
        'display_ai_smart_playlist_field',
        'ai_recommendation_settings',
        'ai_recommendation_section'
    );
}

add_action('admin_init', 'register_ai_recommendation_settings_group');

function display_ai_recommendation_threshold_field() {
    $value = get_option('ai_recommendation_threshold', 5);
    echo esc_html('<input type="number" name="ai_recommendation_threshold" value="' . esc_attr($value) . '" />';
}

function display_ai_smart_playlist_field() {
    $checked = get_option('ai_smart_playlist_enabled', false);
    echo esc_html('<input type="checkbox" name="ai_smart_playlist_enabled" ' . checked($checked, true, false) . ' />';
}

// Enqueue React Script for AI Settings in Admin
function enqueue_ai_settings_react_script() {
    wp_enqueue_script(
        'ai_settings_react',
        plugins_url('/react_components/AISettings.js', __FILE__),
        array('wp_element'),
        time(),
        true
    );

    // Hook the React component into a div in the admin page
    add_action('admin_footer', function () {
        echo esc_html('<div id="ai_settings_root"></div>';
        echo esc_html('<script type="text/javascript">wp.element.render(wp.element.createElement(AISettings), document.getElementById("ai_settings_root"));</script>';
    });
}

add_action('admin_enqueue_scripts', 'enqueue_ai_settings_react_script');
