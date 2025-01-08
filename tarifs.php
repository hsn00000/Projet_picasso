<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'picasso';
$username = 'root'; // Changez avec votre utilisateur
$password = '&6HAUTdanslaFauré'; // Changez avec votre mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Requête pour récupérer les catégories et tarifs
$query = "SELECT c.id, c.libelle AS categorie, t.prix AS tarif 
          FROM categorie c 
          LEFT JOIN tarifs t ON c.id = t.id";
$stmt = $pdo->query($query);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calcul du tarif total si le formulaire est soumis
$total = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($data as $row) {
        $id = $row['id'];
        $quantite = isset($_POST["quantite_$id"]) ? intval($_POST["quantite_$id"]) : 0;
        $total += $quantite * $row['tarif'];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarifs - Exposition Picasso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container d-flex align-items-center">
            <a href="index.html" class="d-flex align-items-center link-body-emphasis text-decoration-none me-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="32" fill="currentColor" class="bi bi-bank"
                    viewBox="0 0 16 16">
                    <path
                        d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z" />
                </svg>
                <span class="fs-5 fw-bold">Musée de Fauré</span>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="oeuvres.html">Les œuvres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="a-propos.html">À propos de Picasso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="informations.html">Informations pratiques</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tarifs.php">Tarifs</a>
                    </li>
                </ul>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</header>

<body class="bg-dark text-white">
    <main class="container mt-4">

        <center>
            <h1 class="text-white highlight">
                Tarifs
            </h1>
        </center>

        <br>

        <blockquote class="blockquote">
            <p>Découvrez l'univers de Pablo Picasso à travers nos expositions captivantes, accessibles à tous. Notre
                Musée de Picasso, propose une gamme de tarifs adaptés à vos besoins, que vous soyez étudiant, famille ou
                amateur d'art. Profitez d'une expérience unique et enrichissante, tout en explorant les œuvres
                emblématiques et l'héritage artistique de l'un des plus grands maîtres de l'art moderne. Consultez nos
                tarifs ci-dessous et préparez votre visite dès aujourd'hui.</p>
            <footer class="blockquote-footer">Introduction</footer>
        </blockquote>

        <br>

        <p class="light text-white">Retrouvez ci-dessous nos tarifs détaillés présentés sous forme de tableau, afin de
            vous
            permettre de choisir facilement l'option qui correspond le mieux à votre profil et à vos besoins:</p>
        <form method="post" action="">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Catégories</th>
                        <th>Tarifs</th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['categorie']) ?></td>
                            <td><?= htmlspecialchars($row['tarif']) ?> €</td>
                            <td>
                                <input type="number" name="quantite_<?= $row['id'] ?>" min="0" value="0"
                                    class="form-control">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Calculer le total</button>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <div class="alert alert-success mt-3">
                <strong>Tarif total : </strong> <?= htmlspecialchars($total) ?> €
            </div>
        <?php endif; ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

<footer class="footer text-white py-3">
    <div class="container">
        <div class="text-center mt-3">
            <p class="small highlight">&copy; 2024 Musée de Picasso. Tous droits réservés.</p>
        </div>
    </div>
</footer>

</html>