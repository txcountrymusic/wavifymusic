<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
// Admin Social Media Management with AI Moderation, Dispute Management, and Safety Controls

// Add a menu item for Social Media Management with tabs
function wavify_add_social_menu() {
    add_menu_page(
        'Social Media Management',
        'Social Media Management',
        'manage_options',
        'wavify_social_management',
        'wavify_render_social_management_page',
        '',
        110
    );
}
add_action('admin_menu', 'wavify_add_social_menu');

// Render the Social Media Management Page with tabs
function wavify_render_social_management_page() {
    ?>
    <div class="wrap">
        <h1>Social Media Management</h1>

        <!__ Tabbed Navigation __>
        <h2 class="nav_tab_wrapper">
            <a href="?page=wavify_social_management&tab=general" class="nav_tab <?php echo wavify_get_active_tab('general'); ?>">General Settings</a>
            <a href="?page=wavify_social_management&tab=moderation" class="nav_tab <?php echo wavify_get_active_tab('moderation'); ?>">AI Moderation</a>
            <a href="?page=wavify_social_management&tab=dispute_management" class="nav_tab <?php echo wavify_get_active_tab('dispute_management'); ?>">Dispute Management</a>
            <a href="?page=wavify_social_management&tab=spam" class="nav_tab <?php echo wavify_get_active_tab('spam'); ?>">Spam Prevention</a>
            <a href="?page=wavify_social_management&tab=safety" class="nav_tab <?php echo wavify_get_active_tab('safety'); ?>">Safety Controls</a>
            <a href="?page=wavify_social_management&tab=analytics" class="nav_tab <?php echo wavify_get_active_tab('analytics'); ?>">Social Analytics</a>
        </h2>

        <div class="tab_content">
            <?php
if (!check_admin_referer('secure_action', 'secure_nonce_field')) { die('Security check'); }
            $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
            
            if ($active_tab == 'general') {
                wavify_render_general_settings();
            } elseif ($active_tab == 'moderation') {
                wavify_render_ai_moderation();
            } elseif ($active_tab == 'dispute_management') {
                wavify_render_dispute_management();
            } elseif ($active_tab == 'spam') {
                wavify_render_spam_prevention();
            } elseif ($active_tab == 'safety') {
                wavify_render_safety_controls();
            } elseif ($active_tab == 'analytics') {
                wavify_render_social_analytics();
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

// Link existing social media functions to menus

function wavify_render_general_settings() {
    // Link to social media feed from social_functions.php
    echo esc_html("<h2>General Social Media Feed</h2>";
    social_media_feed(); // Call the social media feed function from social_functions.php
}

function wavify_render_ai_moderation() {
    ?>
    <h2>AI Moderation</h2>
    <p>Manage AI_driven content moderation settings.</p>
    <form method="post" action="">
<?php wp_nonce_field('secure_action', 'secure_nonce_field'); ?>
        <label for="enable_moderation">Enable AI Moderation:</label>
        <input type="checkbox" name="enable_moderation" checked /><br><br>

        <label for="moderation_level">Select Moderation Strictness:</label>
        <select name="moderation_level">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select><br><br>

        <input type="submit" value="Save Settings" />
    </form>
    <?php
}

function wavify_render_dispute_management() {
    ?>
    <h2>Dispute Management</h2>
    <p>Manage user disputes and flagged content.</p>
    <!__ List of disputed items (simulated for now) __>
    <p>Dispute: User A flagged Post 1 for inappropriate content. Status: Pending Review</p>
    <p>Dispute: User B flagged Post 2 for harassment. Status: Under Investigation</p>
    <?php
}

function wavify_render_spam_prevention() {
    ?>
    <h2>Spam Prevention</h2>
    <p>Enable AI_based spam detection and prevention.</p>
    <form method="post" action="">
        <label for="enable_spam_detection">Enable Spam Detection:</label>
        <input type="checkbox" name="enable_spam_detection" checked /><br><br>

        <label for="spam_threshold">Set Spam Detection Threshold:</label>
        <select name="spam_threshold">
            <option value="low">Low Sensitivity</option>
            <option value="medium">Medium Sensitivity</option>
            <option value="high">High Sensitivity</option>
        </select><br><br>

        <input type="submit" value="Save Settings" />
    </form>
    <?php
}

function wavify_render_safety_controls() {
    ?>
    <h2>Safety Controls</h2>
    <p>Set safety controls for content filters and user protection.</p>
    <form method="post" action="">
        <label for="enable_adult_filter">Enable Adult Content Filter:</label>
        <input type="checkbox" name="enable_adult_filter" checked /><br><br>

        <label for="enable_bullying_filter">Enable Anti_Bullying Filter:</label>
        <input type="checkbox" name="enable_bullying_filter" checked /><br><br>

        <input type="submit" value="Save Safety Controls" />
    </form>
    <?php
}

function wavify_render_social_analytics() {
    // Link AI recommendation function from social_recommendations.php
    echo esc_html("<h2>Social Media Analytics</h2>";
    ai_generate_social_post_recommendations(); // Call AI recommendation function
    ?>
    <p>Total Posts: 15,000</p>
    <p>Total Comments: 40,000</p>
    <p>Spam Detected: 150 incidents</p>
    <?php
}

?>
