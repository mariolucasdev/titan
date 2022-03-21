<?php

// Carregamento do Autoload do Composer
require __DIR__.'/vendor/autoload.php';

// Título da Página
define('TITLE', 'Editar Produto');

// Carregamento de Dependência
use \App\Entity\Produto;

//Validação do Get
if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header('location: index.php?status=error');
  exit;
}

//Consulta de Produto
$obProduto = Produto::getProduto('produtos.*, preco.PRECO, preco.IDPRECO', 'produtos.IDPROD='.$_GET['id'] , null, null, 'preco ON produtos.IDPROD = preco.IDPROD');

// Validar Produto
if(!$obProduto instanceof Produto) {
  header('location: index.php?status=error');
  exit;
}

//Validação de POST
if(isset($_POST['NOME'], $_POST['COR'], $_POST['PRECO'])){

  $obProduto->nome = $_POST['NOME'];
  $obProduto->cor = $_POST['COR'];
  $obProduto->preco = $_POST['PRECO'];
  $obProduto->atualizar();

  header('location: index.php?status=success');
  exit;
}

// Carregamento de includes
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';