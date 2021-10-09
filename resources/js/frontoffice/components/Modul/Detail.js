import React, { useEffect, useState, useRef } from 'react';
import ReactDOM from 'react-dom';
import { Row, Col, Dropdown, DropdownToggle, DropdownMenu, DropdownItem, Button } from 'reactstrap';
import Select from 'react-select';
import { PDFReader, MobilePDFReader } from 'reactjs-pdf-reader';
import axios from 'axios';
import { FiMoreVertical } from "react-icons/fi";
import { ReactSketchCanvas } from "react-sketch-canvas";
import useFetch from '../../../store/useFetch';
import ToggleSwitch from '../ToggleSwitch/ToggleSwitch';
import { Provider as AlertProvider } from 'react-alert'
import AlertTemplate from 'react-alert-template-basic'
import { useAlert } from 'react-alert';
import { ColorPicker, useColor } from "react-color-palette";
import "react-color-palette/lib/css/styles.css";
import { PhotoshopPicker, SketchPicker } from 'react-color';
import reactCSS from 'reactcss'
import "./Detail.css";

const styles = {
    border: "0.0625rem solid #9c9c9c",
    borderRadius: "0.25rem",
    opacity: "40%",
    marginTop: "10px",
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
    const [warna, setWarna] = useState("#000000");
    const [warnaTemp, setWarnaTemp] = useState("#000000");
    const [disabledBtnDone, setDisabledBtnDone] = useState(false);
    const [path, setPath] = useState([]);
    const [showColor, setShowColor] = useState(false);
    const [color, setColor] = useColor("hex", "#121212");

    const { data, isLoading, isError } = useFetch("/modul/"+idModul+"/json")
    const alert = useAlert()

    const toggle = () => setDropdownOpen(prevState => !prevState);

    useEffect(() => {
        console.log("dika idModul", idModul)
    }, [])

    async function finishModul(nextUrl){
        console.log("dika nextUrl", nextUrl)
        // update history
        await postFlag(idModul)

        // direct to next url
        if(nextUrl){
            setTimeout(function(){ window.location.href = nextUrl; }, 3000);
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
            console.error("dika res post flag failed", e?.response)
            alert.show(e?.response.data?.message, {
                timeout: 3000, // custom timeout just for this one alert
                type: 'error',
                onOpen: () => {
                    
                }, // callback that will be executed after this alert open
                onClose: () => {
                   
                } // callback that will be executed after this alert is removed
            })
        })
    }

    async function savePath(){
        let a = await canvas?.current?.exportPaths();
        setPath(a);
    }

    function loadPath(){
        canvas?.current?.loadPaths(path);
    }

    return (<>
        <Row className="mb-1">
            <Col md="12">
            {!isLoading &&
                <>
                <div className="text-left form-inline">
                    <h3>{data?.data?.name ?? '-'}</h3>
                    <div id="toggle" className="ml-auto form-inline">
                        {/* <Button className="btn-main btn-small mr-2" href={linkModul}>
                            Kembali ke List
                        </Button> */}

                        <ToggleSwitch 
                            id="showCanvas"
                            small
                            checked={showCanvas}
                            onChange={() => {
                                setShowCanvas(!showCanvas)
                                if(showCanvas){
                                    loadPath()
                                }else{
                                    savePath()
                                }
                            }}
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
            <Row className="mb-1">
            <Col md="12">

            {showCanvas &&
            <>
            <div id="layer-coret" style={{ position: "absolute", paddingRight: "25px", width: "100%" }}>
                {/*  */}
                {/* <SketchPicker color={ warna } onChange={(color) => setWarna(color.hex)} /> */}
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

                {/*  */}
                <ReactSketchCanvas
                    ref={canvas}
                    style={styles}
                    width="100%"
                    height="800px"
                    strokeWidth={3}
                    strokeColor={warna}
                />
            </div>
            </>
            }
            
            <div style={{overflowX:'auto', height:'100%', marginTop: (showCanvas ? "50px" : "0px")}}>
                {/* <iframe src={"/frontoffice/plugins/pdfviewer/#"+data?.data?.pdf_url} width='100%' height='800px' allowfullscreen webkitallowfullscreen></iframe>  */}
                {/* <object data={data?.data?.pdf_url} type="text/html" width="100%" height="800px"></object> */}

                {/* 
                    Google Docs
                    Pro:
                    - Works on desktop and mobile browser
                    Cons:
                    - 25MB file limit
                    - Requires additional time to download viewer
                */}
                <iframe src={"https://docs.google.com/gview?url="+data?.data?.pdf_url+"?hsLang=en&embedded=true"} style={{ width: "100%", height: "800px" }} frameBorder="0"></iframe>

            </div>

            {/* <div style={{overflowX:'auto', height:'100%', maxHeight:'800px'}}>
                <PDFReader url={data?.data?.pdf_url} width={770} showAllPage={true} isShowHeader={true} isShowFooter={true} hideNavbar={false} />
            </div> */}

            {(data?.data?.previous?.url) &&
            <Button className="mt-1 btn-main btn-small mr-4" href={data?.data?.previous?.slug_url}>Modul Sebelumnya</Button>
            }

            {data?.data?.next?.url ?
            <Button className="mt-1 btn-main btn-small" onClick={() => finishModul(data?.data?.next?.slug_url)}>Modul Berikutnya</Button>
            :
            <Button className="mt-1 btn-main btn-small" 
                disabled={data?.data?.read || disabledBtnDone}
                onClick={() => finishModul()}>Selesai Membaca</Button>
            }

            </Col>
            </Row>
        </>
        }

        {(showCanvas && false)&&
        <div className="layer-toolbox">
            <Button
                onClick={() => {
                    canvas.current.undo();
                }}
                className="btn-main mr-2 btn-small mb-2"
            >
                Undo
            </Button>
            <Button
                onClick={() => {
                    canvas.current.clearCanvas();
                }}
                className="btn-main mr-2 btn-small mb-2"
            >
                Clear
            </Button>
            {/* <Button
                onClick={() => {
                    setShowColor(!showColor)
                }}
                className="btn-main mr-2 btn-small mb-2"
            >
                Change Color
            </Button> */}
            <Button
                onClick={() => {
                    setWarna("red")
                }}
                className="btn-main mr-2 btn-small mb-2"
            >
                Pen Red
            </Button>
            <Button
                onClick={() => {
                    setWarna("black")
                }}
                className="btn-main mr-2 btn-small mb-2"
            >
                Pen Black
            </Button>
            {/* <div style={ {
                marginRight: '.5rem !important',
                padding: '5px',
                background: '#fff',
                borderRadius: '1px',
                boxShadow: '0 0 0 1px rgba(0,0,0,.1)',
                display: 'inline-block',
                cursor: 'pointer',
            } } onClick={ () => setShowColor(!showColor) }>
                    <div style={ {
                        width: '36px',
                        height: '14px',
                        borderRadius: '2px',
                        background: `${ warna }`,
                    } } />
            </div> */}
            <Button
                onClick={() => {
                    canvas.current.redo();
                }}
                className="btn-main mr-2 btn-small mb-2"
            >
                Redo
            </Button>
{/* 
            <SketchPicker color={ warna } onChange={(color) => setWarna(color.hex)} /> */}

            {showColor &&
            <PhotoshopPicker
                className="mr-auto ml-auto"
                color={ warnaTemp }
                onChange={(color) => setWarnaTemp(color.hex)}
                onChangeComplete={(color) => {
                    setWarnaTemp(color.hex)
                }}
                onAccept={() => {
                    setWarna(warnaTemp)
                    setShowColor(!showColor)
                }}
                onCancel={() => {
                    setWarnaTemp(warna)
                    setShowColor(!showColor)
                }}
            />
            }
        </div>
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