<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Produto extends Preco
{
  /**
   * Identificador do Produto
   * @var integer
   */
  public $id;

  /**
   * Nome do Produto
   * @var string
   */
  public $nome;
  
  /**
   * Cor do Produto
   * @var string
   */
  public $cor;
  
  /**
   * Preço do Produto
   * @var string
   */
  public $preco;
  
  /**
   * Método responsável por cadastrar novo produto no banco
   * @return boolean
   */
  public function cadastrar()
  {
    $obDatabase = new Database('produtos');

    $arrProduct = array(
      'NOME' => $this->nome,
      'COR' => $this->cor,
    );

    if($this->id = $obDatabase->insert($arrProduct)){
      // Defini id do produto na classe de Preço extendida por Produto
      $this->setIdProduto($this->id);
      // Define valor do produto na class de Preco extendida por Produto
      $this->setPreco($this->preco);
      // Cadastra preco na tabela de preço
      $this->cadastrarPreco();
    }
  }

  /**
   * Método responsável por atualizar produto no banco
   * @return boolean
   */
  public function atualizar()
  {
    $arrProduct = array(
      'NOME' => $this->nome,
    );

    // Atualiza bine do produto
    if((new Database('produtos'))->update('IDPROD = '.$this->IDPROD, $arrProduct)){
      //Atualiza preco na tabela de preco extendida por produto
      $this->atualizarPreco();
    }
  }

  /**
   * Método estático para busca de produtos
   * @param string $fields
   * @param string $where
   * @param string $order
   * @param string $limit
   * @param string $join
   * @return array
   */
  public static function getProdutos($fields, $where, $order, $limit, $join)
  {
    // Busca os produtos no banco de dados
    return (new Database('produtos'))
      ->select($fields, $where, $order, $limit, $join)
      ->fetchAll(PDO::FETCH_CLASS, self::class);
  }

  /**
   * Método estático para busca um único produto
   * @param string $fields
   * @param string $where
   * @param string $order
   * @param string $limit
   * @param string $join
   * @return array
   */
  public static function getProduto($fields, $where, $order = null, $limit = null, $join)
  {
    return (new Database('produtos'))
      ->select($fields, $where, null, null, $join)
      ->fetchObject(self::class);
  }
}