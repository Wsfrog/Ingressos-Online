<?php
session_start();
include_once 'db.php'; // Conexão com o banco de dados

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php"); // Redireciona para o login caso não esteja logado
    exit();
}

// Buscar os dados do usuário no banco de dados
$usuario_id = $_SESSION['usuario_id'];
$query = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

// Atualizar os dados do usuário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['atualizar'])) {
    $novo_nome = $_POST['nome'];
    $novo_email = $_POST['email'];

    // Atualizar nome e email no banco de dados
    $update_query = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssi", $novo_nome, $novo_email, $usuario_id);
    $update_stmt->execute();

    // Atualizar os dados na sessão
    $_SESSION['usuario_nome'] = $novo_nome;
    $_SESSION['usuario_email'] = $novo_email;

    // Exibir mensagem de sucesso
    $sucesso = "Dados atualizados com sucesso!";
    $usuario['nome'] = $novo_nome; // Atualiza a variável do usuário na página
    $usuario['email'] = $novo_email; // Atualiza o email na página
}

// Excluir usuário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['excluir'])) {
    $delete_query = "DELETE FROM usuarios WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $usuario_id);
    $delete_stmt->execute();

    // Redirecionar após exclusão
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Rock+Salt&family=Yomogi&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #1e1e1e;
            color: #fff;
            font-family: 'Rock Salt', cursive;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 600px;
            background-color: #2c3e50;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            border: 2px solid #e74c3c;
        }

        h3 {
            color: #e74c3c;
            text-align: center;
            font-size: 2.8em;
            font-family: 'Anton', sans-serif;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 10px;
            background-color: #34495e;
            color: #fff;
            border: 2px solid #e74c3c;
        }

        .form-control:focus {
            /*background-color: #2c3e50;*/
            border-color: #e74c3c;
            box-shadow: 0 0 8px rgba(231, 76, 60, 0.8);
        }

        .form-control::placeholder {
            color: #bdc3c7; /* Placeholder fica cinza claro */
        }

        .btn-custom {
            background-color: #e74c3c;
            border-color: #e74c3c;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
            border-radius: 8px;
        }

        .btn-custom:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }

        .alert {
            background-color: #e74c3c;
            color: #fff;
            font-weight: bold;
            padding: 12px;
            border-radius: 5px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.3);
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .footer-symbol {
            text-align: center;
            color: #e74c3c;
            font-size: 24px;
            font-family: 'Yomogi', cursive;
            margin-top: 40px;
        }

        .glass-effect {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            padding: 20px;
        }

        @media (max-width: 576px) {
            .container {
                padding: 20px;
            }
            h3 {
                font-size: 2.2em;
            }
            .button-group {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>

<div class="container glass-effect">
    <h3>Bem-vindo ao Painel de Controle, <?php echo htmlspecialchars($usuario['nome']); ?>!</h3>

    <?php if (isset($sucesso)) { echo "<div class='alert alert-success'>$sucesso</div>"; } ?>

    <form method="POST" action="painel.php">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
        </div>
        
        <div class="button-group">
            <button type="submit" name="atualizar" class="btn btn-custom">Atualizar</button>
            <a href="index.php" class="btn btn-secondary">Sair</a>
        </div>
    </form>

    <form method="POST" action="painel.php" onsubmit="return confirm('Você tem certeza de que deseja excluir sua conta?');">
        <button type="submit" name="excluir" class="btn btn-danger btn-block mt-3">Excluir Conta</button>
    </form>

    <div class="footer-symbol">🎸</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</body>
</html>
