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
      $this->setIdProduto($this->id);
      $this->setPreco(\str_replace(',', '.', $this->preco));
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
    if((new Database('produtos'))->update('IDPROD = '.$this->id, $arrProduct)){
      if($this->id = $obDatabase->update('IDPRECO = '.$this->IDPRECO, $arrProduct)){
        $this->setIdPreco($this->IDPRECO);
        $this->setPreco(\str_replace(',', '.', $this->preco));
        $this->atualizarPreco();
      }
    }
  }

  /**
   * Método estático para busca de produtos
   * @param string $where
   * @param string $order
   * @param string $limit
   * @param string $join
   * @param string $wherJoin
   * @return array
   */
  public static function getProdutos($fields, $where, $order, $limit, $join)
  {
    return (new Database('produtos'))
      ->select($fields, $where, $order, $limit, $join)
      ->fetchAll(PDO::FETCH_CLASS, self::class);
  }

  /**
   * Método estático para busca um porduto pelo id
   * @param string $id
   * @return array
   */
  public static function getProduto($fields, $where, $order, $limit, $join)
  {
    return (new Database('produtos'))
      ->select($fields, $where, $order, $limit, $join)
      ->fetchObject(self::class);
  }
}