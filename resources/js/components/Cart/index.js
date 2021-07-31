

import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import useFetch from '../../store/useFetch';
import { InputWithLabel, InputSelectWithLabel, InputChooseWithLabel, InputModalSelectorWithLabel, InputCheckWithLabel, InputTextAreaWithLabel, InputDatePickerWithLabel, InputMapPickerWithLabel } from '../Form/InputRenderer';
import numeral from 'numeral'

import classNames from 'classnames'
import SimpleContainer from '../SimpleContainer';
import useCart from '../../store/useCart';
import StepStatus from './Step';
import { Badge } from 'react-bootstrap';
import moment from 'moment'
import { object, string } from 'yup';
import Swal from 'sweetalert2';
import { calcCrow } from "../../components/utls"
import useLocationStore from '../../store/LocationStore';



function CartDetailContainer({
    logedin,
    verified
}) {

    const [formTransaksi, setFormTransaksi] = useState({});
    const [currentIndex, setCurrentIndex] = useState(0);
    const [createdTransaction, setCreatedTransaction] = useState({});
    return <>
        <div style={{ marginTop: '120px' }}></div>
        <div className="row justify-content-center "  >
            <StepStatus items={[
                { "key": 1, 'text': "Belanjaan anda" },
                { "key": 2, 'text': "Pengiriman" },
                { "key": 3, 'text': "Pembayaran" },
            ]} currentIndex={currentIndex}>

            </StepStatus>
        </div>
        <div style={{ marginTop: '50px' }}></div>
        <div style={{ display: currentIndex == 0 ? "block" : "none" }} >

            <CartDetail logedin={logedin} setCurrentIndex={setCurrentIndex} verified={verified}></CartDetail>
        </div>
        <div style={{ display: currentIndex == 1 ? "block" : "none" }} >

            <InformasiPengiriman logedin={logedin} setCurrentIndex={setCurrentIndex}
                formTransaksi={formTransaksi} setFormTransaksi={setFormTransaksi}
                setCreatedTransaction={setCreatedTransaction}
            ></InformasiPengiriman>
        </div>
        <div style={{ display: currentIndex == 2 ? "block" : "none" }} >

            <PaymentPage logedin={logedin} setCurrentIndex={setCurrentIndex} createdTransaction={createdTransaction}></PaymentPage>
        </div>
    </>
}


