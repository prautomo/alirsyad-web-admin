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

    var { data, isLoading, isError } = useFetch("/modul/1/json")


    useEffect(() => {
        console.log("dika data", data)
    }, [])

    return (<>
        <Row className="mb-1 text-left">
            {/* {!isLoading &&
                <>
                </>
            } */}
            <Col md="4">
                <Card>
                    <CardBody>
                        <h4>Kelas-1</h4>
                        <ul>
                            <li>
                                <a href="">Matematika</a>
                            </li>
                            <li>
                                <a href="">Matematika</a>
                            </li>
                            <li>
                                <a href="">Matematika</a>
                            </li>
                            <li>
                                <a href="">Matematika</a>
                            </li>
                        </ul>
                    </CardBody>
                </Card>
            </Col>
            <Col md="8">
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
            </Col>
        </Row>
        
    </>);
}

export default NilaiSimulasi;

var container = document.getElementById("nilai-simulasi-fe");

if (container) {
    ReactDOM.render(<NilaiSimulasi />, container);
}