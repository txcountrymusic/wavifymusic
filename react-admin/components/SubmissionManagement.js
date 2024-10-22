
import React, { useEffect, useState } from 'react';
import axios from 'axios';

function SubmissionManagement() {
  const [submissions, setSubmissions] = useState([]);

  useEffect(() => {
    // Fetch all submissions for review
    axios.get('/api/submissions/all')
      .then(response => {
        setSubmissions(response.data);
      })
      .catch(error => {
        console.error("Error fetching submissions", error);
      });
  }, []);

  const approveSubmission = (submissionId) => {
    axios.post({ _wpnonce: 'your_nonce_here',(`/api/submissions/approve/${submissionId}`)
      .then(response => {
        alert('Submission approved');
      })
      .catch(error => {
        console.error("Error approving submission", error);
      });
  };

  return (
    <div>
      <h2>Submission Management</h2>
      {submissions.length > 0 ? (
        <ul>
          {submissions.map((submission, index) => (
            <li key={index}>
              {submission.title} - {submission.status} 
              <button onClick={() => approveSubmission(submission.id)}>Approve</button>
            </li>
          ))}
        </ul>
      ) : (
        <p>No submissions available.</p>
      )}
    </div>
  );
}

export default SubmissionManagement;
