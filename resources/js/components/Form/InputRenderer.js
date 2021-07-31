import React, { useCallback, useEffect, useState } from 'react'
import { Button, Form } from 'react-bootstrap'
import classNames from 'classnames'
import 'react-dates/initialize';
import { SingleDatePicker } from 'react-dates';
import { random } from 'lodash';
import MapPicker from 'react-google-map-picker'
import { Modal } from 'react-bootstrap';
import useLocationStore from '../../store/LocationStore';
import Swal from 'sweetalert2';
import { useDropzone } from 'react-dropzone';



function InputWithLabel({ label, onChange, value, type = "text", appendix, placeholder, required = true }) {
    return (<>
        <div class="mb-3">
            {label ? <label for="exampleFormControlInput1 form-control-label" class="form-label">{label}</label> : ""}
            <div className="form-control-container">
                {appendix && <span>{appendix}</span>}

                <Form.Control required={true} value={value} placeholder={placeholder} onChange={(e) => {

                    onChange(e.target.value)
                }} className="form-control form-control-inner form-control-lg " type={type} />

                <Form.Control.Feedback type="invalid">
                    Silahkan Isi {label}
                </Form.Control.Feedback>
            </div>
        </div>

    </>)
}


function InputTextAreaWithLabel({ label, onChange, value, type, items, placeholder }) {
    return (<>
        <div class="mb-3">
            <label for="exampleFormControlInput1 form-control-label" class="form-label">{label}</label>
            <div className="form-control-container">
                <Form.Control value={value} onChange={(e) => {
                    onChange(e.target.value)
                }} className="form-control form-control-inner form-control-lg " as="textarea" />
            </div>
        </div>

    </>)
}
function InputSelectWithLabel({ label, onChange, value, type, items, appendix, placeholder }) {
    return (<>
        <div class="mb-3">
            <label for="exampleFormControlInput1 form-control-label" class="form-label">{label}</label>
            <div className="form-control-container">
                {appendix && <span>{appendix}</span>}
                {/* {JSON.stringify(items)} */}
                <Form.Control value={value} onChange={(e) => {
                    onChange(e.target.value)
                }} className="form-control form-control-inner form-control-lg " as="select">
                    <option>
                        -- Pilih --
                    </option>
                    {items && items.map((item) => {
                        return <option value={item.id}>
                            {item.name}
                        </option>
                    })}
                </Form.Control>
            </div>
        </div>

    </>)
}

function InputChooseWithLabel({ label, onChange, value, type, items, placeholder }) {
    return (<>
        <div class="">
            <label for="exampleFormControlInput1 form-control-label" class="form-label">{label}</label>
            <div className="form-control-container d-flex flex-column  border-none mt-0">
                {/* {JSON.stringify(items)} */}
                {Object.keys(items).map((item, index) => {
                    return <>

                        <div className="d-flex align-items-center" onClick={() => {
                            onChange(item)
                        }}>
                            <div className={classNames("radioitem", {
                                'active': item == value
                            })}></div>
                            <span>{items[item]}</span>
                        </div>
                    </>
                })}
            </div>
        </div>

    </>)
}

function InputCheckWithLabel({ label, onChange, value, type, items, placeholder }) {
    return (<>
        <div class="">{label &&
            <label for="exampleFormControlInput1 form-control-label" class="form-label">{label}</label>}
            <div className="form-control-container d-flex flex-column border-none mt-0">
                {/* {JSON.stringify(items)} */}
                {Object.keys(items).map((item, index) => {
                    return <>


                        <div className="d-flex align-items-center" onClick={
                            () => {

                                onChange(value == null ? item : null)
                            }
                        }>
                            <div className={classNames("checkitem", {
                                'active': value != null
                            })}></div>
                            <span>{items[item]}</span>
                        </div>
                    </>
                })}
            </div>
        </div>

    </>)
}




function InputDatePickerWithLabel({ label, onChange, value, type, appendix, placeholder }) {
    const [focused, setFocused] = useState(false);
    return (<>
        <div class="mb-3">
            <label for="exampleFormControlInput1 form-control-label" class="form-label">{label}</label>
            <div className="form-control-container">
                {appendix && <span>{appendix}</span>}
                <SingleDatePicker
                    date={value} // momentPropTypes.momentObj or null
                    onDateChange={date => onChange(date)} // PropTypes.func.isRequired
                    focused={focused} // PropTypes.bool
                    onFocusChange={({ focused }) => setFocused(focused)} // PropTypes.func.isRequired
                    id={random()} // PropTypes.string.isRequired,
                />
            </div>
        </div>

    </>)
}



function InputMapPickerWithLabel({ label, onChange, value, type, desc, appendix, placeholder }) {
    var DefaultZoom = 10;


    const [focused, setFocused] = useState(true);
    var { latitude, longitude } = useLocationStore()
    const [location, setLocation] = useState({ ...{ latitude, longitude } });
    const [zoom, setZoom] = useState(DefaultZoom);
    function handleChangeLocation(lat, lng) {
        setLocation({ lat: lat, lng: lng });
    }

    function handleChangeZoom(newZoom) {
        setZoom(newZoom);
    }

    const [showModal, setShowModal] = useState(false);
    return (<>
        <div class="mb-3">
            <label for="exampleFormControlInput1 form-control-label" class="form-label">{label}</label>
            <div className="form-control-container">
                {appendix && <span>{appendix}</span>}
                <div className="form-control form-control-inner form-control-lg" onClick={() => {
                    setShowModal(true)
                }}>
                    {value}
                </div>


                <Modal

                    show={showModal}
                    onHide={() => setShowModal(false)}>


                    <Modal.Header closeButton>
                        <Modal.Title id="example-modal-sizes-title-sm">
                            Pilih Lokasi
                        </Modal.Title>
                    </Modal.Header>
                    <Modal.Body>

                        <MapPicker defaultLocation={{ latitude, longitude }}
                            zoom={zoom}
                            style={{ height: '500px', borderRadius: '4px' }}
                            onChangeLocation={handleChangeLocation}
                            onChangeZoom={handleChangeZoom}
                            apiKey='AIzaSyD07E1VvpsN_0FvsmKAj4nK9GnLq-9jtj8' />
                    </Modal.Body>

                    <Modal.Footer>
                        <Button className="btn btn-danger" onClick={() => {
                            if (location.lat == null || location.lng == null) {
                                Swal.fire("Lokasi", " Silahkan Pilih Lokasi  Di Map", 'warning')
                            } else {

                                onChange(location)
                            }
                            setShowModal(false)
                        }}>Pilih</Button>
                    </Modal.Footer>

                </Modal>

            </div>

            {desc}
        </div>

    </>)
}


