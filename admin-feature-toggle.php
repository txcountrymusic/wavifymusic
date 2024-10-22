<?php if (!defined('ABSPATH')) { exit; } ?>
<?php

// Admin Feature Toggle Menu and Role_Based Access Control

function AdminFeatureToggle() {
    const [features, setFeatures] = React.useState({
        streaming: true,
        distribution: true,
        ai_playlists: true,
        release_scheduling: true,
        email_campaigns: true,
        adaptive_streaming: true,
        metadata_tagging: true
    });

    const [roles, setRoles] = React.useState({
        admin: { streaming: true, distribution: true },
        artist: { streaming: false, distribution: true },
        promoter: { streaming: false, distribution: true },
        listener: { streaming: true, distribution: false }
    });

    // Handle toggling features on or off
    const toggleFeature = (feature) => {
        setFeatures(prev => ({
            ...prev,
            [feature]: !prev[feature]
        }));
    };

    // Handle updating role permissions
    const updateRolePermission = (role, feature) => {
        setRoles(prev => ({
            ...prev,
            [role]: {
                ...prev[role],
                [feature]: !prev[role][feature]
            }
        }));
    };

    // Render the toggle menu and role_based access control
    return (
        <div className="admin_feature_toggle">
            <h3>Feature Toggle Menu</h3>
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

            <h3>Role_Based Access Control</h3>
            <table>
                <thead>
                    <tr>
                        <th>Role</th>
                        {Object.keys(features).map(feature => (
                            <th key={feature}>{feature.replace('_', ' ')}</th>
                        ))}
                    </tr>
                </thead>
                <tbody>
                    {Object.keys(roles).map(role => (
                        <tr key={role}>
                            <td>{role}</td>
                            {Object.keys(features).map(feature => (
                                <td key={feature}>
                                    <input
                                        type="checkbox"
                                        checked={roles[role][feature]}
                                        onChange={() => updateRolePermission(role, feature)}
                                    />
                                </td>
                            ))}
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}

// Enqueue React scripts and render AdminFeatureToggle component
add_action('admin_enqueue_scripts', 'enqueue_react_feature_toggle');

function enqueue_react_feature_toggle() {
    wp_enqueue_script('react', 'https://unpkg.com/react/umd/react.development.js', [], '17', true);
    wp_enqueue_script('react_dom', 'https://unpkg.com/react_dom/umd/react_dom.development.js', [], '17', true);
    wp_enqueue_script('wavify_admin_feature_toggle', plugin_dir_url(__FILE__) . 'admin_feature_toggle.js', [], '1.0', true);
}

// Shortcode to render Admin Feature Toggle Menu
add_shortcode('admin_feature_toggle', 'render_feature_toggle_menu');

function render_feature_toggle_menu($atts) {
    return '<div id="feature_toggle_root"></div>';
}

ReactDOM.render(<AdminFeatureToggle />, document.getElementById('feature_toggle_root'));
