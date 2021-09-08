import React, { useEffect, useState, useCallback } from 'react';
import ReactDOM from 'react-dom';
import { AvForm, AvField, AvGroup, AvInput, AvFeedback, AvRadioGroup, AvRadio, AvCheckboxGroup, AvCheckbox } from 'availity-reactstrap-validation';
import { Row, Col, FormGroup, Label, Button } from 'reactstrap';
import Select from 'react-select';
import axios from 'axios';
import YouTube from 'react-youtube';
import useFetch from '../../store/useFetch';

function VideoDetail({ idVideo }) {
    
    var { data, isLoading, isError } = useFetch("/video/"+idVideo+"/json")

    useEffect(() => {
        console.log("dika idVideo", idVideo)
        console.log("dika data", data)
    }, [])

    function _onReady(event) {
        // access to player in all event handlers via event.target
        console.log("dika", event);
        // event.target.pauseVideo();
    }

    function _onEnd(e){
        console.log("dika post flag", e);
    }

    return (<>
        {isLoading ? 
            <p>Loading...</p>
        :
            <YouTube videoId={data?.data?.youtubeId} opts={{
                height: '390',
                width: '640',
                playerVars: {
                    // https://developers.google.com/youtube/player_parameters
                    autoplay: 1,
                },
            }} 
            onReady={_onReady} 
            onEnd={_onEnd}/>
        }
    </>);
}

export default VideoDetail;

var container = document.getElementById("video-detail-fe");

if (container) {
    var idVideo = container.getAttribute("video-id");

    ReactDOM.render(<VideoDetail idVideo={idVideo} />, container);
}