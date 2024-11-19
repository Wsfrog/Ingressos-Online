<?php
require_once '../modelo/ingressoDAO.php';

class IngressoController {
    private $ingressoDAO;

    public function __construct() {
        $this->ingressoDAO = new IngressoDAO();
    }

    public function listarIngressos() {
        return $this->ingressoDAO->listarIngressos();
    }

    public function venderIngresso($ingressoId, $quantidade) {
        $this->ingressoDAO->venderIngresso($ingressoId, $quantidade);
    }

    public function adicionarIngressos($ingressoId, $quantidade) {
        $this->ingressoDAO->adicionarIngressos($ingressoId, $quantidade);
    }
}
?>