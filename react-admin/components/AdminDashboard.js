
import React from 'react';
import AIPredictiveAnalytics from './AIPredictiveAnalytics';
import AIModeration from './AIModeration';
import NLPAdminCommand from './NLPAdminCommand';

function AdminDashboard() {
  return (
    <div>
      <h1>Wavify Music Admin Dashboard</h1>
      <p>Welcome to the advanced admin dashboard powered by React and AI!</p>

      <div>
        <h2>AI Features</h2>
        <AIPredictiveAnalytics />
        <AIModeration />
        <NLPAdminCommand />
      </div>
    </div>
  );
}

export default AdminDashboard;
