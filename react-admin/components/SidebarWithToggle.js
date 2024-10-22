
import React, { useState } from 'react';
import { Drawer, List, ListItem, ListItemIcon, ListItemText, Switch, CssBaseline, AppBar, Toolbar, Typography, IconButton } from '@material-ui/core';
import { Menu as MenuIcon, Dashboard as DashboardIcon, Brightness4 as Brightness4Icon, Brightness7 as Brightness7Icon } from '@material-ui/icons';

const Sidebar = () => {
  const [isDarkMode, setDarkMode] = useState(false);
  const [sidebarOpen, setSidebarOpen] = useState(true);

  const toggleDarkMode = () => {
    setDarkMode(!isDarkMode);
  };

  const toggleSidebar = () => {
    setSidebarOpen(!sidebarOpen);
  };

  return (
    <div>
      <CssBaseline />
      <AppBar position="fixed">
        <Toolbar>
          <IconButton edge="start" color="inherit" aria-label="menu" onClick={toggleSidebar}>
            <MenuIcon />
          </IconButton>
          <Typography variant="h6" style={{ flexGrow: 1 }}>
            Wavify Admin
          </Typography>
          <IconButton edge="end" color="inherit" onClick={toggleDarkMode}>
            {isDarkMode ? <Brightness7Icon /> : <Brightness4Icon />}
          </IconButton>
        </Toolbar>
      </AppBar>

      <Drawer variant="persistent" anchor="left" open={sidebarOpen}>
        <List>
          <ListItem button>
            <ListItemIcon><DashboardIcon /></ListItemIcon>
            <ListItemText primary="Dashboard" />
          </ListItem>
          {/* Add other menu items as needed */}
        </List>
      </Drawer>
    </div>
  );
};

export default Sidebar;
