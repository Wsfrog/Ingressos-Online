<?php
session_start();
require 'conexao.php';
require '../auth.php';

function esvaziarCarrinho() {
    $_SESSION['carrinho'] = [];
}

if (isset($_POST['comprar'])) {
    esvaziarCarrinho();
}



// Inicialize o carrinho se ele ainda não estiver criado
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Função para adicionar itens ao carrinho
function adicionarAoCarrinho($id, $quantidade, $nome,   $preco, $tipo) {
    $chave = $tipo . '-' . $id; // Diferenciar ingressos de bandas no carrinho
    if (isset($_SESSION['carrinho'][$chave])) {
        $_SESSION['carrinho'][$chave]['quantidade'] += $quantidade;
    } else {
        $_SESSION['carrinho'][$chave] = [
            'nome' => $nome,
            'quantidade' => $quantidade,
            'preco' => $preco,
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

// Função para atualizar a quantidade de um item no carrinho
function atualizarQuantidade($chave, $novaQuantidade) {
    if (isset($_SESSION['carrinho'][$chave]) && $novaQuantidade > 0) {
        $_SESSION['carrinho'][$chave]['quantidade'] = $novaQuantidade;
    }
}

// Processa as ações de adicionar, remover ou atualizar itens
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['adicionar'])) {
        $id = $_POST['id'];
        $quantidade = (int)$_POST['quantidade'];
        $tipo = $_POST['tipo']; // Tipo: 'ingresso' ou 'banda'

        // Valid ação tipo de ingresso
        if ($tipo === 'ingresso') {
            $stmt = $pdo->prepare("SELECT nome, preco FROM ingressos WHERE id = :id");
        } elseif ($tipo === 'banda') {
            $stmt = $pdo->prepare("SELECT nome, preco FROM bandas WHERE id = :id");
        }

        $stmt->execute(['id' => $id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item && is_numeric($item['preco']) && $quantidade > 0) {
            adicionarAoCarrinho($id, $quantidade, htmlspecialchars($item['nome']), (float)$item['preco'], $tipo);
        }
    } elseif (isset($_POST['remover'])) {
        $chave = $_POST['chave']; // Chave do item no carrinho
        removerDoCarrinho($chave);
    } elseif (isset($_POST['atualizar'])) {
        $chave = $_POST['chave']; // Chave do item no carrinho
        $novaQuantidade = (int)$_POST['quantidade'];
        atualizarQuantidade($chave, $novaQuantidade);
    }
}

// Calcula o total do carrinho
function calcularTotal() {
    $total = 0;
    foreach ($_SESSION['carrinho'] as $item) {
        $total += $item['preco'] * $item['quantidade'];
    }
    return number_format($total, 2, ',', '.');
}

// Obter ingressos e bandas disponíveis
$stmtIngressos = $pdo->query("SELECT id, nome, descricao, preco FROM ingressos");
$ingressosDisponiveis = $stmtIngressos->fetchAll(PDO::FETCH_ASSOC);

$stmtBandas = $pdo->query("SELECT id, nome, descricao FROM bandas");
$bandasDisponiveis = $stmtBandas->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras - Rock Amostradinho</title>
    <link rel="stylesheet" href="styles.css">
    <script src="compra.js" defer></script>
</head>
<body>

<div class="navbar">
    <a href="../homepage.php#home" class="active">Home</a>
    <a href="../homepage.php#sobre">Sobre Nós</a>
    <a href="../homepage.php#contato">Contato</a>
    <br><br>
</div>

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
                        <?= htmlspecialchars($banda['nome']) ?> - <?= htmlspecialchars($banda['descricao']) ?>
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
            <th>Nome da banda</th>
            <th>Item</th>
            <th>Tipo</th>
            <th>valor</th>
            <th>Preço total</th>
            <th>Ação</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($_SESSION['carrinho'])): ?>
            <tr>
                <td colspan="7">Seu carrinho está vazio.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($_SESSION['carrinho'] as $chave => $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['nome']) ?></td>
                    <td><?= htmlspecialchars($item['tipo']) ?></td>
                    <td>
                        <form action="carrinho.php" method="post" style="display:inline;">
                            <input type="hidden" name="chave" value="<?= $chave ?>">
                            <input type="number" name="quantidade" value="<?= $item['quantidade'] ?>" min="1" required>
                            <button type="submit" name="atualizar">Atualizar</button>
                        </form>
                    </td>
                    <td>R$<?= number_format((float)$item['preco'], 2, ',', '.') ?></td>
                    <td>R$<?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?></td>
                    <td>
                        <form action="carrinho.php" method="post" style="display:inline;">
                            <input type="hidden" name="chave" value="<?= $chave ?>">
                            <button type="submit" name="remover">Remover</button>
                        </form>
                    </td>
                    <!-- Exibir o nome do usuário logado na nova coluna -->
                    <td>
                        <?php if (isset($_SESSION['usuario_nome'])): ?>
                            <?= htmlspecialchars($_SESSION['usuario_nome']); ?>
                        <?php else: ?>
                            Visitante
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>


    <form action="carrinho.php" method="post" id="formularioCompra">
        <button type="submit" name="comprar" id="comprarButton">Comprar</button>
    </form>

