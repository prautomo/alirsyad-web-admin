import React from 'react';
import { Tab, Tabs } from 'react-bootstrap';

const SoalComponent = ({ }) => {
    // LOCAL STATE

    // USE EFFECT HOOK
    const addTab = () => {
        return "";
    }

    // RENDER
    return (
        <>
            <Tabs
                defaultActiveKey="soal_1"
                id="uncontrolled-tab-example"
                className="mb-3"
            >
                <Tab eventKey="soal_1" title="Soal 1">
                    Soal 1
                </Tab>
                <Tab eventKey="soal_2" title="Soal 2">
                    Soal 2
                </Tab>
            </Tabs>
        </>
    );
};

export default SoalComponent;