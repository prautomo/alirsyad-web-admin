
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
            name: string()
                .required()
        });

        var valid = await checkoutSchema.isValid(mitraDetail);

        if (valid) {


            setDataSent(true)
            var tmpMitraDetail = { ...mitraDetail }
            window.axios.post("/profile/update", tmpMitraDetail).then((res) => {

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
        <SimpleContainer title="Informasi Pengguna" content={
            <>

                <div className="d-flex flex-column">
                    <InputWithLabel label={mitraDetail.role == "CUSTOMER" ? "Nama Pengguna" : "Nama Toko"}  placeholder="EX:  Bank Central Asia"
                        value={mitraDetail["name"]}
                        onChange={(val) => {
                            setMitraDetail({ ...mitraDetail, ...{ name: val } })
                        }}>
                    </InputWithLabel>
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




if (document.getElementById('user-profile-form')) {

    var container = document.getElementById("user-profile-form")
    var mitraDetail = container.getAttribute("mitra_detail") ? container.getAttribute("mitra_detail") : "{}";
    ReactDOM.render(<UpdateJasa mitra_detail={JSON.parse(mitraDetail)} />, container);
}
