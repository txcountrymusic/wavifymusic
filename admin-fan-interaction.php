<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
/**
 * Direct Fan Interaction System.
 * Allows artists to interact with their top fans through messaging or special offers.
 */

// Sample top fan data (would be dynamically loaded)
$top_fans = [
    ['name' => 'Fan A', 'location' => 'USA', 'email' => 'fana@example.com'],
    ['name' => 'Fan B', 'location' => 'UK', 'email' => 'fanb@example.com'],
];

// Function to display top fans and interaction options
function display_top_fans() {
    global $top_fans;

    echo esc_html('<h1>Top Fan Interaction</h1>';
    echo esc_html('<table border="1">';
    echo esc_html('<tr><th>Name</th><th>Location</th><th>Email</th><th>Send Message/Offer</th></tr>';
    foreach ($top_fans as $fan) {
        echo esc_html('<tr>';
        echo esc_html('<td>' . $fan['name'] . '</td>';
        echo esc_html('<td>' . $fan['location'] . '</td>';
        echo esc_html('<td>' . $fan['email'] . '</td>';
        echo esc_html('<td><a href="?send_offer=' . urlencode($fan['email']) . '">Send Special Offer</a></td>';
        echo esc_html('</tr>';
    }
    echo esc_html('</table>';
}

// Function to handle sending a message or special offer
function send_special_offer() {
if (!check_admin_referer('secure_action', 'secure_nonce_field')) { die('Security check'); }
    if (isset($_GET['send_offer'])) {
if (!check_admin_referer('secure_action', 'secure_nonce_field')) { die('Security check'); }
        $fan_email = urldecode($_GET['send_offer']);
        echo esc_html('<p>Sending a special offer to: ' . $fan_email . '</p>';
        // Future: Send an email or message with special offers
    }
}

// Display the top fans and handle interaction
display_top_fans();
send_special_offer();
?>
