import React, { useEffect, useState } from 'react';
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
            // formatter: function(value){
            //     return value + '%';
            // },
            // font: {
            //     size: 3,
            // }      
        },
        title: {
            display: false,
        },
        scales: {
            y: {
                ticks: {
                    stepSize: 500,
                },
            }
        },

    },
    onHover: (event, chartElement) => {
        event.native.target.style.cursor = chartElement[0] ? 'pointer' : 'default';
    }
};

function DashboardSuperadmin() {
    const [listConfigData, setListConfigData] = useState([]);
    const [listDatas, setListDatas] = useState([]);
    const [listDataIds, setListDataIds] = useState([]);
    const [nextApi, setNextApi] = useState({});
    const [selectedBarIdx, setSelectedBarIdx] = useState({});
    const [filterLevel, setfilterLevel] = useState([]);
    const [filters, setFilters] = useState({
        jenjang: [],
        tingkat: [],
        kelas: [],
        mapel: [],
        bab: [],
        subbab: [],
    });
    const [kelasId, setKelasId] = useState(0);
    const [mapelId, setMapelId] = useState(0);
    const [babId, setBabId] = useState(0);
    const [tahunAjaran, setTahunAjaran] = useState([]);
    const [graphicTitle, setGraphicTitle] = useState("");
    const [currentLevel, setCurrentLevel] = useState("");
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        if (listDatas?.length < 1) {
            getDataJenjang()
        }
    }, []);

    const spanBorderRight = {
        borderLeft: "1px solid #F6D0A1",
        marginLeft: "5px",
        marginRight: "5px"
    }

    function graphClickEvent(event, clickedElements) {
        if (clickedElements.length === 0) return

        const { dataIndex, raw } = clickedElements[0].element.$context
        const data = event.chart.data
        const barLabel = data.labels[dataIndex]
        const selectedIdx = dataIndex

        setSelectedBarIdx({
            label: barLabel,
            idx: selectedIdx,
            isClick: true
        })
    }

    useEffect(() => {
        const fetchData = async () => {
            try {
                if (currentLevel === 'tingkat') {
                    const foundJenjang = filters.jenjang.find((data) => selectedBarIdx.label === data.name);
                    if (foundJenjang) {
                        const response = await window.axios.post("/backoffice/json/dashboard/filter/tingkat", { jenjang_id: foundJenjang.id });
                        const data = response.data.data;
                        setFilters((prevFilters) => ({
                            ...prevFilters,
                            tingkat: data,
                        }));
                        $("#tingkat").selectpicker("refresh");
                    } else {
                        console.log("Jenjang tidak ditemukan");
                    }
                } else if (currentLevel === 'kelas') {
                    const labelParts = selectedBarIdx.label.split(" ");
                    const foundTingkat = filters.tingkat.find((data) => labelParts[1] === data.name);
                    if (foundTingkat) {
                        const response = await window.axios.post("/backoffice/json/dashboard/filter/kelas", { tingkat_id: foundTingkat.id });
                        const data = response.data.data;
                        setFilters((prevFilters) => ({
                            ...prevFilters,
                            kelas: data,
                        }));
                        $("#kelas").selectpicker("refresh");
                    } else {
                        console.log("Tingkat tidak ditemukan");
                    }
                } else if (currentLevel === 'mapel') {
                    const labelParts = selectedBarIdx.label.split(" ");
                    const foundKelas = filters.kelas.find((data) => labelParts[1].match(/\d+|\D+/g)[1] === data.name);
                    if (foundKelas) {
                        const response = await window.axios.post("/backoffice/json/dashboard/filter/mapel", { kelas_id: foundKelas.id });
                        const data = response.data.data;
                        setFilters((prevFilters) => ({
                            ...prevFilters,
                            mapel: data,
                        }));
                        $("#mapel").selectpicker("refresh");
                    } else {
                        console.log("Kelas tidak ditemukan");
                    }
                } else if (currentLevel === 'bab') {
                    const labelParts = selectedBarIdx.label
                    const foundMapel = filters.mapel.find((data) => labelParts === data.name);
                    if (foundMapel) {
                        const response = await window.axios.post("/backoffice/json/dashboard/filter/bab", { mapel_id: foundMapel.id });
                        const data = response.data.data;
                        setFilters((prevFilters) => ({
                            ...prevFilters,
                            bab: data,
                        }));
                        $("#bab").selectpicker("refresh");
                    } else {
                        console.log("Mata pelajaran tidak tidak ditemukan")
                    }
                } else if (currentLevel === 'subbab') {
                    const labelParts = selectedBarIdx.label;
                    const foundBab = filters.bab.find((data) => labelParts === data.name);
                    if (foundBab) {
                        const response = await window.axios.post("/backoffice/json/dashboard/filter/subbab", { bab_id: foundBab.id });
                        const data = response.data.data;
                        setFilters((prevFilters) => ({
                            ...prevFilters,
                            subbab: data,
                        }));
                        $("#subbab").selectpicker("refresh");
                    } else {
                        console.log("BAB tidak ditemukan");
                    }
                }
            } catch (err) {
                console.log(err);
            }
        };

        fetchData();
    }, [currentLevel, selectedBarIdx.label]);

    useEffect(() => {
        if (filters.jenjang.length < 1) {
            window.axios.get("/backoffice/json/jenjangs").then((response) => {
                var data = response.data.data
                setFilters({
                    ...filters,
                    jenjang: data,
                    tingkat: [],
                    kelas: [],
                    mapel: [],
                    bab: [],
                    subbab: []
                })

                $("#jenjang").selectpicker("refresh");
            }).catch((err) => {
                console.log(err)
            })
        }
    }, []);


    useEffect(() => {
        if (tahunAjaran.length < 1) {
            window.axios.get("/backoffice/json/dashboard/filter/tahun-ajaran").then((response) => {
                var data = response.data.data
                setTahunAjaran(data)

                $("#tahun-ajaran").selectpicker("refresh");
            }).catch((err) => {
                console.log(err)
            })
        }
    }, []);

    useEffect(() => {
        

        var selectedId = selectedBarIdx.isClick ? listDataIds[selectedBarIdx.idx] : selectedBarIdx.idx

        if (currentLevel == 'siswa' && selectedBarIdx.isClick) {
            window.location.href = `/backoffice/e-raport/${selectedId}/${mapelId}`;
            return;
        }

        setIsLoading(true)

        var params = {
            [nextApi.param]: selectedId
        }

        if( currentLevel == 'mapel') {
            params['kelas_id'] = kelasId
        } else if (currentLevel == 'bab') {
            params['kelas_id'] = kelasId
            // params['mapel_id'] = mapelId
        } else if (currentLevel == 'subbab' || currentLevel == 'siswa') {
            params['bab_id'] = babId
            params['kelas_id'] = kelasId
        }

        window.axios.post(`/backoffice/json/dashboard/${nextApi.name}`, params).then((response) => {
            var data = response.data.data

            options['onClick'] = graphClickEvent

            var chartData = data.data
            var chartDataId = data.data_id
            var graphicTitle = data.graphic_title
            var nextApi = data.next_api
            var currentLevel = data.level

            if (data.kelas_id) {
                setKelasId(data.kelas_id)
            }

            if (data.bab_id) {
                setBabId(data.bab_id)
            }

            if (data.mapel_id) {
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

    const getDataJenjang = () => {
        window.axios.post("/backoffice/json/dashboard/jenjang").then((response) => {  // Gantilah dengan endpoint yang sesuai jika perlu
            var data = response.data.data;

            var chartData = data.data;
            var chartDataId = data.data_id;
            var nextApi = data.next_api;
            var graphicTitle = data.graphic_title;
            var currentLevel = data.level;

            options['onClick'] = graphClickEvent;

            if (data.kelas_id) {
                setKelasId(data.kelas_id);
            }

            if (data.bab_id) {
                setBabId(data.bab_id);
            }

            if (data.mapel_id) {
                setMapelId(data.mapel_id);
            }

            setIsLoading(false);
            setGraphicTitle(graphicTitle);
            setCurrentLevel(currentLevel);
            setNextApi(nextApi);
            setListDatas(chartData);
            setListDataIds(chartDataId);
        }).catch((err) => {
            console.log(err);
        });

        window.axios.post("/backoffice/json/dashboard/filter/level").then((response) => {
            var data = response.data.data;
            setfilterLevel(data);
        }).catch((err) => {
            console.log(err);
        });
    }

    const getOrCreateTooltip = (chart) => {
        let tooltipEl = chart.canvas.parentNode.querySelector('div');
        console.log('tooltipEl 0', tooltipEl)

        if (!tooltipEl) {
            tooltipEl = document.createElement('div');
            tooltipEl.style.background = 'rgba(0, 0, 0, 0.7)';
            tooltipEl.style.borderRadius = '3px';
            tooltipEl.style.color = 'white';
            tooltipEl.style.opacity = 1;
            tooltipEl.style.pointerEvents = 'none';
            tooltipEl.style.position = 'absolute';
            tooltipEl.style.transform = 'translate(-50%, 0)';
            tooltipEl.style.transition = 'all .1s ease';

            const table = document.createElement('table');
            table.style.margin = '0px';

            tooltipEl.appendChild(table);
            chart.canvas.parentNode.appendChild(tooltipEl);
        }

        return tooltipEl;
    };

    const externalTooltipHandler = (context) => {
        // Tooltip Element
        const { chart, tooltip } = context;
        const tooltipEl = getOrCreateTooltip(chart);

        // Hide if no tooltip
        if (tooltip.opacity === 0) {
            tooltipEl.style.opacity = 0;
            return;
        }

        // Set Text
        if (tooltip.body) {
            const dataPoints = tooltip.dataPoints;

            let innerHtml = `<tbody style="font-size:12px;" border="0">`

            dataPoints.forEach((dataPoint, i) => {
                const dataIndex = dataPoint?.dataIndex;
                const dataset = dataPoint?.dataset;
                const dataBenar = dataset?.benars[dataIndex];
                const dataTerjawab = dataset?.terjawabs[dataIndex];
                const dataPercentage = dataset?.data[dataIndex];

                innerHtml += `<tr style="background-color: inherit; border-width: 0; text-align: center; font-weight: bold;">
                    <td colspan="3" style='padding: 0px 3px; margin: 0px;'>${dataPoint?.label}</td>
                </tr>`;

                innerHtml += `<tr style="background-color: inherit; border-width: 0;">
                    <td style='padding: 0px 3px; margin: 0px;'>Level</td>
                    <td style='padding: 0px 3px; margin: 0px;'>:</td>
                    <td style='padding: 0px 3px; margin: 0px;'>${dataset?.label}</td>
                </tr>`;

                innerHtml += `<tr style="background-color: inherit; border-width: 0;">
                    <td style='padding: 0px 3px; margin: 0px;'>Total Benar</td>
                    <td style='padding: 0px 3px; margin: 0px;'>:</td>
                    <td style='padding: 0px 3px; margin: 0px;'>${dataBenar}</td>
                </tr>`;

                innerHtml += `<tr style="background-color: inherit; border-width: 0;">
                    <td style='padding: 0px 3px; margin: 0px;'>Total Terjawab</td>
                    <td style='padding: 0px 3px; margin: 0px;'>:</td>
                    <td style='padding: 0px 3px; margin: 0px;'>${dataTerjawab}</td>
                </tr>`;

                innerHtml += `<tr style="background-color: inherit; border-width: 0;">
                    <td style='padding: 0px 3px; margin: 0px;'>Persentase</td>
                    <td style='padding: 0px 3px; margin: 0px;'>:</td>
                    <td style='padding: 0px 3px; margin: 0px;'>${dataPercentage}%</td>
                </tr>`;
            });
            innerHtml += `</tbody>`;

            const tableRoot = tooltipEl.querySelector('table');
            // Remove old children
            while (tableRoot.firstChild) {
                tableRoot.firstChild.remove();
            }
            // Add new children
            tableRoot.innerHTML = innerHtml;
        }

        const { offsetLeft: positionX, offsetTop: positionY } = chart.canvas;

        // Display, position, and set styles for font
        tooltipEl.style.opacity = 1;
        tooltipEl.style.left = positionX + tooltip.caretX + 'px';
        tooltipEl.style.top = positionY + tooltip.caretY + 'px';
        tooltipEl.style.font = tooltip.options.bodyFont.string;
        tooltipEl.style.padding = tooltip.options.padding + 'px ' + tooltip.options.padding + 'px';
    };

    useEffect(() => {
        const listConfig = [];

        console.log('currentLevel', currentLevel)

        if (currentLevel === 'siswa') {
            // options.indexAxis = 'y';
            // options.plugins.datalabels.formatter = function(value){
            //     return value + '%';
            // };

            // options.plugins.datalabels.font = {
            //     size: 3,
            // }; 
        } else {
            // options.indexAxis = 'x';
            options.plugins.datalabels.formatter = function (value) {
                return value;
            };
            // options.plugins.datalabels.font = {
            //     size: 12,
            // }; 
        }

        options.plugins['tooltip'] = {
            enabled: false,
            external: externalTooltipHandler,
        }

        for (let i = 0; i < listDatas.length; i++) {
            const labels = [];
            const tempScores = [];
            const tempScoresMudah = [];
            const tempScoresSedang = [];
            const tempScoresSulit = [];

            const tempTerjawabMudah = [];
            const tempTerjawabSedang = [];
            const tempTerjawabSulit = [];

            const tempPercentageMudah = [];
            const tempPercentageSedang = [];
            const tempPercentageSulit = [];

            listDatas[i].forEach(element => {
                const data = element;
                labels.push(data.label);
                tempScores.push(data.score);
                if (data?.percentage_split) {
                    tempPercentageMudah.push(data?.percentage_split?.mudah ?? 0);
                    tempPercentageSedang.push(data?.percentage_split?.sedang ?? 0);
                    tempPercentageSulit.push(data?.percentage_split?.sulit ?? 0);
                }

                if (data?.score_split) {
                    tempScoresMudah.push(data?.score_split?.mudah ?? 0);
                    tempScoresSedang.push(data?.score_split?.sedang ?? 0);
                    tempScoresSulit.push(data?.score_split?.sulit ?? 0);
                }

                if (data?.terjawab_split) {
                    tempTerjawabMudah.push(data?.terjawab_split?.mudah ?? 0);
                    tempTerjawabSedang.push(data?.terjawab_split?.sedang ?? 0);
                    tempTerjawabSulit.push(data?.terjawab_split?.sulit ?? 0);
                }
            });

            var objConfig = {
                labels,
                datasets: []
            }

            if (currentLevel === "siswa") {
                objConfig.datasets.push({
                    label: 'Mudah',
                    data: tempPercentageMudah,
                    backgroundColor: "rgba(2, 65, 2, 1)",
                    borderRadius: 10,
                    minBarLength: 1,
                    benars: tempScoresMudah,
                    terjawabs: tempTerjawabMudah,
                    // barThickness: 20,
                });

                objConfig.datasets.push({
                    label: 'Sedang',
                    data: tempPercentageSedang,
                    backgroundColor: "rgba(255, 153, 51, 1)",
                    borderRadius: 10,
                    minBarLength: 1,
                    benars: tempScoresSedang,
                    terjawabs: tempTerjawabSedang,
                    // barThickness: 120,
                });

                objConfig.datasets.push({
                    label: 'Sulit',
                    data: tempPercentageSulit,
                    backgroundColor: "rgba(255, 51, 51, 1)",
                    borderRadius: 10,
                    minBarLength: 1,
                    benars: tempScoresSulit,
                    terjawabs: tempTerjawabSulit,
                    // barThickness: 120,
                });
            } else {
                objConfig.datasets.push({
                    label: 'Score',
                    data: tempScores,
                    backgroundColor: "rgba(2, 65, 2, 1)",
                    borderRadius: 10,
                    minBarLength: 1,
                    // barThickness: 120,
                });
            }

            listConfig.push(objConfig)
        }
        console.log('listConfig', listConfig)
        setListConfigData(listConfig);
    }, [listDatas]);

    const handleChangeTahunAjaran = (e) => {

        window.axios.post("/backoffice/json/dashboard/tahun-ajaran", {tahun_ajaran: e.target.value}).then((response) => {
            getDataJenjang()
            setFilters((prevFilters) => ({
                ...prevFilters,
                tingkat: [],
                kelas: [],
                mapel: [],
                bab: [],
                subbab: []
            }))
                
            $('#jenjang').val(' ');
            $(`#jenjang`).selectpicker("refresh");
            $(`#tingkat`).selectpicker("refresh");
            $(`#kelas`).selectpicker("refresh");
            $(`#mapel`).selectpicker("refresh");
            $(`#bab`).selectpicker("refresh");
            $(`#subbab`).selectpicker("refresh");
        }).catch((err) => {
            console.log(err)
        })
    }

    const handleChange = (e) => {
        var getLevel = filterLevel.filter(function (el) {
            return el.option == e.target.id
        });

        if (getLevel.length == 0) {
            return;
        }

        var level = getLevel[0]
        setNextApi(level.next_api)

        var params = {
            [level.next_api.param]: e.target.value
        }

        if (level?.option === 'kelas' && e.target.value !== kelasId) {
            setKelasId(e.target.value)
            setFilters((prevFilters) => ({
                ...prevFilters,
                mapel: filters.mapel.length > 0 ? filters.mapel.length = 0 : [],
                bab: filters.bab.length > 0 ? filters.bab.length = 0 : [],
                subbab: filters.subbab.length > 0 ? filters.subbab.length = 0 : []
            }))
            $('#mapel').selectpicker("refresh");
            $('#bab').selectpicker("refresh");
            $('#subbab').selectpicker("refresh");
        }

        window.axios.post(`/backoffice/json/dashboard/filter/${level.next_api.name}`, params).then((response) => {
            var data = response.data.data

            if (level.next_api.name === 'tingkat') {
                setFilters((prevFilters) => ({
                    ...prevFilters,
                    tingkat: data,
                    kelas: filters.kelas.length > 0 ? filters.kelas.length = 0 : [],
                    mapel: filters.mapel.length > 0 ? filters.mapel.length = 0 : [],
                    bab: filters.bab.length > 0 ? filters.bab.length = 0 : [],
                    subbab: filters.subbab.length > 0 ? filters.subbab.length = 0 : []
                }))
            } else if (level.next_api.name === 'kelas') {
                setFilters((prevFilters) => ({
                    ...prevFilters,
                    kelas: data,
                    mapel: filters.mapel.length > 0 ? filters.mapel.length = 0 : [],
                    bab: filters.bab.length > 0 ? filters.bab.length = 0 : [],
                    subbab: filters.subbab.length > 0 ? filters.subbab.length = 0 : []
                }))
            } else if (level.next_api.name === 'mapel') {
                setFilters((prevFilters) => ({
                    ...prevFilters,
                    mapel: data,
                    bab: filters.bab.length > 0 ? filters.bab.length = 0 : [],
                    subbab: filters.subbab.length > 0 ? filters.subbab.length = 0 : []
                }))
            } else if (level.next_api.name === 'bab') {
                setFilters((prevFilters) => ({
                    ...prevFilters,
                    bab: data,
                    subbab: filters.subbab.length > 0 ? filters.subbab.length = 0 : []
                }))
            } else if (level.next_api.name === 'subbab') {
                setFilters((prevFilters) => ({
                    ...prevFilters,
                    subbab: data
                }))
            }
            $(`#jenjang`).selectpicker("refresh");
            $(`#tingkat`).selectpicker("refresh");
            $(`#kelas`).selectpicker("refresh");
            $(`#mapel`).selectpicker("refresh");
            $(`#bab`).selectpicker("refresh");
            $(`#subbab`).selectpicker("refresh");
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
                <div style={{ display: 'flex', alignItems: 'center' }}>
                <div style={{ marginLeft: 'auto' }} className="dashboard-filter">
                        <label className="my-auto mr-2" style={{ color: "#9E9E9E" }}>Filter By</label>
                        <select id="tahun-ajaran" name="tahun-ajaran" data-style="btn-green-pastel" className="selectpicker mr-2" placeholder="Tahun Ajaran" onChange={handleChangeTahunAjaran}>
                            <option value="">Semua Tahun Ajaran</option>
                            {tahunAjaran.length > 0 && tahunAjaran.map((data) => (
                                <option key={data.id} value={data.id}>{data.name}</option>
                            ))}
                        </select>
                        <select id="jenjang" name="jenjang" data-style="btn-green-pastel" className="selectpicker mr-2" placeholder="Jenjang" onChange={handleChange}>
                            <option value="">Semua Jenjang</option>
                            {filters.jenjang.length > 0 && filters.jenjang.map((data) => (
                                <option key={data.id} value={data.id}>{data.name}</option>
                            ))}
                        </select>
                        <select id="tingkat" name="tingkat" data-style="btn-green-pastel" className="selectpicker mr-2" placeholder="Tingkat" onChange={handleChange}>
                            <option value="">Semua Tingkat</option>
                            {filters.tingkat.length > 0 && filters.tingkat.map((data) => (
                                <option key={data.id} value={data.id}>{data.name}</option>
                            ))}
                        </select>
                        <select id="kelas" name="kelas" data-style="btn-green-pastel" className="selectpicker mr-2" placeholder="Kelas" onChange={handleChange}>
                            <option value="">Semua Kelas</option>
                            {filters.kelas.length > 0 && filters.kelas.map((data) => (
                                <option key={data.id} value={data.id}>{data.name}</option>
                            ))}
                        </select>
                        <select id="mapel" name="mapel" data-style="btn-green-pastel" className="selectpicker mr-2" placeholder="Mata Pelajaran" onChange={handleChange}>
                            <option value="">Semua Mata Pelajaran</option>
                            {filters.mapel.length > 0 && filters.mapel.map((data) => (
                                <option key={data.id} value={data.id}>{data.name}</option>
                            ))}
                        </select>
                        <select id="bab" name="bab" data-style="btn-green-pastel" className="selectpicker mr-2" placeholder="Module" onChange={handleChange}>
                            <option value="">Semua Module</option>
                            {filters.bab.length > 0 && filters.bab.map((data) => (
                                <option key={data.id} value={data.id}>{data.name}</option>
                            ))}
                        </select>
                        <select id="subbab" name="subbab" data-style="btn-green-pastel" className="selectpicker mr-2" placeholder="Sub-Module" onChange={handleChange}>
                            <option value="">Semua Sub-Module</option>
                            {filters.subbab.length > 0 && filters.subbab.map((data) => (
                                <option key={data.id} value={data.id}>{data.name}</option>
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

                                <div style={{ overflowX: scroll, width: "100%" }}>
                                    <Bar options={options} data={data} />

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            ))
        ) : (
            <div className="row" style={{ height: '70vh', width: '100%' }}>
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

export default DashboardSuperadmin;

if (document.getElementById('dashboard-superadmin')) {
    ReactDOM.render(<DashboardSuperadmin />, document.getElementById('dashboard-superadmin'));
}