<?php
require_once('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = $_POST['itemId'];
    $newName = $_POST['newName'];

    if ($_POST['itemType'] === 'folder') {
        // Esegui la query per aggiornare il nome della cartella nel database
        $query = "UPDATE Directory SET Nome = '$newName' WHERE ID = $itemId";
    } elseif ($_POST['itemType'] === 'link') {
        $newUrl = $_POST['newUrl'];
        // Esegui la query per aggiornare il nome e l'URL del link nel database
        $query = "UPDATE Directory SET Nome = '$newName', Link = '$newUrl' WHERE ID = $itemId";
    } else {
        echo "Tipo di elemento non valido";
        return;
    }

    if ($conn->query($query) === TRUE) {
        echo "Modifica effettuata con successo";
    } else {
        echo "Errore durante la modifica: " . $conn->error;
    }
}

$conn->close();
?>
