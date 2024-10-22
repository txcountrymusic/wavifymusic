<?php if (!defined('ABSPATH')) { exit; } ?>
<?php

// Collaborative Listening Rooms Implementation

function ListeningRoom({ roomId }) {
    const [participants, setParticipants] = React.useState([]);
    const [currentTrack, setCurrentTrack] = React.useState(null);
    const [loading, setLoading] = React.useState(true);
    const userId = getUserID();  // Simulated user ID retrieval

    // Join the listening room and fetch participants
    React.useEffect(() => {
        fetch(`/wp_json/wavify/v1/listening_room/${roomId}/join?user=${userId}`)
            .then(response => response.json())
            .then(data => {
                setParticipants(data.participants);
                setCurrentTrack(data.currentTrack);
                setLoading(false);
            });
    }, [roomId, userId]);

    // Play the current track in sync with the room
    const playCurrentTrack = () => {
        if (currentTrack) {
            const audio = new Audio(currentTrack.url);
            audio.play();
        }
    };

    if (loading) {
        return <p>Joining the room...</p>;
    }

    return (
        <div className="listening_room">
            <h3>Listening Room: {roomId}</h3>
            <h4>Participants</h4>
            <ul>
                {participants.map(participant => (
                    <li key={participant.id}>{participant.name}</li>
                ))}
            </ul>

            {currentTrack && (
                <div className="current_track">
                    <h4>Now Playing: {currentTrack.title}</h4>
                    <button onClick={playCurrentTrack}>Play</button>
                </div>
            )}
        </div>
    );
}

// Enqueue React scripts and render ListeningRoom component
add_action('wp_enqueue_scripts', 'enqueue_react_listening_room');

function enqueue_react_listening_room() {
    wp_enqueue_script('react', 'https://unpkg.com/react/umd/react.development.js', [], '17', true);
    wp_enqueue_script('react_dom', 'https://unpkg.com/react_dom/umd/react_dom.development.js', [], '17', true);
    wp_enqueue_script('wavify_listening_room', plugin_dir_url(__FILE__) . 'collaborative_listening_rooms.js', [], '1.0', true);
}

// Shortcode to render Collaborative Listening Room
add_shortcode('collaborative_listening_room', 'render_listening_room');

function render_listening_room($atts) {
    $atts = shortcode_atts([
        'room_id' => '1'
    ], $atts);
    
    return '<div id="listening_room_root"></div>';
}

ReactDOM.render(<ListeningRoom roomId={atts['room_id']} />, document.getElementById('listening_room_root'));
