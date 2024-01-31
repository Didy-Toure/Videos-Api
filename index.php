<?php
include_once 'include/config.php';

// Créer la connexion
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "\n");
}



// Afficher toutes les vidéos en json

$sqlAllVideos = "SELECT * FROM videos";

$resultAllVideos = $conn->query($sqlAllVideos);

if (!$resultAllVideos) {
    die("Erreur lors de l'exécution de la requête: " . $conn->error);
}

if ($resultAllVideos->num_rows > 0) {
    $rows = array();
    while($row = $resultAllVideos->fetch_assoc()) {
        $rows[] = $row;
    }
    header ('Content-Type: application/json');
    echo json_encode($rows, JSON_PRETTY_PRINT);

} else {
    echo "Aucune vidéo trouvée.";
}

//Ajout dune video 
if (isset($_GET['action']) && $_GET['action'] === 'addVideo') {
    $requiredFields = ['id', 'nom', 'description', 'code', 'categories', 'auteur_nom', 'auteur_utilisateur', 'auteur_verifie', 'auteur_courriel', 'auteur_facebook', 'auteur_instagram', 'auteur_twitch', 'auteur_site_web', 'auteur_description', 'date_publication', 'duree', 'nombre_vues', 'score', 'sous_titres'];

    if (array_reduce($requiredFields, function ($carry, $field) {
        return $carry && isset($_GET[$field]);
    }, true)) {
        $sql = "INSERT INTO videos (id, nom, description, code, categories, auteur_nom, auteur_utilisateur, auteur_verifie, auteur_courriel, auteur_facebook, auteur_instagram, auteur_twitch, auteur_site_web, auteur_description, date_publication, duree, nombre_vues, score, sous_titres) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
          
            $stmt->bind_param(
                "ssssssssssssssssssi",
                $_GET['id'], $_GET['nom'], $_GET['description'], $_GET['code'], $_GET['categories'], $_GET['auteur_nom'],
                $_GET['auteur_utilisateur'], $_GET['auteur_verifie'], $_GET['auteur_courriel'], $_GET['auteur_facebook'],
                $_GET['auteur_instagram'], $_GET['auteur_twitch'], $_GET['auteur_site_web'], $_GET['auteur_description'],
                $_GET['date_publication'], $_GET['duree'], $_GET['nombre_vues'], $_GET['score'], $_GET['sous_titres']
            );

            $result = $stmt->execute();

            if (!$result) {
                die("Erreur lors de l'exécution de la requête: " . $stmt->error);
            }

            $stmt->close();
            echo "La vidéo a été ajoutée avec succès.";
        } else {
            die("Erreur de préparation de la requête SQL: " . $conn->error);
        }
    } else {
        echo "Les données entrees ne sont pas valides.";
    }
}


//suppression de la video 
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['action']) && $_GET['action'] === 'deleteVideo') {
  
    $result = $conn->query("SELECT id FROM videos LIMIT 1");

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $videoId = $row['id'];

        $stmt = $conn->prepare("DELETE FROM videos WHERE id = ?");
        $stmt->bind_param("i", $videoId);
        $resultDeleteVideo = $stmt->execute();

        if (!$resultDeleteVideo) {
            die("Erreur lors de la suppression de la vidéo : " . $stmt->error);
        }

        $stmt->close();
        echo "La première vidéo a été supprimée avec succès.";
    } else {
        echo "Aucune vidéo trouvée.";
    }
}






// Fermer la connexion
$conn->close();
?>
