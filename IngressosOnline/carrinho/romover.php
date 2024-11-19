<?php
session_start();

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = intval($_POST['id']);
    
    if (isset($_SESSION['carrinho'][$id])) {
        unset($_SESSION['carrinho'][$id]);
        header('Location: carrinho.php?status=removido');
        exit;
    }
}

header('Location: carrinho.php?status=erro');
exit;
?>
