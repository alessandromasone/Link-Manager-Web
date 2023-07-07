<?php
require_once('connect.php');

function updateItem($itemId, $newName, $newUrl = null)
{
    global $conn;

    if ($newUrl !== null) {
        // Prepara la query per aggiornare il nome e l'URL dell'elemento nel database
        $query = "UPDATE element SET Nome = ?, Link = ? WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi', $newName, $newUrl, $itemId);
    } else {
        // Prepara la query per aggiornare solo il nome dell'elemento nel database
        $query = "UPDATE element SET Nome = ? WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $newName, $itemId);
    }

    if ($stmt->execute()) {
        return "Modifica effettuata con successo";
    } else {
        return "Errore durante la modifica: " . $stmt->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se i parametri necessari sono presenti
    if (isset($_POST['itemId'], $_POST['newName'], $_POST['itemType'])) {
        $itemId = $_POST['itemId'];
        $newName = $_POST['newName'];
        $itemType = $_POST['itemType'];

        if ($itemType === 'folder') {
            // Aggiorna il nome della cartella
            $result = updateItem($itemId, $newName);
        } elseif ($itemType === 'link') {
            if (isset($_POST['newUrl'])) {
                $newUrl = $_POST['newUrl'];
                // Aggiorna il nome e l'URL del link
                $result = updateItem($itemId, $newName, $newUrl);
            } else {
                $result = "URL mancante per l'elemento di tipo link";
            }
        } else {
            $result = "Tipo di elemento non valido";
        }

        // Invia la risposta come JSON
        sendJsonResponse($result, 'success');
    } else {
        // Invia un messaggio di errore se i parametri necessari non sono presenti
        sendJsonResponse("Parametri mancanti", 'error');
    }
}

$conn->close();
