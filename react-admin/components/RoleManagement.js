
import React, { useEffect, useState } from 'react';
import axios from 'axios';

function RoleManagement() {
  const [roles, setRoles] = useState([]);

  useEffect(() => {
    // Fetch all available roles
    axios.get('/api/roles')
      .then(response => {
        setRoles(response.data);
      })
      .catch(error => {
        console.error("Error fetching roles", error);
      });
  }, []);

  const modifyRolePermissions = (roleId, permissions) => {
    axios.post({ _wpnonce: 'your_nonce_here',(`/api/roles/modify/${roleId}`, { permissions })
      .then(response => {
        alert('Role permissions updated');
      })
      .catch(error => {
        console.error("Error updating role permissions", error);
      });
  };

  return (
    <div>
      <h2>Role Management</h2>
      {roles.length > 0 ? (
        <ul>
          {roles.map((role, index) => (
            <li key={index}>
              {role.name} - Permissions: {role.permissions.join(", ")}
              <button onClick={() => modifyRolePermissions(role.id, ['read', 'write', 'edit'])}>
                Modify Permissions
              </button>
            </li>
          ))}
        </ul>
      ) : (
        <p>No roles available.</p>
      )}
    </div>
  );
}

export default RoleManagement;
