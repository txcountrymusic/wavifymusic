<?php if (!defined('ABSPATH')) { exit; } ?>
<?php

<script>
// Expanded Voice Command System for Admin Panel

window.onload = function() {
    if ('webkitSpeechRecognition' in window) {
        const recognition = new webkitSpeechRecognition();
        recognition.continuous = false;
        recognition.lang = 'en_US';
        recognition.interimResults = false;

        recognition.onresult = function(event) {
            const command = event.results[0][0].transcript.toLowerCase();

            if (command.includes('generate report')) {
                window.location.href = 'admin.php?page=generate_report';
            } else if (command.includes('approve submission')) {
                window.location.href = 'admin.php?page=approve_submission';
            } else if (command.includes('manage users')) {
                window.location.href = 'admin.php?page=manage_users';
            } else if (command.includes('create contract')) {
                window.location.href = 'admin.php?page=create_contract';
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
