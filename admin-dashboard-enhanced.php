<?php check_admin_referer('wavify_nonce_action', 'wavify_nonce_name'); ?>
<?php if (!defined('ABSPATH')) { exit; } ?>
<?php

// React_based Admin Dashboard Enhancements for Submission Management and Analytics

function AdminDashboard() {
    const [submissions, setSubmissions] = React.useState([]);
    const [loading, setLoading] = React.useState(true);
    const [selectedSubmissions, setSelectedSubmissions] = React.useState([]);
    const [analytics, setAnalytics] = React.useState({ plays: 0, downloads: 0 });

    // Fetch submissions data
    React.useEffect(() => {
        fetch('/wp_json/wavify/v1/submissions')
            .then(response => response.json())
            .then(data => {
                setSubmissions(data);
                setLoading(false);
            });
    }, []);

    // Fetch analytics data
    React.useEffect(() => {
        fetch('/wp_json/wavify/v1/analytics')
            .then(response => response.json())
            .then(data => setAnalytics(data));
    }, []);

    // Handle bulk approval
    const handleBulkApprove = () => {
        selectedSubmissions.forEach(submission => {
            fetch(`/wp_json/wavify/v1/approve/${submission}`, { method: 'POST' })
<?php wp_nonce_field('secure_action', 'secure_nonce_field'); ?>
                .then(response => response.json())
                .then(result => {
                    // Handle success or failure
                });
        });
        alert('Selected submissions approved!');
    };

    if (loading) {
        return <p>Loading submissions...</p>;
    }

    return (
        <div className="admin_dashboard">
            <h2>Admin Dashboard</h2>
            <h3>Submission Management</h3>
            <ul>
                {submissions.map(submission => (
                    <li key={submission.id}>
                        <input 
                            type="checkbox" 
                            onChange={(e) => setSelectedSubmissions([...selectedSubmissions, submission.id])} 
                        /> 
                        {submission.title} _ {submission.artist}
                    </li>
                ))}
            </ul>
            <button onClick={handleBulkApprove}>Approve Selected Submissions</button>
            
            <h3>Track Analytics</h3>
            <p>Plays: {analytics.plays}</p>
            <p>Downloads: {analytics.downloads}</p>
        </div>
    );
}

// Enqueue React scripts and render AdminDashboard
add_action('admin_enqueue_scripts', 'enqueue_react_admin_dashboard');

function enqueue_react_admin_dashboard() {
    wp_enqueue_script('react', 'https://unpkg.com/react/umd/react.development.js', [], '17', true);
    wp_enqueue_script('react_dom', 'https://unpkg.com/react_dom/umd/react_dom.development.js', [], '17', true);
    wp_enqueue_script('wavify_admin_dashboard', plugin_dir_url(__FILE__) . 'admin_dashboard_enhanced.js', [], '1.0', true);
}

// Shortcode to render the Admin Dashboard
add_shortcode('admin_dashboard', 'render_admin_dashboard');

function render_admin_dashboard($atts) {
    return '<div id="admin_dashboard_root"></div>';
}

ReactDOM.render(<AdminDashboard />, document.getElementById('admin_dashboard_root'));
