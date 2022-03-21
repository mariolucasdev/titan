# Test Titan PHP, HTML e MySQL

### Processo selectivo para desenvolvedor PHP
Passoa para instalação do projeto avaliativo.

### Downlaod
clone ou faça o donwload do repositório.
```php
git clone https://github.com/mariolucas/titan.git
```
### Setup
Importe a estrutura do banco de dados.
o arquivo está na raíz do diretório do projeto database.sql
```sql
CREATE DATABASE IF NOT EXISTS titan_db;
USE titan_db;

CREATE TABLE IF NOT EXISTS produtos (
    IDPROD INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    NOME CHAR(40),
    COR  CHAR(20)
);

CREATE TABLE IF NOT EXISTS preco (
    IDPRECO INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    PRECO DECIMAL(8,2),
    IDPROD INT
);

ALTER TABLE preco ADD CONSTRAINT FK_PREC_PROD
    FOREIGN KEY(IDPROD) REFERENCES produtos(IDPROD);
```
### Configuraão de Conexão com o bando
Basta alterar os atributos da class Database em:
```php
app/Db/Database.php

/**
   * Host de conexão com banco de dados
   * @var string
   */
  const HOST = 'localhost';

  /**
   * Nome da base de dados
   * @var string
   */
  const NAME = 'dbname';

  /**
   * Usuário do banco de dados
   * @var string
   */
  const USER = 'username';

  /**
   * Senha do banco de dados
   * @var string
   */
  const PASS = 'password';
```
### Instale o composer
Composer foi usuado no projeto apenas para o uso do autoload.
```php
composer install
```
### Rode a aplicação.
Para o desenvolvimento do projeto foi usado o PHP 7.4 e mysql com PHPMyAdmin.

### Observações
No desafio foi explicitamente recomendado que não usássemos frameworks. Levei em consideração que esses frameworks os quais não deveriam ser usados seriam nas tecnologias que estaríamos sendo avaliado. Por isso ainda instalei o boostrap apenas para uso nas questões de layout.
