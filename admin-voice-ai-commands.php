<?php if (!defined('ABSPATH')) { exit; } ?>
<?php

<script>
// Voice_Based AI Commands for Wavify Plugin

window.onload = function() {
    if ('webkitSpeechRecognition' in window) {
        const recognition = new webkitSpeechRecognition();
        recognition.continuous = false;
        recognition.lang = 'en_US';
        recognition.interimResults = false;

        recognition.onresult = function(event) {
            const command = event.results[0][0].transcript.toLowerCase();

            if (command.includes('compose a song')) {
                window.location.href = 'admin.php?page=ai_music_composition';
            } else if (command.includes('generate playlist')) {
                window.location.href = 'admin.php?page=generate_playlist';
            } else if (command.includes('analyze audience')) {
                window.location.href = 'admin.php?page=audience_prediction';
            } else {
                alert('Command not recognized. Please try again.');
            }
        };

        document.getElementById('start_voice_command').onclick = function() {
            recognition.start();
        };
    } else {
        alert('Your browser does not support voice commands.');
    }
};
</script>

<button id="start_voice_command">Start Voice Command</button>
