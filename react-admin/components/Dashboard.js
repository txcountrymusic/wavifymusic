
import React, { useEffect, useState } from 'react';
import axios from 'axios';

function Dashboard() {
  const [submissions, setSubmissions] = useState([]);

  useEffect(() => {
    // Fetch pending submissions for the dashboard widget
    axios.get('/api/submissions/pending')
      .then(response => {
        setSubmissions(response.data);
      })
      .catch(error => {
        console.error("Error fetching pending submissions", error);
      });
  }, []);

  return (
    <div>
      <h1>Admin Dashboard</h1>
      <div>
        <h2>Pending Music Submissions</h2>
        {submissions.length > 0 ? (
          <ul>
            {submissions.map((submission, index) => (
              <li key={index}>{submission.title} - {submission.status}</li>
            ))}
          </ul>
        ) : (
          <p>No pending submissions.</p>
        )}
      </div>
    </div>
  );
}

export default Dashboard;
