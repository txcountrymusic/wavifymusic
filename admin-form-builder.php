<?php if (!defined('ABSPATH')) { exit; } ?>
<?php

// Customizable Form Builder for Frontend and Backend Forms

function AdminFormBuilder() {
    const [formFields, setFormFields] = React.useState({
        frontend: [
            { name: 'artist_name', type: 'text', label: 'Artist Name', required: true },
            { name: 'track_title', type: 'text', label: 'Track Title', required: true },
            { name: 'social_links', type: 'text', label: 'Social Media Links', required: false },
            { name: 'website', type: 'text', label: 'Website Link', required: false }
        ],
        backend: [
            { name: 'approval_status', type: 'dropdown', label: 'Approval Status', required: true },
            { name: 'review_notes', type: 'textarea', label: 'Review Notes', required: false }
        ]
    });

    const [newField, setNewField] = React.useState({ name: '', type: 'text', label: '', required: false, formType: 'frontend' });

    const addField = () => {
        setFormFields(prev => ({
            ...prev,
            [newField.formType]: [...prev[newField.formType], newField]
        }));
        setNewField({ name: '', type: 'text', label: '', required: false, formType: 'frontend' });
    };

    const removeField = (index, formType) => {
        setFormFields(prev => ({
            ...prev,
            [formType]: prev[formType].filter((_, i) => i !== index)
        }));
    };

    return (
        <div className="admin_form_builder">
            <h3>Form Builder _ Frontend and Backend Forms</h3>
            <div className="form_builder_section">
                <h4>Frontend Form Fields</h4>
                <ul>
                    {formFields.frontend.map((field, index) => (
                        <li key={index}>
                            {field.label} ({field.type}) {field.required ? '(Required)' : ''}
                            <button onClick={() => removeField(index, 'frontend')}>Remove</button>
                        </li>
                    ))}
                </ul>
            </div>

            <div className="form_builder_section">
                <h4>Backend Form Fields</h4>
                <ul>
                    {formFields.backend.map((field, index) => (
                        <li key={index}>
                            {field.label} ({field.type}) {field.required ? '(Required)' : ''}
                            <button onClick={() => removeField(index, 'backend')}>Remove</button>
                        </li>
                    ))}
                </ul>
            </div>

            <h4>Add New Field</h4>
            <div className="add_new_field">
                <label>Field Label: </label>
                <input
                    type="text"
                    value={newField.label}
                    onChange={(e) => setNewField(prev => ({ ...prev, label: e.target.value }))}
                /><br />

                <label>Field Type: </label>
                <select
                    value={newField.type}
                    onChange={(e) => setNewField(prev => ({ ...prev, type: e.target.value }))}
                >
                    <option value="text">Text</option>
                    <option value="textarea">Textarea</option>
                    <option value="dropdown">Dropdown</option>
                    <option value="checkbox">Checkbox</option>
                </select><br />

                <label>Required: </label>
                <input
                    type="checkbox"
                    checked={newField.required}
                    onChange={(e) => setNewField(prev => ({ ...prev, required: e.target.checked }))}
                /><br />

                <label>Form Type: </label>
                <select
                    value={newField.formType}
                    onChange={(e) => setNewField(prev => ({ ...prev, formType: e.target.value }))}
                >
                    <option value="frontend">Frontend</option>
                    <option value="backend">Backend</option>
                </select><br />

                <button onClick={addField}>Add Field</button>
            </div>
        </div>
    );
}

// Enqueue React scripts and render AdminFormBuilder component
add_action('admin_enqueue_scripts', 'enqueue_react_admin_form_builder');

function enqueue_react_admin_form_builder() {
    wp_enqueue_script('react', 'https://unpkg.com/react/umd/react.development.js', [], '17', true);
    wp_enqueue_script('react_dom', 'https://unpkg.com/react_dom/umd/react_dom.development.js', [], '17', true);
    wp_enqueue_script('wavify_admin_form_builder', plugin_dir_url(__FILE__) . 'admin_form_builder.js', [], '1.0', true);
}

// Shortcode to render the Admin Form Builder
add_shortcode('admin_form_builder', 'render_admin_form_builder');

function render_admin_form_builder($atts) {
    return '<div id="admin_form_builder_root"></div>';
}

ReactDOM.render(<AdminFormBuilder />, document.getElementById('admin_form_builder_root'));
