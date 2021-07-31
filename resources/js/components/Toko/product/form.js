import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import classNames from 'classnames'

import { object, string } from 'yup';
import Swal from 'sweetalert2';
import useFetch from '../../../store/useFetch';
import SimpleContainer from '../../SimpleContainer';
import { ImagePickerWithLabel, InputSelectWithLabel, InputTextAreaWithLabel, InputWithLabel } from '../../Form/InputRenderer';


function UpdateProduct({ form_data }) {

    const [cover, setCover] = useState([]);
    const [gelery, setGelery] = useState([]);

    const [model, setModel] = useState({});
    useEffect(() => {
        var tmp = { ...form_data }
        tmp.category_id = form_data.sub_category ? form_data.sub_category.category_id : null

        setGelery(form_data.galery ? form_data.galery :  [])
        setCover(form_data.cover ? [form_data.cover] : null)
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
            selling_price: string()
                .required(),
            brand_id: string()
                .required(),
            category_id: string()
                .required(),
            sub_category_id: string()
                .required(),
            unit_id: string()
                .required(),
        });

        var valid = await checkoutSchema.isValid(model);

        if (valid) {


            setDataSent(true)
            var tmpModel = { ...model }
            tmpModel.cover = cover
            tmpModel.galery = gelery
            if (model.id) {
                window.axios.put("/toko/product/" + model.sku_id, tmpModel).then((res) => {

                    Swal.fire("Informasi", res.data.message, "success")
                    window.location.href = "/toko/product";

                }).catch((err) => {
                    Swal.fire("Terjadi kesalahan", err.response.data.message, "error")
                }).finally(() => {
                    setDataSent(false)
                })

            } else {
                window.axios.post("/toko/product", tmpModel).then((res) => {

                    Swal.fire("Informasi", res.data.message, "success")
                    window.location.href = "/toko/product";

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
                    <InputWithLabel label="(*)Nama Produk" placeholder="EX:  Cat"
                        value={model["name"]}
                        onChange={(val) => {
                            var tmp = { ...model }
                            console.log(tmp)
                            setModel({ ...model, ...{ name: val } })
                        }}>
                    </InputWithLabel>
                    <InputTextAreaWithLabel label="(*)Deskripsi" placeholder="EX:  Cat"
                        value={model["description"]}
                        onChange={(val) => {
                            setModel({ ...model, ...{ description: val } })
                        }}>
                    </InputTextAreaWithLabel>
                    <InputWithLabel label="(*)Harga Satuan" placeholder="EX:  Cat"
                        appendix={<i class="fa fa-money" aria-hidden="true"></i>}
                        value={model["selling_price"]}
                        onChange={(val) => {
                            setModel({ ...model, ...{ selling_price: val } })
                        }}>
                    </InputWithLabel>


                    <InputSelectWithLabel label="(*)Brand" placeholder="EX:  Cat" sub_category_id
                        items={!brand.isLoading ? brand.data : []}
                        value={model["brand_id"]}
                        onChange={(val) => {
                            setModel({ ...model, ...{ brand_id: val } })
                        }}>
                    </InputSelectWithLabel>

                    <InputSelectWithLabel label="(*)Category" placeholder="EX:  Cat"
                        items={!category.isLoading ? category.data : []}
                        value={model["category_id"]}
                        onChange={(val) => {
                            setModel({ ...model, ...{ category_id: val } })
                        }}>
                    </InputSelectWithLabel>
                    <InputSelectWithLabel label="(*)Sub Category" placeholder="EX:  Cat"
                        items={subCategory.data ? subCategory.data : []} 
                        value={model["sub_category_id"]}
                        onChange={(val) => {
                            setModel({ ...model, ...{ sub_category_id: val } })
                        }}>
                    </InputSelectWithLabel>

                    <InputSelectWithLabel label="(*)Unit" placeholder="EX:  Cat"
                        items={unit.data ? unit.data : []}
                        value={model["unit_id"]}
                        onChange={(val) => {
                            setModel({ ...model, ...{ unit_id: val } })
                        }}>"
                    </InputSelectWithLabel>
                    <InputWithLabel label="Diskon" placeholder="EX:  Cat"
                        items={unit.data ? unit.data : []}
                        value={model["discount"]}
                        onChange={(val) => {
                            setModel({ ...model, ...{ discount: val } })
                        }}>"
                    </InputWithLabel>

                    <InputTextAreaWithLabel label="Keunggulan" placeholder="EX:  Cat"
                        value={model["keunggulan"]}
                        onChange={(val) => {
                            setModel({ ...model, ...{ keunggulan: val } })
                        }}>
                    </InputTextAreaWithLabel>
                    <InputTextAreaWithLabel label="Spesifikasi" placeholder="EX:  Cat"
                        value={model["spesification"]}
                        onChange={(val) => {
                            setModel({ ...model, ...{ spesification: val } })
                        }}>
                    </InputTextAreaWithLabel>

                </div>



            </>
        }>

        </SimpleContainer>

        <SimpleContainer title="Gambar" content={
            <>

                <div className="d-flex flex-column">
                    <ImagePickerWithLabel label="(*)Cover" placeholder="EX:  Cat"
                        items={cover}
                        onChange={(val) => {
                            setCover([val])
                        }}
                        removeItem={(val) => {
                            setCover(val)
                        }}>
                    </ImagePickerWithLabel>
                    <ImagePickerWithLabel label="Galery" placeholder="EX:  Cat"
                        single={false}
                        items={gelery}
                        onChange={(val) => {
                            var tmp = [...gelery]
                            console.log(gelery)
                            tmp.push(val)
                            setGelery(tmp)
                        }}
                        removeItem={(val) => {
                            setGelery(val)
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

export default UpdateProduct;




if (document.getElementById('form-product')) {

    var container = document.getElementById("form-product")
    var formData = container.getAttribute("form-data") ? container.getAttribute("form-data") : "{}";
    ReactDOM.render(<UpdateProduct form_data={JSON.parse(formData)} />, container);
}
