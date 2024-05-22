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
} from 'chart.js/auto';
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

function DashboardGuruMapel() {

    const [configData, setConfigData] = useState(data);
    const [datas, setDatas] = useState([]);

    useEffect(() => {
        if (datas.length < 1) {
            setDatas([
                {
                    label: "5A",
                    score: 1376,
                },
                {
                    label: "5B",
                    score: 1518,
                }
            ])
        }
    }, []);

    useEffect(() => {
        const labels = [];
        const tempScores = [];
        for (let i=0; i<datas.length; i++) {
            const data = datas[i];
            labels.push(data.label);
            tempScores.push(data.score);
        }
        setConfigData({
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
            ],
        });
    }, [datas]);

    return (<>
        <div className="row mb-4">
            <div className="col-12">
                <div style={{ display: 'flex', alignItems: 'center'}}>
                    <div style={{ marginLeft: 'auto'  }}>
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
        <div className="row">
            <div className="col-12">
                <div className="card">
                    <div className="card-body">
                        <div style={{ display: 'flex', alignItems: 'center' }} className="mb-3">
                            <span className="text-primary">Matematika</span>

                            <div className="dashboard-final-score" style={{ marginLeft: 'auto' }}>
                                <span>Final Score 5A : 1376</span>
                                <span style={{
                                    borderLeft: "1px solid #F6D0A1",
                                    marginLeft: "5px",
                                    marginRight: "5px",                               
                                }}></span>
                                <span>Final Score 5B : 1518</span>
                            </div>
                        </div>

                        <Bar options={options} data={configData} />
                    </div>
                </div>
            </div>
        </div>            
    </>);
}

export default DashboardGuruMapel;

if (document.getElementById('dashboard-guru-mapel')) {
    ReactDOM.render(<DashboardGuruMapel  />, document.getElementById('dashboard-guru-mapel'));
}