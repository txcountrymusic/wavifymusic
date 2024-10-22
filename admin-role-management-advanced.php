<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
function create_advanced_role_management_menu() {
    add_menu_page(
        'Role Management', 
        'Role Management', 
        'manage_options', 
        'advanced_role_management', 
        'role_management_page', 
        'dashicons_admin_users', 
        80
    );
}

function role_management_page() {
    \$roles = get_editable_roles();
    echo esc_html('<h1>Advanced Role Management</h1><form method="post" action="options.php">';
    settings_fields('role_management_settings');
    do_settings_sections('role_management_settings');

    foreach (\$roles as \$role_name => \$role_info) {
        echo esc_html('<h3>' . ucfirst(\$role_name) . '</h3>';
        echo esc_html('<input type="checkbox" name="manage_submissions_' . \$role_name . '" ' . checked(\$role_info['capabilities']['manage_submissions'], true, false) . '> Manage Submissions<br>';
        echo esc_html('<input type="checkbox" name="view_financial_reports_' . \$role_name . '" ' . checked(\$role_info['capabilities']['view_financial_reports'], true, false) . '> View Financial Reports<br>';
    }

    submit_button('Save Changes');
    echo esc_html('</form>';
}

add_action('admin_menu', 'create_advanced_role_management_menu');
?>
