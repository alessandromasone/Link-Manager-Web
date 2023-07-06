<?php
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Preferiti";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
