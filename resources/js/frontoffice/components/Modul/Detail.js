import React, { useEffect, useState, useRef } from 'react';
import ReactDOM from 'react-dom';
import { Row, Col, Dropdown, DropdownToggle, DropdownMenu, DropdownItem, Button } from 'reactstrap';
import Select from 'react-select';
import axios from 'axios';
import { FiMoreVertical } from "react-icons/fi";
import { ReactSketchCanvas } from "react-sketch-canvas";
import useFetch from '../../../store/useFetch';
import ToggleSwitch from '../ToggleSwitch/ToggleSwitch';

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

    var { data, isLoading, isError } = useFetch("/modul/"+idModul+"/json")

    const toggle = () => setDropdownOpen(prevState => !prevState);

    useEffect(() => {
        console.log("dika idModul", idModul)
        console.log("dika data", data)
    }, [])

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
                <ReactSketchCanvas
                    ref={canvas}
                    style={styles}
                    width="100%"
                    height="800px"
                    strokeWidth={3}
                    strokeColor="black"
                />
            </div>
            }
            
            <div style={{overflowX:'auto',height:'100%'}}>
                <object data={data?.data?.pdf_url} type="application/pdf" width="100%" height="800px"></object>
            </div>
        </>
        }
    </>);
}

export default ModulDetail;

var container = document.getElementById("modul-detail-fe");

if (container) {
    var idModul = container.getAttribute("modul-id");
    var linkModul = container.getAttribute("link-modul");
    var linkVideo = container.getAttribute("link-video");
    var linkSimulasi = container.getAttribute("link-simulasi");

    ReactDOM.render(<ModulDetail 
        idModul={idModul} 
        linkModul={linkModul} 
        linkVideo={linkVideo} 
        linkSimulasi={linkSimulasi} 
    />, container);
}