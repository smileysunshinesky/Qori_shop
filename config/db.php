<?php
// session_start();

$server = 'localhost';
$dbuser = 'root';
$dbpass = '';
$database = 'qorishop';


try {
    $conn = mysqli_connect($server, $dbuser, $dbpass, $database);
} catch (PDOException $e) {
    if (!$conn) {
        die ("Connection error: " . mysqli_connect_error());
    }
    // die("Error de conexión a la base de datos: " . $e->getMessage());
}

mysqli_set_charset($conn, "utf8");

?>