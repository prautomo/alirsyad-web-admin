import React, { useEffect } from 'react';
import ReactDOM from 'react-dom';
import useLocationStore from '../../store/LocationStore';
import useFetch from '../../store/useFetch';
import useSwr from "swr"
import { Icon, InlineIcon } from '@iconify/react';
import locationHazardFilled from '@iconify/icons-carbon/location-hazard-filled';
import loading from '../assets/loading.svg'
import { encodeQuery } from '../utls';
function NearestMitra({ data }) {
    var { hasError, latitude, longitude, setCurrentPosition } = useLocationStore()
    var { data, isLoading, isError } = useFetch(!hasError ? "/home/nearestmitra?" + encodeQuery({ latitude, longitude }) : null)



    return (
        <>
            <div class="row ">


                {
                    hasError ? <NoLocationScreen /> :
                        (isLoading ? <LoadingScreen /> : data.map(function (item) {

                            return <div className="col-lg-3 col-md-4"><div className="card  " >
                                <img className="card-img-top" src={item.photo} alt="Card image cap" height="241px" />
                                <div className="card-body">
                                    <h4 className="card-title">{item.name}</h4>
                                    <span className="card-text">{item.distance_in_km ? item.distance_in_km.toFixed() : 0} Km</span>
                                    <p className="card-text"><small className="text-muted"><i className="fa fa-map-marker"> </i> {item.district ? item.district.name : "Not Set"}</small></p>
                                    <p style={{ textAlign: 'center' }}>
                                        <a href={"/toko/" + item.id} className="btn btn-danger btn-md" style={{ width: '100%' }}>Lihat Toko</a>
                                    </p>
                                </div>
                            </div></div>
                        }))

                }
            </div>
        </>
    );
}

function NoLocationScreen() {
    return <>
        <div class="card card-no-locations col-lg-12">
            <div class="card-body  text-center ">
                <Icon icon={locationHazardFilled} width={200} color="#999999" />
                <p class="card-text text-center mt-2">Ups . Lokasi belum di set</p>
            </div>
        </div>
    </>
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

export default NearestMitra;

if (document.getElementById('nearestmitra')) {

    ReactDOM.render(<NearestMitra />, document.getElementById('nearestmitra'));
}
