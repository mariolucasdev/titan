<?php

namespace App\Entity;

use \App\Db\Database;

class Preco
{
  /**
   * Preço do Produto
  */
  public $preco;
  
  /**
   * Id do Produto
  */
  public $idProduto;
  
  /**
   * Get preço do Produto
   */ 
  public function getPreco()
  {
    return $this->preco;
  }

  /**
   * Set preço do Produto
   *
   * @return  self
   * @param integer $preco
   */ 
  public function setPreco($preco)
  {
    $this->preco = $this->converterPreco($preco);

    return $this;
  }

  /**
   * Get id do Produto
   */ 
  public function getIdProduto()
  {
    return $this->idProduto;
  }

  /**
   * Set id do Produto
   * @param integer $idProduto
   * @return  self
   */ 
  public function setIdProduto($idProduto)
  {
    $this->idProduto = $idProduto;

    return $this;
  }

  /**
   * Método responsável pelo cadastro do preço associado ao produto
  */
  public function cadastrarPreco()
  {
    $obDatabase = new Database('preco');
    
    $arrPreco = array(
      'IDPROD' => $this->idProduto,
      'PRECO' => $this->preco,
    );
    
    $obDatabase->insert($arrPreco);
  }
  
  /**
   * Método responsável por alterar o preco
   */
  public function atualizarPreco()
  {
    $obDatabase = new Database('preco');

    $arrPreco = array(
      'PRECO' => $this->converterPreco($this->preco)
    );

    $obDatabase->update('IDPRECO = '.$this->IDPROD, $arrPreco);

    return true;
  }

  /**
   * Método responsável por excluir preço
   * @return boolean
   */
  public function excluirPreco()
  {
    return (new Database('preco'))->delete('IDPRECO = '.$this->IDPRECO);
  }

  /**
   * Helper responsável por converter preco, trocando a vírgula por ponto (decimal)
   */
  public static function converterPreco($preco)
  {
    return str_replace(',', '.', $preco);
  }
}