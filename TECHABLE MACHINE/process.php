<?php
// Vérifier si une image a été envoyée
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données de l'image
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['image'])) {
        $imageData = $data['image'];

        // Décoder l'image Base64
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $decodedImage = base64_decode($imageData);

        // Sauvegarder l'image dans un dossier
        $filename = 'uploads/' . uniqid() . '.png';
        file_put_contents($filename, $decodedImage);

        // Simuler une reconnaissance d'objet (à remplacer par une API ou un modèle réel)
        $recognizedObject = 'Pomme'; // Exemple statique, remplacez avec une logique réelle.

        // Retourner le résultat
        echo json_encode(['result' => $recognizedObject]);
    } else {
        echo json_encode(['error' => 'Aucune image reçue.']);
    }
} else {
    echo json_encode(['error' => 'Méthode non autorisée.']);
}
?>
