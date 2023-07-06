<?php

require_once('connect.php');

// Verifica se la richiesta è di tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se il parametro 'id' è impostato
    if (isset($_POST['itemId'])) {
        $itemId = $_POST['itemId'];

        // Elimina l'elemento dal database
        $sql = "DELETE FROM Directory WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $itemId);
        $success = $stmt->execute();

        if ($success) {
            echo "Elemento eliminato con successo.";
        } else {
            echo "Impossibile eliminare l'elemento.";
        }
    }
}
