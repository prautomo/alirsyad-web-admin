import React, { useEffect, useState, useCallback } from 'react';
import ReactDOM from 'react-dom';
import { AvForm, AvField, AvGroup, AvInput, AvFeedback, AvRadioGroup, AvRadio, AvCheckboxGroup, AvCheckbox } from 'availity-reactstrap-validation';
import { Row, Col, FormGroup, Label, Button } from 'reactstrap';
import Select from 'react-select';
import axios from 'axios';
import useFetch from '../../../store/useFetch';
import ModulPicker from './ModulPicker';

function StoryPathForm({ idStoryPath, cancelLink }) {

    const [simulasis, setSimulasis] = useState([]);
    const [isRequest, setIsRequest] = useState(false);
    const [selectedModul, setSelectedModul] = useState({});
    const [selectedSimulasi, setSelectedSimulasi] = useState({});
    const [selectedSimulasis, setSelectedSimulasis] = useState([
        {simulasi: {
            value: 1,
            label: 'ada',
        }}
    ]);

    useEffect(() => {
        console.log("dika idStoryPath", idStoryPath)
    }, [selectedSimulasis])

    function getSimulasis(mapelId) {
        setIsRequest(true)
		axios.get('/backoffice/story-paths/simulasis/'+mapelId, { headers: { "Content-Type": "application/json" } }).then(function (response) {
			var data = response.data;

            if(data){
                setSimulasis(data);
            }

			setIsRequest(false)
        })
    }

    /**
     * onchange modul
     * @param {*} modulValue 
     */
    function onChangeModul(modulValue){
        // set modul
        setSelectedModul(modulValue);

        // init empty simulasis
        setSimulasis([]);

        // get simulasis by mapel id
        getSimulasis(modulValue?.mata_pelajaran_id);
    }

    function save(){
        console.log("selected Modul", selectedModul)
    }

    function handleOnChangeSimulasi(selected, idx) {
        let nextData = selectedSimulasis.slice();

        nextData[idx].item = selected;    

        setSelectedSimulasis(nextData);
      }    

    function handleAddSimulasi() {
        console.log("dika", selectedSimulasis)
        let array = selectedSimulasis;
        
        array.push({ simulasi: "" });
        
        setSelectedSimulasis(array);
    };

    function handleRemoveSimulasi(idx) {
        let array = selectedSimulasis;

        array.splice(idx, 1);
        
        setSelectedSimulasis(array);
    };    

    return (<AvForm onValidSubmit={save}>
        <Row>
            <Col md="12">
                <AvGroup>
                    <Label className="form-control-label" for="name">
                        Name
                    </Label>
                    <AvInput name="name" id="name" required />
                    <AvFeedback>The name field is required.</AvFeedback>
                </AvGroup>  
            </Col> 

            <Col md="12">
                <AvGroup>
                    <Label className="form-control-label" for="modul">
                        Modul
                    </Label>

                    <ModulPicker 
                        selectedItem={selectedModul}
                        setSelectedItem={onChangeModul}
                    />
                </AvGroup>  
            </Col>

            <Col md="12">
                <Label className="form-control-label" for="simulasi">
                    Simulasi
                </Label>
                <table className="table">
                    <thead>
                        <tr>
                            <th width="90%">Simulasi</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {selectedSimulasis.map((simulasi, idx) => {
                            return (
                        <tr>
                            <th>
                                <Select 
                                    placeholder={"Pilih Simulasi"}
                                    value={simulasi.simulasi}
                                    options={simulasis}
                                    required
                                    onChange={(selected) => {
                                        return handleOnChangeSimulasi(
                                            selected,
                                            idx
                                        );
                                    }}
                                />
                            </th>
                            <th>
                                <a onClick={() => handleRemoveSimulasi(idx)}>Delete</a>
                            </th>
                        </tr>
                            )
                        })}
                        <tr>
                            <td colSpan="2" className="text-right">
                                <Button color="primary" size="sm" onClick={handleAddSimulasi}>Add</Button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Col>

            <Col md="12" className="text-right mt-3">
                <Button color="primary" size="sm">Save</Button>
                <Button color="secondary" size="sm" onClick={()=>window.location.href = cancelLink}>Cancel</Button>
            </Col>
        </Row>
    </AvForm>);
}

export default StoryPathForm;

if (document.getElementById('form-story-path')) {
    var container = document.getElementById("form-story-path");
    var idStoryPath = container.getAttribute("idStoryPath");
    var cancelLink = container.getAttribute("cancel-link");

    ReactDOM.render(<StoryPathForm idStoryPath={idStoryPath} cancelLink={cancelLink} />, container);
}