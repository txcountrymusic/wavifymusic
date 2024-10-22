<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
// Granular Role Management with Temporary Privilege Escalation

function escalate_privilege(\$user_id, \$temporary_role, \$duration_hours) {
    // Store the user's original role
    \$original_role = get_user_role(\$user_id);
    update_user_meta(\$user_id, 'original_role', \$original_role);

    // Assign the temporary role
    wp_update_user(['ID' => \$user_id, 'role' => \$temporary_role]);

    // Set a timer to revert the role after the duration
    wp_schedule_single_event(time() + (\$duration_hours * HOUR_IN_SECONDS), 'revert_role_to_original', [\$user_id]);
}

function revert_role_to_original(\$user_id) {
    // Revert the user to their original role
    \$original_role = get_user_meta(\$user_id, 'original_role', true);
    if (\$original_role) {
        wp_update_user(['ID' => \$user_id, 'role' => \$original_role]);
    }
}

add_action('revert_role_to_original', 'revert_role_to_original');
?>
