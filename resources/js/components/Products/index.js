import { range } from 'lodash';
import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import useFetch from '../../store/useFetch';
import { InputWithLabel, InputSelectWithLabel, InputChooseWithLabel, InputCheckWithLabel } from '../Form/InputRenderer';
import numeral from 'numeral'
import { Pagination } from '../Form/Pagination';
import loading from '../assets/loading.svg'
import { encodeQuery } from '../utls';


function ProductContainer({ initialPageConfig }) {

    const [pageConfig, setPageConfig] = useState({});
    useEffect(() => {
        setPageConfig(initialPageConfig)
    }, []);

    const [selectedItems, setSelectedItems] = useState(null);
    const [queryString, setQueryString] = useState("");

    var { data, isLoading, isError } = useFetch("/app/data/getproducts?" + (encodeQuery({ ...pageConfig })))
    return (<>

        <div style={{ marginTop: '100px' }} className="d-flex flex-column align-items-start">
            {
                <>
                    <div className="mb-4 mt-4 prod-page-header">
                        <h3>Produk Di DigiBook</h3>
                    </div>
                    <div className="row" style={{ width: '100%' }}>

                        <div className="col-lg-3">
                            <RenderFilter setPageConfig={setPageConfig} pageConfig={pageConfig}></RenderFilter>
                        </div>
                        <div className="col-lg-9">
                            {isLoading ? <LoadingScreen /> :
                                <>
                                    <RenderProducts items={data}></RenderProducts>
                                    <Pagination pagination={data} setPageConfig={setPageConfig} pageConfig={pageConfig}></Pagination>
                                </>
                            }

                        </div>
                    </div>

                </>
            }
        </div>

    </>)
}

function LoadingScreen() {
    return <>
        <div class="card card-no-locations col-lg-12">
            <div class="card-body  text-center ">
                <img src={loading} class="" width="200px" alt="" />
                <p class="card-text text-center mt-2">Sedang Mengambil Data</p>
            </div>
        </div>
    </>
}

function RenderProducts({ items }) {
    return <>
        <div className="row">

            {items.data.map((item) => {
                return <ProductItems item={item}></ProductItems>
            })}
        </div>
    </>
}

function RenderFilter({ item, pageConfig, setPageConfig }) {
    useEffect(() => {
        setTempPageConfig(pageConfig)
    }, [pageConfig]);
    const [tempPageConfig, setTempPageConfig] = useState({});

    var { data, isLoading, isError } = useFetch("/app/data/getbrand")
    var kategoriData = useFetch("/app/data/getsubcategory").data
    return <>
        <div className="d-flex flex-column md-none mb-4">

            <h3 className="mb-4">
                <b>
                    Filter Produk
            </b>

            </h3>
            <div className="md-none">


                <InputWithLabel value={tempPageConfig['nama_produk']} onChange={(selected) => {
                    setTempPageConfig({ ...tempPageConfig, ...{ "nama_produk": selected } })
                }} label="Nama Produk" placeholder="Ex: cat"></InputWithLabel>

                <InputWithLabel type="number" value={tempPageConfig['harga_minumum']} onChange={(selected) => {
                    setTempPageConfig({ ...tempPageConfig, ...{ "harga_minumum": selected } })
                }} label="Harga Minimum" appendix="Rp." placeholder="Ex: 50.000"></InputWithLabel>
                <InputWithLabel type="number" value={tempPageConfig['harga_maximum']} onChange={(selected) => {
                    setTempPageConfig({ ...tempPageConfig, ...{ "harga_maximum": selected } })
                }} label="Harga Maksimum" appendix="Rp." placeholder="Ex: 500.000"></InputWithLabel>

                <InputSelectWithLabel value={tempPageConfig['kategori']} onChange={(selected) => {
                    setTempPageConfig({ ...tempPageConfig, ...{ "kategori": selected } })
                }} label="Kategori" placeholder="--Pilih Kategori--" items={kategoriData}></InputSelectWithLabel >

                <InputSelectWithLabel value={tempPageConfig['brand']} onChange={(selected) => {
                    setTempPageConfig({ ...tempPageConfig, ...{ "brand": selected } })
                }} label="Brand" placeholder="--Pilih Brand--" items={data}></InputSelectWithLabel >



                <InputChooseWithLabel value={tempPageConfig['urutan']} onChange={(selected) => {
                    setTempPageConfig({ ...tempPageConfig, ...{ "urutan": selected } })
                }} label="Urutan" items={{
                    HARGA_TERENDAH: "Harga Terendah - Tertinggi",
                    HARGA_TERTINGGI: "Harga Tertinggi - Terendah",
                }}></InputChooseWithLabel>
                <InputCheckWithLabel value={tempPageConfig['urutan_a_Z']} onChange={(selected) => {
                    setTempPageConfig({ ...tempPageConfig, ...{ "urutan_a_Z": selected } })
                }} items={{
                    URUTAN_A_Z: "Urutan dari A - Z",
                }}></InputCheckWithLabel>
                <InputCheckWithLabel value={tempPageConfig['urutan_penjualan']} onChange={(selected) => {
                    setTempPageConfig({ ...tempPageConfig, ...{ "urutan_penjualan": selected } })
                }} items={{
                    URUTAN_PENJUALAN: "Uratan berdasarkan penjualan",
                }}></InputCheckWithLabel>

                <div className="mt-4">
                    <button onClick={() => {
                        setPageConfig(tempPageConfig)
                    }} className="btn btn-danger" style={{ width: '100%', height: '50px' }}>
                        Terapkan filter
                </button>
                </div>
            </div>
        </div>




    </>
}

function ProductItems({ item }) {


    return <>
        <div class="col-lg-3 mb-4">

            <div className="d-flex flex-column product-container">
                <div >
                    <img src={item.cover.image_url} class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="" />

                </div>
                <div className="p-2 d-flex flex-column">
                    <a href={"/product/detail/" + (item.sku_id ? item.sku_id : "")}>
                        <span className="prod_name">
                            {item.name}
                        </span>
                    </a>
                    {item.discount > 0 && <>
                        <strike>
                            <span style={{ color: "#F26525" }} className="pb-2 striped_price">
                                Rp {numeral(item.price).format("0,0")}
                            </span></strike>
                    </>}
                    <span style={{ color: "#F26525" }} className="pb-2 prod_price">
                        Rp {numeral(item.price - (item.discount ? item.discount : 0)).format("0,0")}
                    </span>

                    <span className="prod_mitra">
                        <i class="fa fa-home" color="" aria-hidden="true"></i> &nbsp; {item.mitra.name}
                    </span>

                    <a href={"/product/detail/" + (item.sku_id ? item.sku_id : "")} className="btn btn-danger w-100 text-white">
                        Detail
                </a>

                </div>




            </div>
        </div>
    </>

}

export default ProductContainer;
export {
    Pagination
}

if (document.getElementById('products-container')) {

    var container = document.getElementById("products-container")
    var search_nama_produk = container.getAttribute("search_nama_produk")
    var search_kategori_id = container.getAttribute("subcategory")
    var brand_id = container.getAttribute("brand_id")
    var initialPageConfig = {
        nama_produk: search_nama_produk ? search_nama_produk : "",
        kategori: search_kategori_id ? search_kategori_id : "",
        brand: brand_id ? brand_id : ""
    }
    ReactDOM.render(<ProductContainer initialPageConfig={initialPageConfig} />, container);
}

