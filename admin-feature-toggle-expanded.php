<?php if (!defined('ABSPATH')) { exit; } ?>
<?php

// Expanded Admin Feature Toggle and Advanced Analytics for Wavify Music Plugin

function AdminFeatureToggleExpanded() {
    const [features, setFeatures] = React.useState({
        streaming: true,
        distribution: true,
        analytics: true,
        seo: true,
        payments: true,
        financials: true,
        notifications: true,
    });

    const toggleFeature = (feature) => {
        setFeatures(prev => ({
            ...prev,
            [feature]: !prev[feature]
        }));
    };

    return (
        <div className="admin_feature_toggle_expanded">
            <h3>Admin Feature Toggle Panel</h3>
            <ul>
                {Object.keys(features).map(feature => (
                    <li key={feature}>
                        <label>
                            <input
                                type="checkbox"
                                checked={features[feature]}
                                onChange={() => toggleFeature(feature)}
                            /> 
                            {feature.replace('_', ' ')}
                        </label>
                    </li>
                ))}
            </ul>

            <h3>Advanced Analytics Dashboard</h3>
            <div className="analytics_dashboard">
                <h4>Streaming Analytics</h4>
                <p>Total Streams: 20,000</p>
                <p>Top Tracks by Streams: "Track A", "Track B", "Track C"</p>
                
                <h4>Distribution Analytics</h4>
                <p>Total Distributions: 2,000</p>
                <p>Top Distribution Platforms: Spotify, Apple Music, Tidal</p>
                
                <h4>Financial Analytics</h4>
                <p>Total Revenue: $50,000</p>
                <p>Revenue Breakdown: Streaming _ $20,000 | Distribution _ $30,000</p>
                
                <h4>SEO Analytics</h4>
                <p>Top Pages: /streaming, /distribution, /music_download_center</p>
                <p>Click_Through Rate: 5.2%</p>
            </div>
        </div>
    );
}

// Enqueue React scripts and render AdminFeatureToggleExpanded component
add_action('admin_enqueue_scripts', 'enqueue_react_admin_feature_toggle_expanded');

function enqueue_react_admin_feature_toggle_expanded() {
    wp_enqueue_script('react', 'https://unpkg.com/react/umd/react.development.js', [], '17', true);
    wp_enqueue_script('react_dom', 'https://unpkg.com/react_dom/umd/react_dom.development.js', [], '17', true);
    wp_enqueue_script('wavify_admin_feature_toggle_expanded', plugin_dir_url(__FILE__) . 'admin_feature_toggle_expanded.js', [], '1.0', true);
}

// Shortcode to render the Admin Feature Toggle and Analytics
add_shortcode('admin_feature_toggle_expanded', 'render_admin_feature_toggle_expanded');

function render_admin_feature_toggle_expanded($atts) {
    return '<div id="admin_feature_toggle_expanded_root"></div>';
}

ReactDOM.render(<AdminFeatureToggleExpanded />, document.getElementById('admin_feature_toggle_expanded_root'));
