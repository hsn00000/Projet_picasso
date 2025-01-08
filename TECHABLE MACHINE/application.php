<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application de Reconnaissance d'Objets</title>
  <style>
    video, canvas {
      border: 2px solid #000;
      display: block;
      margin: 10px auto;
      max-width: 100%;
    }
  </style>
</head>
<body>
  <h1>Reconnaissance d'Objets</h1>
  <!-- Vidéo en direct -->
  <video id="videoElement" autoplay></video>
  <!-- Canvas pour capturer une image -->
  <canvas id="canvas" width="640" height="480" style="display: none;"></canvas>
  <!-- Bouton pour capturer une image -->
  <button id="captureButton">Capturer</button>
  <!-- Zone pour afficher les résultats -->
  <div id="output"></div>

  <!-- Inclure le script JavaScript -->
  <script src="script.js"></script>
</body>
</html>


