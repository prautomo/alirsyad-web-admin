import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import classNames from 'classnames'

import { object, string, number } from 'yup';
import Swal from 'sweetalert2';
import useFetch from '../../../store/useFetch';
import moment from 'moment'
import SimpleContainer from '../../SimpleContainer';
import { ImagePickerWithLabel, InputDatePickerWithLabel, InputSelectWithLabel, InputTextAreaWithLabel, InputWithLabel } from '../../Form/InputRenderer';
import { remove } from 'lodash';


function UpdatePromo({ form_data }) {

    const [cover, setCover] = useState([]);
    const [gelery, setGelery] = useState([]);

    const [model, setModel] = useState({});
    useEffect(() => {
        var tmp = { ...form_data }
        tmp.cover_image = [{ image_url: tmp.cover_image }]
        tmp.end_date = moment(tmp.end_date)
        tmp.start_date = moment(tmp.start_date)
        if (tmp.potongan_nominal > 0) {
            tmp.jenis_diskon = "NOMINAL"
        } else {
            tmp.jenis_diskon = "PERSEN"
        }

        setModel(tmp)
    }, []);

    var { data, isLoading, isError } = useFetch("/app/data/district")
    var brand = useFetch("/app/data/getbrand")
    var category = useFetch("/app/data/getcategory")
    var unit = useFetch("/app/data/getunit")
    var subCategory = useFetch(model.category_id && "/app/data/getcategory/" + model.category_id)

    const [dataSent, setDataSent] = useState(false);

    async function updateDataMitra() {


        var checkoutSchema = object().shape({
            name: string()
                .required(),
            description: string()
                .required(),
            code: string()
                .required(),
            start_date: string()
                .required(),
            end_date: string()
                .required(),
            jenis_diskon: string()
                .required(),
        });

        var valid = await checkoutSchema.isValid(model);
        if (model.jenis_diskon == "NOMINAL" && (!model.potongan_nominal || model.potongan_nominal == "")) {
            valid = false;
        }
        if (model.jenis_diskon == "PERSEN" && (!model.potongan_persen || model.potongan_persen == "")) {
            valid = false;
        }
        if (valid) {


            setDataSent(true)

            var tmpModel = { ...model }
            if (model.jenis_diskon == "NOMINAL") {
                delete tmpModel.potongan_persen
            } else {

                delete tmpModel.potongan_nominal
            }
            if (model.id) {
                window.axios.put("/toko/promo/" + model.id, tmpModel).then((res) => {

                    Swal.fire("Informasi", res.data.message, "success")
                    window.location.href = "/toko/promo";

                }).catch((err) => {
                    Swal.fire("Terjadi kesalahan", err.response.data.message, "error")
                }).finally(() => {
                    setDataSent(false)
                })

            } else {
                window.axios.post("/toko/promo", tmpModel).then((res) => {

                    Swal.fire("Informasi", res.data.message, "success")
                    window.location.href = "/toko/promo";

                }).catch((err) => {
                    Swal.fire("Terjadi kesalahan", err.response.data.message, "error")
                }).finally(() => {
                    setDataSent(false)
                })

            }
        } else {
            Swal.fire("Validasi", "Silahkan Isi Semua Informasi ", "warning")

        }

    }

    return (<>
        <SimpleContainer title="Update Product" content={
            <>
                <div className="d-flex flex-column">
                    <InputWithLabel label="(*)Nama Promo" placeholder="EX:  Cat"
                        value={model["name"]}
                        onChange={(val) => {
                            var tmp = { ...model }
                            console.log(tmp)
                            setModel({ ...model, ...{ name: val } })
                        }}>
                    </InputWithLabel>
                    <InputWithLabel label="(*)Kode  Promo" placeholder="EX:  Cat"
                        value={model["code"]}
                        onChange={(val) => {
                            var tmp = { ...model }
                            console.log(tmp)
                            setModel({ ...model, ...{ code: val } })
                        }}>
                    </InputWithLabel>
                    <InputTextAreaWithLabel label="(*)Deskripsi" placeholder="EX:  Cat"
                        value={model["description"]}
                        onChange={(val) => {
                            setModel({ ...model, ...{ description: val } })
                        }}>
                    </InputTextAreaWithLabel>
                    <InputDatePickerWithLabel label="(*)Tanggal Mulai" placeholder="EX:  Cat"
                        value={model["start_date"]}
                        onChange={(val) => {
                            setModel({ ...model, ...{ start_date: val } })
                        }}>
                    </InputDatePickerWithLabel>
                    <InputDatePickerWithLabel label="(*)Tanggal Selesai" placeholder="EX:  Cat"
                        value={model["end_date"]}
                        onChange={(val) => {
                            setModel({ ...model, ...{ end_date: val } })
                        }}>
                    </InputDatePickerWithLabel>


                    <InputSelectWithLabel label="(*)Jenis Diskon" placeholder="EX:  Cat"
                        value={model["jsnis_diskon"]}
                        items={[
                            {
                                id: "PERSEN",
                                name: "Persen"
                            },

                            {
                                id: "NOMINAL",
                                name: "Nominal"
                            }
                        ]}
                        onChange={(val) => {
                            setModel({ ...model, ...{ jenis_diskon: val } })
                        }}>
                    </InputSelectWithLabel>



                    {model.jenis_diskon == "NOMINAL" ?
                        <InputWithLabel label="(*)Promo Rp" placeholder="EX:  Cat"
                            appendix={<i class="fa fa-money" aria-hidden="true"></i>}
                            value={model["potongan_nominal"]}
                            onChange={(val) => {
                                setModel({ ...model, ...{ potongan_nominal: val } })
                            }}>
                        </InputWithLabel>
                        : ""}
                    {model.jenis_diskon == "PERSEN" ?
                        <InputWithLabel label="(*)Promo %" placeholder="EX:  Cat"
                            appendix={<i class="fa fa-money" aria-hidden="true"></i>}
                            value={model["potongan_persen"]}
                            onChange={(val) => {
                                setModel({ ...model, ...{ potongan_persen: val } })
                            }}>
                        </InputWithLabel>
                        : ""}


                </div>



            </>
        }>

        </SimpleContainer>

        {/* 'code',
        'name',
        'description',
        'cover_image',
        'start_date',
        'end_date',
        'potongan_nominal',
        'potongan_persen',
        'mitra_id', */}

        <SimpleContainer title="Cover Image" content={
            <>

                <div className="d-flex flex-column">
                    <ImagePickerWithLabel label="(*)Cover Image" placeholder="EX:  Cat"
                        items={model['cover_image']}
                        onChange={(val) => {
                            setModel({ ...model, ...{ cover_image: [val] } })
                        }}
                        removeItem={(val) => {
                            setModel({ ...model, ...{ cover_image: val } })
                        }}>
                    </ImagePickerWithLabel>
                </div>
            </>
        }></SimpleContainer>
        <div>

            <button disabled={dataSent} onClick={() => {
                updateDataMitra()
            }} className="btn btn-danger">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>  Simpan
        </button>
        </div>
    </>)


}

export default UpdatePromo;




if (document.getElementById('form-promo')) {

    var container = document.getElementById("form-promo")
    var formData = container.getAttribute("form-data") ? container.getAttribute("form-data") : "{}";
    ReactDOM.render(<UpdatePromo form_data={JSON.parse(formData)} />, container);
}
