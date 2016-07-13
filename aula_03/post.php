<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

require_once 'connection.php';

function findAll()
{
    $pdo = connect();
    $stmt = $pdo->prepare("SELECT * FROM clientes ORDER BY nome DESC");
    $stmt->execute();
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($result);
}

findAll();
