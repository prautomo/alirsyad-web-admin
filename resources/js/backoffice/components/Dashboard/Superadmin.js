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

export const data = {
    undefined,
    datasets: [
        {
            label: 'Score',
            data: [],
            backgroundColor: 'rgba(2, 65, 2, 1)',
        }
    ],
};

function DashboardSuperadmin() {

    const [listConfigData, setListConfigData] = useState([]);
    const [listDatas, setListDatas] = useState([]);

    useEffect(() => {
        if (listDatas.length < 1) {
            setListDatas([
                [
                    {
                        label: "TK",
                        score: 1376,
                    },
                    {
                        label: "SD",
                        score: 580,
                    },
                    {
                        label: "SMP",
                        score: 1500,
                    },
                    {
                        label: "SMA",
                        score: 1125,
                    }
                ]
            ])
        }
    }, []);

    const spanBorderRight = {
        borderLeft: "1px solid #F6D0A1",
        marginLeft: "5px",
        marginRight: "5px"
    }
    
    options['onClick'] = graphClickEvent

    function graphClickEvent(event, clickedElements){
        console.log('sss')
        if (clickedElements.length === 0) return

        const { dataIndex, raw } = clickedElements[0].element.$context
        const data = event.chart.data
        const barLabel = event.chart.data.labels[dataIndex]
        console.log('click dataIndex', dataIndex)
        console.log('click data', data)
        console.log('click', barLabel)

        setListDatas([
            [
                {
                    label: "TK 1",
                    score: 1376,
                },
                {
                    label: "TK 2",
                    score: 580,
                }
            ],
            [
                {
                    label: "SD 1",
                    score: 1376,
                },
                {
                    label: "SD 2",
                    score: 580,
                },
                {
                    label: "SD 3",
                    score: 1500,
                },
                {
                    label: "SD 4",
                    score: 1126,
                },
                {
                    label: "SD 5",
                    score: 1518,
                },
                {
                    label: "SD 6",
                    score: 480,
                }
            ],
            [
                {
                    label: "SMP 1",
                    score: 1376,
                },
                {
                    label: "SMP 2",
                    score: 1200,
                },
                {
                    label: "SMP 3",
                    score: 555,
                }
            ],
            [
                {
                    label: "SMA 1",
                    score: 1376,
                },
                {
                    label: "SMA 2",
                    score: 1200,
                },
                {
                    label: "SMA 3",
                    score: 1512,
                }
            ]
        ])
    }

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
                        backgroundColor: 'rgba(2, 65, 2, 1)',
                        borderRadius: 10,
                        minBarLength: 1,
                        barThickness: 120,
                    }
                ]
            }

            listConfig.push(objConfig)
        }
        console.log(listConfig)
        setListConfigData(listConfig);
    }, [listDatas]);
    return (<>
        <div className="row mb-4">
            <div className="col-12">
                <div style={{ display: 'flex', alignItems: 'center'}}>
                    <div style={{ marginLeft: 'auto' }} class="dashboard-filter">
                        <label className="my-auto mr-2" style={{ color: "#9E9E9E"}}>Filter By</label>
                        <select id="mapel" name="mapel" data-style="btn-green-pastel" class="selectpicker mr-2" placeholder="Mata Pelajaran">
                            <option value="">Mata Pelajaran</option>
                            <option value="matematika">MTK</option>
                        </select>
                        <select id="jenjang" name="jenjang" data-style="btn-green-pastel" class="selectpicker mr-2" placeholder="Jenjang">
                            <option value="">Semua Jenjang</option>
                            <option value="sd">SD</option>
                        </select>
                        <select id="tingkat" name="tingkat" data-style="btn-green-pastel" class="selectpicker mr-2" placeholder="Tingkat">
                            <option value="">Semua Tingkat</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                        <select id="kelas" name="kelas" data-style="btn-green-pastel" multiple class="selectpicker mr-2" placeholder="Kelas">
                            <option value="">Semua Kelas</option>
                            <option value="5a">5 A</option>
                            <option value="5b">5 B</option>
                        </select>
                        <select id="module" name="module" data-style="btn-green-pastel" class="selectpicker mr-2" placeholder="Module">
                            <option value="">Semua Module</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                        <select id="submodule" name="submodule" data-style="btn-green-pastel" class="selectpicker mr-2" placeholder="Sub-Module">
                            <option value="">Semua Sub-Module</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        {listConfigData && listConfigData.map((data) => (
            
            <div className="row">
                <div className="col-12">
                    <div className="card">
                        <div className="card-body">
                            <div style={{ display: 'flex', alignItems: 'center' }} className="mb-3">
                                <h2 className="text-primary"><b>Ringkasan Grafik</b></h2>

                                <div className="dashboard-final-score" style={{ marginLeft: 'auto' }}>
                                    <span>TK : <b>1376</b></span>
                                    <span style={spanBorderRight}></span>
                                    <span>SD : <b>580</b></span>
                                    <span style={spanBorderRight}></span>
                                    <span>SMP : <b>1500</b></span>
                                    <span style={spanBorderRight}></span>
                                    <span>SMA : <b>1125</b></span>

                                </div>
                            </div>

                            <Bar options={options} data={data} />
                        </div>
                    </div>
                </div>
            </div>  
        ))}          
    </>);
}

export default DashboardSuperadmin;

if (document.getElementById('dashboard-superadmin')) {
    ReactDOM.render(<DashboardSuperadmin  />, document.getElementById('dashboard-superadmin'));
}