<p id="mensagemSucesso" style="display: none; color: green; font-weight: bold;">Compra realizada com sucesso!</p>
<br><br>
<a href="../homepage.php"><button type="button">Voltar ao Menu</button></a>

    <script>
    // Selecionar os elementos necessários
    const comprarButton = document.getElementById('comprarButton');
    const formulario = document.getElementById('formularioCompra');
    const mensagemSucesso = document.getElementById('mensagemSucesso');

    // Adicionar o evento de clique ao botão
    comprarButton.addEventListener('click', (event) => {
        event.preventDefault(); // Impede a submissão padrão do formulário

        // Mostrar a mensagem de sucesso
        mensagemSucesso.textContent = 'Compra realizada com sucesso!';
        mensagemSucesso.style.display = 'block';

        // Limpar todos os campos do formulário (se necessário)
        formulario.reset();

        // Ocultar a mensagem após 3 segundos (opcional)
        setTimeout(() => {
            mensagemSucesso.style.display = 'none';
        }, 3000);
    });
    const comprarButton = document.getElementById('comprarButton');
    const mensagemSucesso = document.getElementById('mensagemSucesso');

    comprarButton.addEventListener('click', () => {
    mensagemSucesso.style.display = 'block';
    setTimeout(() => {
        mensagemSucesso.style.display = 'none';
    }, 3000);
    
});


   

</script>

</main>
</body>
</html>
<style>
.navbar {
            background-color: #1f1f1f;
            display: flex;
            justify-content: center; /* Centraliza os itens */
            align-items: center;
            padding: 15px 0;
        }

        .navbar a {
            color: #f0f0f0;
            text-decoration: none;
            padding: 14px 20px;
            display: inline-block;
            font-size: 18px;
            transition: background-color 0.3s;
            margin: 0 10px; /* Espaçamento entre os itens */
        }

        .navbar a:hover, .navbar a.active {
            background-color: #b30000;
            color: #ffffff;
        }

        .navbar .profile-icon {
            margin-right: 15px; /* Espaçamento entre o ícone e os links */
            font-size: 24px; /* Tamanho do ícone */
            color: #f0f0f0; /* Cor do ícone */
        }
        /* Estilo do Dropdown */
        .dropdown-menu {
    background-color: #1f1f1f; /* Cor de fundo do dropdown */
    border: none; /* Remove a borda padrão */
}

        .dropdown-item {
    color: #f0f0f0; /* Cor do texto dos itens do dropdown */
}

        .dropdown-item:hover {
    background-color: #b30000; /* Cor de fundo ao passar o mouse */
    color: #ffffff; /* Cor do texto ao passar o mouse */
}


</style>