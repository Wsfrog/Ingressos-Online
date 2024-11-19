# Sistema de Gerenciamento de Ingressos 🎫

Bem-vindo ao sistema de gerenciamento de ingressos, uma solução completa para usuários que desejam comprar ingressos e administradores que precisam gerenciar bandas e eventos com eficiência. 

# Participantes do Projeto 👥

O sistema de gerenciamento de ingressos foi desenvolvido de forma colaborativa por uma equipe de programadores Full Stack, onde todas as funcionalidades foram realizadas em conjunto. Trabalhamos lado a lado em cada etapa do projeto, unindo esforços para garantir qualidade e eficiência.

## Equipe de Desenvolvimento 💻

### Participantes:
1. Wesley Oliveira da Silva - https://github.com/Wsfrog  
2. André Rodrigues Miranda Júnior - https://github.com/Andre-Rodriguesjr  
3. João Pedro Ferreiro Reduzino -  https://github.com/JotaPe-dev

### Contribuições Conjuntas:
- **Back-end**:
  - Estruturação do banco de dados MySQL com tabelas otimizadas para operações CRUD.
  - Desenvolvimento do sistema de autenticação (login e registro).
  - Implementação de funcionalidades avançadas no carrinho de compras, como cálculo de totais e gerenciamento dinâmico.
  - Criação de consultas SQL utilizando `JOIN` para facilitar relatórios administrativos e gestão de compras.

- **Front-end**:
  - Desenvolvimento de páginas responsivas utilizando HTML, CSS e JavaScript.
  - Design intuitivo para uma melhor experiência do usuário, com validações e interatividade.
  - Estilização avançada para o gerenciamento de ingressos e bandas.

- **Administração do Sistema**:
  - Implementação de ferramentas para adicionar bandas e ingressos, com suporte para imagens via URL.
  - Criação de relatórios detalhados para visualização de dados de compras e usuários.

### Tecnologias Utilizadas:
- **Linguagens**: PHP, SQL, HTML, CSS, JavaScript.  
- **Banco de Dados**: MySQL.  
- **Ferramentas**: XAMPP/WAMP para desenvolvimento local.

---

Desenvolvemos o projeto de forma colaborativa, unindo nossas habilidades e criatividade para criar uma aplicação funcional e robusta. O trabalho em equipe foi essencial para o sucesso desta solução. 🎉  

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

