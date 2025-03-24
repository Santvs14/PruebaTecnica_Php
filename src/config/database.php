<?php

$host = 'localhost';
 $db = 'my_database';
 $user = 'mysql';
 $pass = 'userpassword';
 $dsn = "mysql:host=$host;dbname=$db";


 
 try {
    // Crear una conexión PDO
    $pdo = new PDO($dsn, $user, $pass);
    // Configurar el manejo de errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Error en la conexión
    echo 'Error de conexión: ' . $e->getMessage();
    exit();
}
?>