
import React, { useState } from 'react';
import axios from 'axios';

function NLPAdminCommand() {
  const [command, setCommand] = useState('');
  const [response, setResponse] = useState('');

  // Handle the NLP command submission
  const handleSubmit = (event) => {
    event.preventDefault();
    axios.post({ _wpnonce: 'your_nonce_here',('/api/ai/nlp-command', { command })
      .then(response => {
        setResponse(response.data);
      })
      .catch(error => {
        console.error("There was an error processing the NLP command!", error);
      });
  };

  return (
    <div>
      <h2>AI-Powered Admin Command Interface</h2>
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          value={command}
          onChange={(e) => setCommand(e.target.value)}
          placeholder="Enter your command (e.g., Show top-performing artists)"
        />
        <button type="submit">Submit</button>
      </form>
      {response && <p>{response}</p>}
    </div>
  );
}

export default NLPAdminCommand;
