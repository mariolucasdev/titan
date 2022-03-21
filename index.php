<?php

// Carregamento do autoload do composer
require __DIR__.'/vendor/autoload.php';

// Carregamento de Dependência
use \App\Entity\Produto;

// Buscar do prosutos para listagem
$produtos = Produto::getProdutos("produtos.*, preco.PRECO, preco.IDPRECO", null, null, null, "preco ON produtos.IDPROD = preco.IDPROD");
$discount = Produto::calculateDiscounts();
$colors   = Produto::getColors();

// Carregamento de Includes
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem.php';
include __DIR__.'/includes/footer.php';