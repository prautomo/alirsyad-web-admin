import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import useFetch from '../../store/useFetch';
import { InputMapPickerWithLabel, InputWithLabel, InputTextAreaWithLabel, InputModalSelectorWithLabel, InputSelectWithLabel } from '../Form/InputRenderer';
import SimpleContainer from '../SimpleContainer';
import classNames from 'classnames'

import { object, string } from 'yup';
import Swal from 'sweetalert2';


function UpdateJasa({ mitra_detail }) {

    const [mitraDetail, setMitraDetail] = useState({});
    useEffect(() => {
        console.log(mitra_detail)
        var subService = (mitra_detail.sub_service ? mitra_detail.sub_service : {})
        setMitraDetail({

            ...mitra_detail, ...{
                service_id: subService.service_id,
                sub_service_id: subService.id,
            }
        })
    }, []);

    var { data, isLoading, isError } = useFetch(mitraDetail.service_id && "/app/data/service/" + mitraDetail.service_id)
    var dataService = useFetch("/app/data/service").data

    const [dataSent, setDataSent] = useState(false);

    async function updateDataMitra() {
        // "jasa_id",
        // "latitude",
        // "longitude",
        // "bank_name",
        // "bank_account_number",
        // "bank_account_holder",
        // "rating",
        // "alamat",
        // "biaya",
        // "sub_service_id",


        var checkoutSchema = object().shape({
            biaya: string()
                .required(),
            bank_name: string()
                .required(),
            bank_account_number: string()
                .required(),
            bank_account_holder: string()
                .required(),
            location: object()
                .required(),
            alamat: string()
                .required(),
            sub_service_id: string()
                .required(),
        });

        var valid = await checkoutSchema.isValid(mitraDetail);

        if (valid) {


            setDataSent(true)
            var tmpMitraDetail = { ...mitraDetail }
            tmpMitraDetail["sub_service_id"] = tmpMitraDetail.sub_service_id
            tmpMitraDetail["longitude"] = tmpMitraDetail.location.lng
            tmpMitraDetail["latitude"] = tmpMitraDetail.location.lat
            window.axios.post("/jasa/update", tmpMitraDetail).then((res) => {

                Swal.fire("Informasi", res.data.message, "success")

            }).catch((err) => {
                Swal.fire("Terjadi kesalahan", err.response.data.message, "error")
            }).finally(() => {
                setDataSent(false)
            })
        } else {
            Swal.fire("Validasi", "Silahkan Isi Semua Informasi ", "warning")

        }

    }

    return (<>
        <SimpleContainer title="Biaya Pengerjaan" content={
            <>

                <div className="d-flex flex-column">
                    <InputWithLabel label="Biaya Per Hari" type="number" placeholder="EX:  Bank Central Asia"
                        value={mitraDetail["biaya"]}
                        onChange={(val) => {
                            setMitraDetail({ ...mitraDetail, ...{ biaya: val } })
                        }}>
                    </InputWithLabel>
                </div>

            </>
        }>

        </SimpleContainer>
        <SimpleContainer title="Bank Pembayaran" content={
            <>

                <div className="d-flex flex-column">
                    <InputWithLabel label="Nama Bank" placeholder="EX:  Bank Central Asia"
                        value={mitraDetail["bank_name"]}
                        onChange={(val) => {
                            setMitraDetail({ ...mitraDetail, ...{ bank_name: val } })
                        }}>
                    </InputWithLabel>
                    <InputWithLabel label="Nomor Rekening" placeholder="EX:  13213123"
                        value={mitraDetail["bank_account_number"]}
                        onChange={(val) => {
                            setMitraDetail({ ...mitraDetail, ...{ bank_account_number: val } })
                        }}>
                    </InputWithLabel>
                    <InputWithLabel label="Nama Pemilik Rekening" placeholder="EX:  "
                        value={mitraDetail["bank_account_holder"]}
                        onChange={(val) => {
                            setMitraDetail({ ...mitraDetail, ...{ bank_account_holder: val } })
                        }}>
                    </InputWithLabel>
                </div>

            </>
        }>

        </SimpleContainer>
        <SimpleContainer title="Lokasi Mitra" content={
            <>

                <div className="d-flex flex-column">
                    <InputTextAreaWithLabel label="Alamat" placeholder="EX: Jl Kolonel Masturi No1"
                        value={mitraDetail["alamat"]}
                        onChange={(val) => {
                            setMitraDetail({ ...mitraDetail, ...{ alamat: val } })
                        }}>
                    </InputTextAreaWithLabel>
                    <InputMapPickerWithLabel label="Koordinat Lokasi"
                        value={JSON.stringify(mitraDetail["location"])}
                        onChange={(val) => {
                            setMitraDetail({ ...mitraDetail, ...{ location: val } })
                        }}>
                    </InputMapPickerWithLabel>

                    <InputSelectWithLabel label="Kategori" items={dataService ? dataService : []} value={mitraDetail['service_id']} onChange={(e) => {
                        setMitraDetail({ ...mitraDetail, ...{ service_id: e } })
                    }}>

                    </InputSelectWithLabel>
                    <InputSelectWithLabel label="Sub Kategori" items={!isLoading ? data : []} value={mitraDetail['sub_service_id']} onChange={(e) => {
                        setMitraDetail({ ...mitraDetail, ...{ sub_service_id: e } })
                    }}>

                    </InputSelectWithLabel>
                </div>

            </>
        }>

        </SimpleContainer>

        <button disabled={dataSent} onClick={() => {
            updateDataMitra()
        }} className="btn btn-danger">
            <i class="fa fa-floppy-o" aria-hidden="true"></i>  Simpan
        </button>
    </>)


}

export default UpdateJasa;




if (document.getElementById('jasa-update-form')) {

    var container = document.getElementById("jasa-update-form")
    var mitraDetail = container.getAttribute("mitra_detail") ? container.getAttribute("mitra_detail") : "{}";
    ReactDOM.render(<UpdateJasa mitra_detail={JSON.parse(mitraDetail)} />, container);
}
