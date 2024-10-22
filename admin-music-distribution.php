<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
// Admin Music Distribution Management interface with a tabbed structure

// Add a menu item for Music Distribution with tabs
function wavify_add_music_distribution_menu() {
    add_menu_page(
        'Music Distribution',
        'Music Distribution',
        'manage_options',
        'wavify_music_distribution',
        'wavify_render_music_distribution_page',
        '',
        110
    );
}
add_action('admin_menu', 'wavify_add_music_distribution_menu');

// Render the Music Distribution Page with tabs
function wavify_render_music_distribution_page() {
    ?>
    <div class="wrap">
        <h1>Music Distribution</h1>

        <!__ Tabbed Navigation __>
        <h2 class="nav_tab_wrapper">
            <a href="?page=wavify_music_distribution&tab=general" class="nav_tab <?php echo wavify_get_active_tab('general'); ?>">General Settings</a>
            <a href="?page=wavify_music_distribution&tab=submissions" class="nav_tab <?php echo wavify_get_active_tab('submissions'); ?>">Submissions</a>
            <a href="?page=wavify_music_distribution&tab=bulk_upload" class="nav_tab <?php echo wavify_get_active_tab('bulk_upload'); ?>">Bulk Upload</a>
            <a href="?page=wavify_music_distribution&tab=status" class="nav_tab <?php echo wavify_get_active_tab('status'); ?>">Distribution Status</a>
            <a href="?page=wavify_music_distribution&tab=payments" class="nav_tab <?php echo wavify_get_active_tab('payments'); ?>">Payments</a>
        </h2>

        <div class="tab_content">
            <?php
if (!check_admin_referer('secure_action', 'secure_nonce_field')) { die('Security check'); }
            $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
            
            if ($active_tab == 'general') {
                wavify_render_general_settings();
            } elseif ($active_tab == 'submissions') {
                wavify_render_submissions();
            } elseif ($active_tab == 'bulk_upload') {
                wavify_render_bulk_upload();
            } elseif ($active_tab == 'status') {
                wavify_render_distribution_status();
            } elseif ($active_tab == 'payments') {
                wavify_render_payments();
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

// Render functions for each tab content

function wavify_render_general_settings() {
    ?>
    <h2>General Settings</h2>
    <p>Configure general settings for music distribution.</p>
    <form method="post" action="">
<?php wp_nonce_field('secure_action', 'secure_nonce_field'); ?>
        <label for="distribution_mode">Select Distribution Mode:</label>
        <select name="distribution_mode">
            <option value="manual">Manual Distribution</option>
            <option value="automatic">Automatic Distribution</option>
        </select><br><br>
        <input type="submit" value="Save Settings" />
    </form>
    <?php
}

function wavify_render_submissions() {
    ?>
    <h2>Music Submissions</h2>
    <p>Manage submissions for the Music Download Center.</p>
    <!__ List of submissions would go here (simulated for now) __>
    <p>Track: Song 1 _ Status: Pending Approval</p>
    <p>Track: Song 2 _ Status: Approved</p>
    <?php
}

function wavify_render_bulk_upload() {
    ?>
    <h2>Bulk Upload Music</h2>
    <form enctype="multipart/form_data" method="post" action="">
        <label for="csv_upload">Upload Metadata via CSV:</label>
        <input type="file" name="csv_upload" accept=".csv" /><br><br>

        <label for="zip_upload">Upload Music Files via ZIP:</label>
        <input type="file" name="zip_upload" accept=".zip" /><br><br>

        <label for="cloud_link">Upload from Cloud (Dropbox, Google Drive, OneDrive):</label>
        <input type="url" name="cloud_link" placeholder="Enter shared link..." /><br><br>

        <input type="submit" value="Upload Music" />
    </form>
    <?php
}

function wavify_render_distribution_status() {
    ?>
    <h2>Distribution Status</h2>
    <p>Track the status of music distribution.</p>
    <!__ Simulated distribution status data __>
    <p>Track: Song 1 _ Status: Distributed</p>
    <p>Track: Song 2 _ Status: Pending</p>
    <?php
}

function wavify_render_payments() {
    ?>
    <h2>Payments</h2>
    <p>Manage payments related to music distribution.</p>
    <!__ Simulated payment data __>
    <p>Artist: Artist 1 _ Payment: $500 _ Status: Paid</p>
    <p>Artist: Artist 2 _ Payment: $300 _ Status: Pending</p>
    <?php
}

?>
