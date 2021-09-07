import React, { useCallback, useState } from 'react'
import { useDropzone } from 'react-dropzone'

function Uploader({ index, onUploadSuccess, default_image }) {
  const [currentUrl, setcurrentUrl] = useState();
  const [uploadStatus, setUploadStatus] = useState(
    "Upload"
  );
  const onDrop = useCallback((acceptedFiles) => {
    acceptedFiles.forEach((file) => {
      const reader = new FileReader()

      reader.onabort = () => console.log('file reading was aborted')
      reader.onerror = () => console.log('file reading has failed')
      reader.onload = () => {
        // Do whatever you want with the file contents
        const binaryStr = reader.result
        setUploadStatus("Uploading..")
        window.axios.post("/backoffice/upload/base64", {
          base64_image: binaryStr
        }).then((response) => {
          console.log(response.data.data)
          setcurrentUrl(response.data.data.image)
          onUploadSuccess(index, response.data.data.image)
          setUploadStatus("")
        })
      }
      reader.readAsDataURL(file)
    })

  }, [])
  const { getRootProps, getInputProps } = useDropzone({ onDrop })

  return (
    <>
      <div {...getRootProps()} style={{
        height: '100px',
        border: "1px dashed #dddddd",
        borderRadius: "5px",
        width: '100px'
      }}>
        <input {...getInputProps()} />
        {currentUrl ?
          <img src={currentUrl} style={{
            height: 'inherit',
            padding:'3px',
          }}  title="Drag Here To Upload Image"></img>
          : <p style={{
            textAlign: 'center', marginTop: '40px'
          }} title="Drag Here To Upload Image">{uploadStatus}</p>}
      </div>
    </>
  )
}

export default Uploader
