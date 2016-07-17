<?php
function connect()
{
    // conexão normal com o banco de dados
    $pdo = new \PDO('mysql:dbname=curso_angularjs;host=localhost', 'webapp', 'webapp');
    if ($pdo) {
        return $pdo;
    }
    return false;
}
