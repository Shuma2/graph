<?php
try{
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=graph', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
}
catch(PDOException $e){
    $error = 'Error connecting to database: ' . $e->getMessage();
    include 'error.html.php';
    exit();
}