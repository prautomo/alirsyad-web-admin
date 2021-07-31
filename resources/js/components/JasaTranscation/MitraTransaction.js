import React, { useState } from 'react'
import ReactDOM from 'react-dom'
import useFetch from "../../store/useFetch"
import moment from 'moment'
import numeral from 'numeral'
import { Pagination } from '../Products';
import { encodeQuery } from '../utls';
import TransactionRenderer from './TransactionRenderer'
import { InputWithLabel } from '../Form/InputRenderer'


const map_page_header = {
    "recent": "Pesanan Terbaru",
    "process": " Pesanan Sedang Di Proses",
    "new": "Pesanan  Baru",
    "finish": "Pesanan Selesai",
}

function MitraTransaction({ status }) {

    const [pageConfig, setPageConfig] = useState({});

    var { data, isLoading, isEroor } = useFetch("/jasa/transaction/" + status + "/data?" + encodeQuery(pageConfig))
    return (<>

        <div class="d-flex  flex-column">

            <div className="d-flex flex-row w-100 justify-content-between">

                <h4>{map_page_header[status]}</h4>
                <div>
                    <InputWithLabel label={null} onChange={(e) => {
                        setPageConfig({ ...pageConfig, ...{ search: e } })
                    }} placeholder="Pencarian"></InputWithLabel>
                </div>

            </div>
            <hr>
            </hr>
            <div class="d-flex flex-column ">
                {isLoading ? "Loading" :
                    <>

                        <TransactionRenderer data={data} role="MITRA" setRevalidate={(token) => {
                            setPageConfig({ ...pageConfig, ...{ "revalidate": token } })
                        }}></TransactionRenderer>
                        <Pagination pagination={data} current_page={1} setPageConfig={setPageConfig} ></Pagination>

                    </>}

            </div>
        </div>
    </>)
}

export default MitraTransaction;


if (document.getElementById('jasa-mitra-transaction-list-container')) {

    var container = document.getElementById("jasa-mitra-transaction-list-container")
    var status = container.getAttribute("status")
    ReactDOM.render(<MitraTransaction status={status ? status : "recent"} />, container);
}



