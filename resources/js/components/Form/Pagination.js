import React, { useState } from 'react'
import { Form } from 'react-bootstrap'
import classNames from 'classnames'
import { range } from 'lodash'



function Pagination({ pagination, setPageConfig, pageConfig }) {
    var pageRangeStart = pagination.current_page - 3 > 0 ? pagination.current_page - 3 : 1
    var pageRangeEnd = (pagination.current_page + 4 <= pagination.last_page) ? (pagination.current_page + 4 ): pagination.last_page  + 1
    return (<>
        <div className="d-flex justify-content-center align-items-center">
             
            {pagination.prev_page_url && <i class="fa fa-chevron-left" aria-hidden="true" onClick={() => {

                setPageConfig({ ...pageConfig, ...{ page: pagination.current_page - 1 } })
            }} style={{ fontSize: '30px', color: 'red', width: '40px', cursor: 'pointer' }}></i>}
            {range(pageRangeStart, pageRangeEnd).map((page) => {

                return <button onClick={() => {
                    setPageConfig({ ...pageConfig, ...{ page: page } })
                }} className={classNames("btn", { 'btn-danger': page == pagination.current_page })}>{page}</button>
            })}


            {pagination.next_page_url && <i class="fa fa-chevron-right" aria-hidden="true" onClick={() => {

                setPageConfig({ ...pageConfig, ...{ page: pagination.current_page + 1 } })
            }} style={{ fontSize: '30px', color: 'red', width: '40px', textAlign: 'right', cursor: 'pointer' }}></i>}

        </div>

    </>)
}

export {
    Pagination
}