import React, { useEffect, useState, useCallback } from 'react';
import { Input } from 'reactstrap';
import ReactDOM from 'react-dom';
import queryString from 'query-string';
import Dropzone, { useDropzone } from 'react-dropzone';
import * as XLSX from 'xlsx';
import validator from 'validator'
import Swal from 'sweetalert2';
import FormGroupComponents from '../../components/FormGroupComponents';
import SoalComponent from './SoalComponent';
import SoalContextProvider from './SoalContextProvider';

function CreateSoal() {

    const [queryParams, setQueryParams] = useState({})
    const [form, setForm] = useState(null);
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
            // Swal.fire("Berhasil Mengupload", response.data.message)

            Swal.fire({
                title: 'Berhasil Mengupload',
                showDenyButton: false,
                showCancelButton: false,
                confirmButtonText: `OK`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '/backoffice/external-users?role=SISWA'
                } 
            })
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
        <SoalContextProvider
            value={{ form }}
        >
            <div className="row gap-20 masonry pos-r">
                <div className="col col-md-12">
                    <FormGroupComponents label="Modul (*)">
                        <select className='form-control select2-hidden-accessible'>
                            <option value={"adaw"}>Adwa</option>
                        </select>
                    </FormGroupComponents>
                </div>
                <div className="col col-md-12">
                    <FormGroupComponents label="Mata Pelajaran">
                        <select className='form-control select2-hidden-accessible'>
                            <option value={"adaw"}>Adwa</option>
                        </select>
                    </FormGroupComponents>
                </div>
                <div className="col col-md-12">
                    <FormGroupComponents label="Subab">
                        <Input type='number' placeholder='Subab' />
                    </FormGroupComponents>
                </div>
                <div className="col col-md-12">
                    <FormGroupComponents label="Judul Subab">
                        <Input type='text' placeholder='Judul Subab' />
                    </FormGroupComponents>
                </div>
                <div className="col col-md-12">
                    <FormGroupComponents label="Jumlah Publish">
                        <Input type='number' placeholder='Jumlah Publish' />
                    </FormGroupComponents>
                </div>
                <div className="col col-md-12">
                    <FormGroupComponents label="KKM Level Easy">
                        <Input type='number' placeholder='KKM Level Easy' />
                    </FormGroupComponents>
                </div>
                <div className="col col-md-12">
                    <FormGroupComponents label="KKM Level Medium">
                        <Input type='number' placeholder='KKM Level Medium' />
                    </FormGroupComponents>
                </div>
                <div className="col col-md-12">
                    <FormGroupComponents label="KKM Level Hard">
                        <Input type='number' placeholder='KKM Level Hard' />
                    </FormGroupComponents>
                </div>
                <div className="col col-md-12">
                    <FormGroupComponents label="Upload File Soal">
                        <div {...getRootProps()} style={{
                            border: "1px dashed #dddddd",
                            borderRadius: "5px",
                            marginBottom: "10px"
                        }} >
                            <input {...getInputProps()} />
                            <p style={{ textAlign: "center", marginTop: 10 }}>Geser File Excel Ke sini</p>
                        </div>

                        <SoalComponent />
                    </FormGroupComponents>
                </div>
            </div>
        </SoalContextProvider>
    );
}

export default CreateSoal;

if (document.getElementById('create-soal')) {

    ReactDOM.render(<CreateSoal  />, document.getElementById('create-soal'));
}