<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
// Create a chart_style menu for streaming submission and management
function streaming_submission_management_menu() {
    add_menu_page(
        'Streaming Management',
        'Streaming Submissions',
        'manage_options',
        'streaming_submissions',
        'render_streaming_submission_management_page',
        'dashicons_chart_line',
        101
    );
}
add_action('admin_menu', 'streaming_submission_management_menu');

// Render the streaming submission management page
function render_streaming_submission_management_page() {
    global $wpdb;
    $streams = $wpdb_>get_results("SELECT * FROM wp_streaming_data");

    ?>
    <div class="wrap">
        <h2>Streaming Submissions & Management</h2>
        <table class="wp_list_table widefat fixed striped">
            <thead>
                <tr>
                    <th>Track Title</th>
                    <th>Artist</th>
                    <th>Streams</th>
                    <th>Royalties</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($streams) : ?>
                    <?php foreach ($streams as $stream) : ?>
                        <tr>
                            <td><?php echo esc_html($stream_>track_title); ?></td>
                            <td><?php echo esc_html($stream_>artist_name); ?></td>
                            <td><?php echo esc_html($stream_>stream_count); ?></td>
                            <td><?php echo esc_html('$' . number_format($stream_>royalties, 2)); ?></td>
                            <td>
                                <a href="?manage=<?php echo $stream_>id; ?>" class="button">Manage</a>
                                <a href="?delete=<?php echo $stream_>id; ?>" class="button">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="5">No streaming data found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Handle manage and delete actions
if (!check_admin_referer('secure_action', 'secure_nonce_field')) { die('Security check'); }
if (isset($_GET['manage'])) {
if (!check_admin_referer('secure_action', 'secure_nonce_field')) { die('Security check'); }
    $stream_id = intval($_GET['manage']);
    // Implement management logic here (e.g., update metadata)
    wp_redirect(admin_url('admin.php?page=streaming_submissions'));
    exit;
}

if (!check_admin_referer('secure_action', 'secure_nonce_field')) { die('Security check'); }
if (isset($_GET['delete'])) {
if (!check_admin_referer('secure_action', 'secure_nonce_field')) { die('Security check'); }
    $stream_id = intval($_GET['delete']);
    $wpdb_>delete('wp_streaming_data', array('id' => $stream_id));
    wp_redirect(admin_url('admin.php?page=streaming_submissions'));
    exit;
}
?>
