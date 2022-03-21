<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database
{
  /**
   * Host de conexão com banco de dados
   * @var string
   */
  const HOST = 'localhost';

  /**
   * Nome da base de dados
   * @var string
   */
  const NAME = 'titan_db';

  /**
   * Usuário do banco de dados
   * @var string
   */
  const USER = 'root';

  /**
   * Senha do banco de dados
   * @var string
   */
  const PASS = '';

  /**
   * Nome da tablea a ser manipulada
   * @var string
   */
  private $table;

  /**
   * Instância do PDO (conexão)
   * @var PDO
   */
  private $connection;

  /**
   * Define a table e instancia a conexão
   * @param string
   */
  public function __construct($table = null)
  {
    $this->table = $table;
    $this->setConnection();
  }

  /**
   * Método responsável por criar uma conexão com o banco de dados
   */
  private function setConnection()
  {
    try {
      $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER, self::PASS);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die('Error: '. $e->getMessage());
    }
  }

  /**
   * Método responsável por executar queries dentro do banco de dados
   * @param string $query
   * @param array $params
   * @return PDOStatement
   */
  public function execute($query, $params = [])
  {
    try {
      $statement = $this->connection->prepare($query);
      $statement->execute($params);
      return $statement;
    } catch (PDOException $e) {
      die('Error: '. $e->getMessage());
    }

  }

  /**
   * Método responsável inserir dados no banco de dados
   * @param array $values [ field => value ]
   * @return integer id inserido
   */
  public function insert($values)
  {
    //Dados da query
    $fields = array_keys($values);
    $binds = array_pad([], count($fields), '?');

    //Montagem da Query
    $query = 'INSERT INTO '. $this->table .' ('.implode(',', $fields).') VALUES ('. \implode(',', $binds) .')';
    
    //Executa o insert
    $this->execute($query, array_values($values));

    //Retorna o id inserido;
    return $this->connection->lastInsertId();
  }

  /**
   * Método responsável por executar consulta no banco de dados
   * @param string $where
   * @param string $order
   * @param string $limit
   * @param string $join
   * @param string $whereJoin
   * @return PDOStatement
   */
   public function select($fields = "*", $where = null, $order = null, $limit = null, $join = null)
   {
      // Dados da query
      $where = strlen($where) ? 'WHERE '.$where : null;
      $order = strlen($order) ? 'ORDER BY '.$order : null;
      $limit = strlen($limit) ? 'LIMIT '.$limit : null;
      $join = strlen($join) ? 'JOIN '.$join : null;
      
      // Montagem da Query
      $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$join.' '.$where.' '.$order.' '.$limit;

      //Executa a query
      return $this->execute($query);
   }

  
}