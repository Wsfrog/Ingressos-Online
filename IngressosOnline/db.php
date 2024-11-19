<?php
// db.php - Conexão com o banco de dados

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "venda_ingressos"; // Substitua pelo nome do seu banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
