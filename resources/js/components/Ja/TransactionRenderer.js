
import React, { useState } from 'react'
import moment from 'moment'
import numeral from 'numeral'
import Swal from 'sweetalert2';
import { Modal, Button } from 'react-bootstrap'

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

const actionLabel = {
    "TERIMA": "Menerima Pesanan",
    "TOLAK": "Menolak Pesanan",
    "KIRIM": "Pengirim Pesanan",
    "CUSTOMER_TERIMA": "Menerima Pesanan  ? \n Pastikan Barang Yang Anda Dalam Keadaan Baik",
}
export default function TransactionRenderer({ data, role, setRevalidate }) {

    function mitraAction(item, action) {
        Swal.fire({
            title: 'Konfirmasi ?',
            text: "Anda yakin akan  " + actionLabel[action],
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {
                window.axios.post("/mitra/updatepesanan", {
                    item, action
                }).then((res) => {

                    Swal.fire("Mitra", res.data.message, "success")
                    setRevalidate(Math.random())
                }).catch((err) => {

                    Swal.fire("Opss.", err.response.data.message, "success")
                    console.log(err)
                }).finally(() => {
                })
            }
        })

    }
    function customerAction(item, action) {
        Swal.fire({
            title: 'Konfirmasi ?',
            text: "Anda yakin akan  " + actionLabel[action],
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {
                window.axios.post("/customer/updatepesanan", {
                    item, action
                }).then((res) => {

                    Swal.fire("Customer", res.data.message, "success")
                    setRevalidate(Math.random())
                }).catch((err) => {

                    Swal.fire("Opss.", err.response.data.message, "success")
                    console.log(err)
                }).finally(() => {
                })
            }
        })

    }
    const [showModal, setShowModal] = useState(false);
    const [currentItem, setCurrentItem] = useState({});
    return <>
        {data.data.length == 0 ? "Belum Ada Pesanan" : data.data.map((transItem) => {
            return <>
                <div className="card mb-1">
                    <div className="card-body p-2 ">
                        <div className="d-flex justify-content-between">
                            <div className="d-flex flex-column">
                                <h5 className="card-title m-0"><span className="text-danger">{transItem.kode_transaksi}</span></h5>
                                <span className="text-muted">{moment(transItem.created_at).format("D-M-Y")}</span>
                            </div>
                            <div className="d-flex flex-column">
                                <span class="badge badge-success text-black">{status_transaksi_const[transItem.status_transaksi]}</span>
                            </div>
                        </div>
                        <div className="d-flex justify-content-between ">
                            <div className="d-flex flex-row" >

                                <div className="d-flex flex-column" style={{ width: '230px' }}>

                                    {role === "CUSTOMER" &&
                                        <span>
                                            Mitra : <span className="text-muted">{transItem.mitra.name}</span>
                                        </span>}
                                    {role === "MITRA" &&
                                        <span>
                                            Customer : <span className="text-muted">{transItem.customer.name}</span>
                                        </span>}
                                    <span>
                                        Ongkos Kirim: <span className="text-muted">Rp. {numeral(transItem.ongkos_kirim).format("0,0")}</span>
                                    </span>
                                </div>

                                <div className="d-flex flex-column">

                                    <span>
                                        Potongan: <span className="text-muted">Rp. {numeral(transItem.diskon).format("0,0")}</span>
                                    </span>
                                    <span>
                                        Total Transaksi : <span className="text-muted">Rp. {numeral(
                                        Number(transItem.total_transaksi)
                                    ).format("0,0")}</span>
                                    </span>
                                </div>
                            </div>
                            <div className="d-flex flex-row">

                                <div className="d-flex flex-column">
                                    <button className="btn btn-success btn-sm" onClick={() => {
                                        setShowModal(true)
                                        setCurrentItem(transItem)
                                    }}>
                                        Detail
                                </button>
                                </div>
                                {(transItem.status_transaksi === "NOT_PAID" && role == "CUSTOMER") &&
                                    <div className="d-flex flex-column">
                                        <a href={transItem.payment.deep_link_url} className="btn btn-sm btn-primary  ">Bayar  <i class="fa fa-money" aria-hidden="true"></i></a>
                                    </div>}
                                {(transItem.status_transaksi === "MITRA_SEND" && role == "CUSTOMER") &&
                                    <div className="d-flex flex-column">
                                        <button onClick={() => { customerAction(transItem, "CUSTOMER_TERIMA") }} className="btn btn-sm btn-primary  "><i class="fa fa-dropbox" aria-hidden="true"></i> &nbsp;Terima</button>
                                    </div>}
                                {(transItem.status_transaksi === "WAIT_MITRA_CONFIRM" && role == "MITRA") &&
                                    <div className="d-flex flex-column">
                                        <div classNam="btn-group">

                                            <button onClick={() => { mitraAction(transItem, "TERIMA") }} className="btn btn-sm btn-primary  "> <i class="fa fa-check" aria-hidden="true"></i> &nbsp;Terima  </button>
                                            <button onClick={() => { mitraAction(transItem, "TOLAK") }} className="btn btn-sm btn-danger  "><i class="fa fa-close" aria-hidden="true"></i>  &nbsp;Tolak </button>
                                        </div>
                                    </div>}
                                {(transItem.status_transaksi === "MITRA_CONFIRM_ACC" && role == "MITRA") &&
                                    <div className="d-flex flex-column">
                                        <div classNam="btn-group">

                                            <button onClick={() => { mitraAction(transItem, "KIRIM") }} className="btn btn-sm btn-primary  ">  <i class="fa fa-send" aria-hidden="true"></i> &nbsp;Kirim  </button>
                                        </div>
                                    </div>}
                            </div>

                        </div>
                    </div>
                </div>
            </>
        })}
        <TransactionDetailModal showModal={showModal} setShowModal={setShowModal} item={currentItem}></TransactionDetailModal>
    </>
}

function TransactionDetailModal({ showModal, setShowModal, item }) {

    return <>
        <Modal show={showModal} onHide={() => { setShowModal(false) }}>
            <Modal.Header closeButton>
                <Modal.Title>Detail Transaksi</Modal.Title>
            </Modal.Header>
            <Modal.Body>



                {item.detail && item.detail.map((detail) => {
                    return <div class="card  m-1">
                        <div class="card-body p-2 d-flex flex-column" >
                            <h4 class="card-title">{detail.product.name}</h4>
                            <small class="card-title">{detail.product.desc}</small>
                            <span >Jumlah : <span className="text-muted">{detail.jumlah}</span></span>
                            <span >Harga  : <span className="text-muted">Rp. {numeral(detail.sub_total).format("0,0")}</span></span>
                        </div>
                    </div>
                })}
            </Modal.Body>
            <Modal.Footer>
                <Button variant="secondary" onClick={() => { setShowModal(false) }}>
                    Close
          </Button>
            </Modal.Footer>
        </Modal>
    </>

}

export {
    TransactionDetailModal
}