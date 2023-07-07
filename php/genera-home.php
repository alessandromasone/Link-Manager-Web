<?php
require_once('connect.php');

// Funzione ricorsiva per generare la struttura ad albero
function generaStruttura($id_genitore, $conn)
{
    $output = '';

    // Prepara la query utilizzando un prepared statement per evitare SQL injection
    $query = "SELECT * FROM Directory WHERE ID_genitore = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_genitore);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $output = '<ul>';
        while ($row = $result->fetch_assoc()) {
            $id = $row['ID'];
            $nome = $row['Nome'];
            $tipo = $row['Tipo'];

            $output .= '<li data-attrib-id="' . $id . '" data-attrib-type="' . $tipo . '">';
            if ($tipo == 'folder') {
                $output .= '
                    <a>
                        <i class="fas fa-folder-open yellow folder-icon"></i>
                        <span>' . $nome . '</span>
                        <i class="fas fa-solid fa-pen edit-icon" onclick="clickeditbutton(' . $id . ')"></i>
                        <i class="fas fa-plus add-icon" data-attrib-id="' . $id . '" onclick="clickaddbutton(' . $id . ')"></i>
                        <i class="fas fa-trash delete-icon" data-attrib-id="' . $id . '" onclick="clickdeletebutton(' . $id . ')"></i>
                    </a>';
            } else {
                $link = !empty($row['Link']) ? 'href="' . $row['Link'] . '"' : '';
                $output .= '
                    <a ' . $link . '>
                        <span>' . $nome . '</span>
                        <i class="fas fa-solid fa-pen edit-icon" onclick="clickeditbutton(' . $id . ')"></i>
                        <i class="fas fa-trash delete-icon" data-attrib-id="' . $id . '" onclick="clickdeletebutton(' . $id . ')"></i>
                    </a>';
            }


            // Richiama la funzione ricorsivamente per generare i figli dell'elemento corrente
            $output .= generaStruttura($id, $conn);

            $output .= '</li>';
        }

        $output .= '</ul>';
    }

    $stmt->close();

    return $output;
}

// Ottieni l'ID dell'elemento radice dal database
$query = "SELECT ID FROM Directory WHERE ID_genitore IS NULL";
$stmt = $conn->prepare($query);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $rootId = $row['ID'];

    // Genera la struttura della sidebar utilizzando l'ID dell'elemento radice
    $output = '<li data-attrib-id="' . $rootId . '" data-attrib-type="folder">';
    $output .= '<a href="#"><i class="fas fa-folder-open yellow folder-icon"></i> <span> Root</span><i class="fas fa-plus add-icon" data-attrib-id="' . $rootId . '"></i></a>';

    $output .= generaStruttura($rootId, $conn);

    $output .= '</li>';

    echo $output;
} else {
    echo "Errore: impossibile determinare l'elemento radice nel database.";
}

$stmt->close();
$conn->close();
