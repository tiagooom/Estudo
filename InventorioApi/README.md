<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Sistema de Controle de Inventário - API Laravel

Este é um sistema básico de controle de inventário desenvolvido com Laravel. Ele oferece uma API RESTful que permite gerenciar produtos, autenticação via token, e endpoints para relatórios de inventário, como produtos esgotados.

## Requisitos

- **[PHP]()**
- **[Composer]()**
- **[MySQL]()**
- **[Laravel]()**

## Funcionalidades

CRUD de Produtos: Gerenciamento completo de produtos (criação, leitura, atualização e exclusão).
Autenticação com Laravel Sanctum: Protege os endpoints da API para acesso seguro.
Relatórios de Inventário: Verifica produtos esgotados ou com estoque baixo.

## Instalação

1. Clone o repositório para sua máquina local:
   
   ```bash
   git clone https://github.com/tiagooom/Estudo.git
   cd ../Estudo/ProjectManager
2. Instalar as dependecias de pacotes com composer:
   
   ```bash
   composer install
3. Crie o arquivo .env baseado no .env.example mudando o nome do banco que deseja criar:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nome_do_banco
4. Gerar key local para o laravel:
   
   ```bash
    php artisan key:generate
5. Executar migration:
   
   ```bash
   php artisan migrate
6. Popular banco para teste caso deseje:
   
   ```bash
   php artisan db:seed
7. Iniciar servidor de desenvolvimento:
   
   ```bash   
    php artisan serve



## Endpoints da API
Autenticação
Registro de Usuário

URL: /api/register
Método: POST
Parâmetros:
name: Nome do usuário
email: Email do usuário
password: Senha do usuário
password_confirmation: Confirmação de senha
Resposta: Retorna o token de autenticação.
Login de Usuário

URL: /api/login
Método: POST
Parâmetros:
email: Email do usuário
password: Senha do usuário
Resposta: Retorna o token de autenticação.
Produtos
Listar Todos os Produtos

URL: /api/produtos
Método: GET
Descrição: Retorna todos os produtos com paginação.
Adicionar um Novo Produto

URL: /api/produtos
Método: POST
Parâmetros:
nome: Nome do produto
quantidade: Quantidade em estoque
Autenticação: Requer token de autenticação.
Atualizar um Produto

URL: /api/produtos/{id}
Método: PUT
Parâmetros:
nome: Nome do produto
quantidade: Quantidade em estoque
Autenticação: Requer token de autenticação.
Deletar um Produto

URL: /api/produtos/{id}
Método: DELETE
Autenticação: Requer token de autenticação.
Relatórios de Inventário
Relatório de Produtos Esgotados

URL: /api/produtos/relatorio/esgotados
Método: GET
Descrição: Retorna todos os produtos com quantidade zero em estoque.
Relatório de Produtos com Baixo Estoque

URL: /api/produtos/relatorio/baixo-estoque
Método: GET
Descrição: Retorna produtos com quantidade abaixo de um limite pré-definido.
Testes e Documentação
Testando a API com Postman
Utilize o Postman para testar os endpoints descritos acima.
Para endpoints que requerem autenticação, obtenha o token via login e insira-o no cabeçalho da requisição como Authorization: Bearer {token}.
Observação
Certifique-se de incluir o token de autenticação nos endpoints protegidos.