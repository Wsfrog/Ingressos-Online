<?php
require_once 'conexao.php';

class IngressoDAO {
    private $conexao;

    public function __construct() {
        $this->conexao = Conexao::getConexao();
    }

    public function listarIngressos() {
        $sql = "SELECT * FROM ingresso";
        $stmt = $this->conexao->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function venderIngresso($ingressoId, $quantidade) {
        $sql = "INSERT INTO vendasingressos (IngressoId, quantidadeVendida) VALUES (:ingressoId, :quantidade)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':ingressoId', $ingressoId);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->execute();
        
        // Atualizar o estoque de ingressos
        $sql = "UPDATE ingresso SET quantidadeDisponivel = quantidadeDisponivel - :quantidade WHERE idIngresso = :ingressoId";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':ingressoId', $ingressoId);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->execute();
    }

    public function adicionarIngressos($ingressoId, $quantidade) {
        $sql = "UPDATE ingresso SET quantidadeDisponivel = quantidadeDisponivel + :quantidade WHERE idIngresso = :ingressoId";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':ingressoId', $ingressoId);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->execute();
    }
}
?>