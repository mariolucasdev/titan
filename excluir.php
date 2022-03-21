<?php

// Carregamento do Autoload do Composer
require __DIR__.'/vendor/autoload.php';

// Carregamento de Dependência
use \App\Entity\Produto;

//Validação do Get
if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header('Locarion: index.php?status=error');
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
if(isset($_POST['excluir'])){

  $obProduto->excluirPreco();
  $obProduto->excluir();

  header('location: index.php?status=success');
  exit;
}

// Carregamento de includes
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmar-exclusao.php';
include __DIR__.'/includes/footer.php';