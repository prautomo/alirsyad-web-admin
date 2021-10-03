import React, { useEffect, useState, useCallback } from 'react';
import ReactDOM from 'react-dom';
import { Row, Col, FormGroup, Label, Button } from 'reactstrap';
import axios from 'axios';
import YouTube from 'react-youtube';
import useFetch from '../../../store/useFetch';
import { Provider as AlertProvider } from 'react-alert'
import AlertTemplate from 'react-alert-template-basic'
import { useAlert } from 'react-alert'

function VideoDetail({ idVideo, rel }) {
    
    const [videoId, setVideoId] = useState(idVideo);
    const [showNext, setShowNext] = useState(false);

    const { data, isLoading, isError } = useFetch("/video/"+idVideo+"/json")
    const alert = useAlert()

    useEffect(() => {
        console.log("dika idVideo", idVideo, rel)
    }, [])

    function _onReady(event) {
        // access to player in all event handlers via event.target
        // console.log("dika", event);
        // event.target.pauseVideo();
        setShowNext(data?.data?.watched ?? false);
    }

    function _onEnd(e){
        // console.log("dika post flag", e);
        postFlag(videoId);
    }

    async function postFlag(idVideo){
        const payload = {};

        await axios.post(`/videos/${idVideo}/flag/json`, { payload })
        .then(res => {
            // if from modul
            if(rel){
                console.log("dika close tab", rel)
                window.close();
                close();
            }
            setShowNext(true);
            // console.log("dika res post flag", res.data);
            alert.show('Berhasil menonton video!', {
                timeout: 3000, // custom timeout just for this one alert
                type: 'success',
                onOpen: () => {
                    
                }, // callback that will be executed after this alert open
                onClose: () => {
                   
                } // callback that will be executed after this alert is removed
            })
        }).catch((e) => {
            console.error("dika res post flag failed", e.response.data)
            alert.show(e.response.data?.message, {
                timeout: 3000, // custom timeout just for this one alert
                type: 'error',
                onOpen: () => {
                    
                }, // callback that will be executed after this alert open
                onClose: () => {
                   
                } // callback that will be executed after this alert is removed
            })
        })
    }

    return (<>
        {isLoading ? 
            <p>Loading...</p>
        :
        <>
            <YouTube videoId={data?.data?.youtubeId} opts={{
                height: '600',
                width: '100%',
                playerVars: {
                    // https://developers.google.com/youtube/player_parameters
                    fs: 1,
                    autoplay: 0,
                    controls: 1,
                    disablekb: 1,
                    rel: 0, 
                },
            }} 
            onReady={_onReady} 
            onEnd={_onEnd}/>

            {(data?.data?.previous?.url) &&
            <Button className="mt-4 btn-main mr-4 btn-small" href={data?.data?.previous?.url}>Video Sebelumnya</Button>
            }

            {(showNext && data?.data?.next?.url) &&
            <Button className="mt-4 btn-main btn-small" href={data?.data?.next?.url}>Video Berikutnya</Button>
            }
        </>
        }
    </>);
}

export default VideoDetail;

const options = {
    position: 'bottom right',
    timeout: 3000,
    offset: '30px',
    transition: 'scale'
}

const RootVideoDetail = (props) => {
    return (
    <AlertProvider template={AlertTemplate} {...options}>
        <VideoDetail idVideo={props?.idVideo} rel={props?.rel} />
    </AlertProvider>
    )
}

var container = document.getElementById("video-detail-fe");

if (container) {
    var idVideo = container.getAttribute("video-id");
    var rel = container.getAttribute("video-rel");

    ReactDOM.render(<RootVideoDetail idVideo={idVideo} rel={rel} />, container);
}