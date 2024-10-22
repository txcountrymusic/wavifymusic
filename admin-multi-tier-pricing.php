<?php check_admin_referer('wavify_nonce_action', 'wavify_nonce_name'); ?>
<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
// Admin interface to manage multi_tier pricing for subscriptions
function admin_multi_tier_pricing() {
    ?>
    <div class="wrap">
        <h1>Multi_Tier Pricing Management</h1>
        <form method="post" action="">
<?php wp_nonce_field('wavify_nonce_action', 'wavify_nonce_name'); ?>
<?php wp_nonce_field('secure_action', 'secure_nonce_field'); ?>
            <h2>Fan Subscription Tiers</h2>
            <label for="free_price">Free Tier Price:</label>
            <input type="text" name="free_price" value="<?php echo get_option('free_price', 0); ?>" readonly><br>

            <label for="premium_price">Premium Tier Price:</label>
            <input type="text" name="premium_price" value="<?php echo get_option('premium_price', 10); ?>"><br>

            <label for="hifi_price">HiFi Tier Price:</label>
            <input type="text" name="hifi_price" value="<?php echo get_option('hifi_price', 20); ?>"><br>

            <h2>Industry Subscription Tiers</h2>
            <label for="basic_price">Basic Tier Price:</label>
            <input type="text" name="basic_price" value="<?php echo get_option('basic_price', 100); ?>"><br>

            <label for="pro_price">Pro Tier Price:</label>
            <input type="text" name="pro_price" value="<?php echo get_option('pro_price', 250); ?>"><br>

            <label for="enterprise_price">Enterprise Tier Price:</label>
            <input type="text" name="enterprise_price" value="<?php echo get_option('enterprise_price', 500); ?>"><br>

            <input type="submit" value="Save Pricing">
        </form>
    </div>
    <?php

    // Handle price updates
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        update_option('premium_price', sanitize_text_field($_POST['premium_price']));
        update_option('hifi_price', sanitize_text_field($_POST['hifi_price']));
        update_option('basic_price', sanitize_text_field($_POST['basic_price']));
        update_option('pro_price', sanitize_text_field($_POST['pro_price']));
        update_option('enterprise_price', sanitize_text_field($_POST['enterprise_price']));

        echo esc_html("<p>Pricing updated successfully!</p>";
    }
}
?>
