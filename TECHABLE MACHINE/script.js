const video = document.getElementById('videoElement');
const canvas = document.getElementById('canvas');
const captureButton = document.getElementById('captureButton');
const outputDiv = document.getElementById('output');

// Activer la caméra
navigator.mediaDevices.getUserMedia({ video: true })
  .then((stream) => {
    video.srcObject = stream;
  })
  .catch((err) => {
    console.error("Erreur d'accès à la caméra : ", err);
  });

// Capturer une image et l'envoyer au serveur
captureButton.addEventListener('click', () => {
  const context = canvas.getContext('2d');
  // Dessiner l'image actuelle de la vidéo sur le canvas
  context.drawImage(video, 0, 0, canvas.width, canvas.height);

  // Convertir le canvas en une image Base64
  const imageData = canvas.toDataURL('image/png');

  // Envoyer l'image au serveur via AJAX
  fetch('process.php', {
    method: 'POST',
    body: JSON.stringify({ image: imageData }),
    headers: { 'Content-Type': 'application/json' }
  })
  .then(response => response.json())
  .then(data => {
    // Afficher les résultats
    outputDiv.innerHTML = `<h3>Objet détecté : ${data.result}</h3>`;
  })
  .catch(error => console.error('Erreur :', error));
});
