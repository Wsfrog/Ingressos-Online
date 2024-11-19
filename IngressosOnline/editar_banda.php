<?php
require_once 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('ID inválido.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $ano_formacao = $_POST['ano_formacao'];

    $sql = "UPDATE bandas SET nome = ?, genero = ?, ano_formacao = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $nome, $genero, $ano_formacao, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM bandas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$banda = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Banda</title>
</head>
<body>
    <h1>Editar Banda</h1>
    <form method="POST" action="">
        <label for="nome">Nome da Banda:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($banda['nome']); ?>" required><br>

        <label for="genero">Gênero Musical:</label>
        <input type="text" name="genero" id="genero" value="<?php echo htmlspecialchars($banda['genero']); ?>" required><br>

        <label for="ano_formacao">Ano de Formação:</label>
        <input type="number" name="ano_formacao" id="ano_formacao" value="<?php echo htmlspecialchars($banda['ano_formacao']); ?>" required><br>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
