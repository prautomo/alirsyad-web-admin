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
    
    const getOrCreateTooltip = (chart) => {
        let tooltipEl = chart.canvas.parentNode.querySelector('div');
      
        if (tooltipEl != undefined) {
          let existTooltip = document.getElementById("chart-tooltip");

          if(existTooltip != undefined)
          {
            existTooltip.remove();
          }

          tooltipEl = document.createElement('div');
          tooltipEl.id = 'chart-tooltip'
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
        const {chart, tooltip} = context;
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
      
        const {offsetLeft: positionX, offsetTop: positionY} = chart.canvas;
      
        // Display, position, and set styles for font
        tooltipEl.style.opacity = 1;
        tooltipEl.style.left = positionX + tooltip.caretX + 'px';
        tooltipEl.style.top = positionY + tooltip.caretY + 'px';
        tooltipEl.style.font = tooltip.options.bodyFont.string;
        tooltipEl.style.padding = tooltip.options.padding + 'px ' + tooltip.options.padding + 'px';
    };

    useEffect(() => {
        const labels = [];
        const tempMudah = {
            totalBenar: [],
            totalTerjawab: [],
            percentage: []
        }
        const tempSedang = {
            totalBenar: [],
            totalTerjawab: [],
            percentage: []
        }
        const tempSulit = {
            totalBenar: [],
            totalTerjawab: [],
            percentage: []
        }

        options.plugins['tooltip'] = {
            enabled: false,
            external: externalTooltipHandler,
        }

        for (let i=0; i<datas.length; i++) {
            const data = datas[i];
            labels.push(data.label);
            
            tempMudah.totalBenar.push(data.mudah.total_benar);
            tempSedang.totalBenar.push(data.sedang.total_benar);
            tempSulit.totalBenar.push(data.sulit.total_benar);
            
            tempMudah.totalTerjawab.push(data.mudah.total_terjawab);
            tempSedang.totalTerjawab.push(data.sedang.total_terjawab);
            tempSulit.totalTerjawab.push(data.sulit.total_terjawab);

            tempMudah.percentage.push(data.mudah.percentage);
            tempSedang.percentage.push(data.sedang.percentage);
            tempSulit.percentage.push(data.sulit.percentage);
        }

        setConfigData({
            labels,
            datasets: [
                {
                    label: 'Percentage Mudah',
                    data: tempMudah.percentage,
                    backgroundColor: 'rgba(2, 65, 2, 1)',
                    borderRadius: 10,
                    minBarLength: 1,
                    benars: tempMudah.totalBenar,
                    terjawabs: tempMudah.totalTerjawab,
                    // barThickness: 120,
                },
                {
                    label: 'Percentage Sedang',
                    data: tempSedang.percentage,
                    backgroundColor: 'rgba(255, 153, 51, 1)',
                    borderRadius: 10,
                    minBarLength: 1,
                    benars: tempSedang.totalBenar,
                    terjawabs: tempSedang.totalTerjawab,
                    // barThickness: 120,
                },
                {
                    label: 'Percentage Sulit',
                    data: tempSulit.percentage,
                    backgroundColor: 'rgba(255, 51, 51, 1)',
                    borderRadius: 10,
                    minBarLength: 1,
                    benars: tempSulit.totalBenar,
                    terjawabs: tempSulit.totalTerjawab,
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