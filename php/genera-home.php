<?php
require_once('connection.php');

// Funzione ricorsiva per generare la struttura ad albero
function generaStruttura($id_genitore, $conn)
{
    $output = '';
    // Query per selezionare i figli dell'elemento genitore specificato
    $query = "SELECT * FROM Directory WHERE ID_genitore = $id_genitore";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $output = '<ul>';
        while ($row = $result->fetch_assoc()) {
            $id = $row['ID'];
            $nome = $row['Nome'];
            $tipo = $row['Tipo'];

            $output .= '<li data-attrib-id="' . $id . '" data-attrib-type="' . $tipo . '">';
            if ($tipo == 'folder') {
                $output .= '<a href="#"><i class="fas fa-folder-open yellow folder-icon"></i> <span>' . $nome . '</span><i class="fas fa-plus add-icon" data-attrib-id="' . $id . '"></i> <i class="fas fa-trash delete-icon" data-attrib-id="' . $id . '"></i></a>';
            } else {
                $output .= '<a href="#"><span>' . $nome . '</span><i class="fas fa-trash delete-icon" data-attrib-id="' . $id . '"></i></a>';
            }

            // Richiama la funzione ricorsivamente per generare i figli dell'elemento corrente
            $output .= generaStruttura($id, $conn);

            $output .= '</li>';
        }

        $output .= '</ul>';
    }

    $result->free_result();

    return $output;
}

// Ottieni l'ID dell'elemento radice dal database
$query = "SELECT ID FROM Directory WHERE ID_genitore IS NULL";
$result = $conn->query($query);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $rootId = $row['ID'];

    // Genera la struttura della sidebar utilizzando l'ID dell'elemento radice
    $output = '<li data-attrib-id="' . $rootId . '" data-attrib-type="folder">';
    $output .= '<a href="#"><i class="fas fa-folder-open yellow"></i> <span>Root</span></a>';

    $output .= generaStruttura($rootId, $conn);

    $output .= '</li>';

    echo $output;
} else {
    echo "Errore: impossibile determinare l'elemento radice nel database.";
}

$result->free_result();
$conn->close();
?>
