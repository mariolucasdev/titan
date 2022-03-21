<?php

// Carregamento do autoload
require __DIR__.'/vendor/autoload.php';

// Definição de Título
define('TITLE', 'Cadastrar Produto');

// Carregamento de Dependência
use \App\Entity\Produto;

//Validação de POST
if(isset($_POST['NOME'], $_POST['COR'], $_POST['PRECO'])){
  $obProduto = new Produto;
  $obProduto->nome = $_POST['NOME'];
  $obProduto->cor = $_POST['COR'];
  $obProduto->preco = $_POST['PRECO'];
  $obProduto->cadastrar();

  header('location: index.php?status=success');
  exit;
}

// Carregamento de Includes
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';