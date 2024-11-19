<?php
session_start();
require 'conexao.php';
require '../auth.php';

// Inicializa o carrinho se ele ainda não estiver criado
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Função para adicionar itens ao carrinho
function adicionarAoCarrinho($id, $quantidade, $nome, $preco, $tipo) {
    $chave = $tipo . '-' . $id; // Diferenciar ingressos de bandas no carrinho
    // Verifica se o item já está no carrinho
    if (isset($_SESSION['carrinho'][$chave])) {
        $_SESSION['carrinho'][$chave]['quantidade'] += $quantidade;
    } else {
        $_SESSION['carrinho'][$chave] = [
            'nome' => $nome,
            'quantidade' => $quantidade,
            'preco' => (float)$preco, // Garantir que o preço seja do tipo float
            'tipo' => $tipo
        ];
    }
}

// Função para remover itens do carrinho
function removerDoCarrinho($chave) {
    if (isset($_SESSION['carrinho'][$chave])) {
        unset($_SESSION['carrinho'][$chave]);
    }
}

// Processa as ações de adicionar ou remover itens
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['adicionar'])) {
        $id = $_POST['id'];
        $quantidade = (int)$_POST['quantidade'];
        $tipo = $_POST['tipo']; // Tipo: 'ingresso' ou 'banda'

        // Verifica se o tipo é ingresso ou banda
        if ($tipo === 'ingresso') {
            $stmt = $pdo->prepare("SELECT nome, preco FROM ingressos WHERE id = :id");
        } elseif ($tipo === 'banda') {
            $stmt = $pdo->prepare("SELECT nome, preco FROM bandas WHERE id = :id");
        }

        // Executa a consulta
        $stmt->execute(['id' => $id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificação se o item foi encontrado
        if ($item) {
            // Depuração
            error_log("Item encontrado: " . print_r($item, true));
            adicionarAoCarrinho($id, $quantidade, $item['nome'], $item['preco'], $tipo);
            // Redireciona para o carrinho com mensagem de sucesso
            header('Location: carrinho.php?status=adicionado');
            exit;
        } else {
            // Depuração
            error_log("Item não encontrado no banco de dados.");
            header('Location: carrinho.php?status=erro');
            exit;
        }
    } elseif (isset($_POST['remover'])) {
        $chave = $_POST['chave']; // Chave do item no carrinho
        removerDoCarrinho($chave);
        header('Location: carrinho.php?status=removido');
        exit;
    }
}

// Calcula o total do carrinho
function calcularTotal() {
    $total = 0;
    foreach ($_SESSION['carrinho'] as $item) {
        $total += (float)$item['preco'] * (int)$item['quantidade'];
    }
    return number_format($total, 2, ',', '.');
}

// Obter ingressos e bandas disponíveis
$stmtIngressos = $pdo->query("SELECT id, nome, preco FROM ingressos");
$ingressosDisponiveis = $stmtIngressos->fetchAll(PDO::FETCH_ASSOC);

$stmtBandas = $pdo->query("SELECT id, nome, preco FROM bandas");
$bandasDisponiveis = $stmtBandas->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if (isset($_GET['status'])): ?>
    <?php if ($_GET['status'] === 'adicionado'): ?>
        <p style="color: green;">Item adicionado ao carrinho com sucesso!</p>
    <?php elseif ($_GET['status'] === 'removido'): ?>
        <p style="color: green;">Item removido do carrinho com sucesso!</p>
    <?php elseif ($_GET['status'] === 'erro'): ?>
        <p style="color: red;">Erro ao adicionar o item ao carrinho.</p>
    <?php endif; ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>Carrinho de Compras</h1>
</header>

<main>
    <h2>Adicionar Itens ao Carrinho</h2>
    <form action="carrinho.php" method="post">
        <label for="tipo">Tipo:</label>
        <select name="tipo" id="tipo" required>
            <option value="ingresso">Ingresso</option>
            <option value="banda">Banda</option>
        </select>

        <label for="id">Item:</label>
        <select name="id" id="id" required>
            <optgroup label="Ingressos">
                <?php foreach ($ingressosDisponiveis as $ingresso): ?>
                    <option value="<?= $ingresso['id'] ?>" data-tipo="ingresso">
                        <?= htmlspecialchars($ingresso['nome']) ?> - R$<?= number_format($ingresso['preco'], 2, ',', '.') ?>
                    </option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="Bandas">
                <?php foreach ($bandasDisponiveis as $banda): ?>
                    <option value="<?= $banda['id'] ?>" data-tipo="banda">
                        <?= htmlspecialchars($banda['nome']) ?> - R$<?= number_format($banda['preco'], 2, ',', '.') ?>
                    </option>
                <?php endforeach; ?>
            </optgroup>
        </select>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" min="1" required>

        <button type="submit" name="adicionar">Adicionar ao Carrinho</button>
    </form>

    <h2>Carrinho de Compras</h2>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Total</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($_SESSION['carrinho'])): ?>
                <tr>
                    <td colspan="5">Seu carrinho está vazio.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($_SESSION['carrinho'] as $chave => $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['nome']) ?></td>
                        <td><?= $item['quantidade'] ?></td>
                        <td>R$<?= number_format((float)$item['preco'], 2, ',', '.') ?></td>
                        <td>R$<?= number_format((float)$item['preco'] * (int)$item['quantidade'], 2, ',', '.') ?></td>
                        <td>
                            <form action="carrinho.php" method="post" style="display:inline;">
                                <input type="hidden" name="chave" value="<?= $chave ?>">
                                <button type="submit" name="remover">Remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <p><strong>Total:</strong> R$<?= calcularTotal() ?></p>
    <button id="comprarButton">Comprar</button> <br><br>
    <a href="../homepage.php"><button>Voltar ao Menu</button></a>
</main>

</body>
</html>