function CartDetail({ logedin, setCurrentIndex, verified }) {

    var { cart, addItem, getTotalTransaksi, removeItem, mapCartByMitra } = useCart();
    const [mappedByMitra, setMappedByMitra] = useState({});

    useEffect(() => {
        var item = mapCartByMitra()
        setMappedByMitra(item)
    }, [cart]);


    function setJumlah(jumlah, item) {
        var tmp = {}
        tmp[item.sku_id] = { ...item, ...{ jumlah: jumlah } }
        addItem({ ...cart, ...tmp })
    }

    return (<>
        <div className="row justify-content-center" >

            <div className="col-lg-10 ">
                <SimpleContainer title="Shopping Cart" content={
                    <>
                        <small>
                            Daftar belanjaan anda
                        </small>

                        <div style={{ marginTop: '30px' }}></div>
                        <div className="d-flex flex-column">
                            {Object.keys(mappedByMitra).map((mitraInstance) => {
                                var mitraItems = mappedByMitra[mitraInstance]
                                var mitra = mitraItems[0].mitra

                                return <>


                                    <SimpleContainer content={
                                        <>

                                            <h5>{mitra.name}</h5>
                                            {mitraItems.map((cartItem) => {
                                                return <div className="d-flex flex-row justify-content-start pt-3  align-items-center pb-3 pl-0 ">

                                                    <div style={{ width: '130px', height: '130px', border: "1px solid #eee" }} className="d-flex  align-items-center">
                                                        <img src={cartItem.cover.image_url} class="img-fluid " alt="" />
                                                    </div>
                                                    <div className="pl-2 d-flex flex-column w-100" >

                                                        <div className="d-flex justify-content-between align-items-center w-100" >
                                                            <div className=" d-flex flex-column">

                                                                <b>{cartItem.name}</b>


                                                                {cartItem.discount > 0 && <>
                                                                    <strike>
                                                                        <span style={{ color: "#F26525" }} className="pb-2 striped_price">
                                                                            Rp {numeral(cartItem.selling_price).format("0,0")}
                                                                        </span></strike>
                                                                </>}
                                                                <span style={{ color: "#F26525" }} className="pb-2 prod_price">
                                                                    <b>    Rp {numeral(cartItem.selling_price - (cartItem.discount ? cartItem.discount : 0)).format("0,0")}
                                                                    </b>
                                                                </span>
                                                            </div>
                                                            <button className="btn btn-danger" style={{ width: '40px', height: '40px' }} onClick={() => {
                                                                Swal.fire({
                                                                    title: 'Keranjang belanja',
                                                                    text: "Anda yakin akan mengeluarkan " + cartItem.name + "  dari keranjang",
                                                                    icon: 'warning',
                                                                    showCancelButton: true,
                                                                    confirmButtonText: 'Ya'
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        removeItem(cartItem.sku_id)
                                                                    }
                                                                })
                                                            }}>
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </button>

                                                        </div>
                                                        <div className="d-flex justify-content-between align-items-center w-100" style={{ marginTop: '10px', }}>

                                                            <div className="d-flex align-items-center  justify-content-between" style={{ width: '130', height: '40px', border: "1px solid #BEBEBE" }}>
                                                                <button className="btn " style={{ width: '40px', height: '40px' }} onClick={() => {
                                                                    setJumlah(cartItem.jumlah - 1 >= 1 ? cartItem.jumlah - 1 : 1, cartItem)
                                                                }}>
                                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                                </button>

                                                                <span className="mb-0">
                                                                    {cartItem.jumlah}
                                                                </span>
                                                                <button className="btn" style={{ width: '40px', height: '40px' }} onClick={() => {
                                                                    setJumlah(cartItem.jumlah + 1 < 1000 ? cartItem.jumlah + 1 : 1000, cartItem)
                                                                }}>
                                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                                </button>
                                                            </div>


                                                            <div>
                                                                <h5>

                                                                    Rp. {numeral((cartItem.selling_price - (cartItem.discount > 0 ? cartItem.discount : 0)) * cartItem.jumlah).format('0,0')}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            })}
                                        </>
                                    }>

                                    </SimpleContainer>
                                </>
                            })}

                        </div>

                        <div className="d-flex flex-row justify-content-between">
                            <div>Total Item</div>
                            <div><b>{Object.keys(cart).length} Item</b></div>
                        </div>
                        <div className="d-flex flex-row justify-content-between">
                            <div>Total Harga</div>
                            <div><h5>Rp. {numeral(getTotalTransaksi()).format("0,0")} </h5></div>
                        </div>


                        {logedin &&

                            <div className="d-flex justify-content-end mt-4">
                                <div className="d-flex flex-column align-items-end">

                                {!verified &&
                                    <span className="text-danger">Silahkan Verifikasi Email Anda Untuk Melakukan Checkout.</span>}
                                <button disabled={Object.keys(cart).length < 1  || !verified} className="btn btn-danger" style={{ width: '200px', height: '50px' }} onClick={() => {
                                    setCurrentIndex(1)
                                }}>
                                    Checkout &nbsp; <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </button>
                                </div>
                            </div>}
                    </>
                }></SimpleContainer>

            </div>
        </div>
    </>)
}

