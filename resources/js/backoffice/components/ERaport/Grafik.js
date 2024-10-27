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

function GrafikERaport({ siswa_id, mapel_id }) {

    const [configData, setConfigData] = useState(data);
    const [datas, setDatas] = useState([]);
    const [title, setTitle] = useState({});

    useEffect(() => {
        const searchParams = new URLSearchParams(window.location.search);

        if (datas.length < 1) {
            // get data from /json/e-raport/grafik/{id}/{mapelId}; id = siswa_id
            window.axios.get(`/backoffice/json/e-raport/grafik/${siswa_id}/${mapel_id}`).then(function (response) {
                const data = response.data.data;
                const data_babs = data.babs;
                let result;

                if(searchParams.has('bab')){
                    const bab_id = searchParams.get('bab')
                    const data_subbabs = data_babs.find((element) => {
                        return element.id == bab_id
                    })

                    result = data_subbabs.subbabs.map((element) => {
                        return {
                          'label' : element.label,
                          'score' : element.score,
                          'mudah' : element.mudah,
                          'sedang' : element.sedang,
                          'sulit' : element.sulit
                        }
                    })
                }else{
                    result = data_babs.map((element) => {
                        return {
                          'label' : element.label,
                          'score' : element.score,
                          'mudah' : element.mudah,
                          'sedang' : element.sedang,
                          'sulit' : element.sulit
                        }
                    })
                }

                setDatas(result)
                setTitle({
                    'label': data.label,
                    'total_score': data.score
                })
            });
        }
    }, []);

    useEffect(() => {
        const labels = [];
        const tempMudah = [];
        const tempSedang = [];
        const tempSulit = [];
        for (let i=0; i<datas.length; i++) {
            const data = datas[i];
            labels.push(data.label);
            tempMudah.push(data.mudah);
            tempSedang.push(data.sedang);
            tempSulit.push(data.sulit);
        }

        setConfigData({
            labels,
            datasets: [
                {
                    label: 'Percentage Mudah',
                    data: tempMudah,
                    backgroundColor: 'rgba(2, 65, 2, 1)',
                    borderRadius: 10,
                    minBarLength: 1,
                    // barThickness: 120,
                },
                {
                    label: 'Percentage Sedang',
                    data: tempSedang,
                    backgroundColor: 'rgba(255, 153, 51, 1)',
                    borderRadius: 10,
                    minBarLength: 1,
                    // barThickness: 120,
                },
                {
                    label: 'Percentage Sulit',
                    data: tempSulit,
                    backgroundColor: 'rgba(255, 51, 51, 1)',
                    borderRadius: 10,
                    minBarLength: 1,
                    // barThickness: 120,
                }
            ],
        });
    }, [datas]);

    return (<>
        <div className="row mt-4">
            <div className="col-12">
                <div className="card">
                    <div className="card-body">
                        <div style={{ display: 'flex', alignItems: 'center' }} className="mb-3">
                            <span className="text-primary">{title.label}</span>

                            <div className="dashboard-final-score" style={{ marginLeft: 'auto' }}>
                                <span>{title.label} : {title.total_score}</span>
                                {/* <span style={{
                                    borderLeft: "1px solid #F6D0A1",
                                    marginLeft: "5px",
                                    marginRight: "5px",                               
                                }}></span> */}
                            </div>
                        </div>

                        <Bar options={options} data={configData} />
                    </div>
                </div>
            </div>
        </div>            
    </>);
}

export default GrafikERaport;

var container = document.getElementById("grafik-eraport");

if (container) {
    var siswaId = container.getAttribute("siswa-id");
    var mapelId = container.getAttribute("mapel-id");

    ReactDOM.render(<GrafikERaport siswa_id={siswaId} mapel_id={mapelId} />, container);
}