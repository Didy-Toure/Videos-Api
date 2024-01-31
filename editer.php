<?php
include_once 'include/config.php';

// Créer la connexion
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "\n");
}

// Update la video 3

if ((($_SERVER['REQUEST_METHOD'] === 'PUT') || ($_SERVER['REQUEST_METHOD'] === 'GET')) && isset($_GET['id'])) {
    $videoId = $_GET['id'];
    
    $sql = "UPDATE videos SET nom = ?, description = ?, code = ?, categories = ?, auteur_nom = ?, auteur_utilisateur = ?, auteur_verifie = ?, auteur_courriel = ?, auteur_facebook = ?, auteur_instagram = ?, auteur_twitch = ?, auteur_site_web = ?, auteur_description = ?, date_publication = ?, duree = ?, nombre_vues = ?, score = ?, sous_titres = ? WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param(
        "sssssssssssssssssi",
        
        $_GET['nom'], $_GET['description'], $_GET['code'], $_GET['categories'], $_GET['auteur_nom'],
        $_GET['auteur_utilisateur'], $_GET['auteur_verifie'], $_GET['auteur_courriel'], $_GET['auteur_facebook'],
        $_GET['auteur_instagram'], $_GET['auteur_twitch'], $_GET['auteur_site_web'], $_GET['auteur_description'],
        $_GET['date_publication'], $_GET['duree'], $_GET['nombre_vues'], $_GET['score'], $_GET['sous_titres'], $videoId
    );
    
    $result = $stmt->execute();
    
    if (!$result) {
        die("Erreur lors de l'exécution de la requête: " . $stmt->error);
    }
    
    echo "La vidéo a été mise à jour avec succès.";
}



?>