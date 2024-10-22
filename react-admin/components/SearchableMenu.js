
import React, { useState } from 'react';
import { TextField, List, ListItem, ListItemIcon, ListItemText } from '@material-ui/core';
import { Search as SearchIcon, Settings as SettingsIcon, Payment as PaymentIcon, Analytics as AnalyticsIcon } from '@material-ui/icons';

const SearchableMenu = () => {
  const [searchQuery, setSearchQuery] = useState('');
  const [menuItems] = useState([
    { id: '1', title: 'Settings', icon: <SettingsIcon /> },
    { id: '2', title: 'Payments', icon: <PaymentIcon /> },
    { id: '3', title: 'Analytics', icon: <AnalyticsIcon /> },
  ]);

  const filteredItems = menuItems.filter((item) => item.title.toLowerCase().includes(searchQuery.toLowerCase()));

  return (
    <div>
      <TextField
        variant="outlined"
        placeholder="Search Menu..."
        onChange={(e) => setSearchQuery(e.target.value)}
        InputProps={{
          startAdornment: <SearchIcon />,
        }}
      />
      <List>
        {filteredItems.map((item) => (
          <ListItem button key={item.id}>
            <ListItemIcon>{item.icon}</ListItemIcon>
            <ListItemText primary={item.title} />
          </ListItem>
        ))}
      </List>
    </div>
  );
};

export default SearchableMenu;
