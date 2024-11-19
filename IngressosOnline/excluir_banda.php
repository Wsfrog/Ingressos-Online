<?php
require_once 'db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "DELETE FROM bandas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: index.php");
exit;
?>
