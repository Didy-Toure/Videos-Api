<?php
include_once 'include/config.php';

// Créer la connexion
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "\n");
}

// Afficher les commentaires 
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getVideoComments' && isset($_GET['video_id'])) {
    $videoId = $_GET['video_id'];

    $stmt = $conn->prepare("SELECT * FROM avis WHERE video_id = ?");
    $stmt->bind_param("i", $videoId);

    $result = $stmt->execute();

    if (!$result) {
        die("Erreur lors de l'exécution de la requête : " . $stmt->error);
    }

    $comments = array();
    $commentResult = $stmt->get_result();

    while ($row = $commentResult->fetch_assoc()) {
        $comments[] = $row;
    }

    $stmt->close();

    if (empty($comments)) {
        echo "Aucun commentaire trouvé pour la vidéo avec l'ID $videoId.";
    } else {
        header ('Content-Type: application/json');
        echo json_encode($comments, JSON_PRETTY_PRINT);
    }
}


// Ajout dun commentaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'addComment') {
    $requiredFields = ['id', 'video_id', 'note', 'commentaire'];


    if (array_reduce($requiredFields, function ($carry, $field) {
        return $carry && isset($_POST[$field]);
    }, true)) {
        $sql = "INSERT INTO avis (id, video_id, note, commentaire) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param(
                "iiss",
                $_POST['id'], $_POST['video_id'], $_POST['note'], $_POST['commentaire']
            );

            $result = $stmt->execute();

            if (!$result) {
                die("Erreur lors de l'exécution de la requête : " . $stmt->error);
            }

            echo "Commentaire ajouté avec succès.";
        } else {
            die("Erreur lors de la préparation de la requête : " . $conn->error);
        }
    } else {
        echo "Veuillez spécifier les champs suivants : " . implode(', ', $requiredFields);
    }
}

//mise a jour de la note 
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['action']) && $_GET['action'] === 'updateVideoScore' && isset($_POST['id']) && isset($_POST['note'])) {
    $videoId = $_POST['id'];
    $newNote = $_POST['note'];

    $stmt = $conn->prepare("UPDATE videos SET note = ? WHERE id = ?");
    $stmt->bind_param("ii", $newNote, $videoId);

    $result = $stmt->execute();

    if (!$result) {
        die("Erreur lors de la mise à jour du score : " . $stmt->error);
    }

    echo "Score mis à jour avec succès.";

    $stmt->close();
}

// Fermer la connexion
$conn->close();
?>
