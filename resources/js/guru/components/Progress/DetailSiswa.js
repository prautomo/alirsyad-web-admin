import React, { useEffect, useState, useRef } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import TableScrollbar from 'react-table-scrollbar';
import useFetch from '../../../store/useFetch';
import { TabContent, TabPane, Nav, NavItem, NavLink, Card, Button, CardTitle, CardText, Row, Col, CardBody } from 'reactstrap';
import classnames from 'classnames';
import './DetailSiswa.css';

function DetailSiswa({ idMapel, idSiswa }) {

    const [activeTab, setActiveTab] = useState(0);
    const [isLoadingModul, setIsLoadingModul] = useState(false);
    const [dataModul, setDataModul] = useState([]);
    const [isLoadingVideo, setIsLoadingVideo] = useState(false);
    const [dataVideo, setDataVideo] = useState([]);
    const [isLoadingSimulasi, setIsLoadingSimulasi] = useState(false);
    const [dataSimulasi, setDataSimulasi] = useState([]);

    // const { data, isLoading, isError } = useFetch(`/guru/json/getModuls?q_mata_pelajaran_id=${idMapel}`)

    const toggleTab = async (tabIndex, tabName) => {
        // load data
        if(tabName==="video"){
            loadDataVideo(idMapel, idSiswa);
        }else if(tabName==="simulasi"){
            loadDataSimulasi(idMapel, idSiswa);
        }else{
            loadDataModul(idMapel, idSiswa);
        }
        
        // switch tab
        if(activeTab !== tabIndex) setActiveTab(tabIndex);
    }

    /**
     * load data modul
     * @param {*} mapelId 
     * @param {*} siswaId 
     */
    async function loadDataModul(mapelId, siswaId){
        setIsLoadingModul(true);

        await axios.get(`/guru/json/getModuls?q_mata_pelajaran_id=${mapelId}&q_siswa_id=${siswaId}`, { headers: { "Content-Type": "application/json" } }).then(function (response) {
			var data = response.data;
			
			if(data?.success){
				setDataModul(data?.data);
			}

        }).catch((e) => {
            console.error("dika error", e?.response?.data?.message)
        })

        setIsLoadingModul(false);
    }

    /**
     * load data video
     * @param {*} mapelId 
     * @param {*} siswaId 
     */
     async function loadDataVideo(mapelId, siswaId){
        setIsLoadingVideo(true);

        await axios.get(`/guru/json/getVideos?q_mata_pelajaran_id=${mapelId}&q_siswa_id=${siswaId}`, { headers: { "Content-Type": "application/json" } }).then(function (response) {
			var data = response.data;
			
			if(data?.success){
				setDataVideo(data?.data);
			}

        }).catch((e) => {
            console.error("dika error", e?.response?.data?.message)
        })

        setIsLoadingVideo(false);
    }

    /**
     * load data simulasi
     * @param {*} mapelId 
     * @param {*} siswaId 
     */
     async function loadDataSimulasi(mapelId, siswaId){
        setIsLoadingSimulasi(true);

        await axios.get(`/guru/json/getSimulasis?q_mata_pelajaran_id=${mapelId}&q_siswa_id=${siswaId}`, { headers: { "Content-Type": "application/json" } }).then(function (response) {
			var data = response.data;
			
			if(data?.success){
				setDataSimulasi(data?.data);
			}

        }).catch((e) => {
            console.error("dika error", e?.response?.data?.message)
        })

        setIsLoadingSimulasi(false);
    }

    useEffect(() => {
        loadDataModul(idMapel, idSiswa);
    }, [])

    return (<>
        <Nav tabs className="detail-progress-siswa-tabs">
            <NavItem key={0}>
                <NavLink
                    href="#"
                    className={classnames({ active: activeTab === 0 })}
                    onClick={() => { toggleTab(0, 'modul') }}
                >
                    Modul
                </NavLink>
            </NavItem>
            <NavItem key={1}>
                <NavLink
                    href="#"
                    className={classnames({ active: activeTab === 1 })}
                    onClick={() => { toggleTab(1, 'video') }}
                >
                    Video
                </NavLink>
            </NavItem>
            <NavItem key={2}>
                <NavLink
                    href="#"
                    className={classnames({ active: activeTab === 2 })}
                    onClick={() => { toggleTab(2, 'simulasi') }}
                >
                    Simulasi
                </NavLink>
            </NavItem>
        </Nav>

        <TabContent activeTab={activeTab}>
            {/* Start Modul */}
            <TabPane tabId={0}>
                <Row>
                    <Col sm="12">
                        <Card>
                            <CardBody className="pr-0 pl-0">
                                <TableScrollbar height="350px">
                                    <table className="table" id="user">
                                        <thead>
                                            <tr style={{ backgroundColor: "#FFFFFF" }}>
                                                <th width={"5%"} className="text-center">
                                                    No
                                                </th>
                                                <th width={"65%"}>
                                                    Nama Modul
                                                </th>
                                                <th width={"30%"}>
                                                    Progres Modul
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {!isLoadingModul && dataModul?.map((val, idx) => {
                                                return <tr key={idx}>
                                                    <td width={"5%"} className="text-center">
                                                        {idx+1}
                                                    </td>
                                                    <td width={"65%"} className="">
                                                        {val['name'] ?? '-'}
                                                    </td>
                                                    <td width={"30%"} className="text-left">
                                                    {val['read'] ?
                                                        <span className="badge badge-success">Selesai dipelajari</span>
                                                    :
                                                        <span className="badge badge-warning">Sedang dipelajari</span>
                                                    }
                                                    </td>
                                                </tr>
                                            })}

                                            {(isLoadingModul) &&
                                            <tr>
                                                <td colSpan="5" className="text-center">
                                                    Loading...
                                                </td>
                                            </tr>
                                            }

                                            {(!isLoadingModul && dataModul.length < 1) &&
                                            <tr>
                                                <td colSpan="5" className="text-left">
                                                    Belum ada data.
                                                </td>
                                            </tr>
                                            }
                                        </tbody>
                                    </table>
                                </TableScrollbar>
                            </CardBody>
                        </Card>
                    </Col>
                </Row>
            </TabPane>
            {/* End Modul */}

            {/* Start Video */}
            <TabPane tabId={1}>
                <Row>
                    <Col sm="12">
                        <Card>
                            <CardBody className="pr-0 pl-0">
                                <TableScrollbar height="350px">
                                    <table className="table" id="user">
                                        <thead>
                                            <tr style={{ backgroundColor: "#FFFFFF" }}>
                                                <th width={"5%"} className="text-center">
                                                    No
                                                </th>
                                                <th width={"65%"}>
                                                    Nama Video
                                                </th>
                                                <th width={"30%"}>
                                                    Progres Video
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {!isLoadingVideo && dataVideo?.map((val, idx) => {
                                                return <tr key={idx}>
                                                    <td width={"5%"} className="text-center">
                                                        {idx+1}
                                                    </td>
                                                    <td width={"65%"} className="">
                                                        {val['name'] ?? '-'}
                                                    </td>
                                                    <td width={"30%"} className="text-left">
                                                    {val['watched'] ?
                                                        <span class="badge badge-success">Selesai ditonton</span>
                                                    :
                                                        <span class="badge badge-warning">Belum selesai ditonton</span>
                                                    }
                                                    </td>
                                                </tr>
                                            })}

                                            {(isLoadingVideo) &&
                                            <tr>
                                                <td colSpan="5" className="text-center">
                                                    Loading...
                                                </td>
                                            </tr>
                                            }

                                            {(!isLoadingVideo && dataVideo.length < 1) &&
                                            <tr>
                                                <td colSpan="5" className="text-left">
                                                    Belum ada data.
                                                </td>
                                            </tr>
                                            }
                                        </tbody>
                                    </table>
                                </TableScrollbar>
                            </CardBody>
                        </Card>
                    </Col>
                </Row>
            </TabPane>
            {/* End Video */}

            {/* Start Simulasi */}
            <TabPane tabId={2}>
                <Row>
                    <Col sm="12">
                        <Card>
                            <CardBody className="pr-0 pl-0">
                                <TableScrollbar height="350px" style={{ overflowX: "hidden !important" }}>
                                    <table className="table" id="user">
                                        <thead>
                                            <tr style={{ backgroundColor: "#FFFFFF" }}>
                                                <th width={"5%"} className="text-center">
                                                    No
                                                </th>
                                                <th width={"45%"}>
                                                    Nama Simulasi
                                                </th>
                                                <th width={"10%"} className="text-center">
                                                    Total Percobaan
                                                </th>
                                                <th width={"10%"} className="text-center">
                                                    Jumlah Berhasil<br/>
                                                    <span style={{ fontSize:"8px" }} className="text-primary">
                                                        10 Percobaan terakhir
                                                    </span>
                                                </th>
                                                <th width={"10%"} className="text-center">
                                                    Jumlah Gagal<br/>
                                                    <span style={{ fontSize:"8px" }} className="text-primary">
                                                        10 Percobaan terakhir
                                                    </span>
                                                </th>
                                                <th width={"20%"} className="text-center">
                                                    Nilai Siswa<br/>
                                                    <span style={{ fontSize:"8px" }} className="text-primary">
                                                        10 Percobaan terakhir
                                                    </span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {!isLoadingSimulasi && dataSimulasi?.map((val, idx) => {
                                                return <tr key={idx}>
                                                    <td width={"5%"} className="text-center">
                                                        {idx+1}
                                                    </td>
                                                    <td width={"45%"} className="">
                                                        <a href={`/guru/simulasi-percobaan/${val['id']}/detail?q_siswa_id=${idSiswa}`} target="_blank">
                                                            {val['name'] ?? '-'}<br/>
                                                            <span className="text-primary" style={{ fontSize:"12px" }}>Level {val['level'] ?? '-'}</span>
                                                        </a>
                                                    </td>
                                                    <td width={"10%"} className="text-center">
                                                        {val['total_percobaan'] ?? 0}
                                                    </td>
                                                    <td width={"10%"} className="text-center">
                                                        {val['10_percobaan_terakhir_berhasil'] ?? 0}
                                                    </td>
                                                    <td width={"10%"} className="text-center">
                                                        {val['10_percobaan_terakhir_gagal'] ?? 0}
                                                    </td>
                                                    <td width={"20%"} className="text-center">
                                                        {val['rata_rata_score'] ?? 0}
                                                    </td>
                                                </tr>
                                            })}

                                            {(isLoadingSimulasi) &&
                                            <tr>
                                                <td colSpan="5" className="text-center">
                                                    Loading...
                                                </td>
                                            </tr>
                                            }

                                            {(!isLoadingSimulasi && dataSimulasi.length < 1) &&
                                            <tr>
                                                <td colSpan="5" className="text-left">
                                                    Belum ada data.
                                                </td>
                                            </tr>
                                            }
                                        </tbody>
                                    </table>
                                </TableScrollbar>
                            </CardBody>
                        </Card>
                    </Col>
                </Row>
            </TabPane>
            {/* End Simulasi */}
        </TabContent>
    </>);
}

export default DetailSiswa;

var container = document.getElementById("progress-detail-siswa");

if (container) {
    var idMapel = container.getAttribute("mapel-id");
    var idSiswa = container.getAttribute("siswa-id");

    ReactDOM.render(<DetailSiswa idMapel={idMapel} idSiswa={idSiswa} />, container);
}