import { Button, Modal } from 'react-bootstrap';
import React, { useState } from 'react'
import ReactDOM from 'react-dom'
import numeral from 'numeral'
import Swal from 'sweetalert2';

function PenarikanDana({ saldo }) {

    function requestPengambilanData() {

        Swal.fire({
            title: 'Konfirmasi ?',
            text: "Anda yakin akan mengambil saldo  anda senilai Rp." + numeral(saldo).format("0,0") + "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {

                window.axios.post("/app/saldo/requestTarikDana").then((res) => {
                    Swal.fire("Pengambilan Dana", res.data.message, "success")
                    location.reload();
                }).catch((err) => {

                    Swal.fire("Pengambilan Dana", err.response.data.message, "error")
                })
            }
        })

    }
    const [show, setShow] = useState(false);
    return <>

        <div>
            <a name="" id="" href="#" role="button"
                onClick={() => {
                    setShow(true)
                }}>Tarik Dana</a>
        </div>
        <Modal show={show} onHide={() => { setShow(false) }}>
            <Modal.Body>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <p> Jumlah Dana: </p>
                    <h3 class="text-danger m-4">
                        Rp. {numeral(saldo).format("0,0")}
                    </h3>
                    <small>Penarikan dana akan di proses paling lambat 2x24 jam</small>
                    <Button className="mt-2" onClick={requestPengambilanData}>Tarik Semua</Button>
                </div>
            </Modal.Body>
        </Modal>
    </>
}

export default PenarikanDana;



if (document.getElementById('penarikan-dana')) {

    var container = document.getElementById("penarikan-dana")

    var saldo = container.getAttribute("saldo");

    ReactDOM.render(<PenarikanDana saldo={saldo} />, container);
}
