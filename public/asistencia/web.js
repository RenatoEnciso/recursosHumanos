const video = document.getElementById("video");
const persona = document.getElementById("id");

var inputs = document.getElementsByName("archivos");

let labels=[];
  for (let i = 0; i < inputs.length; i++) {
    labels.push(inputs[i].value);
  }

  // labels = ["Messi","Renato"];

Promise.all([
  faceapi.nets.ssdMobilenetv1.loadFromUri("asistencia/models"),
  faceapi.nets.faceRecognitionNet.loadFromUri("asistencia/models"),
  faceapi.nets.faceLandmark68Net.loadFromUri("asistencia/models"),
]).then(startWebcam);

function startWebcam() {
  navigator.mediaDevices
    .getUserMedia({
      video: true,
      audio: false,
    })
    .then((stream) => {
      video.srcObject = stream;
    })
    .catch((error) => {
      console.error(error);
    });
}

function getLabeledFaceDescriptions() {
  
  return Promise.all(
    labels.map(async (label) => {
      const descriptions = [];
      for (let i = 1; i <= 1; i++) {
        const img = await faceapi.fetchImage(`./storage/archivosFotoPerfil/${label}.jpg`);
        const detections = await faceapi
          .detectSingleFace(img)
          .withFaceLandmarks()
          .withFaceDescriptor();
        descriptions.push(detections.descriptor);
      }
      return new faceapi.LabeledFaceDescriptors(label, descriptions);
    })
  );
}

video.addEventListener("play", async () => {
  const labeledFaceDescriptors = await getLabeledFaceDescriptions();
  const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);

  const canvas = faceapi.createCanvasFromMedia(video);
  document.body.append(canvas);

  const displaySize = { width: video.width, height: video.height };
  faceapi.matchDimensions(canvas, displaySize);

  setInterval(async () => {
    const detections = await faceapi
      .detectAllFaces(video)
      .withFaceLandmarks()
      .withFaceDescriptors();

    const resizedDetections = faceapi.resizeResults(detections, displaySize);

    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);

    const results = resizedDetections.map((d) => {
      return faceMatcher.findBestMatch(d.descriptor);
    });
    results.forEach((result, i) => {
      const box = resizedDetections[i].detection.box;
      const drawBox = new faceapi.draw.DrawBox(box, {
        label: result,
        
      });
      drawBox.draw(canvas);
      if(result.label==persona.value){
        console.log("Es renato.FIN");
        //manda que haga click el boton 
      }
      console.log(result.label);
    });
  }, 100);
});