function InformasiPengiriman({ formTransaksi, setFormTransaksi, setCurrentIndex, setCreatedTransaction }) {

    var { cart, addItem, getTotalTransaksi, removeItem, removeAllItem, mapCartByMitra } = useCart();

    const [mappedByMitra, setMappedByMitra] = useState({});
    const [totalOngkir, setTotalOngkir] = useState(0);
    const [coorMitra, setCoorMitra] = useState({});
    useEffect(() => {
        var item = mapCartByMitra()
        setMappedByMitra(item)



    }, [cart]);

    useEffect(() => {

        var ongkirByMitra = {}
        var totalOngkir = 0
        var coorMitras = {}
        _.map(mappedByMitra, (item) => {
            var mitra = item[0].mitra
            coorMitras[mitra.id] = {
                lat: mitra.detail_mitra.latitude,
                long: mitra.detail_mitra.longitude
            }

            var mitraOngkir = (mitra.detail_mitra ? mitra.detail_mitra.ongkir_km : 10000)

            var total = getMapJarakMitra(mitra.id, mitra.detail_mitra.latitude, mitra.detail_mitra.longitude) * mitraOngkir
            ongkirByMitra[mitra.id] = total
            totalOngkir = totalOngkir + total
        })

        setTotalOngkir(totalOngkir)
        setOngkirByMitra(ongkirByMitra)
        setCoorMitra(coorMitras)

    }, [mappedByMitra]);

    var { data, isLoading, isError } = useFetch("/app/data/getmypromos")
    const [validatedDiscount, setValidatedDiscount] = useState({});
    const [checkoutProcess, setCheckoutProcess] = useState(false);

    const [ongkirByMitra, setOngkirByMitra] = useState({});
    function onVoucherSelected(voucher) {
        setCheckoutProcess(true)
        window.axios.post("/app/validatevoucher", {
            cart, voucher
        }).then((res) => {
            setValidatedDiscount(res.data)

            Swal.fire("Voucher", "Voucher " + voucher.name + " Berahasil Diterapkan", "success")
        }).catch((err) => {
            setValidatedDiscount({})

            Swal.fire("Opss.", "Voucher " + voucher.name + " Gagal Diterapkan", "success")
            console.log(err)
        }).finally(() => {
            setCheckoutProcess(false)
        })
    }


    async function sendCheckoutRequest() {

        var checkoutSchema = object().shape({
            nama_penerima: string()
                .required(),
            nomor_telepon: string()
                .required(),
            alamat: string()
                .required(),
            location: object()
                .required(),
            patokan: string()
                .required(),
            catatan: string()
                .required(),
            waktu_pengiriman: string()
                .required(),
        });

        var valid = await checkoutSchema.isValid(formTransaksi);

        if (valid) {


            setCheckoutProcess(true)
            window.axios.post("/app/postcheckout", {
                cart, selectedVoucher, formTransaksi, mappedByMitra, ongkirByMitra
            }).then((res) => {
                removeAllItem()
                setCurrentIndex(2)
                setCreatedTransaction(res.data.data)


            }).catch((err) => {
                Swal.fire("Terjadi kesalahan", err.response.data.message, "error")
            }).finally(() => {
                setCheckoutProcess(false)
            })
        } else {
            Swal.fire("Validasi", "Silahkan Isi Semua Informasi Pengiriman", "warning")

        }


    }

    const [selectedVoucher, setSelectedVoucher] = useState(null);

    var { latitude, longitude } = useLocationStore()
    function getMapJarakMitra(mitra_id, lat, long) {
        if (mitra_id in coorMitra) {

            var corrdMitra = coorMitra[mitra_id]
            var currentLocation = formTransaksi.location ? formTransaksi.location : { lat: latitude, lng: longitude }
            console.log(currentLocation.lat,
                currentLocation.lng,
                corrdMitra.lat,
                corrdMitra.long)
            return Math.ceil(calcCrow(
                currentLocation.lat,
                currentLocation.lng,
                corrdMitra.lat,
                corrdMitra.long


            ).toFixed(1))
        } else if (lat && long) {
            var currentLocation = formTransaksi.location ? formTransaksi.location : { lat: latitude, lng: longitude }
            return Math.ceil(calcCrow(
                currentLocation.lat,
                currentLocation.lng,
                lat,
                long


            ).toFixed(1))
        } else {
            return 0
        }
    }


    return (<>
        <div className="row justify-content-center" >


            <div className="col-lg-10 ">
                <div class="row">
                    <div class="col-lg-8">
                        <SimpleContainer title="Informasi Pengiriman" content={
                            <>

                                <small>
                                    Informasi Pengiriman
                        </small>

                                <div style={{ marginTop: '30px' }}></div>

                                <InputWithLabel label="Nama Penerima :"
                                    placeholder=""
                                    value={formTransaksi["nama_penerima"]}
                                    onChange={(value) => {
                                        setFormTransaksi({ ...formTransaksi, ... { nama_penerima: value } })
                                    }}

                                    appendix={<i class="fa fa-user" aria-hidden="true"></i>}></InputWithLabel>


                                <InputWithLabel label="Nomor Telepon :"

                                    value={formTransaksi["nomor_telepon"]}
                                    onChange={(value) => {
                                        setFormTransaksi({ ...formTransaksi, ... { nomor_telepon: value } })
                                    }}
                                    appendix={<i class="fa fa-phone" aria-hidden="true"></i>}></InputWithLabel>

                                <InputMapPickerWithLabel label="Lokasi : " desc={<small>
                                    *Maks Pengiriman Maks 5KM , Lebih Dari Itu Dikenakan Biaya Per KM nya
                                    </small>}
                                    appendix={<i class="fa fa-map-pin" aria-hidden="true" ></i>}
                                    value={JSON.stringify(formTransaksi["location"])}
                                    onChange={(value) => {
                                        setFormTransaksi({ ...formTransaksi, ... { location: value } })
                                    }}></InputMapPickerWithLabel>



                                <InputWithLabel label="Alamat : "

                                    value={formTransaksi["alamat"]}
                                    onChange={(value) => {
                                        setFormTransaksi({ ...formTransaksi, ... { alamat: value } })
                                    }}
                                    appendix={<i class="fa fa-bookmark" aria-hidden="true" ></i>}></InputWithLabel>


                                <InputWithLabel label="Patokan : "

                                    value={formTransaksi["patokan"]}
                                    onChange={(value) => {
                                        setFormTransaksi({ ...formTransaksi, ... { patokan: value } })
                                    }}
                                    appendix={<i class="fa fa-bookmark" aria-hidden="true" ></i>}></InputWithLabel>

                                <InputTextAreaWithLabel label="Catatan :"

                                    value={formTransaksi["catatan"]}
                                    onChange={(value) => {
                                        setFormTransaksi({ ...formTransaksi, ... { catatan: value } })
                                    }}
                                ></InputTextAreaWithLabel>

                                <InputDatePickerWithLabel label="Waktu Pengiriman :"
                                    value={formTransaksi["waktu_pengiriman"]}
                                    onChange={(value) => {
                                        setFormTransaksi({ ...formTransaksi, ... { waktu_pengiriman: value } })
                                    }}
                                    appendix={<i class="fa fa-calendar" aria-hidden="true" ></i>}></InputDatePickerWithLabel>


                            </>
                        }></SimpleContainer>
                    </div>

                    <div class="col-lg-4">
                        <SimpleContainer title="Promo" content={
                            <>
                                <div>
                                    <InputModalSelectorWithLabel label="Promo: " desc={
                                        <small>Gunakan Promo yang anda punya</small>
                                    }
                                        appendix={<i class="fa fa-percent" aria-hidden="true"></i>}
                                        value={selectedVoucher}
                                        onChange={(selected) => {
                                            setSelectedVoucher(selected)
                                            onVoucherSelected(selected)
                                        }}
                                        items={isLoading ? [] : data}
                                        itemRenderer={(currentItem, currentId, selected, setSelected) => {
                                            return <>
                                                <div class={classNames("card no-border mb-2", {
                                                    'text-white': selected.id == currentItem.id,
                                                    'bg-primary': selected.id == currentItem.id
                                                })} onClick={() => {
                                                    setSelected(currentItem)
                                                }}>
                                                    <div class="card-body ">
                                                        <div className="d-flex align-items-center" >
                                                            <div>

                                                                <img src={currentItem.cover_image} style={{ width: '100px', marginRight: '10px' }} alt="" />
                                                            </div>
                                                            <div>

                                                                <h5 class="card-title p-0">{currentItem.name}</h5>
                                                                <p class="card-text p-0 m-0">{currentItem.description}</p>
                                                                <Badge variant="info" className="text-white">{moment(currentItem.start_date).format('D-M-Y')} &nbsp; Sampai &nbsp;
                                                                {moment(currentItem.end_date).format('D-M-Y')}
                                                                </Badge>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </>

                                        }}>
                                    </InputModalSelectorWithLabel>
                                </div>

                                {validatedDiscount &&
                                    <div className="d-flex flex-column">
                                        <div>Potongan  </div>
                                        <div><h5>Rp. {numeral((validatedDiscount.discount ? validatedDiscount.discount : 0)).format("0,0")} </h5></div>
                                    </div>}
                            </>
                        }>

                        </SimpleContainer>

                        <hr></hr>
                        <SimpleContainer title="Ringkasan Pesanan" content={
                            <>

                                <small>
                                    Daftar belanjaan anda
                        </small>

                                <div className="d-flex flex-column">

                                    {Object.keys(mappedByMitra).map((keyItem) => {
                                        var item = mappedByMitra[keyItem]
                                        var mitra = item[0].mitra
                                        var jarakkeMItra = getMapJarakMitra(mitra.id)
                                        return <>

                                            <b>
                                                {mitra.name}
                                            </b>
                                            {item.map((cartItem) => {
                                                return <div className="d-flex flex-column ">
                                                    <span>

                                                        {cartItem.name} x {cartItem.jumlah}
                                                    </span>
                                                    <span className="text-muted">
                                                        Rp. {numeral((cartItem.selling_price - (cartItem.discount > 0 ? cartItem.discount : 0)) * cartItem.jumlah).format('0,0')}
                                                    </span>
                                                </div>

                                            })}
                                            <div className="d-flex flex-column">
                                                <div>Ongkos Kirim ({jarakkeMItra} KM) </div>
                                                <div><h6>Rp. {numeral(jarakkeMItra * (mitra.detail_mitra ? mitra.detail_mitra.ongkir_km : 10000)).format("0,0")}</h6></div>
                                            </div>
                                            <hr></hr>
                                        </>
                                    })}


                                    <div className="d-flex flex-column mt-2">
                                        <div>Total Pesanan</div>
                                        <div><h5>Rp. {numeral(getTotalTransaksi() - (validatedDiscount.discount ? validatedDiscount.discount : 0)).format("0,0")} </h5></div>
                                    </div>


                                    <div className="d-flex flex-column mt-2">
                                        <div>Total Ongkos Kirim</div>
                                        <div><h5>Rp. {numeral(totalOngkir).format("0,0")} </h5></div>
                                    </div>
                                    <div className="d-flex flex-column mt-2">
                                        <div>Total </div>
                                        <div><h5>Rp. {numeral(getTotalTransaksi() - (validatedDiscount.discount ? validatedDiscount.discount : 0) + totalOngkir).format("0,0")} </h5></div>
                                    </div>
                                </div>
                            </>
                        }>



                        </SimpleContainer>
                        <hr></hr>





                        <div className="d-flex flex-column mt-3" >
                            <div> </div>
                            <div>
                                <button disabled={checkoutProcess} onClick={() => { sendCheckoutRequest() }} className="btn btn-danger" style={{
                                    height: '50px',
                                    width: '100%',
                                    fontWeight: 'bold'
                                }}>Pembayaran <i class="fa fa-chevron-right" aria-hidden="true"></i> </button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </>
    )
}