function InputModalSelectorWithLabel({ label, onChange, value, type, desc, appendix, placeholder, items, itemRenderer }) {
    var DefaultZoom = 10;


    const [tempSelected, setTempSelected] = useState({});
    const [showModal, setShowModal] = useState(false);
    return (<>
        <div class="mb-3">
            <label for="exampleFormControlInput1 form-control-label" class="form-label">{label}</label>
            <div className="form-control-container">
                {appendix && <span>{appendix}</span>}
                <div className={classNames("form-control form-control-inner form-control-lg", {
                    "text-muted": value == ""
                })} onClick={() => {
                    setShowModal(true)
                }}>
                    {value ? value.name : placeholder}
                </div>


                <Modal

                    show={showModal}
                    onHide={() => setShowModal(false)}>


                    <Modal.Header closeButton>
                        <Modal.Title id="example-modal-sizes-title-sm">
                            Pilih
                        </Modal.Title>
                    </Modal.Header>
                    <Modal.Body style={{ height: '60vh', overflowY: 'scroll' }}>

                        {items && items.map((currentItem, currentIndex) => {
                            return itemRenderer(currentItem, currentIndex, tempSelected, setTempSelected)
                        })}

                    </Modal.Body>
                    <Modal.Footer>
                        <Button className="btn btn-danger" onClick={() => {
                            onChange(tempSelected)
                            setShowModal(false)
                        }}>Pilih</Button>
                    </Modal.Footer>

                </Modal>

            </div>

            {desc}
        </div>

    </>)
}



function ImagePickerWithLabel({ label, onChange, value, type, items, removeItem, placeholder, single = true }) {
    const [initialSet, setInitialSet] = useState(false);
    const [uploadState, setUploadState] = useState("");



    function actionRemoveItem(index) {
        let tmp = [...items]
        tmp.splice(index, 1)
        console.log(tmp)

        if (single) {
            removeItem(tmp.length > 0 ? tmp[0] : null)
        } else {
            removeItem(tmp)
        }
    }
    function addItems(base) {

    }
    function uploadImage(base) {
        onChange({ image_url: base })

    }
    return (<>
        <div class="mb-3">
            <label for="exampleFormControlInput1 form-control-label" class="form-label">{label}</label>
            <div className="form-control-container mb-2">
                <div className={classNames("form-control form-control-inner form-control-lg", {
                    "text-muted": value == ""
                })} onClick={() => {

                }}>
                    <div className="d-flex flex-column">
                        <div>

                            <MyDropzone onItemSelected={uploadImage} >

                            </MyDropzone>

                        </div>

                    </div>
                </div>
            </div>
            <div className="row">
                {items && items.map((item, index) => {
                    return <div className="col-lg-3 p-3 " >
                        <div style={{ position: 'absolute', top: 10, right: 10 }}>
                            <button className="btn btn-danger btn-sm" onClick={() => {
                                Swal.fire({
                                    title: "Galery",
                                    text: "Apa Anda Yakin Ingin Menghapus Gambar",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Ya'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        actionRemoveItem(index)
                                    }
                                })
                            }}><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </div>
                        <img src={item?.image_url} className="img-fluid" alt="" />
                    </div>
                })}
            </div>
        </div>

    </>)
}

function MyDropzone({ onItemSelected, }) {
    const [uploadState, setUploadState] = useState(null);
    const onDrop = (acceptedFiles) => {
        acceptedFiles.forEach((file) => {
            const reader = new FileReader()

            reader.onabort = () => console.log('file reading was aborted')
            reader.onerror = () => console.log('file reading has failed')
            reader.onload = () => {
                // Do whatever you want with the file contents

                const binaryStr = reader.result
                setUploadState("Uploading.");

                window.axios.post("/app/image/upload", {
                    base_image: binaryStr
                }).then(function (data) {
                    onItemSelected(data.data.image_url)
                }).catch((err) => {
                    console.log(err)
                    Swal.fire("Upload", err.response.data.data.message)
                }).finally(() => {
                    setUploadState("Finished.");
                })
            }
            reader.readAsDataURL(file)
        })

    }
    const { getRootProps, getInputProps } = useDropzone({ onDrop })

    return (
        <div {...getRootProps()}>
            <input {...getInputProps()} />
            <p>{uploadState ? uploadState : "Drag 'n' drop some files here, or click to select files"}</p>
        </div>
    )
}






export {
    InputWithLabel,
    InputSelectWithLabel,
    InputTextAreaWithLabel,
    InputChooseWithLabel,
    InputCheckWithLabel,
    InputDatePickerWithLabel,
    InputMapPickerWithLabel,
    InputModalSelectorWithLabel,
    ImagePickerWithLabel,

}