<?php
//ESTILO POR PROCEDIMIENTOS

$host="localhost";
$user="root";
$pass="root";
$db="reread";

//Crear la conexión
$conn = mysqli_connect($host, $user, $pass, $db);

//Checkear la conexión
if ($conn){
    echo "Error: Nose puedo conectar a MySQL.". PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}else{
    mysqli_set_charset($conn, "utf8");
}
?>