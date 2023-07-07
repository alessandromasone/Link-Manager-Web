<?php
require_once('connect.php');

// Funzione per aggiornare l'ID genitore di un elemento
function updateParentId($itemId, $newParentId)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE Directory SET ID_genitore = ? WHERE ID = ?");
    $stmt->bind_param("ii", $newParentId, $itemId);

    if ($stmt->execute()) {
        return "ID genitore aggiornato con successo.";
    } else {
        return "Errore durante l'aggiornamento dell'ID genitore: " . $stmt->error;
    }
}

// Funzione per verificare se un elemento può essere spostato in un nuovo genitore
function canMoveToParent($itemId, $newParentId)
{
    global $conn;

    $itemType = null;
    $parentType = null;

    // Verifica se l'elemento da spostare è una cartella o un file
    $query = "SELECT Tipo FROM Directory WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($itemType);

    if ($stmt->fetch()) {
        // Verifica se il nuovo genitore è una cartella
        $query = "SELECT Tipo FROM Directory WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $newParentId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($parentType);

        if ($stmt->fetch()) {
            if ($itemType === 'file' && $parentType !== 'folder') {
                return "Un file può essere spostato solo all'interno di una cartella.";
            }
        } else {
            return "Il genitore specificato non esiste.";
        }
    } else {
        return "L'elemento specificato non esiste.";
    }

    return true;
}

// Verifica se la richiesta è una richiesta POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se i parametri necessari sono impostati
    if (isset($_POST['itemId']) && isset($_POST['newParentId']) && !empty($_POST['itemId']) && !empty($_POST['newParentId'])) {
        // Ottieni i dati dalla richiesta POST
        $itemId = $_POST['itemId'];
        $newParentId = $_POST['newParentId'];

        // Verifica se l'elemento può essere spostato nel nuovo genitore
        $canMove = canMoveToParent($itemId, $newParentId);

        if ($canMove === true) {
            // Effettua l'aggiornamento dell'ID genitore
            $result = updateParentId($itemId, $newParentId);

            // Invia la risposta come JSON
            sendJsonResponse($result, 'success');
        } else {
            // Invia un messaggio di errore
            sendJsonResponse($canMove, 'error');
        }
    } else {
        // Invia un messaggio di errore se mancano i parametri necessari
        sendJsonResponse('Parametri mancanti.', 'error');
    }
} else {
    // Invia un messaggio di errore se la richiesta non è una richiesta POST
    sendJsonResponse('Metodo non consentito.', 'error');
}
