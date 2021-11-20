import React, { useEffect, useState, useRef } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import TableScrollbar from 'react-table-scrollbar';
import useFetch from '../../../store/useFetch';
import { TabContent, TabPane, Nav, NavItem, NavLink, Card, Button, CardTitle, CardText, Row, Col, CardBody } from 'reactstrap';
import classnames from 'classnames';
import './DetailSimulasiPercobaan.css';

function DetailSimulasiPercobaan({ idSimulasi, idSiswa }) {

    const { data, isLoading, isError } = useFetch(`/guru/json/simulasi/${idSimulasi}/nilai?q_siswa_id=${idSiswa}`)

    useEffect(() => {
        
    }, [])

    return (<>
        {isLoading ? 
        <p>Loading...</p>
        :
        <>
            <Row className="mb-2">
                <Col md="6">
                    <span className="label-progress">
                        Total Percobaan
                    </span>
                </Col>
                <Col md="6">
                    <span className="label-progress">
                        : {data?.data?.jumlah_percobaan ?? 0}
                    </span>
                </Col>
            </Row>
            <Row className="mb-2">
                <Col md="6">
                    <span className="label-progress">
                        Jumlah Berhasil
                    </span>
                </Col>
                <Col md="6">
                    <span className="label-progress">
                        : {data?.data?.jumlah_benar ?? 0}
                    </span>
                </Col>
            </Row>
            <Row className="mb-2">
                <Col md="6">
                    <span className="label-progress">
                        Jumlah Gagal
                    </span>
                </Col>
                <Col md="6">
                    <span className="label-progress">
                        : {data?.data?.jumlah_salah ?? 0}
                    </span>
                </Col>
            </Row>

            <Row className="mb-2">
                <Col md="12">
                    <span className="label-progress">
                        Jumlah Berhasil 10 Percobaan Terakhir: {data?.data?.percobaan_terakhir?.jumlah_benar ?? 0}
                    </span>
                </Col>
            </Row>
            <Row className="mb-2">
                <Col md="12">
                    <span className="label-progress">
                        Jumlah Gagal 10 Percobaan Terakhir: {data?.data?.percobaan_terakhir?.jumlah_salah ?? 0}
                    </span>
                </Col>
            </Row>
            <hr className="my-1"/>
            <Row className="">
                <Col md="6">
                    <span className="label-progress font-weight-bolder">
                        Nilai Akhir Siswa
                    </span>
                </Col>
                <Col md="6">
                    <span className="label-progress font-weight-bolder">
                        : {data?.data?.nilai_akhir ?? 0}
                    </span>
                </Col>
            </Row>
        </>
        }
    </>);
}

export default DetailSimulasiPercobaan;

var container = document.getElementById("detail-simulasi-percobaan");

if (container) {
    var idSimulasi = container.getAttribute("simulasi-id");
    var idSiswa = container.getAttribute("siswa-id");

    ReactDOM.render(<DetailSimulasiPercobaan idSimulasi={idSimulasi} idSiswa={idSiswa} />, container);
}