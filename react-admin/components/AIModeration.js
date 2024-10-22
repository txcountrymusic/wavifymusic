
import React, { useEffect, useState } from 'react';
import axios from 'axios';

function AIModeration() {
  const [moderationLogs, setModerationLogs] = useState([]);

  // Fetch moderation logs from backend API
  useEffect(() => {
    axios.get('/api/ai/moderation-logs')
      .then(response => {
        setModerationLogs(response.data);
      })
      .catch(error => {
        console.error("There was an error fetching the moderation logs!", error);
      });
  }, []);

  return (
    <div>
      <h2>AI Content Moderation</h2>
      {moderationLogs.length > 0 ? (
        <ul>
          {moderationLogs.map((log, index) => (
            <li key={index}>{log.message}: {log.status}</li>
          ))}
        </ul>
      ) : (
        <p>No moderation actions taken yet.</p>
      )}
    </div>
  );
}

export default AIModeration;
