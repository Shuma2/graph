<?php
try{
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=graph', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
}
catch(PDOException $e){
    $error = "DataBase error: " . $e->getMessage();
    $line = date('[d.m.Y H:i:s]: ');
    $log = fopen("inc/ErrorLog.txt", 'a') or die("Unable to create file");
    fwrite($log, $line . $error . "\n") or die ('Unable to write data');
    fclose($log);
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/error.html.php';
    exit();
}