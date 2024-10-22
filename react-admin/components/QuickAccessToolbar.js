
import React from 'react';
import { Fab, Tooltip } from '@material-ui/core';
import { Add as AddIcon, Edit as EditIcon, Save as SaveIcon } from '@material-ui/icons';

const QuickAccessToolbar = () => {
  return (
    <div style={{ position: 'fixed', bottom: 20, right: 20 }}>
      <Tooltip title="Add">
        <Fab color="primary" aria-label="add" style={{ marginRight: 10 }}>
          <AddIcon />
        </Fab>
      </Tooltip>
      <Tooltip title="Edit">
        <Fab color="secondary" aria-label="edit" style={{ marginRight: 10 }}>
          <EditIcon />
        </Fab>
      </Tooltip>
      <Tooltip title="Save">
        <Fab color="default" aria-label="save">
          <SaveIcon />
        </Fab>
      </Tooltip>
    </div>
  );
};

export default QuickAccessToolbar;
