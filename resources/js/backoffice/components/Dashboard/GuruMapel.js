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
import { ThreeCircles } from 'react-loader-spinner';

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

function DashboardGuruMapel() {
    const [chartConfigs, setChartConfigs] = useState([]);
    const [rawCharts, setRawCharts] = useState([]);
    const [rawIds, setRawIds] = useState([]);
    const [nextApi, setNextApi] = useState({});
    const [selectedBar, setSelectedBar] = useState({});
    const [filterLevel, setFilterLevel] = useState([]);
    const [filters, setFilters] = useState({
        mengajar: [],
        bab: [],
        subbab: [],
    });
    const [kelasId, setKelasId] = useState(0);
    const [mapelId, setMapelId] = useState(0);
    const [babId, setBabId] = useState(0);
    const [graphicTitle, setGraphicTitle] = useState("");
    const [currentLevel, setCurrentLevel] = useState("");
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        if (rawCharts.length < 1) {
            window.axios.post('/backoffice/json/dashboard/bab').then((response) => {
                const data = response.data.data;
                const chartData = data.data;
                const chartIds = data.data_id;
                options['onClick'] = graphClickEvent;

                if (data.kelas_id) setKelasId(data.kelas_id);
                if (data.mapel_id) setMapelId(data.mapel_id);
                if (data.bab_id) setBabId(data.bab_id);

                setLoading(false);
                setGraphicTitle(data.graphic_title);
                setCurrentLevel(data.level);
                setNextApi(data.next_api);
                setRawCharts(chartData);
                setRawIds(chartIds);
            }).catch((err) => console.log(err));

            window.axios.post('/backoffice/json/dashboard/filter/level').then((response) => {
                const data = response.data.data;
                setFilterLevel(data);
            }).catch((err) => console.log(err));
        }
    }, []);

    useEffect(() => {
        if (filters.mengajar.length < 1) {
            window.axios.post('/backoffice/json/dashboard/filter/mengajar').then((response) => {
                const data = response.data;
                setFilters((prev) => ({
                    ...prev,
                    mengajar: data.data,
                }));

                if (data.kelas_id) setKelasId(data.kelas_id);
                if (data.mapel_id) setMapelId(data.mapel_id);

                const val = `${data.mapel_id}/${data.kelas_id}`;
                $('#mengajar').val(val);
                $('#mengajar').selectpicker('refresh');
            }).catch((err) => console.log(err));
        }
    }, []);

    useEffect(() => {
        if (mapelId) {
            window.axios.post('/backoffice/json/dashboard/filter/bab', { mapel_id: mapelId }).then((response) => {
                const data = response.data.data;
                setFilters((prev) => ({
                    ...prev,
                    bab: data,
                }));
                $('#bab').selectpicker('refresh');
            }).catch((err) => console.log(err));
        }
    }, [mapelId]);

    function graphClickEvent(event, clickedElements) {
        if (clickedElements.length === 0) return;
        const { dataIndex } = clickedElements[0].element.$context;
        const data = event.chart.data;
        const barLabel = data.labels[dataIndex];

        setLoading(true);
        setSelectedBar({ label: barLabel, idx: dataIndex, isClick: true });
    }

    useEffect(() => {
        const fetchFilter = async () => {
            try {
                if (currentLevel === 'subbab') {
                    const label = selectedBar.label;
                    const foundBab = filters.bab.find((d) => label === d.name);
                    if (foundBab) {
                        window.axios.post('/backoffice/json/dashboard/filter/subbab', { bab_id: foundBab.id })
                            .then((response) => {
                                const data = response.data.data;
                                setFilters((prev) => ({ ...prev, subbab: data }));
                                $('#subbab').selectpicker('refresh');
                            }).catch((err) => console.log(err));
                    }
                }
            } catch (err) {
                console.log(err);
            }
        };
        fetchFilter();
    }, [currentLevel, selectedBar.label, filters.bab]);

    useEffect(() => {
        const selectedId = selectedBar.isClick ? rawIds[selectedBar.idx] : selectedBar.idx;

        if (currentLevel === 'siswa') {
            window.location.href = `/backoffice/e-raport/${selectedId}/${mapelId}`;
            return;
        }

        if (!nextApi.name) return;

        setLoading(true);

        const params = { [nextApi.param]: selectedId };

        if (currentLevel === 'bab') {
            params['kelas_id'] = kelasId;
            params['mapel_id'] = mapelId;
        } else if (currentLevel === 'subbab') {
            params['bab_id'] = babId;
            params['kelas_id'] = kelasId;
        }

        window.axios.post(`/backoffice/json/dashboard/${nextApi.name}`, params).then((response) => {
            const data = response.data.data;
            options['onClick'] = graphClickEvent;
            setLoading(false);
            setGraphicTitle(data.graphic_title);
            setCurrentLevel(data.level);
            setNextApi(data.next_api);
            setRawCharts(data.data);
            setRawIds(data.data_id);

            if (data.kelas_id) setKelasId(data.kelas_id);
            if (data.mapel_id) setMapelId(data.mapel_id);
            if (data.bab_id) setBabId(data.bab_id);
        }).catch((err) => console.log(err));
    }, [selectedBar]);

    useEffect(() => {
        const configs = [];
        for (let i = 0; i < rawCharts.length; i++) {
            const labels = [];
            const scores = [];
            rawCharts[i].forEach((el) => {
                labels.push(el.label);
                scores.push(el.score);
            });
            configs.push({
                labels,
                datasets: [{
                    label: 'Score',
                    data: scores,
                    backgroundColor: 'rgba(2, 65, 2, 1)',
                    borderRadius: 10,
                    minBarLength: 1,
                }],
            });
        }
        setChartConfigs(configs);
    }, [rawCharts]);

    const handleMengajarChange = (e) => {
        const level = filterLevel.find((el) => el.option === 'mengajar');
        if (!level) return;

        setNextApi(level.next_api);

        const [mapel, kelas] = e.target.value.split('/');
        setMapelId(parseInt(mapel));
        setKelasId(parseInt(kelas));
        setBabId(0);

        const params = { [level.next_api.param]: e.target.value };

        window.axios.post(`/backoffice/json/dashboard/filter/${level.next_api.name}`, params)
            .then((response) => {
                const data = response.data.data;
                setFilters((prev) => ({ ...prev, bab: data, subbab: [] }));
                $('#bab').selectpicker('refresh');
                $('#subbab').selectpicker('refresh');
            }).catch((err) => console.log(err));

        setLoading(true);
        setSelectedBar({ label: e.target.id, idx: e.target.value, isClick: false });
    };

    const handleChange = (e) => {
        const getLevel = filterLevel.filter((el) => el.option === e.target.id);
        if (getLevel.length === 0) return;

        const level = getLevel[0];
        setNextApi(level.next_api);

        const params = { [level.next_api.param]: e.target.value };
        if (kelasId !== 0) params['kelas_id'] = kelasId;

        window.axios.post(`/backoffice/json/dashboard/filter/${level.next_api.name}`, params).then((response) => {
            const data = response.data.data;

            if (level.next_api.name === 'bab') {
                setFilters((prev) => ({ ...prev, bab: data, subbab: [] }));
            } else if (level.next_api.name === 'subbab') {
                setFilters((prev) => ({ ...prev, subbab: data }));
            }

            $('#bab').selectpicker('refresh');
            $('#subbab').selectpicker('refresh');
        }).catch((err) => console.log(err));

        setLoading(true);
        setSelectedBar({ label: e.target.id, idx: e.target.value, isClick: false });
    };

    const spanBorderRight = {
        borderLeft: '1px solid #F6D0A1',
        marginLeft: '5px',
        marginRight: '5px',
    };

    return (
        <>
            <div className="row mb-4">
                <div className="col-12">
                    <div style={{ display: 'flex', alignItems: 'center' }}>
                        <div style={{ marginLeft: 'auto' }} className="dashboard-filter">
                            <label className="my-auto mr-2" style={{ color: '#9E9E9E' }}>Filter By</label>
                            <select
                                id="mengajar"
                                name="mengajar"
                                data-style="btn-green-pastel"
                                className="selectpicker mr-2"
                                placeholder="Mata Pelajaran"
                                onChange={handleMengajarChange}
                            >
                                <option value="">Mengajar</option>
                                {filters.mengajar.length > 0 &&
                                    filters.mengajar.map((data) => (
                                        <option value={data.id}>{data.name}</option>
                                    ))}
                            </select>
                            <select
                                id="bab"
                                name="bab"
                                data-style="btn-green-pastel"
                                className="selectpicker mr-2"
                                placeholder="Module"
                                onChange={handleChange}
                            >
                                <option value="">Semua Module</option>
                                {filters.bab.length > 0 &&
                                    filters.bab.map((data) => (
                                        <option value={data.id}>{data.name}</option>
                                    ))}
                            </select>
                            <select
                                id="subbab"
                                name="subbab"
                                data-style="btn-green-pastel"
                                className="selectpicker mr-2"
                                placeholder="Sub-Module"
                                onChange={handleChange}
                            >
                                <option value="">Semua Sub-Module</option>
                                {filters.subbab.length > 0 &&
                                    filters.subbab.map((data) => (
                                        <option value={data.id}>{data.name}</option>
                                    ))}
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {!loading ? (
                chartConfigs &&
                chartConfigs.map((data, idxData) => (
                    <div className="row" key={`chart-${idxData}`}>
                        <div className="col-12">
                            <div className="card">
                                <div className="card-body">
                                    <div style={{ display: 'flex', alignItems: 'center' }} className="mb-3">
                                        <h2 className="text-primary"><b>{graphicTitle}</b></h2>
                                        <div className="dashboard-final-score" style={{ marginLeft: 'auto' }}>
                                            {data.datasets[0].data.length < 15 &&
                                                data.datasets[0].data.map((value, idx) => (
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
        </>
    );
}

export default DashboardGuruMapel;

if (document.getElementById('dashboard-guru-mapel')) {
    ReactDOM.render(<DashboardGuruMapel />, document.getElementById('dashboard-guru-mapel'));
}
