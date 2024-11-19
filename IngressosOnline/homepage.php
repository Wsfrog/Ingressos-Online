<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IngressosOnline</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
</head>

<body>
    <!-- Navbar -->
    <!-- Navbar -->
<div class="navbar">
    <div class="dropdown">
        <a href="#" class="dropdown-toggle" id="profileDropdown" data-toggle="dropdown">
            <i class="fas fa-user-circle profile-icon"></i>
        </a> <!-- Ícone de perfil -->
        <div class="dropdown-menu" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="painel.php">painel</a>
            <a class="dropdown-item" href="logout.php">logout</a>
        </div> 
    </div>
    <a href="#home" class="active">Home</a>
    <a href="#sobre">Sobre Nós</a>
    <a href="#contato">Contato</a>
    <a href="Adicionar_ingressos.php    ">Adicionar Ingressos</a>
</div>


    <!-- Seção de Boas-vindas -->
    <div id="home" class="caixa_home">
        <h1>Bem Vindo ao Ingressos Online</h1>
        <p>Aqui é um site onde você pode fazer compra de ingressos online de maneira segura. Oferecemos ingressos de qualquer tipo de show e qualquer gênero musical: rock, rap, pop, jazz, samba. Os ingressos valem para qualquer lugar do mundo.</p>

        <!-- Carrossel de Imagens -->
        <div id="carouselShows" class="carousel slide" data-ride="carousel">
            <!-- Indicadores -->
            <ul class="carousel-indicators">
                <li data-target="#carouselShows" data-slide-to="0" class="active"></li>
                <li data-target="#carouselShows" data-slide-to="1"></li>
                <li data-target="#carouselShows" data-slide-to="2"></li>
            </ul>

            <!-- Imagens do Carrossel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/tste.webp" alt="foto da capa de caveira" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="img/Guita.webp" alt="Roqueiros no palco" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="img/Show.webp" alt="show de roque" class="d-block w-100">
                </div>
            </div>

            <!-- Controles do Carrossel -->
            <a class="carousel-control-prev" href="#carouselShows" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#carouselShows" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <!-- Seção Sobre Nós -->
    <div id="sobre" class="sobre_nos">
        <h2>Sobre Nós</h2>
        <p>Nós somos a Ingressos Online, dedicados a oferecer a melhor experiência de compra de ingressos para eventos ao vivo. Trabalhamos com uma variedade de shows e festivais, garantindo que você tenha acesso aos melhores lugares e preços.</p>
    </div>

    <div class="card-container">
        <!-- Linha 1 -->
        <div class="card">
            <img src="./img/korn.jpg" alt="Korn">
            <h3>Korn</h3>
            <p>Korn é uma banda americana de nu metal formada em 1993 em Bakersfield, Califórnia. Eles são considerados pioneiros do gênero, combinando elementos de metal alternativo com hip-hop, rock industrial e outras influências, O som da banda é caracterizado pelos riffs pesados e graves da guitarra de sete cordas, baixo distorcido e os vocais dinâmicos e emotivos de Jonathan Davis. Álbums como Korn (1994) e Follow the Leader (1998) foram marcos do gênero e catapultaram a banda ao sucesso global.</p>
             <a href="./Ingressos/Korn.php"> <button>Comprar Ingresso</button> </a>
        </div>

        <div class="card">
            <img src="./img/Slip.jpg" alt="Logo da Banda 2">
            <h3>Slipknot</h3>
            <p>Slipknot é uma banda americana de metal formada em 1995 em Des Moines, Iowa, famosa por seu som agressivo e visual impactante. Com nove membros usando máscaras e uniformes, a banda criou uma estética única que reflete a intensidade das musicas. Seu álbum de estreia homônimo em 1999 estabeleceu a banda como uma força no metal, com hits como "Wait and Bleed". Ao longo dos anos, Slipknot ganhou destaque mundial e uma base de fãs dedicada.</p>
            <a href="./Ingressos/Slipknot.php"> <button>Comprar Ingresso</button> </a>
        </div>

        <div class="card">
            <img src="./img/Project46.jpg" alt="Logo da Banda 3">
            <h3>Project46</h3>
            <p>Project46 é uma banda brasileira de metal formada em 2008 em São Paulo. Conhecida por suas letras em português que abordam temas de crítica social e pessoal, a banda rapidamente ganhou destaque na cena nacional. Quem Doer (2014), ajudaram a consolidar a banda como um dos principais nomes do metal brasileiro, levando-os a festivais de destaque e turnês pelo país e fora dele.</p>
            <a href="./Ingressos/Project46.php"> <button>Comprar Ingresso</button> </a>
        </div>

        <!-- Linha 2 -->
        <div class="card">
            <img src="./img/SOAD.jpg" alt="Logo da Banda 4">
            <h3>System of a down</h3>
            <p>System of a Down é uma banda americana de metal alternativo formada em 1994 em Los Angeles, conhecida por seu estilo único que combina elementos de metal, rock progressivo e música tradicional armênia.. O som do System of a Down é marcado por mudanças de ritmo e estilo dentro das músicas, alternando entre passagens agressivas e melódicas. Álbuns como Toxicity (2001) e Mezmerize (2005) estabeleceram o grupo como uma força inovadora no cenário musical global.</p>
            <a href="./Ingressos/SOAD.php"> <button>Comprar Ingresso</button> </a>
        </div>

        <div class="card">
            <img src="./img/Beatles.jpg" alt="Logo da Banda 5">
            <h3>The Beatles</h3>
            <p>The Beatles foi uma banda de rock britânica formada em Liverpool em 1960, composta por John Lennon, Paul McCartney, George Harrison e Ringo Starr. Considerada uma das bandas mais influentes da história, os Beatles revolucionaram a música popular com sua criatividade musical, letras marcantes e inovações técnicas. Álbuns como Sgt. Pepper’s Lonely Hearts Club Band (1967) e Abbey Road (1969) são marcos culturais que consolidaram seu legado como pioneiros e ícones da música moderna.</p>
            <a href="./Ingressos/Beatles.php"> <button>Comprar Ingresso</button> </a>
        </div>

        <div class="card">
            <img src="./img/eskrota.webp" alt="Logo da Banda 6">
            <h3>Eskrota</h3>
            <p>Eskrøta é uma banda brasileira de thrash metal formada em 2013, composta por mulheres e conhecida por seu som agressivo e letras críticas. Originária de São Paulo, a banda aborda temas de resistência, feminismo, injustiças sociais e questões de desigualdade, sempre com um tom direto e contestador.  Com EPs e álbuns independentes, a banda se destacou na cena underground brasileira, conquistando fãs e respeito pela autenticidade e força de suas performances.</p>
            <a href="./Ingressos/Eskrota.php"> <button>Comprar Ingresso</button> </a>
        </div>

        <!-- Linha 3 -->
        <div class="card">
            <img src="./img/AXTY.jpg" alt="Logo da Banda 7">
            <h3>Axty</h3>
            <p>AXTY é uma banda brasileira de metalcore formada em Belo Horizonte, Minas Gerais. Conhecida por misturar peso e melodia, a banda traz influências de metal moderno e hardcore, com letras em português que abordam temas introspectivos e sociais. </p>
             <a href="./Ingressos/axty.php"> <button>Comprar Ingresso</button> </a>
        </div>

        <div class="card">
            <img src="./img/Crypta.jpg" alt="Logo da Banda 8">
            <h3>Crypta</h3>
            <p>Crypta é uma banda brasileira de death metal formada em 2019, composta por Fernanda Lira (vocal e baixo), Luana Dametto (bateria), Tainá Bergamaschi (guitarra) e Jéssica di Falchi (guitarra). Fundada por ex-integrantes da banda Nervosa, a Crypta se tornou rapidamente uma força na cena do metal extremo mundial, conquistando fãs com seu som brutal e técnico.</p>
            <a href="./Ingressos/Crypta.php"> <button>Comprar Ingresso</button> </a>
        </div>

        <div class="card">
            <img src="./img/BlackPantera.jpg" alt="Logo da Banda 9">
            <h3>Black Pantera</h3>
            <p>Black Pantera é uma banda brasileira de hardcore e metal formada em 2014 em Uberaba, Minas Gerais, composta por Charles Gama (vocal e guitarra), Chaene da Gama (baixo) e Rodrigo "Pancho" Augusto (bateria). A banda se destaca por suas letras fortes e críticas sociais, abordando temas como racismo, desigualdade e resistência, refletindo experiências da realidade brasileira e da luta antirracista. </p>
            <a href="./Ingressos/BlackPantera.php"> <button>Comprar Ingresso</button> </a>
        </div>
    </div>
    <?php
