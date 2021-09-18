import React, { useEffect, useState, useRef } from 'react';
import ReactDOM from 'react-dom';
import { Row, Col, Dropdown, DropdownToggle, DropdownMenu, DropdownItem, Button } from 'reactstrap';
import Select from 'react-select';
import axios from 'axios';
import { FiMoreVertical } from "react-icons/fi";
import { ReactSketchCanvas } from "react-sketch-canvas";
import useFetch from '../../../store/useFetch';
import ToggleSwitch from '../ToggleSwitch/ToggleSwitch';
import { Provider as AlertProvider } from 'react-alert'
import AlertTemplate from 'react-alert-template-basic'
import { useAlert } from 'react-alert'

const styles = {
    border: "0.0625rem solid #9c9c9c",
    borderRadius: "0.25rem",
    opacity: "40%",
};

function ModulDetail({ 
    idModul, 
    linkModul,
    linkVideo,
    linkSimulasi,
}) {

    const canvas = useRef();
    
    const [showCanvas, setShowCanvas] = useState(false);
    const [dropdownOpen, setDropdownOpen] = useState(false);
    const [warna, setWarna] = useState("black");
    const [disabledBtnDone, setDisabledBtnDone] = useState(false);

    var { data, isLoading, isError } = useFetch("/modul/"+idModul+"/json")

    const toggle = () => setDropdownOpen(prevState => !prevState);

    useEffect(() => {
        console.log("dika idModul", idModul)
        console.log("dika data", data)
    }, [])

    async function finishModul(nextUrl){
        // update history
        await postFlag(idModul)

        // direct to next url
        if(nextUrl){
            window.location.href = nextUrl;
        }
    }

    async function postFlag(idModul){
        const payload = {};

        await axios.post(`/moduls/${idModul}/flag/json`, { payload })
        .then(res => {
            setDisabledBtnDone(true);
            // console.log("dika res post flag", res.data);
            alert.show('Modul berhasil dibaca!', {
                timeout: 3000, // custom timeout just for this one alert
                type: 'success',
                onOpen: () => {
                    
                }, // callback that will be executed after this alert open
                onClose: () => {
                   
                } // callback that will be executed after this alert is removed
            })
        }).catch((e) => {
            setDisabledBtnDone(false);
            console.error("dika res post flag failed", e.response.data)
            alert.show(e.response.data?.message, {
                timeout: 3000, // custom timeout just for this one alert
                type: 'error',
                onOpen: () => {
                    
                }, // callback that will be executed after this alert open
                onClose: () => {
                   
                } // callback that will be executed after this alert is removed
            })
        })
    }

    return (<>
        <Row className="mb-1">
            <Col md="12">
            {!isLoading &&
                <>
                <div className="text-left form-inline">
                    <h3>{data?.data?.name ?? '-'}</h3>
                    <div id="toggle" className="ml-auto form-inline">
                        <ToggleSwitch 
                            id="showCanvas"
                            small
                            checked={showCanvas}
                            onChange={setShowCanvas}
                        />

                        <Dropdown isOpen={dropdownOpen} toggle={toggle} size="sm" className="btn-outline" direction="left">
                            <DropdownToggle style={{
                                background: "none",
                                color: "#000000",
                                borderColor: "#ffffff"
                            }}>
                                <FiMoreVertical size="15" />
                            </DropdownToggle>
                            <DropdownMenu>
                                <DropdownItem>
                                    <a href={linkModul}>
                                        Modul Pembelajaran
                                    </a>
                                </DropdownItem>
                                <DropdownItem>
                                    <a href={linkVideo}>
                                        Video Pembelajaran
                                    </a>
                                </DropdownItem>
                                <DropdownItem>
                                    <a href={linkSimulasi}>
                                        Simulasi Pembelajaran
                                    </a>
                                </DropdownItem>
                            </DropdownMenu>
                        </Dropdown>
                    </div>
                </div>
                <hr/>
                </>
            }
            </Col>
        </Row>
        {isLoading ? 
            <p>Loading...</p>
        :
        <>
            {/* <p>{ JSON.stringify(data) }</p> */}

            {showCanvas &&
            <div id="layer-coret" style={{ position: "absolute", paddingRight: "12px" }}>
                <Button
                    onClick={() => {
                        canvas.current.clearCanvas();
                    }}
                    className="btn-main mr-2 btn-small"
                >
                    Clear
                </Button>
                <Button
                    onClick={() => {
                        canvas.current.undo();
                    }}
                    className="btn-main mr-2 btn-small"
                >
                    Undo
                </Button>
                <Button
                    onClick={() => {
                        canvas.current.redo();
                    }}
                    className="btn-main mr-2 btn-small"
                >
                    Redo
                </Button>
                <Button
                    onClick={() => {
                        setWarna("red");
                    }}
                    className="btn-main mr-2 btn-small"
                >
                    Red
                </Button>
                <Button
                    onClick={() => {
                        setWarna("black");
                    }}
                    className="btn-main mr-2 btn-small"
                >
                    Black
                </Button>
                <ReactSketchCanvas
                    ref={canvas}
                    style={styles}
                    width="100%"
                    height="800px"
                    strokeWidth={3}
                    strokeColor={warna}
                />
            </div>
            }
            
            <div style={{overflowX:'auto',height:'100%'}}>
                <object data={data?.data?.pdf_url} type="application/pdf" width="100%" height="800px"></object>
            </div>

            {data?.data?.next?.url ?
            <Button className="mt-4 btn-main" onClick={() => finishModul(data?.data?.next?.url)}>Modul Berikutnya</Button>
            :
            <Button className="mt-4 btn-main" 
                disabled={data?.data?.read || disabledBtnDone}
                onClick={() => finishModul()}>Selesai Membaca</Button>
            }
        </>
        }
    </>);
}

export default ModulDetail;

const options = {
    position: 'bottom right',
    timeout: 3000,
    offset: '30px',
    transition: 'scale'
}

const RootVideoDetail = (props) => {
    return (
    <AlertProvider template={AlertTemplate} {...options}>
        <ModulDetail 
            idModul={props?.idModul}
            linkModul={props?.linkModul}
            linkVideo={props?.linkVideo}
            linkSimulasi={props?.linkSimulasi}
        />
    </AlertProvider>
    )
}

var container = document.getElementById("modul-detail-fe");

if (container) {
    var idModul = container.getAttribute("modul-id");
    var linkModul = container.getAttribute("link-modul");
    var linkVideo = container.getAttribute("link-video");
    var linkSimulasi = container.getAttribute("link-simulasi");

    ReactDOM.render(<RootVideoDetail 
        idModul={idModul} 
        linkModul={linkModul} 
        linkVideo={linkVideo} 
        linkSimulasi={linkSimulasi} 
    />, container);
}