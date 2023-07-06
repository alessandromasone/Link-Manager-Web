<?php
require_once('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = $_POST['itemId'];
    $newName = $_POST['newName'];

    // Esegui la query per aggiornare il nome dell'elemento nel database
    $query = "UPDATE Directory SET Nome = '$newName' WHERE ID = $itemId";

    if ($conn->query($query) === TRUE) {
        echo "Modifica del nome effettuata con successo";
    } else {
        echo "Errore durante la modifica del nome: " . $conn->error;
    }
}

$conn->close();
?>