$conn = new mysqli('localhost', 'root', '', 'venda_ingressos');
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT * FROM bandas";
$result = $conn->query($sql);
?>

<div class="card-container">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '<img src="' . $row['imagem_url'] . '" alt="Imagem da Banda">';
            echo '<h3>' . $row['nome'] . '</h3>';
            echo '<p>' . $row['descricao'] . '</p>';
            echo '<p><strong>Preço: R$ ' . number_format($row['preco'], 2, ',', '.') . '</strong></p>';
            echo '<a href="carrinho\carrinho.php?banda_id=' . $row['id'] . '"><button class="btn btn-primary">Comprar Ingresso</button></a>';
            echo '</div>';
        }
    } else {
        echo '<p>Nenhuma banda cadastrada.</p>';
    }
    ?>
</div>

<?php $conn->close(); ?>

    <!-- Seção Bandas Dinâmicas -->
    <div class="card-container">
        
        <?php if ($result->num_rows > 0): ?>
            <?php while ($banda = $result->fetch_assoc()): ?>
                <div class="card">
                    <img src="<?= htmlspecialchars($banda['foto_url']) ?>" alt="Foto da banda">
                    <h3><?= htmlspecialchars($banda['nome']) ?></h3>
                    <p><strong>Gênero:</strong> <?= htmlspecialchars($banda['genero']) ?></p>
                    <p><strong>Formação:</strong> <?= htmlspecialchars($banda['formacao']) ?></p>
                    <a href="Ingressos/<?= htmlspecialchars($banda['nome']) ?>.php">
                        <button>Comprar Ingresso</button>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhuma banda cadastrada no momento.</p>
        <?php endif; ?>
    </div>

    <!-- Seção de Contato -->
    <div id="contato" class="formulario">
        <h2>Contato</h2>
        <form>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" rows="4" required></textarea>

            <button type="submit">Enviar</button>
        </form>
    </div>
 
