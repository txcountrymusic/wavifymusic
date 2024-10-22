
import React, { useEffect, useState } from 'react';
import axios from 'axios';

function PaymentsManagement() {
  const [payments, setPayments] = useState([]);

  useEffect(() => {
    // Fetch all pending royalty payments
    axios.get('/api/payments/royalties')
      .then(response => {
        setPayments(response.data);
      })
      .catch(error => {
        console.error("Error fetching payments", error);
      });
  }, []);

  const processPayment = (paymentId) => {
    axios.post({ _wpnonce: 'your_nonce_here',(`/api/payments/process/${paymentId}`)
      .then(response => {
        alert('Payment processed');
      })
      .catch(error => {
        console.error("Error processing payment", error);
      });
  };

  return (
    <div>
      <h2>Payments Management</h2>
      {payments.length > 0 ? (
        <ul>
          {payments.map((payment, index) => (
            <li key={index}>
              {payment.artistName} - Amount: {payment.amount}
              <button onClick={() => processPayment(payment.id)}>Process Payment</button>
            </li>
          ))}
        </ul>
      ) : (
        <p>No pending payments.</p>
      )}
    </div>
  );
}

export default PaymentsManagement;
