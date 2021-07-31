import React from 'react'
import classNames from 'classnames'


export default function StepStatus({ items, currentIndex }) {


    return (<>

        <div className="d-flex flex-row justify-content-between container" style={{
            width: "500px",
        }}>
            {
                items.map((item, index) => {

                    return <div className={classNames("d-flex flex-column align-items-center ", {
                        'text-muted': currentIndex == index
                    })}>
                        <div className="d-flex flex-column align-items-center justify-content-center"


                            style={{ width: '50px', height: "50px", background: (currentIndex == index ? "red" : "#FEB3B4"), borderRadius: '25px' }}>
                            <h3 className="m-0 text-white">
                                {item.key}</h3>


                        </div>
                        <span className="mt-2">
                            {item.text}

                        </span>
                    </div>
                })
            }
        </div>

    </>)
}