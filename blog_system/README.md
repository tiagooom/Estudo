<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Blog System

Este é um sistema de blog desenvolvido em Laravel, permitindo que usuários autenticados possam criar, editar e excluir artigos. O sistema inclui autenticação segura, controle de permissões, categorização de artigos, sistema de comentários e caching para otimização de desempenho.

## Requisitos

- **[PHP]()**
- **[Composer]()**
- **[MySQL]()**
- **[Laravel]()**

## Instalação

1. Clone o repositório:
   
   ```bash
   git clone https://github.com/tiagooom/Estudo.git
   cd ../Estudo/blog_system
2. Instalar as dependecias do laravel:
   
   ```bash
   composer install
3. Copie e configure o arquivo .env para o banco de dados escolhido:

    ```bash
    cp .env.example .env
4. Gere a chave da aplicação:
   
   ```bash
    php artisan key:generate
5. Execute as migrações e seeders:
   
   ```bash
   php artisan migrate
6. Popular banco para teste e criação do usuario admin:
   
   ```bash
   php artisan db:seed
7. Iniciar servidor de desenvolvimento:
   
   ```bash   
    php artisan serve

## Funcionalidades Implementadas

1.1 Autenticação e Autorização

Registro e login de usuários.

Hashing seguro de senhas.

Diferenciação entre usuários comuns e administradores.

1.2 CRUD de Artigos

Criar, editar e excluir artigos.

Listagem paginada dos artigos.

Filtragem de artigos por categoria.

Ordenação dos artigos por mais recentes.

1.3 Categorização

Criação e gerenciamento de categorias.

Associação de artigos a categorias.

1.4 Sistema de Comentários

Adicionar, visualizar e excluir comentários nos artigos.

1.5 Caching

Implementação de cache para a primeira página da listagem de artigos para melhorar desempenho.

Atualização automática do cache ao criar, editar ou excluir artigos.

## Uso do Sistema

Acesso ao Sistema

Faça login com o usuario admin ou cadastra-se.

Acesse a página principal para visualizar os artigos.

Utilize o menu para criar novos artigos ou administrar categorias (se for administrador).

Gerenciamento de Artigos

Para criar um artigo, clique em "Novo Artigo", preencha os campos e salve.

Para editar, clique no botão "Editar" ao lado do artigo desejado (se for administrador ou dono do artigo).

Para excluir, utilize o botão "Excluir" (se for administrador ou dono do artigo).

Comentários

Na página de um artigo, adicione um comentário preenchendo o campo correspondente.

O administrador e os usuários podem excluir seus próprios comentários.