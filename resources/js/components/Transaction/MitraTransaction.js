import React, { useState } from 'react'
import ReactDOM from 'react-dom'
import useFetch from "../../store/useFetch"
import moment from 'moment'
import numeral from 'numeral'
import { Pagination } from '../Products';
import { encodeQuery } from '../utls';
import TransactionRenderer from './TransactionRenderer'
import { InputWithLabel } from '../Form/InputRenderer'
import useSWR from 'swr'


const map_page_header = {
    "recent": "Pesanan Terbaru",
    "process": " Pesanan Sedang Di Proses",
    "new": "Pesanan  Baru",
    "finish": "Pesanan Selesai",
}

function CustomerTransaction({ status }) {

    const [pageConfig, setPageConfig] = useState({});

    // var { data, isLoading, isEroor } = useFetch( "/toko/transaction/" + status + "/data?" + encodeQuery(pageConfig))
    var {data, error} =  useSWR("/toko/transaction/" + status + "/data?" + encodeQuery(pageConfig), window.getAxios)
    return (<>

        <div class="d-flex  flex-column">

            <div className="d-flex flex-row w-100 justify-content-between">

                <h4>{map_page_header[status]}</h4>
                <div>
                    <InputWithLabel label={null} onChange={(e) => {
                        setPageConfig({...pageConfig , ...{search: e}})
                    }} placeholder="Pencarian"></InputWithLabel>
                </div>

            </div>
            <hr>
            </hr>
            <div class="d-flex flex-column ">
                {!data ? "Loading" :
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

export default CustomerTransaction;


if (document.getElementById('toko-transaction-list-container')) {

    var container = document.getElementById("toko-transaction-list-container")
    var status = container.getAttribute("status")
    ReactDOM.render(<CustomerTransaction status={status ? status : "recent"} />, container);
}



