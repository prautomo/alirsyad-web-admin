import { range } from 'lodash';
import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import useFetch from '../../store/useFetch';
import { InputWithLabel, InputSelectWithLabel, InputChooseWithLabel, InputCheckWithLabel } from '../Form/InputRenderer';
import numeral from 'numeral'
import { Pagination } from '../Form/Pagination';
import loading from '../assets/loading.svg'
import BreadCumb from '../Breadcomb';
import classNames from 'classnames'
import SimpleContainer from '../SimpleContainer';
import useCart from '../../store/useCart';
import Swal from 'sweetalert2';
import { ProductItems, RenderProducts } from './per_toko'


function ProductDetailContainer({ prod_id }) {


    var { data, isLoading, isError } = useFetch("/product/detail/" + prod_id)
    return (<>
        <div className="row" style={{ marginTop: '100px' }}>
            <div className="col-lg-12">

                <BreadCumb params={{
                    "/": "Home",
                    "/produk": "Produk",
                    "": (data ? data.name : "Product Name"),
                }}></BreadCumb>
            </div>
            <div className="col-lg-6">
                {isLoading ? "Loading" :
                    <>

                        <GaleryRender cover={data.cover} galery={data.galery}></GaleryRender>
                        <div style={{ marginTop: '50px' }}></div>

                        <SimpleContainer title={"Detail Produk & Spesifikasi"} content={

                            (data.spesification ? data.spesification : "").split("\n").map((item) => {
                                return <span className="detail_info">{item}</span>
                            })

                        }>

                        </SimpleContainer>
                        <div style={{ marginTop: '50px' }}></div>
                        <SimpleContainer title={"Keunggulan :"} content={

                            (data.keunggulan ? data.keunggulan : "").split("\n").map((item) => {
                                return <span className="detail_info">{item}</span>
                            })

                        }>

                        </SimpleContainer>
                        <div style={{ marginTop: '50px' }}></div>
                    </>

                }
            </div>
            <div className="col-lg-6">

                {isLoading ? "Loading" :
                    <>

                        <h2>
                            <b>
                                {data.name}</b>
                                &nbsp; <span className="text-muted">(Terjual : {data.terjual})</span>
                        </h2>
                        <SimpleContainer title={"Deskripsi :"} content={
                            <span className="detail_info">{data.description}</span>
                        }>

                        </SimpleContainer>

                        <div style={{ marginTop: '30px' }}></div>

                        <SimpleContainer title={"SKU :"} content={
                            <span className="detail_info">{data.code}</span>
                        }>

                        </SimpleContainer>
                        <div style={{ marginTop: '30px' }}></div>

                        <SimpleContainer title={"Harga :"} content={
                            <div>

                                {data.discount > 0 && <>
                                    <strike>
                                        <h4 className="pb-2 striped_price text-muted">
                                            Rp {numeral(data.selling_price).format("0,0")}
                                        </h4></strike>
                                </>}
                                <h3 className="pb-2 prod_price">
                                    <b>

                                        Rp {numeral(data.selling_price - (data.discount ? data.discount : 0)).format("0,0")}
                                    </b>
                                </h3>
                            </div>

                        }>

                        </SimpleContainer>




                        <div style={{ marginTop: '30px' }}></div>
                        <ItemCountPicker item={data}>

                        </ItemCountPicker>




                    </>
                }
            </div>


            <div className="col-lg-12">

                {isLoading ? "Loading" :
                    <>


                        <hr></hr>

                        <SimpleContainer title="Rekomendasi" content={
                            <>


                                <div className="row">

                                    {data.recomendations ? data.recomendations.map((item) => {
                                        return <ProductItems item={item}></ProductItems>
                                    }) : "Tidak Ada Rekomendasi"}
                                </div>

                            </>
                        }>

                        </SimpleContainer>


                    </>
                }
            </div>


        </div>
    </>)
}



function ItemCountPicker({ item }) {
    var { cart, addItem, removeItem } = useCart();
    const [inCart, setInCart] = useState(false);

    useEffect(() => {
        setJumlah(cart[item.sku_id] ? cart[item.sku_id].jumlah : 0)
        setInCart(cart[item.sku_id] ? true : false)
    }, [cart]);

    const [jumlah, setJumlah] = useState(1);
    return <>
        <div className="d-flex flex-column">

            <div className="d-flex align-items-center  justify-content-between" style={{ width: '177.93px', height: '60px', border: "1px solid #BEBEBE" }}>
                <button className="btn " style={{ width: '60px', height: '60px' }} onClick={() => {
                    setJumlah(jumlah - 1 >= 0 ? jumlah - 1 : 0)
                }}>
                    <i class="fa fa-minus" aria-hidden="true"></i>
                </button>

                <h3 className="mb-0">
                    {jumlah}
                </h3>
                <button className="btn" style={{ width: '60px', height: '60px' }} onClick={() => {
                    setJumlah(jumlah + 1 < 1000 ? jumlah + 1 : 1000)
                }}>
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>

            <div style={{ marginTop: '20px' }}></div>

            <button className="w-100 btn btn-danger font-weight-bold" style={{ height: '60px' }}
                onClick={() => {
                    if (jumlah > 0) {

                        var tmpItem = {}

                        tmpItem[item.sku_id] = { ...item, ...{ jumlah: jumlah } }
                        addItem(tmpItem)


                        Swal.fire("Keranjang Belanja", item.name + "  berhasil di tambahkan ke keranjang", "success")
                    } else if (inCart && jumlah == 0) {

                        Swal.fire({
                            title: 'Keranjang belanja',
                            text: "Anda yakin akan mengeluarkan " + item.name + "  dari keranjang",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                removeItem(item.sku_id)
                            }
                        })
                    }

                }}> {inCart && jumlah == 0 ? "Keluarkan Dari Keranjang " : "Masukan Keranjang"}</button>
        </div>
    </>

}

function GaleryRender({ cover, galery }) {

    useEffect(() => {
        setCurretnCover(cover ? cover : galery[0])
    }, []);

    const [curretnCover, setCurretnCover] = useState({});
    return (<>
        <div className="d-flex flex-column justify-items-center">
            <div className="galery-cover d-flex align-items-center justify-content-center ">

                <img src={curretnCover.image_url} style={{ height: '300px' }} class="img-fluid " alt="" />
            </div>
            <div>

                <div className=" d-flex align-items-center flex-wrap justify-content-center" style={{ margin: '0px' }}>
                    {galery.map((galeryItem) => {

                        return <div className={classNames("d-flex  align-items-center thumb-container", {
                            'active': galeryItem.id == curretnCover.id
                        })} onClick={() => {
                            setCurretnCover(galeryItem)
                        }}>
                            <img src={galeryItem.image_url} class="img-fluid " alt="" />
                        </div>
                    })}

                </div>
            </div>
        </div>
    </>)
}


export default ProductDetailContainer;

if (document.getElementById('products-detail')) {

    var container = document.getElementById("products-detail")
    var prod_id = container.getAttribute("prod_id")
    ReactDOM.render(<ProductDetailContainer prod_id={prod_id} />, container);
}

