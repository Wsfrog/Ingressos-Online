<?php
session_start();
require 'conexao.php';

// Verifique se o item a ser editado existe
if (isset($_GET['id']) && isset($_GET['quantidade'])) {
    $chave = $_GET['id'];
    $quantidadeAtual = $_GET['quantidade'];

    // Verificar se o item existe no carrinho
    if (isset($_SESSION['carrinho'][$chave])) {
        $item = $_SESSION['carrinho'][$chave];
    } else {
        echo "Item não encontrado no carrinho.";
        exit;
    }
}

// Processar a atualização do carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novaQuantidade = (int)$_POST['quantidade'];

    // Se a quantidade for válida, atualize o carrinho
    if ($novaQuantidade > 0) {
        $_SESSION['carrinho'][$chave]['quantidade'] = $novaQuantidade;
        header("Location: carrinho.php?status=atualizado");
        exit;
    } else {
        echo "Quantidade inválida!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Item no Carrinho</title>
</head>
<body>
    <h1>Editar Item no Carrinho</h1>

    <form action="editar.php?id=<?= $chave ?>" method="post">
        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" value="<?= $quantidadeAtual ?>" min="1" required>
        <button type="submit">Atualizar</button>
    </form>
    
    <br>
    <a href="carrinho.php">Voltar para o Carrinho</a>
</body>
</html>
