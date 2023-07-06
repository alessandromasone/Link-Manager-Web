<?php

require_once('connect.php');

if (isset($_GET['folder'])) {
    // Aggiunta di una cartella
    $folderName = $_POST['folderName'];

    if (isset($_POST['parentId']) && !empty($_POST['parentId'])) {
        $parentId = $_POST['parentId'];
    } else {
        // Recupera l'ID della radice dal database
        $query = "SELECT ID FROM Directory WHERE ID_genitore IS NULL";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $parentId = $row['ID'];
        } else {
            // Se non viene trovata la radice nel database, gestisci l'errore di conseguenza
            echo "Errore: ID della radice non trovato";
            return;
        }
    }

    // Prepara la query per l'inserimento della cartella nel database
    $query = "INSERT INTO Directory (Nome, Tipo, ID_genitore) VALUES ('$folderName', 'folder', $parentId)";
    if ($conn->query($query) === TRUE) {
        // Ottieni l'ID generato per il nuovo elemento
        $newItemId = $conn->insert_id;

        // Restituisci l'ID come risposta
        //echo $newItemId;
        $output = '<li data-attrib-id="' . $newItemId . '" data-attrib-type="folder">';

        $output .= '<a href="#"><i class="fas fa-folder-open yellow folder-icon"></i> <span>' . $folderName . '</span><i class="fas fa-plus add-icon" data-attrib-id="' . $newItemId . '" onclick="clickaddbutton(' . $newItemId . ')"></i> <i class="fas fa-trash delete-icon" data-attrib-id="' . $newItemId . '" onclick="clickdeletebutton(' . $newItemId . ')"></i></a></li>';

        echo $output;
    } else {
        echo "Errore durante l'aggiunta della cartella: " . $conn->error;
    }
} else if (isset($_GET['link'])) {
    // Aggiunta di un link
    $linkName = $_POST['folderName'];

    if (isset($_POST['parentId']) && !empty($_POST['parentId'])) {
        $parentId = $_POST['parentId'];
    } else {
        // Recupera l'ID della radice dal database
        $query = "SELECT ID FROM Directory WHERE ID_genitore IS NULL";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $parentId = $row['ID'];
        } else {
            // Se non viene trovata la radice nel database, gestisci l'errore di conseguenza
            echo "Errore: ID della radice non trovato";
            return;
        }
    }

    // Prepara la query per l'inserimento del link nel database
    $query = "INSERT INTO Directory (Nome, Tipo, ID_genitore) VALUES ('$linkName', 'link', $parentId)";
    if ($conn->query($query) === TRUE) {
        // Ottieni l'ID generato per il nuovo elemento
        $newItemId = $conn->insert_id;

        // Restituisci l'ID come risposta
        //echo $newItemId;
        $output = '<li data-attrib-id="' . $newItemId . '" data-attrib-type="link">';

        $output .= '<a href="#"><span>' . $linkName . '</span><i class="fas fa-trash delete-icon" data-attrib-id="' . $newItemId . '" onclick="clickdeletebutton(' . $newItemId . ')"></i></a></li>';
        echo $output;
    } else {
        echo "Errore durante l'aggiunta del link: " . $conn->error;
    }
}



$conn->close();
