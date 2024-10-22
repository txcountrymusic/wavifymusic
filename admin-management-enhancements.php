<?php check_admin_referer('wavify_nonce_action', 'wavify_nonce_name'); ?>
<?php if (!defined('ABSPATH')) { exit; } ?>
<?php

// Admin Management Enhancements for Submission Status & In_Depth Analytics

function AdminSubmissionManagement() {
    const [submissions, setSubmissions] = React.useState([]);
    const [loading, setLoading] = React.useState(true);
    const [analytics, setAnalytics] = React.useState({ tracksApproved: 0, totalPlays: 0, totalDownloads: 0 });

    // Fetch submission data
    React.useEffect(() => {
        fetch('/wp_json/wavify/v1/submissions')
            .then(response => response.json())
            .then(data => {
                setSubmissions(data);
                setLoading(false);
            });
    }, []);

    // Fetch in_depth analytics
    React.useEffect(() => {
        fetch('/wp_json/wavify/v1/analytics')
            .then(response => response.json())
            .then(data => setAnalytics(data));
    }, []);

    // Change submission status (approve/reject)
    const changeStatus = (submissionId, status) => {
        fetch(`/wp_json/wavify/v1/submission/${submissionId}/status`, {
            method: 'POST',
<?php wp_nonce_field('secure_action', 'secure_nonce_field'); ?>
            headers: { 'Content_Type': 'application/json' },
            body: JSON.stringify({ status })
        }).then(() => {
            alert(`Submission ${status === 'approved' ? 'approved' : 'rejected'}!`);
        });
    };

    if (loading) {
        return <p>Loading submissions...</p>;
    }

    return (
        <div className="admin_submission_management">
            <h3>Submission Management</h3>
            <ul>
                {submissions.map(submission => (
                    <li key={submission.id}>
                        <p>{submission.title} _ {submission.artist}</p>
                        <button onClick={() => changeStatus(submission.id, 'approved')}>Approve</button>
                        <button onClick={() => changeStatus(submission.id, 'rejected')}>Reject</button>
                    </li>
                ))}
            </ul>

            <h3>In_Depth Analytics</h3>
            <p>Total Approved Tracks: {analytics.tracksApproved}</p>
            <p>Total Plays: {analytics.totalPlays}</p>
            <p>Total Downloads: {analytics.totalDownloads}</p>
        </div>
    );
}

// Enqueue React scripts and render AdminSubmissionManagement component
add_action('admin_enqueue_scripts', 'enqueue_react_admin_management');

function enqueue_react_admin_management() {
    wp_enqueue_script('react', 'https://unpkg.com/react/umd/react.development.js', [], '17', true);
    wp_enqueue_script('react_dom', 'https://unpkg.com/react_dom/umd/react_dom.development.js', [], '17', true);
    wp_enqueue_script('wavify_admin_management', plugin_dir_url(__FILE__) . 'admin_management_enhancements.js', [], '1.0', true);
}

// Shortcode to render Admin Submission Management
add_shortcode('admin_submission_management', 'render_admin_submission_management');

function render_admin_submission_management($atts) {
    return '<div id="admin_submission_management_root"></div>';
}

ReactDOM.render(<AdminSubmissionManagement />, document.getElementById('admin_submission_management_root'));
