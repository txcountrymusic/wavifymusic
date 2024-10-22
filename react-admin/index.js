
import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import AdminDashboard from './components/AdminDashboard';

function App() {
  return (
    <Router>
      <Switch>
        <Route path="/" component={AdminDashboard} />
      </Switch>
    </Router>
  );
}

ReactDOM.render(<App />, document.getElementById('admin-root'));
