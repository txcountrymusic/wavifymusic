
import React, { useState } from 'react';
import axios from 'axios';

function BreadcrumbSettings() {
  const [breadcrumbEnabled, setBreadcrumbEnabled] = useState(true);
  const [separator, setSeparator] = useState(' > ');
  const [depth, setDepth] = useState(3);

  const saveSettings = () => {
    axios.post({ _wpnonce: 'your_nonce_here',('/api/breadcrumbs/settings', {
      breadcrumbEnabled,
      separator,
      depth
    }).then(() => {
      alert('Breadcrumb settings saved successfully!');
    }).catch((error) => {
      console.error('Error saving breadcrumb settings', error);
    });
  };

  return (
    <div>
      <h2>Breadcrumb Settings</h2>
      <label>
        Enable Breadcrumbs:
        <input type="checkbox" checked={breadcrumbEnabled} onChange={() => setBreadcrumbEnabled(!breadcrumbEnabled)} />
      </label><br />
      <label>
        Breadcrumb Separator:
        <input type="text" value={separator} onChange={(e) => setSeparator(e.target.value)} />
      </label><br />
      <label>
        Breadcrumb Depth:
        <input type="number" value={depth} onChange={(e) => setDepth(e.target.value)} min="1" max="5" />
      </label><br />
      <button onClick={saveSettings}>Save Settings</button>
    </div>
  );
}

export default BreadcrumbSettings;
