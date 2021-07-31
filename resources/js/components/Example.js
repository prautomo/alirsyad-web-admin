import React, { useEffect } from 'react';
import ReactDOM from 'react-dom';
import useLocationStore from '../store/LocationStore';

function Example({ data }) {
    var { hasError, latitude,  longitude, setCurrentPosition } = useLocationStore()


    useEffect(() => {
        navigator.geolocation.getCurrentPosition(function (position) {
            setCurrentPosition({ latitude: position.coords.latitude, longitude: position.coords.longitude , error: false })
        } ,  function (err) {
            setCurrentPosition({ latitude: null, longitude: null ,  error:  true})
        });
    }, []);

    


    return (
        <>
        </>
    );
}

export default Example;

if (document.getElementById('example')) {
    var data = document.getElementById('example').getAttribute("data")

    ReactDOM.render(<Example data={data} />, document.getElementById('example'));
}
