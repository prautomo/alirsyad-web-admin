import React from 'react'
import classNames from 'classnames'


export default function BreadCumb({ params }) {

    return (<>

        <div className="d-flex align-items-center">
            {
                Object.keys(params).map((value, index) => {
                    return <>
                        {index != 0 &&
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>}
                        <span style={{ padding: '10px' }} className={classNames({
                            'text-muted': (index != Object.keys(params).length - 1),
                            'font-weight-bold': (index == Object.keys(params).length - 1)
                        })}>{params[value]}</span>

                    </>
                })
            }
        </div>


    </>)
}