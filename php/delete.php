<?php

require_once('connect.php');

// Verifica se la richiesta è di tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se il parametro 'itemId' è impostato
    if (isset($_POST['itemId'])) {
        $itemId = $_POST['itemId'];

        // Prepara la query di eliminazione
        $sql = "DELETE FROM Directory WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $itemId);

        // Esegui la query
        if ($stmt->execute()) {
            // Verifica se sono state eliminate righe dal database
            if ($stmt->affected_rows > 0) {
                $data = "Elemento eliminato con successo.";
                $status = "success";
            } else {
                $data = "Impossibile trovare l'elemento da eliminare.";
                $status = "error";
            }
        } else {
            $data = "Errore durante l'eliminazione dell'elemento.";
            $status = "error";
        }
    } else {
        $data = "Parametro 'itemId' mancante.";
        $status = "error";
    }
} else {
    $data = "Richiesta non valida.";
    $status = "error";
}

// Richiama la funzione sendJsonResponse
sendJsonResponse($data, $status);
