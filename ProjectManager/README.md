<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Project Manager - Laravel

Este é um sistema básico de gerenciamento de projetos e tarefas desenvolvido com Laravel. O sistema permite criar, editar e gerenciar projetos e tarefas, além de associar usuários a projetos e atribuir tarefas para os usuários.

## Requisitos

- **[PHP]()**
- **[Composer]()**
- **[MySQL]()**
- **[Laravel]()**

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
