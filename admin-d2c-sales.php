<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
/**
 * Direct_to_Consumer (D2C) Sales System for artists.
 * Allows artists to sell exclusive content, subscriptions, and digital products directly to fans.
 */

// Sample D2C offerings (could be dynamically loaded from a database)
$d2c_offerings = [
    ['item' => 'Exclusive Album', 'price' => 25.00, 'type' => 'digital'],
    ['item' => 'VIP Fan Subscription', 'price' => 10.00, 'type' => 'subscription'],
    ['item' => 'Limited Edition Merch', 'price' => 50.00, 'type' => 'physical'],
];

// Function to display D2C store
function display_d2c_store() {
    global $d2c_offerings;

    echo esc_html('<h1>Direct_to_Consumer Store</h1>';
    echo esc_html('<ul>';
    foreach ($d2c_offerings as $offering) {
        echo esc_html('<li>';
        echo $offering['item'] . ' _ $' . number_format($offering['price'], 2);
        echo esc_html(' (' . ucfirst($offering['type']) . ')';
        echo esc_html('</li>';
    }
    echo esc_html('</ul>';
    
    // Option for fans to subscribe or purchase
    echo esc_html('<button>Subscribe or Purchase</button>';
}

// Display the D2C store
display_d2c_store();
?>
