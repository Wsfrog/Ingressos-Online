# Sistema de Gerenciamento de Ingressos 🎫

Bem-vindo ao sistema de gerenciamento de ingressos, uma solução completa para usuários que desejam comprar ingressos e administradores que precisam gerenciar bandas e eventos com eficiência. 

## Funcionalidades Principais 🛠️

### Para Usuários:
- **Login e Cadastro**: 
  - Sistema de autenticação para criar contas ou acessar uma conta existente.
  - CRUD completo para gerenciar perfis de usuários.

- **Carrinho de Compras**:
  - Adição e remoção de ingressos.
  - Visualização de preços e totais para confirmação.
  - Histórico de compras para verificar ingressos adquiridos.

### Para Administradores:
- **Adicionar Bandas e Ingressos**:
  - Cadastro de novas bandas com nome, descrição e imagem (utilizando URLs).
  - Sistema CRUD para gerenciar os ingressos disponíveis.

- **Gerenciamento de Compras**:
  - Ferramenta para visualizar quais usuários compraram ingressos específicos, utilizando `JOIN` no banco de dados para exibir informações de usuários e seus respectivos ingressos de forma eficiente.

## Tecnologias Utilizadas 🖥️
- **Back-end**: PHP
- **Banco de Dados**: MySQL com suporte para operações CRUD.
- **Front-end**: HTML, CSS, JavaScript (para funcionalidades como validação e interatividade).
- **Integração do Carrinho**: `JOIN` SQL para facilitar a visualização de compras pelos administradores.

## Estrutura do Banco de Dados 🗂️

### Tabelas Principais:
1. **Usuários**:
   - `id`: Identificador único.
   - `nome`: Nome do usuário.
   - `email`: E-mail.
   - `senha`: Senha criptografada.

2. **Bandas**:
   - `id`: Identificador único.
   - `nome`: Nome da banda.
   - `descricao`: Informações sobre a banda.
   - `imagem_url`: URL da imagem da banda.

3. **Ingressos**:
   - `id`: Identificador único.
   - `banda_id`: ID da banda relacionada.
   - `preco`: Preço do ingresso.
   - `quantidade`: Quantidade disponível.

4. **Carrinho**:
   - `id`: Identificador único.
   - `usuario_id`: ID do usuário que está comprando.
   - `ingresso_id`: ID do ingresso no carrinho.
   - `quantidade`: Quantidade do ingresso no carrinho.

5. **Compras**:
   - `id`: Identificador único.
   - `usuario_id`: ID do comprador.
   - `ingresso_id`: ID do ingresso comprado.
   - `data`: Data da compra.

## Exemplos de Operações SQL 💾

### `JOIN` para Visualizar Compras:
```sql
SELECT 
    compras.id AS compra_id, 
    usuarios.nome AS nome_usuario, 
    ingressos.preco AS preco_ingresso, 
    bandas.nome AS banda_nome 
FROM 
    compras
JOIN usuarios ON compras.usuario_id = usuarios.id
JOIN ingressos ON compras.ingresso_id = ingressos.id
JOIN bandas ON ingressos.banda_id = bandas.id;

Inserção de Nova Banda:
INSERT INTO bandas (nome, descricao, imagem_url) 
VALUES ('Nome da Banda', 'Descrição da Banda', 'https://url-da-imagem.com');

Inserção de Nova Compra:
INSERT INTO compras (usuario_id, ingresso_id, data) 
VALUES (1, 2, NOW());

Como Executar o Projeto 🚀
Clone este repositório:

git clone https://github.com/seu-usuario/sistema-ingressos.git

Configure o banco de dados:

Importe o arquivo banco.sql na sua instância MySQL.
Atualize as credenciais de conexão no arquivo config.php.

Inicie o servidor local (ex.: XAMPP, WAMP, ou um servidor PHP)

