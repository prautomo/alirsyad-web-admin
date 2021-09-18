import React, { useEffect, useState, useRef } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import TableScrollbar from 'react-table-scrollbar';
import useFetch from '../../../store/useFetch';
import { TabContent, TabPane, Nav, NavItem, NavLink, Card, Button, CardTitle, CardText, Row, Col, CardBody } from 'reactstrap';
import classnames from 'classnames';

function DetailProgressBelajar({ }) {

    const [activeTab, setActiveTab] = useState(-1);
    const [isLoadingSiswa, setIsLoadingSiswa] = useState(false);
    const [dataSiswa, setDataSiswa] = useState([]);

    const { data, isLoading, isError } = useFetch("/guru/json/ngajar")

    const toggleTab = async (tab, mapelId, kelasId) => {
        // load data
        console.log("dika mapelId", mapelId);
        console.log("dika kelasId", kelasId);
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
        <Nav tabs>
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
                                                        {val['name'] ?? '-'}
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

                                            {(dataSiswa.length < 1) &&
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