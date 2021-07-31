import React from  'react'

export default function SimpleContainer({title,  content}) {
    
    return (<>

    <div className="card border-none  " style={{backgroundColor:'transparent'}}>
    
        <h3>{title}</h3>
        <div className="d-flex flex-column">

        {content}
        </div>
    </div>
    </>)
}