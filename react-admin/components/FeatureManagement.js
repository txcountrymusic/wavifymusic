
import React, { useState } from 'react';

function FeatureManagement() {
  const [features, setFeatures] = useState({
    aiEnabled: true,
    analyticsEnabled: true,
    moderationEnabled: false,
  });

  const toggleFeature = (featureName) => {
    setFeatures({
      ...features,
      [featureName]: !features[featureName],
    });
  };

  return (
    <div>
      <h2>Feature Management</h2>
      <label>
        <input
          type="checkbox"
          checked={features.aiEnabled}
          onChange={() => toggleFeature('aiEnabled')}
        />
        AI Features Enabled
      </label><br/>
      <label>
        <input
          type="checkbox"
          checked={features.analyticsEnabled}
          onChange={() => toggleFeature('analyticsEnabled')}
        />
        Analytics Features Enabled
      </label><br/>
      <label>
        <input
          type="checkbox"
          checked={features.moderationEnabled}
          onChange={() => toggleFeature('moderationEnabled')}
        />
        Moderation Features Enabled
      </label>
    </div>
  );
}

export default FeatureManagement;
