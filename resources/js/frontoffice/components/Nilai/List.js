import React, { useEffect, useState, useRef } from 'react';
import ReactDOM from 'react-dom';
import { Row, Col, Dropdown, DropdownToggle, DropdownMenu, DropdownItem, Button, Card, CardBody } from 'reactstrap';
import Select from 'react-select';
import axios from 'axios';
import { FiMoreVertical } from "react-icons/fi";
import { ReactSketchCanvas } from "react-sketch-canvas";
import useFetch from '../../../store/useFetch';
import "./List.css";
import moment from 'moment';

function NilaiSimulasi() {

    const [isLoadingLeft, setIsLoadingLeft] = useState(false);
    const [isLoadingRight, setIsLoadingRight] = useState(false);
    const [dataProgress, setDataProgress] = useState({});

    var { data, isLoading, isError } = useFetch("/nilai-simulasi/mapels/json")

    useEffect(() => {
        changeMapel(data?.data[0]?.mata_pelajarans[0]?.id)
    }, [])

    async function changeMapel(id){
        setIsLoadingRight(true);

        await axios.get(`/nilai-simulasi/mapels/${id}/json`, { headers: { "Content-Type": "application/json" } }).then(function (response) {
			var data = response.data;

            console.log("dika data", data)
			
			if(data.success){
				setDataProgress(data?.data);
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
                <>
                {dataProgress?.mata_pelajaran && 
                <Card>
                    <CardBody>
                        <h4>Progres Simulasi {dataProgress?.mata_pelajaran ?? "-"}</h4>
                        <div className="d-block w-100">
                            <div className="progress" style={{ height: "1.5rem" }} title="Progress">
                                <div 
                                    className="progress-bar" 
                                    role="progressbar" aria-valuenow={dataProgress?.progress?.percentage ?? 0} 
                                    aria-valuemin="0" aria-valuemax="100" 
                                    style={{ 
                                        width: dataProgress?.progress?.percentage ?? 0+"%",
                                        backgroundColor: "rgb(52, 125, 241)"
                                    }}
                                ></div>
                            </div>
                            <div className="mt-1 font-weight-bold" style={{ fontSize: "1rem" }}>
                                <span>{dataProgress?.progress?.done ?? 0} dari {dataProgress?.progress?.total ?? 0} simulasi selesai</span>
                            </div>
                        </div>
                        <hr/>

                        <div style={{ height: "500px", overflow: "auto" }}>
                            {(dataProgress?.simulasis ?? []).map((simulasi) => {
                                return <Row className="mt-3 mr-0 ml-0" key={simulasi?.id}>
                                <Col md="4">
                                    <img src={simulasi?.cover_url ?? "/images/placeholder.png"} width="100%" height="120px" />
                                </Col>
                                <Col md="8">
                                    <div className="">
                                        <span className={"fa fa-star"+ ( simulasi?.rata_rata_score >= 33 ? " rating-checked" : "")}></span>
                                        <span className={"fa fa-star"+ ( simulasi?.rata_rata_score >= 66 ? " rating-checked" : "")}></span>
                                        <span className={"fa fa-star"+ ( simulasi?.rata_rata_score >= 99 ? " rating-checked" : "")}></span>
                                        <span className="ml-3 pt-1">{simulasi?.rata_rata_score.toFixed(2) ?? 0}/100</span>
                                    </div>
                                    <h6 className="title-nilai-simulasi">
                                        <a href={simulasi?.slug_url ?? "#"}>
                                            {simulasi?.name ?? "-"}
                                        </a>
                                    </h6>
                                    <small>Selesai dikerjakan pada {moment(simulasi?.last_score?.created_at).format("DD MMMM YYYY")}</small>
                                </Col>
                            </Row>;
                            })}    
                        </div>
                    </CardBody>
                </Card>
                }
                </>
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