</body>
</html>

<style>
     body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
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

        /* Lugar de Boas-vindas */
        .caixa_home {
            text-align: center;
            padding: 50px;
            background: url('img/fundo_concerto.jpg') no-repeat center center;
            background-size: cover;
            color: #f0f0f0;
        }

        .caixa_home h1 {
            font-size: 3em;
            text-shadow: 2px 2px #000;
        }

        /* Carrossel de Imagens */
        .carousel-inner img {
            height: 500px;
            object-fit: cover;
        }

        /* Seção Sobre Nós */
        .sobre_nos {
            padding: 50px;
            text-align: center;
        }

        /* Formulário */
        .formulario {
            margin: 50px auto;
            max-width: 600px;
            background-color: #1f1f1f;
            padding: 30px;
            border-radius: 10px;
            
        }

        .formulario label {
            color: #f0f0f0;
        }

        .formulario input[type="text"],
        .formulario input[type="email"],
        .formulario textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            border: none;
            background: #333;
            color: #f0f0f0;
            border-radius: 5px;
        }

        .formulario button {
            background-color: #b30000;
            color: #f0f0f0;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .formulario button:hover {
            background-color: #d10000;
        }
        
        
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            margin: 20px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
            padding: 20px;
            max-width: 1000px;
        }

        .card {
            flex: 1 1 30%; /* Garantindo que cada card ocupe cerca de 30% do espaço com um espaçamento entre eles */
            max-width: 30%;
            padding: 15px;
            background-color: #333;
            color: #fff;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .card h3 {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 0.9em;
            margin-bottom: 20px;
            line-height: 1.4;
        }

        .card button {
            background-color: #ff4500;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
            padding-top:10px; 
        }
       

        .card button:hover {
            background-color: #ff6a3d;
        }
        .card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-between;
    padding: 20px;
    max-width: 1000px;
}

.card {
    flex: 1 1 30%; /* Cada card ocupa cerca de 30% do espaço */
    max-width: 30%;
    padding: 15px;
    background-color: #333;
    color: #fff;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}

.card img {
    width: 100%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 15px;
}

.card h3 {
    font-size: 1.2em;
    margin-bottom: 10px;
}

.card p {
    font-size: 0.9em;
    margin-bottom: 20px;
    line-height: 1.4;
}

.card button {
    background-color: #ff4500;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s;
}

.card button:hover {
    background-color: #ff6a3d;
}

        /* Responsividade */
        @media (max-width: 768px) {
            .card {
                width: 45%;
            }
        }

        @media (max-width: 480px) {
            .card {
                width: 100%;
            }
        }
</style>