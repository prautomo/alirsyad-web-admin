import React, { useEffect, useState, useCallback } from 'react';
import ReactDOM from 'react-dom';
import queryString from 'query-string';
import Dropzone, { useDropzone } from 'react-dropzone';
import * as XLSX from 'xlsx';
import { Col, ButtonGroup, Button, Form, FormGroup } from 'react-bootstrap';
import validator from 'validator'
import Swal from 'sweetalert2';

function UploadBatchSiswa() {

    const [queryParams, setQueryParams] = useState({})
    const [params, setParams] = useState({});
    const [excelData, setExcelData] = useState([]);
    const [tingkats, setTingkats] = useState([]);

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
                // load tingkat
                getTingkats()
                // set excel data
                setExcelData(data)
            }
            reader.readAsBinaryString(file)
        })

    }, [])
    const { getRootProps, getInputProps } = useDropzone({ onDrop })


    var doUploadBatch = () => {
        if(excelData.length < 1){
            Swal.fire("Gagal Mengupload", "Data masih kosong!")
            return;
        }
        window.axios.post("/backoffice/external-users/import", { data: excelData, params: params }).then((response) => {
            console.log(response.data.data)
            Swal.fire("Berhasil Mengupload", response.data.message)
        }).catch((err) => {
            Swal.fire("Gagal Mengupload", err.response.data.message)
        })

    }

    // const onUploadSuccess = (index, url) => {
    //     const currentItem = Object.assign({}, excelData[index]);
    //     currentItem.default_image = url
    //     excelData[index] = currentItem
    //     console.log(excelData)
    //     setExcelData(excelData)
    // }

    const onTingkatChange = (index, val) => {
        const currentItem = Object.assign({}, excelData[index]);
        currentItem.G = val;
        excelData[index] = currentItem;
        setExcelData(excelData);
    }

    const onKelasChange = (index, val) => {
        const currentItem = Object.assign({}, excelData[index]);
        currentItem.H = val;
        excelData[index] = currentItem;
        setExcelData(excelData);
    }
      
    const handleRemove = index => () => {
        const rows = [...excelData];
        rows.splice(index, 1);
        setExcelData(rows)

        // use nis
        // let items = excelData.filter(row => row.A != item.A);
        // setExcelData(items);
    };

    var getTingkats = () => {
        window.axios.get("/backoffice/tingkats").then((response) => {
            console.log("dika", response.data)
            setTingkats(response.data.data)
        })
    }

    useEffect(() => {
        let params = queryString.parse(location.search)
        setQueryParams(params)
    }, [excelData])

    return (

        <div className="row gap-20 masonry pos-r">
            <div className="masonry-sizer col-lg-12"></div>
            <div className="masonry-item col-lg-12">
                <div className="bd bgc-white">
                    <div className="layers">
                        <div className="layer w-100 p-20 ">
                            <div {...getRootProps()} style={{
                                border: "1px dashed #dddddd",
                                borderRadius: "5px",
                            }} >
                                <input {...getInputProps()} />
                                <p style={{ textAlign: "center", marginTop: 10 }}>Geser File Excel Ke sini</p>
                            </div>
                        </div>

                        <Col className="mt-2 text-right pr-0">
                            <Button className="btn-info" size="sm" onClick={() => {window.location.href = '/uploads/template_batch_siswa.xlsx'}}>Download Template</Button>{" "}
                            <Button className="btn-secondary" size="sm" onClick={() => {window.location.href = '/backoffice/external-users?role=SISWA'}}>Cancel</Button>{" "}
                            <Button color="primary" size="sm" onClick={doUploadBatch}>Upload Data</Button>
                        </Col>

                        {/* <div className="layer w-100 p-20 mt-2">
                            <h3>Options</h3>
                            <div className="col-md-4 pl-0">
                                <FormGroup>
                                    <Form.Label htmlFor="exampleSelect">Default Password</Form.Label>
                                    <input className="form-control" value="123456" />
                                </FormGroup>
                            </div>
                        </div> */}

                        <div className="layer w-100 p-20 mt-2">
                            <h3>Preview Data</h3>
                            <table className="table table-bordered">
                                <tr>
                                    <th width="15%">
                                        NIS
                                    </th>
                                    <th width="15%">
                                        Name
                                    </th>
                                    <th width="15%">
                                        Username
                                    </th>
                                    <th width="15%">
                                        Email
                                    </th>
                                    <th width="20%">
                                        Tingkat
                                    </th>
                                    <th width="15%">
                                        Kelas
                                    </th>
                                    <th width="5%">
                                        Aksi
                                    </th>
                                </tr>
                                {excelData.map((item, index) => {
                                    // init var
                                    let nisCol = item.A;
                                    let nameCol = item.B;
                                    let usernameCol = item.C;
                                    let emailCol = item.D;
                                    let phoneCol = item.E ? item.E : '-';
                                    let rombonganBelajarCol = item.F ? item.F : '-';
                                    let tingkatCol = item.G;
                                    let kelasCol = item.H;

                                    return <tr key={index}>
                                        <td>
                                            {nisCol}
                                        </td>
                                        <td>
                                            {nameCol}
                                        </td>
                                        <td>
                                            {usernameCol}
                                        </td>
                                        <td>
                                            {emailCol}
                                            {!validator.isEmail(emailCol) && 
                                            <>
                                                <br/>
                                                <small className="text-danger">Email not valid.</small>
                                            </>
                                            }
                                        </td>
                                        <td>
                                            <select className="form-control" onChange={(event) => {
                                                onTingkatChange(index, event.target.value);
                                                // load kelas list
                                            }} disabled>
                                                <option>Pilih Tingkat</option>
                                                {tingkats.map((tingkat) => {
                                                    // // change label to id
                                                    // if(tingkatCol==tingkat.name){
                                                    //     onTingkatChange(index, tingkat.id);
                                                    // }
                                                    return <option value={tingkat.id} selected={tingkatCol==tingkat.id}>{tingkat.name}</option>
                                                })}
                                                {/* if tingkat not found */}
                                                {!Boolean(tingkats.some(tingkat => tingkat.id == tingkatCol)) &&
                                                    <option value={tingkatCol} selected={true}>{tingkatCol}</option>
                                                }
                                            </select>
                                        </td>
                                        <td>
                                            <select className="form-control" onChange={(event) => {
                                                
                                            }} disabled>
                                                <option>{kelasCol}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a onClick={handleRemove(index)} style={{ cursor: "pointer" }}>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                })}

                                {excelData.length === 0 && <tr><td colSpan="7">No data.</td></tr>}
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    );
}

export default UploadBatchSiswa;

if (document.getElementById('uploadsiswa-list')) {

    ReactDOM.render(<UploadBatchSiswa  />, document.getElementById('uploadsiswa-list'));
}