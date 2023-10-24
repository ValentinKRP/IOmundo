<?php

var_dump('aaaa');

$host = 'localhost';
$dbname = 'interviu';
$username = 'root';
$password = 'root';

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql = "SELECT Name, Email, image_path FROM your_table";
    $stmt = $pdo->query($sql);


    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


    header('Content-Type: application/json');


    echo json_encode($data);
} catch (PDOException $e) {

    echo 'Error: ' . $e->getMessage();
}
