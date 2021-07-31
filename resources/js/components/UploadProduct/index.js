import React, { useEffect, useState, useCallback } from 'react';
import ReactDOM from 'react-dom';
import queryString from 'query-string';
import Dropzone, { useDropzone } from 'react-dropzone';
import * as XLSX from 'xlsx';
import Uploader from './Uploader';
import { Col, ButtonGroup, Button, Form, FormGroup } from 'react-bootstrap';
import Swal from 'sweetalert2';

function UploadProduk() {

    const [mitras, setMitras] = useState([])
    const [queryParams, setQueryParams] = useState({})

    const [excelData, setexcelData] = useState([]);
    const [selectedMitra, setselectedMitra] = useState();

    const onDrop = useCallback((acceptedFiles) => {
        acceptedFiles.forEach((file) => {
            const reader = new FileReader()

            reader.onabort = () => console.log('file reading was aborted')
            reader.onerror = () => console.log('file reading has failed')
            reader.onload = () => {
                // Do whatever you want with the file contents
                // const binaryStr = reader.result
                // console.log(binaryStr)
                /* Parse data */
                const bstr = reader.result;
                const wb = XLSX.read(bstr, { type: 'binary' });
                /* Get first worksheet */
                const wsname = wb.SheetNames[0];
                const ws = wb.Sheets[wsname];
                /* Convert array of arrays */
                const data = XLSX.utils.sheet_to_json(ws, { header: "A" });
                /* Update state */
                data.splice(0, 1)
                console.log("Data>>>", data)
                setexcelData(data)
            }
            reader.readAsBinaryString(file)
        })

    }, [])
    const { getRootProps, getInputProps } = useDropzone({ onDrop })


    var getData = () => {
        window.axios.get("/backoffice/mitras").then((response) => {
            setMitras(response.data.data)
        })

    }
    var doUploadBatch = () => {
        window.axios.post("/backoffice/batchproductmitra/upload", { data: excelData, mitra_id: selectedMitra }).then((response) => {
            console.log(response.data.data)
            Swal.fire("Berhasil Mengupload", response.data.message)
        }).catch((err) => {
            Swal.fire("Gagal Mengupload", err.response.data.message)
        })

    }

    const onUploadSuccess = (index, url) => {
        const currentItem = Object.assign({}, excelData[index]);
        currentItem.default_image = url
        excelData[index] = currentItem
        console.log(excelData)
        setexcelData(excelData)
    }
    useEffect(() => {
        let params = queryString.parse(location.search)
        setQueryParams(params)
        getData()
    }, [])


    return (

        <div className="row gap-20 masonry pos-r">
            <div className="masonry-sizer col-lg-12"></div>
            <div className="masonry-item col-lg-12">
                <div className="bd bgc-white">
                    <div className="layers">
                        <div className="layer w-100 p-20 ">
                            <FormGroup>
                                <Form.Label htmlFor="exampleSelect">Mitra</Form.Label>
                                <Form.Control as="select" name="select" id="exampleSelect" onChange={(event) => {
                                    console.log(event.target.value)
                                    setselectedMitra(event.target.value)
                                }}>
                                    <option>Pilih Mitra</option>
                                    {mitras.map((item) => {
                                        return <option value={item.id}>{item.name}</option>
                                    })}
                                </Form.Control>
                            </FormGroup>
                            <div {...getRootProps()} style={{
                                border: "1px dashed #dddddd",
                                borderRadius: "5px",
                            }} >
                                <input {...getInputProps()} />
                                <p style={{ textAlign: "center", marginTop: 10 }}>Geser File Excel Ke sini</p>
                            </div>

                        </div>


                        <div className="layer w-100 p-20">

                            <table className="table table-bordered">
                                <tr>
                                    <th>
                                        Product Name
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th>
                                        Price
                                    </th>
                                    <th>
                                        Selling Price
                                    </th>
                                    <th>
                                        Unit
                                    </th>
                                    <th>
                                        Default Image
                                    </th>
                                </tr>
                                {excelData.map((item, index) => {

                                    return <tr>
                                        <td>
                                            {item.A}
                                        </td>
                                        <td>
                                            {item.B}
                                        </td>
                                        <td>
                                            {item.C}
                                        </td>
                                        <td>
                                            {item.D}
                                        </td>
                                        <td>
                                            {item.E}
                                        </td>
                                        <td>
                                            <Uploader index={index} onUploadSuccess={onUploadSuccess} default_image={item.default_image}></Uploader>
                                        </td>
                                    </tr>
                                })}
                            </table>
                        </div>
                        <Col className="mt-2">
                            <ButtonGroup>
                                <Button color="primary" onClick={doUploadBatch}>Upload Data</Button>
                            </ButtonGroup>
                        </Col>
                    </div>
                </div>

            </div>
        </div>
    );
}

export default UploadProduk;

if (document.getElementById('uploadproduk-list')) {

    ReactDOM.render(<UploadProduk  />, document.getElementById('uploadproduk-list'));
}