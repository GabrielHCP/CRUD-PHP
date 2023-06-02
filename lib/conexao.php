<?php

$host = "localhost";
$db = "projeto";
$user = "root";
$pass = "";

$mysqli = new mysqli($host, $user, $pass, $db);
if($mysqli->connect_errno) {
    die("Falha na conexão com o banco de dados");
}

// Código para conexão com banco de dados