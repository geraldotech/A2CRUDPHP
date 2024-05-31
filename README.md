# Cadastro de carros e sistema de login

<hr>

![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Oracle](https://img.shields.io/badge/Oracle-F80000?style=for-the-badge&logo=oracle&logoColor=black)
![jquery](https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white)
![](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)


## Deploy

- [Deploy](http://projeto.geraldox.com/public/)

## About

Projeto simples de sistema de login com CRUD (create, read, update, delete).


## Getting started

Como executar o projeto localmente

é necessário ter instalado o Apache, PHP e MySQL, no windows pode instalar tudo junto usando uma das ferramentas abaixo:

- [XAMPP](https://www.apachefriends.org/pt_br/index.html)
- [EasyPHP](https://www.easyphp.org/)

Para VPS Linux Ubuntu pode usar esse tutorial [atualizado da DigitalOcean](https://www.digitalocean.com/community/tutorials/how-to-install-lamp-stack-on-ubuntu)

## Cloning

- `https://github.com/geraldotech/A2CRUDPHP.git`
- No caso do xampp descompactar na raiz do apache geralmente em `C:\xampp\htdocs`
- iniciar o mysql e apache
- acessar o `http://localhost/phpmyadmin` e criar um database

- se estiver no linux/windows o comando: `CREATE DATABASE nomedatabase;` o tutorial da DigitalOcean que citei tem todas as instruções necessários em ambientes linux.

### Escolha uma opção:

1. importar o banco de dados 

ir no database criado > import > selecionar o arquivo> `revendacarros.sql`

2. criar um banco de dados usando as queries:

- create users table: bcrypt(PHP HASH)

```sql
CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

````

- create `cars` table:

```sql
CREATE TABLE cars (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    cor VARCHAR(30) NOT NULL,
    ano INT(4) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    status ENUM('novo', 'seminovo') NOT NULL
);
```

## crie seu usuário:

- http://localhost/A2CRUDPHP/public/register.php

## Faça seu login:

- http://localhost/A2CRUDPHP/public/

## might help

Images svg thanks esse repo https://github.com/dangnelson/car-makes-icons
