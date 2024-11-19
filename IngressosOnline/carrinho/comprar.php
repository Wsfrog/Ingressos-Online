<?php
session_start();
require 'conexao.php';

header('Content-Type: application/json');

if (empty($_SESSION['carrinho'])) {
    echo json_encode(['success' => false, 'message' => 'Carrinho vazio.']);
    exit;
}

try {
    $pdo->beginTransaction();

    foreach ($_SESSION['carrinho'] as $id => $item) {
        $stmt = $pdo->prepare("SELECT quantidadeDisponivel, nome FROM ingressos WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $ingresso = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$ingresso || $ingresso['quantidadeDisponivel'] < $item['quantidade']) {
            $pdo->rollBack();
            echo json_encode(['success' => false, 'message' => 'Quantidade insuficiente para o evento ' . $ingresso['nome']]);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE ingressos SET quantidadeDisponivel = quantidadeDisponivel - :quantidade WHERE id = :id");
        $stmt->execute(['quantidade' => $item['quantidade'], 'id' => $id]);

        $stmt = $pdo->prepare("INSERT INTO vendasingressos (IngressoId, quantidadeVendida) VALUES (:id, :quantidade)");
        $stmt->execute(['id' => $id, 'quantidade' => $item['quantidade']]);
    }

    $pdo->commit();
    $_SESSION['carrinho'] = [];
    echo json_encode(['success' => true, 'message' => 'Compra realizada com sucesso.']);

} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Erro ao processar a compra: ' . $e->getMessage()]);
}
?>
