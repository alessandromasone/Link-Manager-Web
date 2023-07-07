<?php
require_once('connect.php');

function updateItem($itemId, $newName, $newUrl = null)
{
    global $conn;

    if ($newUrl !== null) {
        $query = "UPDATE Directory SET Nome = ?, Link = ? WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi', $newName, $newUrl, $itemId);
    } else {
        $query = "UPDATE Directory SET Nome = ? WHERE ID = ?";
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
    if (isset($_POST['itemId'], $_POST['newName'], $_POST['itemType'])) {
        $itemId = $_POST['itemId'];
        $newName = $_POST['newName'];
        $itemType = $_POST['itemType'];

        if ($itemType === 'folder') {
            $result = updateItem($itemId, $newName);
        } elseif ($itemType === 'link') {
            if (isset($_POST['newUrl'])) {
                $newUrl = $_POST['newUrl'];
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
