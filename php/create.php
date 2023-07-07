<?php

require_once('connect.php');

if (isset($_GET['folder'])) {
    // Aggiunta di una cartella
    $folderName = $_POST['itemName'];

    if (isset($_POST['parentId']) && !empty($_POST['parentId'])) {
        $parentId = $_POST['parentId'];
    } else {
        // Recupera l'ID della radice dal database
        $query = "SELECT ID FROM Directory WHERE ID_genitore IS NULL";
        $statement = $conn->prepare($query);
        $statement->execute();

        $result = $statement->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $parentId = $row['ID'];
        } else {
            // Se non viene trovata la radice nel database, gestisci l'errore di conseguenza
            $errorMessage = "Errore: ID della radice non trovato";
            sendJsonResponse($errorMessage, 'error');
            return;
        }
    }

    // Prepara la query per l'inserimento della cartella nel database
    $query = "INSERT INTO Directory (Nome, Tipo, ID_genitore) VALUES (?, 'folder', ?)";
    $statement = $conn->prepare($query);
    $statement->bind_param("si", $folderName, $parentId);

    if ($statement->execute()) {
        // Ottieni l'ID generato per il nuovo elemento
        $newItemId = $statement->insert_id;

        // Crea la stringa HTML per la nuova cartella
        $output = '<li data-attrib-id="' . $newItemId . '" data-attrib-type="folder">';
        $output .= '<a href="#"><i class="fas fa-folder-open yellow folder-icon"></i> <span>' . $folderName . '</span><i class="fas fa-solid fa-pen edit-icon" onclick="clickeditbutton(' . $newItemId . ')"></i> <i class="fas fa-plus add-icon" data-attrib-id="' . $newItemId . '" onclick="clickaddbutton(' . $newItemId . ')"></i> <i class="fas fa-trash delete-icon" data-attrib-id="' . $newItemId . '" onclick="clickdeletebutton(' . $newItemId . ')"></i></a></li>';

        // Invia la risposta come JSON
        sendJsonResponse($output, 'success');
    } else {
        $errorMessage = "Errore durante l'aggiunta della cartella: " . $statement->error;
        sendJsonResponse($errorMessage, 'error');
    }

    // Chiudi la connessione al database
    $statement->close();
    $conn->close();
} else if (isset($_GET['link'])) {
    // Aggiunta di un link
    $linkName = $_POST['itemName'];

    if (isset($_POST['itemUrl']) && !empty($_POST['parentId'])) {
        $url = $_POST['itemUrl'];
    } else {
        $url = '';
    }
    if (isset($_POST['parentId']) && !empty($_POST['parentId'])) {
        $parentId = $_POST['parentId'];
    } else {
        // Recupera l'ID della radice dal database
        $query = "SELECT ID FROM Directory WHERE ID_genitore IS NULL";
        $statement = $conn->prepare($query);
        $statement->execute();

        $result = $statement->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $parentId = $row['ID'];
        } else {
            // Se non viene trovata la radice nel database, gestisci l'errore di conseguenza
            $errorMessage = "Errore: ID della radice non trovato";
            sendJsonResponse($errorMessage, 'error');
            return;
        }
    }

    // Prepara la query per l'inserimento del link nel database
    $query = "INSERT INTO Directory (Nome, Tipo, ID_genitore, Link) VALUES (?, 'link', ?, ?)";
    $statement = $conn->prepare($query);
    $statement->bind_param("sis", $linkName, $parentId, $url);

    if ($statement->execute()) {
        // Ottieni l'ID generato per il nuovo elemento
        $newItemId = $statement->insert_id;

        // Crea la stringa HTML per il nuovo link
        $output = '<li data-attrib-id="' . $newItemId . '" data-attrib-type="link">';
        $output .= '<a href="' . $url . '"><span>' . $linkName . '</span><i class="fas fa-solid fa-pen edit-icon" onclick="clickeditbutton(' . $newItemId . ')"></i> <i class="fas fa-trash delete-icon" data-attrib-id="' . $newItemId . '" onclick="clickdeletebutton(' . $newItemId . ')"></i></a></li>';

        // Invia la risposta come JSON
        sendJsonResponse($output, 'success');
    } else {
        $errorMessage = "Errore durante l'aggiunta del link: " . $statement->error;
        sendJsonResponse($errorMessage, 'error');
    }

    // Chiudi la connessione al database
    $statement->close();
    $conn->close();
}
