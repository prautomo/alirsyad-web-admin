import React, { useEffect, useState, useRef } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import TableScrollbar from 'react-table-scrollbar';
import useFetch from '../../../store/useFetch';
import { TabContent, TabPane, Nav, NavItem, NavLink, Card, Button, CardTitle, CardText, Row, Col, CardBody } from 'reactstrap';
import classnames from 'classnames';
import './DetailProgressBelajar.css';

function DetailProgressBelajar({ }) {

    const [activeTab, setActiveTab] = useState(-1);
    const [isLoadingSiswa, setIsLoadingSiswa] = useState(false);
    const [dataSiswa, setDataSiswa] = useState([]);
    const [mapelIdActive, setMapelIdActive] = useState(0);

    const { data, isLoading, isError } = useFetch("/guru/json/ngajar")

    const toggleTab = async (tab, mapelId, kelasId) => {
        // set mapel id
        setMapelIdActive(mapelId);
        // load data
        await loadSiswa(mapelId, kelasId);
        
        // switch tab
        if(activeTab !== tab) setActiveTab(tab);
    }

    async function loadSiswa(mapelId, kelasId){
        setIsLoadingSiswa(true);

        await axios.get(`/guru/json/getSiswa?mata_pelajaran_id=${mapelId}&kelas_id=${kelasId}`, { headers: { "Content-Type": "application/json" } }).then(function (response) {
			var data = response.data;
			
			if(data.success){
				setDataSiswa(data?.data);
			}

        }).catch((e) => {
            console.error("dika error", e?.response?.data?.message)
        })

        setIsLoadingSiswa(false);
    }

    useEffect(() => {
        
    }, [])

    return (<>
        {isLoading ? 
        <p>Loading...</p>
        :
        <>
        <Nav tabs className="detail-progress-siswa-tab">
            {data?.data?.map((mapel, idx) => {
                return (
                    <NavItem key={idx}>
                        <NavLink
                            href="#"
                            className={classnames({ active: activeTab === idx })}
                            onClick={() => { toggleTab(idx, mapel?.mata_pelajaran?.id, mapel?.kelas?.id) }}
                        >
                            {mapel?.mata_pelajaran?.name} - {mapel?.tingkat?.name}{mapel?.kelas?.name}
                        </NavLink>
                    </NavItem>
                )
            })}
        </Nav>
        <TabContent>
            <TabPane >
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
                                                <th width={"35%"}>
                                                    Nama Siswa
                                                </th>
                                                <th width={"20%"} className="text-center">
                                                    Progres Modul
                                                </th>
                                                <th width={"20%"} className="text-center">
                                                    Progres Video
                                                </th>
                                                <th width={"20%"} className="text-center">
                                                    Progres Simulasi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {!isLoadingSiswa && dataSiswa?.map((val, idx) => {
                                                return <tr key={idx}>
                                                    <td width={"5%"} className="text-center">
                                                        {idx+1}
                                                    </td>
                                                    <td width={"35%"} className="">
                                                        <a href={`/guru/progress/${mapelIdActive}/detail/${val['id'] ?? '-'}`} target="_blank">
                                                            {val['name'] ?? '-'}
                                                        </a>
                                                    </td>
                                                    <td width={"20%"} className="text-center">
                                                        {val['progress_modul']?.done ?? 0}/{val['progress_modul']?.total ?? 0}
                                                    </td>
                                                    <td width={"20%"} className="text-center">
                                                        {val['progress_video']?.done ?? 0}/{val['progress_video']?.total ?? 0}
                                                    </td>
                                                    <td width={"20%"} className="text-center">
                                                        {val['progress_simulasi']?.done ?? 0}/{val['progress_simulasi']?.total ?? 0}
                                                    </td>
                                                </tr>
                                            })}

                                            {(isLoadingSiswa) &&
                                            <tr>
                                                <td colSpan="5" className="text-center">
                                                    Loading...
                                                </td>
                                            </tr>
                                            }

                                            {(!isLoadingSiswa && dataSiswa.length < 1) &&
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
        </TabContent>
        </>
        }
    </>);
}

export default DetailProgressBelajar;

var container = document.getElementById("progress-detail-guru");

if (container) {
    ReactDOM.render(<DetailProgressBelajar />, container);
}