-- Criação do banco de dados
CREATE DATABASE venda_ingressos;
USE venda_ingressos;

-- Remover o banco de dados se necessário
DROP DATABASE venda_ingressos;

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- Tabela de bandas
CREATE TABLE bandas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    imagem_url VARCHAR(255) NOT NULL
);

-- Tabela de ingressos
CREATE TABLE ingressos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    quantidade_disponivel INT NOT NULL
);
CREATE TABLE carrinho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_banda INT,
    quantidade INT DEFAULT 1,
    FOREIGN KEY (id_banda) REFERENCES bandas(id)
);

-- Tabela de moradores (necessária para a relação de compras)
CREATE TABLE moradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telefone VARCHAR(20)
);

-- Tabela de compras
CREATE TABLE compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    morador_id INT NOT NULL,
    ingresso_id INT NOT NULL,
    quantidade INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    data_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (morador_id) REFERENCES moradores(id),  -- Chave estrangeira para a tabela moradores
    FOREIGN KEY (ingresso_id) REFERENCES ingressos(id) -- Chave estrangeira para a tabela ingressos
);

-- Exibição dos dados de cada tabela
SELECT * FROM usuarios;
SELECT * FROM ingressos;
SELECT * FROM bandas;
SELECT * FROM moradores;
SELECT * FROM compras;

-- Descrição das tabelas
DESCRIBE usuarios;
DESCRIBE ingressos;
DESCRIBE bandas;
DESCRIBE moradores;
DESCRIBE compras;
ALTER TABLE bandas ADD COLUMN preco DECIMAL(10, 2) NOT NULL;

select * from bandas;

    INSERT INTO ingressos (id, nome, descricao, preco, quantidade_disponivel) VALUES
('Korn', 'Banda de nu metal dos EUA.', 'https://example.com/korn.jpg', 100, 200),
('Slipknot', 'Banda de metal alternativo.', 'https://example.com/slipknot.jpg', 120, 250),
('Project46', 'Banda de metal brasileira.', 'https://example.com/project46.jpg', 90, 300),
('System of a Down', 'Banda de rock alternativo.', 'https://example.com/systemofadown.jpg', 110, 150),
('The Beatles', 'Lendária banda de rock britânica.', 'https://example.com/beatles.jpg', 150, 100),
('Eskrota', 'Banda de thrash metal brasileira.', 'https://example.com/eskrota.jpg', 80, 180),
('Axty', 'Banda independente de rock.', 'https://example.com/axty.jpg', 60, 350),
('Crypta', 'Banda de death metal.', 'https://example.com/crypta.jpg', 95, 220),
('Black Pantera', 'Banda de crossover thrash.', 'https://example.com/blackpantera.jpg', 85, 275);