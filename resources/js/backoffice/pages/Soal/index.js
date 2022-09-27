import React, { useEffect, useState, useCallback } from 'react';
import ReactDOM from 'react-dom';
import queryString from 'query-string';
import { useDropzone } from 'react-dropzone';
import * as XLSX from 'xlsx';
import { Col, Button } from 'react-bootstrap';
import Swal from 'sweetalert2';

function UploadBatchSoal({ id }) {

    const [queryParams, setQueryParams] = useState({})
    const [params, setParams] = useState({});
    const [excelData, setExcelData] = useState([]);

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
        window.axios.post(`/backoffice/paket-soals/${id}/soal/import`, { data: excelData, params: params }).then((response) => {
            console.log(response.data.data)
            // Swal.fire("Berhasil Mengupload", response.data.message)

            Swal.fire({
                title: 'Berhasil Mengupload',
                showDenyButton: false,
                showCancelButton: false,
                confirmButtonText: `OK`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = `/backoffice/paket-soals/${id}/soal`
                }
            })
        }).catch((err) => {
            Swal.fire("Gagal Mengupload", err.response.data.message)
        })

    }

    const handleRemove = index => () => {
        const rows = [...excelData];
        rows.splice(index, 1);
        setExcelData(rows)
    };

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
                        <Col className="mt-2 text-left pl-0">
                            <h3>1. Download Sample Excel</h3>
                            <Button className="btn-info" size="sm" onClick={() => {window.location.href = '/uploads/template_batch_soal.xlsx'}}>Download Template</Button>
                        </Col>

                        <div className="layer w-100 p-20 mt-2">
                            <h3>2. Upload File Excel</h3>
                            <div {...getRootProps()} style={{
                                border: "1px dashed #dddddd",
                                borderRadius: "5px",
                            }} >
                                <input {...getInputProps()} />
                                <p style={{ textAlign: "center", marginTop: 10 }}>Geser File Excel Ke sini</p>
                            </div>
                        </div>

                        <Col className="mt-2 text-left pl-0">
                            <h3>3. Upload Data or Cancel</h3>
                            <Button color="primary" size="sm" onClick={doUploadBatch}>Upload Data</Button>{" "}
                            <Button className="btn-secondary" size="sm" onClick={() => {window.location.href = `/backoffice/paket-soals/${id}/soal`}}>Cancel</Button>
                        </Col>

                        <div className="layer w-100 p-20 mt-2">
                            <h3>Preview Data</h3>
                            <table className="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th width="5%">
                                            No
                                        </th>
                                        <th width="20%">
                                            Soal
                                        </th>
                                        <th width="15%">
                                            Pilihan A
                                        </th>
                                        <th width="15%">
                                            Pilihan B
                                        </th>
                                        <th width="15%">
                                            Pilihan C
                                        </th>
                                        <th width="10%">
                                            Pilihan D
                                        </th>
                                        <th width="10%">
                                            Pilihan E
                                        </th>
                                        <th width="5%">
                                            Jawaban
                                        </th>
                                        <th width="5%">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                {excelData.map((item, index) => {
                                    // init var
                                    let no = item.A;
                                    let soal = item.B;
                                    let pilihanA = item.C;
                                    let pilihanB = item.D;
                                    let pilihanC = item.E;
                                    let pilihanD = item.F;
                                    let pilihanE = item.G ? item.G : '-';
                                    let jawaban = item.H.replace("1", "A").replace("2", "B").replace("3", "C").replace("4", "D").replace("5", "E");

                                    return <tr key={index}>
                                        <td>
                                            {no}
                                        </td>
                                        <td>
                                            {soal}
                                        </td>
                                        <td>
                                            {pilihanA}
                                        </td>
                                        <td>
                                            {pilihanB}
                                        </td>
                                        <td>
                                            {pilihanC}
                                        </td>
                                        <td>
                                            {pilihanD}
                                        </td>
                                        <td>
                                            {pilihanE}
                                        </td>
                                        <td>
                                            {jawaban}
                                        </td>

                                        <td>
                                            <a onClick={handleRemove(index)} style={{ cursor: "pointer" }}>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                })}
                                </tbody>

                                {excelData.length === 0 && <tr><td colSpan="7">No data.</td></tr>}
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    );
}

export default UploadBatchSoal;

var container = document.getElementById("batch-soal");

if (container) {
    var idPaket = container.getAttribute("paket-soal-id");

    ReactDOM.render(<UploadBatchSoal id={idPaket} />, container);
}
