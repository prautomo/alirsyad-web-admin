import React, { useState } from 'react'
import ReactDOM from 'react-dom'
import useFetch from "../../store/useFetch"
import moment from 'moment'
import numeral from 'numeral'
import { Pagination } from '../Products';
import { encodeQuery } from '../utls';
import TransactionRenderer from './TransactionRenderer'
import { InputWithLabel } from '../Form/InputRenderer'


const status_transaksi_const = {
    "NEW": "Pesanan Baru",
    "NOT_PAID": "Menunggu Pembayaran",
    "WAIT_CONFIRM_PAID": "Menunggu verifikasi",
    "PAID": "Pesanan Sudah Diverifikasi DigiBook",
    "WAIT_MITRA_CONFIRM": "Pesanan Menunggu Konfirmasi Mitra",
    "MITRA_CONFIRM_ACC": "Pesanan Sedang diproses",
    "MITRA_CONFIRM_DEC": "Pesanan Ditolak",
    "MITRA_SEND": "Pesanan Anda Sedang Dikirim",
    "CUSTOMER_RECEIVE": "Pesanan Sudah Diterima",
    "CUSTOMER_COMPLAINT": "customer Melakukan Komplain",
    "DIBATALKAN": "Pesanan Dibatalkan",
    "BERMAN_COMPLAINT_ACC": "Komplain Diterima DigiBook",
    "BERMAN_COMPLAINT_DEC": "Komplain Ditolak DigiBook",
};

const map_page_header = {
    "recent": "Pesanan Terbaru",
    "process": " Pesanan Sedang Di Proses",
    "new": "Pesanan  Baru",
    "finish": "Pesanan Selesai",
}

function JasaCustomerTransaction({ status }) {

    const [pageConfig, setPageConfig] = useState({});

    var { data, isLoading, isEroor } = useFetch("/customer/jasa/transaction/" + status + "/data?" + encodeQuery(pageConfig))
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
                        <TransactionRenderer data={data} role={"CUSTOMER"} setRevalidate={(token) => {
                            setPageConfig({ ...pageConfig, ...{ "revalidate": token } })
                        }}></TransactionRenderer>
                        <Pagination pagination={data} current_page={1} setPageConfig={setPageConfig} ></Pagination>

                    </>}

            </div>
        </div>
    </>)
}

export default JasaCustomerTransaction


if (document.getElementById('jasa-transaction-list-container')) {

    var container = document.getElementById("jasa-transaction-list-container")
    var status = container.getAttribute("status")
    ReactDOM.render(<JasaCustomerTransaction status={status ? status : "recent"} />, container);
}



