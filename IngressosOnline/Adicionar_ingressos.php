<?php
// Conectar ao banco de dados
$conn = new mysqli('localhost', 'root', '', 'venda_ingressos');

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Inicializar variáveis com valores padrão para evitar warnings
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
$imagem_url = isset($_POST['imagem_url']) ? $_POST['imagem_url'] : '';
$preco = isset($_POST['preco']) ? $_POST['preco'] : '';

// Função para escapar strings e prevenir SQL Injection
function escape($conn, $data) {
    return $conn->real_escape_string(trim($data));
}

// ADICIONAR
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar'])) {
    $nome = escape($conn, $_POST['nome']);
    $descricao = escape($conn, $_POST['descricao']);
    $imagem_url = escape($conn, $_POST['imagem_url']);
    $preco = escape($conn, $_POST['preco']);

    if (!empty($nome) && !empty($descricao) && !empty($imagem_url) && !empty($preco)) {
        $sql = "INSERT INTO bandas (nome, descricao, imagem_url, preco) VALUES ('$nome', '$descricao', '$imagem_url', '$preco')";
        if ($conn->query($sql) === TRUE) {
            echo "Banda cadastrada com sucesso!";
        } else {
            echo "Erro ao cadastrar banda: " . $conn->error;
        }
    } else {
        echo "Preencha todos os campos!";
    }
}

// EDITAR
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $id = (int) $_POST['id'];
    $nome = escape($conn, $_POST['nome']);
    $descricao = escape($conn, $_POST['descricao']);
    $imagem_url = escape($conn, $_POST['imagem_url']);
    $preco = escape($conn, $_POST['preco']);

    if (!empty($nome) && !empty($descricao) && !empty($imagem_url) && !empty($preco)) {
        $sql = "UPDATE bandas SET nome='$nome', descricao='$descricao', imagem_url='$imagem_url', preco='$preco' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Banda atualizada com sucesso!";
        } else {
            echo "Erro ao atualizar banda: " . $conn->error;
        }
    } else {
        echo "Preencha todos os campos!";
    }
}

// EXCLUIR
if (isset($_GET['excluir'])) {
    $id = (int) $_GET['excluir'];
    $sql = "DELETE FROM bandas WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Banda excluída com sucesso!";
    } else {
        echo "Erro ao excluir banda: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Bandas</title>
</head>
<body>

<div class="navbar">
   
    <a href="homepage.php#home" class="active">Home</a>
    <a href="homepage.php#sobre">Sobre Nós</a>
    <a href="homepage.php#contato">Contato</a>
</div>

    <!-- Formulário para Adicionar -->
    <h2>Adicionar Nova Banda</h2>
    <form method="POST" action="Adicionar_ingressos.php">
        <input type="hidden" name="adicionar" value="1">
        <label for="nome">Nome da Banda:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="4" required></textarea>

        <label for="imagem_url">URL da Imagem:</label>
        <input type="text" id="imagem_url" name="imagem_url" required>

        <label for="preco">preco do show:</label>
        <input type="number" id="preco" name="preco" required>
        <br><br>

        <button type="submit">Cadastrar Banda</button>
    </form>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cae4c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 15px;
            text-align: left;
        }

        table th {
            background-color: #5cb85c;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table img {
            max-width: 100px;
            border-radius: 4px;
        }

        table a {
            color: #007bff;
            text-decoration: none;
            margin-left: 10px;
        }

        table a:hover {
            text-decoration: underline;
        }

        form[style='display:inline-block;'] {
            margin: 0;
            padding: 0;
        }

        form[style='display:inline-block;'] input, 
        form[style='display:inline-block;'] textarea {
            margin-bottom: 5px;
            padding: 5px;
            font-size: 12px;
        }

        form[style='display:inline-block;'] button {
            padding: 5px 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <!-- Listagem das Bandas -->
    <h2>Bandas Cadastradas</h2>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Imagem</th>
            <th>preco</th>
            <th>Ações</th>
        </tr>
        <?php
        // Listar Bandas
        $result = $conn->query("SELECT * FROM bandas");
        while ($banda = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$banda['nome']}</td>
                <td>{$banda['descricao']}</td>
                <td><img src='{$banda['imagem_url']}' alt='{$banda['nome']}' width='100'></td>
                <td><a href='{$banda['preco']}' target='_blank'>Ingressos</a></td>
                <td>
                    <!-- Formulário para Editar -->
                    <form action='Adicionar_ingressos.php' method='POST' style='display:inline-block;'>
                        <input type='hidden' name='editar' value='1'>
                        <input type='hidden' name='id' value='{$banda['id']}'>
                        <input type='text' name='nome' value='{$banda['nome']}' required>
                        <textarea name='descricao' required>{$banda['descricao']}</textarea>
                        <input type='text' name='imagem_url' value='{$banda['imagem_url']}' required>
                        <input type='number' name='preco' value='{$banda['preco']}' required>
                        <button type='submit'>Salvar</button>
                    </form>
                    <!-- Link para Excluir -->
                    <a href='Adicionar_ingressos.php?excluir={$banda['id']}'>Excluir</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>

<style>
.navbar {
            background-color: #1f1f1f;
            display: flex;
            justify-content: center; /* Centraliza os itens */
            align-items: center;
            padding: 15px 0;
        }

        .navbar a {
            color: #f0f0f0;
            text-decoration: none;
            padding: 14px 20px;
            display: inline-block;
            font-size: 18px;
            transition: background-color 0.3s;
            margin: 0 10px; /* Espaçamento entre os itens */
        }

        .navbar a:hover, .navbar a.active {
            background-color: #b30000;
            color: #ffffff;
        }

        .navbar .profile-icon {
            margin-right: 15px; /* Espaçamento entre o ícone e os links */
            font-size: 24px; /* Tamanho do ícone */
            color: #f0f0f0; /* Cor do ícone */
        }
        /* Estilo do Dropdown */
        .dropdown-menu {
    background-color: #1f1f1f; /* Cor de fundo do dropdown */
    border: none; /* Remove a borda padrão */
}

        .dropdown-item {
    color: #f0f0f0; /* Cor do texto dos itens do dropdown */
}

        .dropdown-item:hover {
    background-color: #b30000; /* Cor de fundo ao passar o mouse */
    color: #ffffff; /* Cor do texto ao passar o mouse */
}


</style>