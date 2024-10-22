<?php if (!defined('ABSPATH')) { exit; } ?>

<?php
function display_real_time_analytics_dashboard() {
    \$submissions = get_submission_count_by_month();
    \$revenue = get_revenue_data();
    \$engagement = get_user_engagement_stats();

    echo esc_html('<h1>Real_Time Analytics Dashboard</h1>';
    echo esc_html('<canvas id="submissionChart"></canvas>';
    echo esc_html('<canvas id="revenueChart"></canvas>';
    echo esc_html('<canvas id="engagementChart"></canvas>';

    echo esc_html('<script>
        const submissionChart = new Chart(document.getElementById("submissionChart"), {
            type: "bar",
            data: {
                labels: ["January", "February", "March"],
                datasets: [{ data: [' . implode(",", \$submissions) . '] }]
            }
        });

        const revenueChart = new Chart(document.getElementById("revenueChart"), {
            type: "line",
            data: {
                labels: ["January", "February", "March"],
                datasets: [{ data: [' . implode(",", \$revenue) . '] }]
            }
        });

        const engagementChart = new Chart(document.getElementById("engagementChart"), {
            type: "pie",
            data: {
                labels: ["Listeners", "Artists", "Promoters"],
                datasets: [{ data: [' . implode(",", \$engagement) . '] }]
            }
        });
    </script>';
}

add_action('admin_menu', function() {
    add_menu_page('Real_Time Analytics', 'Analytics', 'manage_options', 'real_time_analytics', 'display_real_time_analytics_dashboard');
});
?>
