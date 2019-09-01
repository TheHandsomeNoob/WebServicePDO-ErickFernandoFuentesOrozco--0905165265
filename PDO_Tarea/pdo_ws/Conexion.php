<?php

$host         = "localhost";
$username     = "root";
$password     = "";
$dbname       = "dbpaginasweb";

try {
    $Conexion = new PDO('mysql:host=localhost;dbname=dbpaginasweb', $username, $password);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}