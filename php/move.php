<?php

require_once('connect.php');

// Funzione per aggiornare l'ID genitore di un elemento
function updateParentId($itemId, $newParentId)
{
    global $conn;

    $sql = "UPDATE Directory SET ID_genitore = '$newParentId' WHERE ID = '$itemId'";
    if ($conn->query($sql) === TRUE) {
        return "ID genitore aggiornato con successo.";
    } else {
        return "Errore durante l'aggiornamento dell'ID genitore: " . $conn->error;
    }
}

// Verifica se la richiesta è una richiesta POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ottieni i dati dalla richiesta POST
    $itemId = $_POST['itemId'];
    $newParentId = $_POST['newParentId'];

    // Effettua l'aggiornamento dell'ID genitore
    $result = updateParentId($itemId, $newParentId);

    // Restituisci la risposta come JSON
    header('Content-Type: application/json');
    echo json_encode($result);
} else {
    // Restituisci un messaggio di errore se la richiesta non è una richiesta POST
    echo "Metodo non consentito.";
}
