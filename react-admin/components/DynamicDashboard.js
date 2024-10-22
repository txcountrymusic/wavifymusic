
import React, { useState } from 'react';
import { Grid, Paper } from '@material-ui/core';
import { DragDropContext, Droppable, Draggable } from 'react-beautiful-dnd';

const DashboardWidget = ({ widget, index }) => {
  return (
    <Draggable draggableId={widget.id} index={index}>
      {(provided) => (
        <Grid item xs={12} sm={6} md={4} ref={provided.innerRef} {...provided.draggableProps} {...provided.dragHandleProps}>
          <Paper style={{ padding: 20 }}>
            <h3>{widget.title}</h3>
            <p>{widget.content}</p>
          </Paper>
        </Grid>
      )}
    </Draggable>
  );
};

const DynamicDashboard = () => {
  const [widgets, setWidgets] = useState([
    { id: '1', title: 'Analytics', content: 'Display analytics data here.' },
    { id: '2', title: 'Pending Submissions', content: 'Show pending submissions here.' },
    { id: '3', title: 'Recent Payments', content: 'Show recent payments here.' },
  ]);

  const onDragEnd = (result) => {
    if (!result.destination) return;

    const reorderedWidgets = Array.from(widgets);
    const [movedWidget] = reorderedWidgets.splice(result.source.index, 1);
    reorderedWidgets.splice(result.destination.index, 0, movedWidget);

    setWidgets(reorderedWidgets);
  };

  return (
    <DragDropContext onDragEnd={onDragEnd}>
      <Droppable droppableId="dashboard">
        {(provided) => (
          <Grid container spacing={3} ref={provided.innerRef} {...provided.droppableProps}>
            {widgets.map((widget, index) => (
              <DashboardWidget key={widget.id} widget={widget} index={index} />
            ))}
            {provided.placeholder}
          </Grid>
        )}
      </Droppable>
    </DragDropContext>
  );
};

export default DynamicDashboard;