function PaymentPage({ createdTransaction }) {
    return (<>
        <div className="row justify-content-center" >

            <div className="col-lg-10 d-flex  flex-column justify-content-center align-items-center ">
                <SimpleContainer title={"Pembayaran"}>


                </SimpleContainer>

                <div className="d-flex flex-column justify-content-center align-items-center">
                    <b>Pesanan Anda anda sudah kami terima</b>

                    <span>Dengan Total Transaksi : </span>
                    <div style={{ marginTop: '30px' }}></div>
                    <h3>
                        Rp. {numeral(createdTransaction.total_transaksi ? createdTransaction.total_transaksi : 0).format('0,0')}
                    </h3>
                    <span>Silahkan klik tautan di bawah untuk melakukan pembayaran</span>


                    <a href={createdTransaction.payment ? createdTransaction.payment.deep_link_url : ""} className="btn btn-danger " style={{
                        fontWeight: 'bold', width: '300px', marginTop: '30px'
                    }}>
                        <i class="fa fa-id-card" aria-hidden="true"></i> &nbsp; Lakukan pembayaran
                    </a>

                </div>
            </div>
        </div>
    </>
    )
}
function VoucherBox({
    onVoucherValidated
}) {

    return <>
    </>


}

export default CartDetailContainer;

if (document.getElementById('cart-detail')) {

    var container = document.getElementById("cart-detail")
    var logedin = container.getAttribute("logedin")
    var verified = container.getAttribute("verified")


    ReactDOM.render(<CartDetailContainer logedin={logedin ? logedin : false} verified={verified ? verified : false} />, container);
}

