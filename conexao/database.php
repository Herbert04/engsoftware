<?php
$user = 'root';
$pw = '';
$host = 'localhost';
$db = 'engsoftware';
try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8;", $user, $pw);
    $conn->query("SET NAMES utf8");
} catch (Exception $e) {
    die("Erro na conexão com o DB: " . $e->getMessage());
}
?>
