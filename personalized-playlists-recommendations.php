<?php if (!defined('ABSPATH')) { exit; } ?>
<?php

// Advanced Personalized Playlists and Real_Time Recommendations

function PersonalizedPlaylists() {
    const [recommendations, setRecommendations] = React.useState([]);
    const [loading, setLoading] = React.useState(true);
    const [personalizedPlaylist, setPersonalizedPlaylist] = React.useState([]);
    const userId = getUserID();  // Simulated user ID retrieval

    // Fetch personalized recommendations based on user behavior (AI_driven)
    React.useEffect(() => {
        fetch(`/wp_json/wavify/v1/recommendations?user=${userId}`)
            .then(response => response.json())
            .then(data => {
                setRecommendations(data);
                setLoading(false);
            });
    }, [userId]);

    // Generate personalized playlist based on user listening history and preferences
    const generatePlaylist = () => {
        fetch(`/wp_json/wavify/v1/personalized_playlist?user=${userId}`)
            .then(response => response.json())
            .then(playlist => setPersonalizedPlaylist(playlist));
    };

    if (loading) {
        return <p>Loading recommendations...</p>;
    }

    return (
        <div className="personalized_playlists">
            <h3>Your Personalized Playlist</h3>
            <button onClick={generatePlaylist}>Generate My Playlist</button>
            <ul>
                {personalizedPlaylist.map(track => (
                    <li key={track.id}>{track.title} _ {track.artist}</li>
                ))}
            </ul>

            <h3>Recommended for You</h3>
            <ul>
                {recommendations.map(track => (
                    <li key={track.id}>{track.title} _ {track.artist}</li>
                ))}
            </ul>
        </div>
    );
}

// Enqueue React scripts and render PersonalizedPlaylists component
add_action('wp_enqueue_scripts', 'enqueue_react_personalized_playlists');

function enqueue_react_personalized_playlists() {
    wp_enqueue_script('react', 'https://unpkg.com/react/umd/react.development.js', [], '17', true);
    wp_enqueue_script('react_dom', 'https://unpkg.com/react_dom/umd/react_dom.development.js', [], '17', true);
    wp_enqueue_script('wavify_personalized_playlists', plugin_dir_url(__FILE__) . 'personalized_playlists_recommendations.js', [], '1.0', true);
}

// Shortcode to render Personalized Playlists
add_shortcode('personalized_playlists', 'render_personalized_playlists');

function render_personalized_playlists($atts) {
    return '<div id="personalized_playlists_root"></div>';
}

ReactDOM.render(<PersonalizedPlaylists />, document.getElementById('personalized_playlists_root'));
