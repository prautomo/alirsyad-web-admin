import React, { useState } from 'react'
import ReactDOM from 'react-dom'
import useFetch from '../../store/useFetch'
import { InputDatePickerWithLabel, InputSelectWithLabel, InputTextAreaWithLabel } from '../Form/InputRenderer'
import SimpleContainer from '../SimpleContainer'
import { object, string } from 'yup'
import Swal from 'sweetalert2'


function JasaContainer(params) {
    var { data, isLoading, isError } = useFetch("/app/data/service")
    const [selecteService, setSelecteService] = useState(null);
    const [selectedSubService, setSelectedSubService] = useState(null);
    const [tanggalMulai, setTanggalMulai] = useState(null);
    const [catatan, setCatatan] = useState(null);

    const [dataSent, setDataSent] = useState(false);


    async function sendInq() {
        var inq = {
            service_id: selecteService,
            sub_service_id: selectedSubService,
            catatan: catatan,
            tanggalMulai: tanggalMulai
        }




        var checkoutSchema = object().shape({
            service_id: string()
                .required(),
            sub_service_id: string()
                .required(),
            catatan: string()
                .required(),
            tanggalMulai: string()
                .required(),

        });

        var valid = await checkoutSchema.isValid(inq);

        if (valid) {


            setDataSent(true)
            window.axios.post("/app/checkoutjasa", inq).then((res) => {

                Swal.fire("Informasi", res.data.message, "success")

            }).catch((err) => {
                Swal.fire("Terjadi kesalahan", err.response.data.message, "error")
            }).finally(() => {
                setDataSent(false)
            })
        } else {
            Swal.fire("Validasi", "Silahkan Isi Semua Informasi ", "warning")

        }



        window.axios.post
    }

    var subItemData = useFetch(selecteService && "/app/data/service/" + selecteService).data
    return (<>
        <SimpleContainer title="Permintaan Jasa" content={<>

            <div className="row">
                <div className="col-lg-5">

                    <InputSelectWithLabel value={selecteService} plabel="Pilih Jasa" items={!isLoading ? data : []} onChange={
                        (e) => {
                            setSelecteService(e)
                        }
                    }></InputSelectWithLabel>


                    <InputSelectWithLabel value={selectedSubService} label="Pilih Sub Jasa" items={subItemData} onChange={
                        (e) => {
                            setSelectedSubService(e)
                        }}></InputSelectWithLabel>

                    <InputTextAreaWithLabel label="Catatan" value={catatan} onChange={(e) => {
                        setCatatan(e)
                    }}>
                    </InputTextAreaWithLabel>
                    <InputDatePickerWithLabel label="Tanggal Mulai" value={tanggalMulai} onChange={(e) => {
                        setTanggalMulai(e)
                    }}>

                    </InputDatePickerWithLabel>

                    <button className="btn btn-danger w-100" style={{ height: '50px' }} onClick={sendInq}>Kirim</button>

                </div>
            </div>
        </>}>

        </SimpleContainer>
    </>)
}



export default JasaContainer




if (document.getElementById('jasa-container')) {

    var container = document.getElementById("jasa-container")
    ReactDOM.render(<JasaContainer />, container);
}

