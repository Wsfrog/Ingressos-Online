<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project46 Ingresso</title>
    
</head>
<body>
    <div class="container">
        <h1>Project46</h1>
        <div class="imagem">
            <img src="../img/Project46.jpg" alt="project46_banda">
        </div>

        <h2>Descrição do show</h2>
        <div class="descricao">
            <p>O Project46 é uma banda brasileira de metal que mescla influências de metalcore e hardcore com letras intensas e reflexivas. Com uma sonoridade potente e uma presença de palco envolvente, eles estão conquistando o público com sua energia contagiante.</p>
        </div>

        <hr>

        <div class="precoGeral">
            <h3>Informações do Show</h3>
            <p class="price">Preço por ingresso: R$ 150,00</p>
            <p class="descricao">Prepare-se para uma experiência inesquecível com o Project46 ao vivo no <strong>Barshow</strong>!</p>
            <p><strong>Data:</strong> 16 de dezembro de 2024</p>
            <p><strong>Hora:</strong> 21:00 (Abertura dos portões: 18:00)</p>
            <p><strong>Local:</strong> Barshow no Taguatinga Norte Bloco A - Loja - Taguatinga, Brasília - DF,.</p>
            <p><strong>Descrição:</strong>O Project46 é uma proeminente banda brasileira de metal que se destaca por sua fusão de metalcore e hardcore, apresentando uma sonoridade pesada e cheia de nuances. Formada em São Paulo, a banda ganhou notoriedade com suas letras profundas que abordam temas sociais, pessoais e emocionais, conectando-se de maneira intensa com os fãs. A mistura de riffs explosivos, batidas poderosas e vocais impactantes cria uma experiência sonora envolvente e única em suas apresentações ao vivo. Com uma discografia crescente e uma presença de palco marcante, o Project46 se consolidou como uma das principais forças do metal brasileiro contemporâneo.</p>

            <div class="quantity-controls">
                <button onclick="decreaseQuantity()">-</button>
                <span class="quantity" id="ticket-quantity">1</span>
                <button onclick="increaseQuantity()">+</button>
            </div>

            <a href="../carrinho/carrinho.php"><button class="buy-button" onclick="addToCart()">Adicionar ao carrinho</button></a>
        </div>
    </div>

    <footer>&copy; Direitos autorais reservados ao André. Todos os direitos reservados.</footer>

    <style>
        /* Estilos Gerais */
        body {
            background-color: #1e1e1e;
            color: #e0e0e0;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1, h2, h3, h4 {
            text-align: center;
            color: #f5a623;
        }

        .container {
            max-width: 800px;
            padding: 20px;
            background-color: #2c2c2c;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            margin-top: 20px;
        }

        .imagem img {
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.5);
            display: block;
            margin: 0 auto;
        }

        .descricao {
            font-size: 16px;
            line-height: 1.6;
            text-align: center;
            margin: 20px 0;
        }

        hr {
            border: none;
            border-top: 2px solid #444;
            margin: 20px 0;
        }

        .precoGeral {
            border: 2px solid #444;
            padding: 20px;
            text-align: center;
            margin-top: 20px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .quantity-controls button {
            width: 30px;
            height: 30px;
            font-size: 20px;
            color: #e0e0e0;
            background-color: #f5a623;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .quantity-controls button:hover {
            background-color: #d48e1d;
        }

        .quantity {
            font-size: 18px;
            width: 30px;
            text-align: center;
        }

        .price {
            font-size: 20px;
            color: #f5a623;
        }

        .buy-button {
            background-color: #f5a623;
            color: #1e1e1e;
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .buy-button:hover {
            background-color: #d48e1d;
        }

        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
            text-align: center;
        }
    </style>

    <script>
    const ticketPrice = 150; // Atualizado para o preço correto
    let quantity = 1;

    function updateTotalPrice() {
        document.getElementById("total-price").textContent = (ticketPrice * quantity).toFixed(2);
    }

    function increaseQuantity() {
        quantity++;
        document.getElementById("ticket-quantity").textContent = quantity;
        updateTotalPrice();
    }

    function decreaseQuantity() {
        if (quantity > 1) {
            quantity--;
            document.getElementById("ticket-quantity").textContent = quantity;
            updateTotalPrice();
        }
    }

    function buyTickets() {
        // Redirecionar diretamente para a página de vendas
        window.location.href = './Vendas/visao/index.php';
    }
    </script>
</body>
</html>
