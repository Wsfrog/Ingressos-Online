<?php
include_once 'auth.php'; // Incluir as funções de login, cadastro e logout

// Inicializar a sessão
session_start();

// Variáveis para mensagens de erro
$erro_login = "";
$erro_cadastro = "";

// Verificar se o usuário já está logado
if (isset($_SESSION['usuario_id'])) {
    header("Location: painel.php"); // Redirecionar para o painel
    exit();
}

// Processar login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (login($email, $senha)) {
        header("Location: homepage.php"); // Redirecionar após login bem-sucedido
        exit();
    } else {
        $erro_login = "E-mail ou senha incorretos!";
    }
}

// Processar cadastro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email_cadastro'];
    $senha = $_POST['senha_cadastro'];

    $erro_cadastro = cadastrar($nome, $email, $senha); // Chama a função de cadastro
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login e Cadastro - Rock Style</title>
    <!-- Fonts from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Rock+Salt&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap 4 -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: url('img/Hero.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            font-family: '', sans-serif;
            padding-top: 50px;
            backdrop-filter: blur(5px); /* Efeito de desfoque suave no fundo */
            transition: background 0.5s ease;
        }

        h3 {
            font-family: 'Rock Salt', cursive;
            color: #e74c3c;
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 30px;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.8);
        }

        .form-control {
            background-color: rgba(51, 51, 51, 0.9); /* Menos opacidade para mais contraste */
            color: #fff;
            border: 1px solid #444;
            border-radius: 25px;
            padding: 12px;
            font-size: 1.1em;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #444;
            border-color: #e74c3c;
            color: #fff;
            box-shadow: 0 0 15px rgba(231, 76, 60, 0.7);
        }

        .form-group label {
            font-size: 1.1em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .btn {
            font-weight: ;
            border-radius: 25px;
            padding: 12px;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }

        .btn-primary:hover {
            background-color: #c0392b;
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(231, 76, 60, 0.7);
        }

        .btn-success {
            background-color: #2ecc71;
            border-color: #2ecc71;
        }

        .btn-success:hover {
            background-color: #27ae60;
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(46, 204, 113, 0.7);
        }

        .alert {
            background-color: #f44336;
            color: #fff;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .container {
            max-width: 900px;
            margin-top: 50px;
        }

        .card {
            background-color: rgba(34, 34, 34, 0.8);
            border: 1px solid #444;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-body {
            padding: 30px;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .col-md-5 {
            flex: 0 0 48%;
            margin-bottom: 20px;
        }

        @media (max-width: 767px) {
            .col-md-5 {
                flex: 0 0 100%;
            }
        }

        /* Adicionando botões de UI/UX */
        .btn-ui {
            border-radius: 30px;
            padding: 12px 30px;
            background-color: #1abc9c;
            border: none;
            color: white;
            font-size: 1.1em;
            transition: all 0.3s ease;
        }

        .btn-ui:hover {
            background-color: #16a085;
            transform: scale(1.05);
            box-shadow: 0 0 12px rgba(26, 188, 156, 0.8);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <!-- Card de Login -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fas fa-sign-in-alt"></i> Login</h3>
                    <?php if ($erro_login) { echo "<div class='alert'>$erro_login</div>"; } ?>
                    <form method="POST" action="login.php">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" name="senha" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary btn-block">Entrar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Card de Cadastro -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fas fa-user-plus"></i> Cadastro</h3>
                    <?php if ($erro_cadastro) { echo "<div class='alert'>$erro_cadastro</div>"; } ?>
                    <form method="POST" action="login.php">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="email_cadastro">E-mail</label>
                            <input type="email" class="form-control" name="email_cadastro" required>
                        </div>
                        <div class="form-group">
                            <label for="senha_cadastro">Senha</label>
                            <input type="password" class="form-control" name="senha_cadastro" required>
                        </div>
                        <button type="submit" name="cadastrar" class="btn btn-success btn-block">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts do Bootstrap e FontAwesome -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</body>
</html>
