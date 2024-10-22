<?php if (!defined('ABSPATH')) { exit; } ?>
<?php

// Social Media Sharing Implementation

// Function to generate social media sharing buttons (for Facebook, Twitter, etc.)
function generate_social_sharing_buttons($url, $title) {
    echo esc_html('<div class="social_sharing_buttons">';
    echo esc_html('<a href="https://www.facebook.com/sharer.php?u=' . urlencode($url) . '" target="_blank">Share on Facebook</a>';
    echo esc_html(' | ';
    echo esc_html('<a href="https://twitter.com/share?url=' . urlencode($url) . '&text=' . urlencode($title) . '" target="_blank">Share on Twitter</a>';
    echo esc_html(' | ';
    echo esc_html('<a href="https://www.linkedin.com/shareArticle?url=' . urlencode($url) . '&title=' . urlencode($title) . '" target="_blank">Share on LinkedIn</a>';
    echo esc_html('</div>';
}

// Shortcode to display social media sharing buttons
add_shortcode('social_sharing', 'render_social_sharing');

function render_social_sharing($atts) {
    $atts = shortcode_atts([
        'url' => get_permalink(),
        'title' => get_the_title()
    ], $atts);
    
    ob_start();
    generate_social_sharing_buttons($atts['url'], $atts['title']);
    return ob_get_clean();
}
