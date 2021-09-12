import React, { useEffect, useState, useRef } from 'react';
import ReactDOM from 'react-dom';
import { Row, Col, Dropdown, DropdownToggle, DropdownMenu, DropdownItem, Button, Card, CardBody } from 'reactstrap';
import Select from 'react-select';
import axios from 'axios';
import { FiMoreVertical } from "react-icons/fi";
import { ReactSketchCanvas } from "react-sketch-canvas";
import useFetch from '../../../store/useFetch';
import "./List.css";

function NilaiSimulasi() {

    const [isLoadingLeft, setIsLoadingLeft] = useState(false);
    const [isLoadingRight, setIsLoadingRight] = useState(false);

    var { data, isLoading, isError } = useFetch("/nilai-simulasi/mapels/json")

    useEffect(() => {
        
    }, [])

    async function changeMapel(id){
        setIsLoadingRight(true);

        await axios.get(`/modul/${id}/json`, { headers: { "Content-Type": "application/json" } }).then(function (response) {
			var data = response.data;

            console.log("dika data", data)
			
			if(data.status){
				
			}

        }).catch((e) => {
            console.error("dika error", e.response.data?.message)
        })

        setIsLoadingRight(false);
    }

    return (<>
        <Row className="mb-1 text-left">
            <Col md="4">
                <Card>
                    <CardBody>
                        {/* active tingkat kelas */}
                        {!isLoading &&
                            data?.data.map((val) => {
                                let tingkat = val?.tingkat;
                                let mapels = val?.mata_pelajarans ?? [];
                                return <div key={tingkat}>
                                <h4>Kelas-{tingkat}</h4>
                                <ul>
                                    {mapels.map((mataPelajaran) => {
                                        return <li key={mataPelajaran?.id}>
                                            <a className="cursor-pointer" onClick={() => changeMapel(mataPelajaran?.id)}>{ mataPelajaran?.name ?? '-' }</a>
                                        </li>
                                    })}
                                </ul>
                                </div>
                            })
                        }
                        
                    </CardBody>
                </Card>
            </Col>
            <Col md="8">
                {isLoadingRight ? 
                <p>Loading....</p> : 
                <Card>
                    <CardBody>
                        <h4>Progres Simulasi Matematika</h4>
                        <div className="d-block w-100">
                            <div className="progress" style={{ height: "1.5rem" }} title="Progress">
                                <div 
                                    className="progress-bar" 
                                    role="progressbar" aria-valuenow="50" 
                                    aria-valuemin="0" aria-valuemax="50" 
                                    style={{ 
                                        width: "50%",
                                        backgroundColor: "rgb(52, 125, 241)"
                                    }}
                                ></div>
                            </div>
                            <div className="mt-1 font-weight-bold" style={{ fontSize: "1rem" }}>
                                <span>5 dari 10 simulasi selesai</span>
                            </div>
                        </div>
                        <hr/>

                        <div style={{ height: "500px", overflow: "auto" }}>
                            {[1,2,3,4,5,6,7,8,9,10].map((val) => {
                                return <Row className="mt-3 mr-0 ml-0" key={val}>
                                <Col md="4">
                                    <img src="/images/placeholder.png" width="100%" height="120px" />
                                </Col>
                                <Col md="8">
                                    <div className="">
                                        <span className="fa fa-star rating-checked"></span>
                                        <span className="fa fa-star"></span>
                                        <span className="fa fa-star"></span>
                                        <span className="ml-3 pt-1">100/100</span>
                                    </div>
                                    <h6 className="title-nilai-simulasi">
                                        <a href="">
                                            Mengurutkan Bilangan
                                        </a>
                                    </h6>
                                    <small>Selesai dikerjakan pada 17 Agustus 2021</small>
                                </Col>
                            </Row>;
                            })}    
                        </div>
                    </CardBody>
                </Card>
                }
            </Col>
        </Row>
        
    </>);
}

export default NilaiSimulasi;

var container = document.getElementById("nilai-simulasi-fe");

if (container) {
    ReactDOM.render(<NilaiSimulasi />, container);
}