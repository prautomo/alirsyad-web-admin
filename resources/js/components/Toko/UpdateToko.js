import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import useFetch from '../../store/useFetch';
import { InputMapPickerWithLabel, InputWithLabel, InputTextAreaWithLabel, InputModalSelectorWithLabel } from '../Form/InputRenderer';
import SimpleContainer from '../SimpleContainer';
import classNames from 'classnames'

import { object, string } from 'yup';
import Swal from 'sweetalert2';


function UpdateToko({ mitra_detail }) {

    const [mitraDetail, setMitraDetail] = useState({});
    useEffect(() => {
        setMitraDetail(mitra_detail)
    }, []);

    var { data, isLoading, isError } = useFetch("/app/data/district")

    const [dataSent, setDataSent] = useState(false);

    async function updateDataMitra() {

        var checkoutSchema = object().shape({
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
            district: object()
                .required(),
        });

        var valid = await checkoutSchema.isValid(mitraDetail);

        if (valid) {


            setDataSent(true)
            var tmpMitraDetail = { ...mitraDetail }
            tmpMitraDetail["district_id"] = tmpMitraDetail.district.id
            tmpMitraDetail["longitude"] = tmpMitraDetail.location.lng
            tmpMitraDetail["latitude"] = tmpMitraDetail.location.lat
            window.axios.post("/toko/update", tmpMitraDetail).then((res) => {

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

                    <InputModalSelectorWithLabel label="Kota / Kecamatan"
                        value={mitraDetail["district"]}
                        items={!isLoading && data}
                        onChange={(val) => {
                            setMitraDetail({ ...mitraDetail, ...{ district: val } })
                        }}
                        itemRenderer={(currentItem, currentIndex, tempSelected, setTempSelected) => {
                            return <>
                                <div className={classNames("d-flex flex-column card p-2 mb-2", {
                                    "bg-primary": tempSelected.id == currentItem.id,
                                    "text-white": tempSelected.id == currentItem.id
                                })} style={{ cursor: 'pointer' }} onClick={() => {
                                    console.log(currentItem)
                                    setTempSelected(currentItem)
                                }}>
                                    {currentItem.name}
                                </div>
                            </>
                        }}
                    >
                    </InputModalSelectorWithLabel>
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

export default UpdateToko;




if (document.getElementById('toko-update-form')) {

    var container = document.getElementById("toko-update-form")
    var mitraDetail = container.getAttribute("mitra_detail") ? container.getAttribute("mitra_detail") : "{}";
    ReactDOM.render(<UpdateToko mitra_detail={JSON.parse(mitraDetail)} />, container);
}
