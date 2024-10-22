
import React, { Suspense, useState, useEffect } from 'react';
import { useQuery } from 'react-query';
import { atom, useRecoilState } from 'recoil';
import { RecoilRoot } from 'recoil';
import { fetchAIAnalyticsData } from './api/aiData';
import io from 'socket.io-client';  // WebSocket client

// Recoil state management
const aiAnalyticsState = atom({
  key: 'aiAnalyticsState',
  default: []
});

// React Query data fetching
const fetchAnalytics = async () => {
  const response = await fetchAIAnalyticsData();
  return response.json();
};

// WebSocket connection for real-time updates
const socket = io('https://wavify-analytics-socket.com');  // Placeholder for actual WebSocket server

function AIPredictiveAnalytics() {
  const [analyticsData, setAnalyticsData] = useRecoilState(aiAnalyticsState);
  const { data, isLoading } = useQuery('aiAnalytics', fetchAnalytics, {
    suspense: true,
    refetchInterval: 60000, // Poll every 60 seconds
  });

  useEffect(() => {
    // Listen for real-time updates from the WebSocket server
    socket.on('analyticsUpdate', (newData) => {
      setAnalyticsData((prevState) => [...prevState, newData]);
    });

    // Clean up WebSocket connection on component unmount
    return () => {
      socket.off('analyticsUpdate');
    };
  }, []);

  return (
    <RecoilRoot>
      <div>
        <h1>AI Predictive Analytics</h1>
        <Suspense fallback={<div>Loading analytics data...</div>}>
          {isLoading ? (
            <p>Loading...</p>
          ) : (
            <div>
              <ul>
                {data.map((item, index) => (
                  <li key={index}>{item.name}: {item.value}</li>
                ))}
              </ul>
              {/* Real-time data from WebSocket */}
              <ul>
                {analyticsData.map((item, index) => (
                  <li key={index}>{item.name}: {item.value}</li>
                ))}
              </ul>
            </div>
          )}
        </Suspense>
      </div>
    </RecoilRoot>
  );
}

export default AIPredictiveAnalytics;
