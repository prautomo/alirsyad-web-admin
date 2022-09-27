import React from 'react';
import PropTypes from 'prop-types';

const FormGroupComponents = ({ children, label }) => {
    // RENDER
    return (
        <div className='form-group'>
            <label className="form-control-label">{label}</label>
            { children }
        </div>
    );
};

FormGroupComponents.propTypes = {
    label: PropTypes.string,
};

export default FormGroupComponents;