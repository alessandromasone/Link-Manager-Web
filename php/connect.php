<?php
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "link-manager-web";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

function sendJsonResponse($data, $status)
{
    // Crea un array con i dati e lo stato
    $response = array(
        'data' => $data,
        'status' => $status
    );

    // Imposta l'intestazione Content-Type a JSON
    header('Content-Type: application/json');

    // Stampa la risposta JSON
    echo json_encode($response);
}
