<?php
include_once 'db.php'; // Incluir a conexão com o banco de dados

// Função de login
function login($email, $senha) {
    global $conn;

    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        if (password_verify($senha, $usuario['senha'])) {
            // Inicia a sessão e armazena o ID do usuário
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            return true;
        }
    }
    return false;
}

// Função de cadastro
function cadastrar($nome, $email, $senha) {
    global $conn;

    // Verifica se o e-mail já existe
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return "E-mail já cadastrado!";
    }

    // Senha criptografada
    $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);

    // Insere o novo usuário
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha_cripto);

    if ($stmt->execute()) {
        return "";
    } else {
        return "Erro ao cadastrar usuário!";
    }
}
?>
