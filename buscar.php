<?php

// Carregamento do autoload do composer
require __DIR__.'/vendor/autoload.php';

// Carregamento de Dependência
use \App\Entity\Produto;

// Validando parâmetros via Get
if(isset($_GET)) {

  // Remove itens do array com valores null
  $where = array_filter($_GET);

  // Pega nome das colunas
  $fields = array_keys($where);

  // Configurações de Preço se maio ou menos ao valor do campo
  if(isset($_GET['FILTRO_PRECO']) && $_GET['FILTRO_PRECO'] == 'mei'){
    $signal = '<';
  }

  if(isset($_GET['FILTRO_PRECO']) && $_GET['FILTRO_PRECO'] == 'mai'){
    $signal = '>';
  }

  $arrWhere = [];

  // Configura os parâmetros com LIKE para pesquisa no banco
  foreach($fields as $field) {
    //Verifica para não incluri FILTRO_PRECO no where da busca 
    if($field != 'FILTRO_PRECO') {
      //Se a coluna for de preço a tratativa será apenas com = a de maior ou menos é feito nas linhas 18 a 25
      if($field == 'PRECO') {
        array_push($arrWhere, $field.' = '.$where[$field]);
      } else {
        //Buscar em caráter de pesquisa por termos
        array_push($arrWhere, $field.' LIKE "%'.$where[$field].'%"');
      }
    }
  }

  // Monta o Where
  $where = implode(' AND ', $arrWhere);

  //Define busca de preço por maior ou igual como complemento do $where 
  if(isset($signal)){
    //Verifica se um sinal de maior ou menos foi passa e ver se existe um preço setado
    if(isset($_GET['PRECO']) && $_GET['PRECO']){
      //Concatena com o where filtro por > ou <
      $where .= ' OR PRECO '.$signal.' '.$_GET['PRECO'];
    }
  }
} else {
  header('Locarion: index.php?status=error');
  exit;
}

// Buscar do prosutos para listagem
$produtos = Produto::getProdutos("produtos.*, preco.PRECO, preco.IDPRECO", $where, null, null, "preco ON produtos.IDPROD = preco.IDPROD");
$discount = Produto::calculateDiscounts();
$colors   = Produto::getColors();

// Carregamento de Includes
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem.php';
include __DIR__.'/includes/footer.php';