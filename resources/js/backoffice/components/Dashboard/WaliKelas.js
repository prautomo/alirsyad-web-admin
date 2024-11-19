import React, { useEffect, useState, useCallback } from 'react';
import ReactDOM from 'react-dom';
import "./index.css";
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend,
} from 'chart.js/auto/auto.js';
import ChartDataLabels from 'chartjs-plugin-datalabels';
import { Bar } from 'react-chartjs-2';
import { ThreeCircles } from 'react-loader-spinner'
ChartJS.register(
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend,
    ChartDataLabels
);

export const options = {
    responsive: true,
    plugins: {
        legend: {
            display: false,
        },
        datalabels: {
            display: true,
            align: 'center',
            anchor: 'center',
            color: 'white',
        },
        title: {
            display: false,
        },
        scales: {
            y: {
                ticks: {
                    stepSize: 500,
                },
            },
        },
    },
    onHover: (event, chartElement) => {
        event.native.target.style.cursor = chartElement[0] ? 'pointer' : 'default';
    }
};

function DashboardWaliKelas() {

    const [listConfigData, setListConfigData] = useState([]);
    const [listDatas, setListDatas] = useState([]);
    const [listDataIds, setListDataIds] = useState([]);
    const [nextApi, setNextApi] = useState({});
    const [selectedBarIdx, setSelectedBarIdx] = useState({});
    const [filterLevel, setfilterLevel] = useState([]);
    const [filters, setFilters] = useState({
        mapel: [],
        bab: [],
        subbab: [],
    });
    const [kelasId, setKelasId] = useState(0);
    const [mapelId, setMapelId] = useState(0);
    const [babId, setBabId] = useState(0);
    const [graphicTitle, setGraphicTitle] = useState("");
    const [currentLevel, setCurrentLevel] = useState("");
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        if (listDatas.length < 1) {
            window.axios.post(`/backoffice/json/dashboard/mapel`).then((response) => {
                var data = response.data.data

                var chartData = data.data
                var chartDataId = data.data_id
                var nextApi = data.next_api
                var graphicTitle = data.graphic_title
                var currentLevel = data.level

                options['onClick'] = graphClickEvent

                if(data.kelas_id){
                    setKelasId(data.kelas_id)
                }
    
                if(data.bab_id){
                    setBabId(data.bab_id)
                }
    
                if(data.mapel_id){
                    setMapelId(data.mapel_id)
                }

                setIsLoading(false)
                setGraphicTitle(graphicTitle)
                setCurrentLevel(currentLevel)
                setNextApi(nextApi)
                setListDatas(chartData)
                setListDataIds(chartDataId)
            }).catch((err) => {
                console.log(err)
            })
            
            window.axios.post("/backoffice/json/dashboard/filter/level").then((response) => {
                var data = response.data.data
                setfilterLevel(data)
            }).catch((err) => {
                console.log(err)
            })
        }
    }, []);

    const spanBorderRight = {
        borderLeft: "1px solid #F6D0A1",
        marginLeft: "5px",
        marginRight: "5px"
    }

    function graphClickEvent(event, clickedElements){
        if (clickedElements.length === 0) return
        
        const { dataIndex, raw } = clickedElements[0].element.$context
        const data = event.chart.data
        const barLabel = data.labels[dataIndex]
        const selectedIdx = dataIndex

        setIsLoading(true)
        setSelectedBarIdx({
            label: barLabel,
            idx: selectedIdx,
            isClick: true
        })
    }

    const fetchData = async (endpoint, params, setter, pickerId) => {
        try {
            const response = await window.axios.post(endpoint, params);
            const data = response.data.data;
            setter((prevFilters) => ({
                ...prevFilters,
                [pickerId]: data,
            }));
            $(`#${pickerId}`).selectpicker("refresh");
        } catch (err) {
            console.log(err);
        }
    };

    useEffect(() => {
        const { label } = selectedBarIdx;

        if (label) {
            // issue
            if (filters.mapel.length > 1) {
                const labelParts = label
                const foundMapel = filters.mapel.find((data) => labelParts === data.name);
                if (foundMapel) {
                    fetchData(
                        "/backoffice/json/dashboard/filter/bab",
                        { mapel_id: foundMapel.id },
                        setFilters,
                        "bab"
                    );
                }
            }

            if(filters.bab.length > 1){
                const labelParts = label;
                console.log('labelParts!!!!!!!!!!!!!!!!!!!', labelParts)
                const foundBab = filters.bab.find((data) => labelParts === data.name);
                if (foundBab) {
                    fetchData(
                        "/backoffice/json/dashboard/filter/subbab",
                        { bab_id: foundBab.id },
                        setFilters,
                        "subbab"
                    );
                }
            }
        }
    }, [selectedBarIdx.isClick, filters]);

    useEffect(() => {
        if(filters.mapel.length < 1){

            window.axios.post("/backoffice/json/dashboard/filter/mapel").then((response) => {
                var data = response.data.data
                setFilters({
                    ...filters, 
                    mapel: data
                })

                $("#mapel").selectpicker("refresh");
            }).catch((err) => {
                console.log(err)
            })
        }

    }, []);

    useEffect(() => {
        var selectedId = selectedBarIdx.isClick ? listDataIds[selectedBarIdx.idx] : selectedBarIdx.idx

        if(currentLevel == 'siswa'){
            window.location.href = `/backoffice/e-raport/${selectedId}/${mapelId}`;
            return;
        }

        setIsLoading(true)
        
        var params = {
            [nextApi.param] : selectedId
        }

        if(kelasId != 0){
            params['kelas_id'] = kelasId
        }

        if(babId != 0){
            params['bab_id'] = babId
        }

        window.axios.post(`/backoffice/json/dashboard/${nextApi.name}`, params).then((response) => {
            var data = response.data.data

            options['onClick'] = graphClickEvent

            var chartData = data.data
            var chartDataId = data.data_id
            var graphicTitle = data.graphic_title
            var nextApi = data.next_api
            var currentLevel = data.level

            if(data.kelas_id){
                setKelasId(data.kelas_id)
            }

            if(data.bab_id){
                setBabId(data.bab_id)
            }
        
            if(data.mapel_id){
                setMapelId(data.mapel_id)
            }

            setIsLoading(false)
            setGraphicTitle(graphicTitle)
            setCurrentLevel(currentLevel)
            setNextApi(nextApi)
            setListDataIds(chartDataId)
            setListDatas(chartData)
        }).catch((err) => {
            console.log(err)
        })
    }, [selectedBarIdx]);

    useEffect(() => {
        const listConfig = [];
        for (let i=0; i<listDatas.length; i++) {
            const labels = [];
            const tempScores = [];

            listDatas[i].forEach(element => {
                const data = element;
                labels.push(data.label);
                tempScores.push(data.score);
            });
            
            var objConfig = {
                labels,
                datasets: [
                    {
                        label: 'Score',
                        data: tempScores,
                        backgroundColor: "rgba(2, 65, 2, 1)",
                        borderRadius: 10,
                        minBarLength: 1,
                        // barThickness: 120,
                    }
                ]
            }

            listConfig.push(objConfig)
        }
        console.log('listConfig', listConfig)

        setListConfigData(listConfig);
    }, [listDatas]);

    const handleChange = (e) => {
        var getLevel = filterLevel.filter(function (el) {
            return el.option == e.target.id
        });
        
        if(getLevel.length == 0){
            return;
        }

        var level = getLevel[0]
        setNextApi(level.next_api)

        var params = {
            [level.next_api.param] : e.target.value
        }
        
        if(kelasId != 0){
            params['kelas_id'] = kelasId
        }

        window.axios.post(`/backoffice/json/dashboard/filter/${level.next_api.name}`, params).then((response) => {
            var data = response.data.data

            setFilters({
                ...filters, 
                [level.next_api.name]: data
            })

            $(`#${level.next_api.name}`).selectpicker("refresh");
        }).catch((err) => {
            console.log(err)
        })

        setIsLoading(true)
        setSelectedBarIdx({
            label: e.target.id,
            idx: e.target.value,
            isClick: false
        })
    }
    
    return (<>
        <div className="row mb-4">
            <div className="col-12">
                <div style={{ display: 'flex', alignItems: 'center'}}>
                    <div style={{ marginLeft: 'auto' }} className="dashboard-filter">
                        <label className="my-auto mr-2" style={{ color: "#9E9E9E"}}>Filter By</label>
                        <select id="mapel" name="mapel" data-style="btn-green-pastel" className="selectpicker mr-2" placeholder="Mata Pelajaran" onChange={handleChange}>
                            <option value="">Semua Mata Pelajaran</option>
                            {filters.mapel.length > 0 && filters.mapel.map((data) => (
                                <option value={data.id}>{data.name}</option>
                            ))}
                        </select>
                        <select id="bab" name="bab" data-style="btn-green-pastel" className="selectpicker mr-2" placeholder="Module" onChange={handleChange}>
                            <option value="">Semua Module</option>
                            {filters.bab.length > 0 && filters.bab.map((data) => (
                                <option value={data.id}>{data.name}</option>
                            ))}
                        </select>
                        <select id="subbab" name="subbab" data-style="btn-green-pastel" className="selectpicker mr-2" placeholder="Sub-Module" onChange={handleChange}>
                            <option value="">Semua Sub-Module</option>
                            {filters.subbab.length > 0 && filters.subbab.map((data) => (
                                <option value={data.id}>{data.name}</option>
                            ))}
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {!isLoading ? (
            listConfigData && listConfigData.map((data, idxData) => (
                <div className="row">
                    <div className="col-12">
                        <div className="card">
                            <div className="card-body">
                                <div style={{ display: 'flex', alignItems: 'center' }} className="mb-3">
                                    <h2 className="text-primary"><b>{graphicTitle}</b></h2>
    
                                    <div className="dashboard-final-score" style={{ marginLeft: 'auto' }}>
                                        {data.datasets[0].data.length < 15 && data.datasets[0].data.map((value, idx) => (
                                            <>
                                                <span>{data.labels[idx]} : <b>{value}</b></span>
                                                <span style={spanBorderRight}></span>
                                            </>
                                        ))}
                                    </div>
                                </div>
    
                                <Bar options={options} data={data} />
                            </div>
                        </div>
                    </div>
                </div>  
            ))    
        ) : (
            <div className="row" style={{ height: '70vh', width:'100%' }}>
                <div className="col-12 d-flex justify-content-center align-items-center" style={{ flexDirection: 'column' }}>
                    <ThreeCircles
                        visible={true}
                        height="100"
                        width="100"
                        color="#024102"
                        ariaLabel="three-circles-loading"
                        wrapperStyle={{}}
                        wrapperClass=""
                    />
                    <h2 className="mt-2">Mohon tunggu...</h2>
                </div>
            </div>  
        )}
             
    </>);
}

export default DashboardWaliKelas;

if (document.getElementById('dashboard-wali-kelas')) {
    ReactDOM.render(<DashboardWaliKelas  />, document.getElementById('dashboard-wali-kelas'));
}