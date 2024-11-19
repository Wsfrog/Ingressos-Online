<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluir a banda do banco de dados
    $sql = "DELETE FROM bandas WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Banda excluída com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>
