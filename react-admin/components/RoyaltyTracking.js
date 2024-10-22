
import React, { useEffect, useState } from 'react';
import axios from 'axios';

function RoyaltyTracking() {
  const [royalties, setRoyalties] = useState([]);

  useEffect(() => {
    // Fetch all royalties owed to artists
    axios.get('/api/royalties')
      .then(response => {
        setRoyalties(response.data);
      })
      .catch(error => {
        console.error("Error fetching royalties", error);
      });
  }, []);

  return (
    <div>
      <h2>Royalty Tracking</h2>
      {royalties.length > 0 ? (
        <ul>
          {royalties.map((royalty, index) => (
            <li key={index}>
              {royalty.artistName} - Amount Owed: {royalty.amountOwed}
            </li>
          ))}
        </ul>
      ) : (
        <p>No royalties owed at the moment.</p>
      )}
    </div>
  );
}

export default RoyaltyTracking;
