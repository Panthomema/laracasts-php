<?php

namespace Core;
use PDO;

class Database 
{
  public $connection;
  public $statement; // would be protected

  public function __construct($config, $username = 'root', $password = '') {
    
    // smart use of that function to build the PDO dsn
    $dsn = 'mysql:' . http_build_query($config, '', ';');

    // make the connection, defaulting the output
    $this->connection = new PDO($dsn, $username, $password, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  // query method, return the statement so we do with it whatever
  public function query($query, $params = [])
  {
    $this->statement = $this->connection->prepare($query);
    $this->statement->execute($params);
    return $this;
  }

  // wrap fetch()
  public function find() {
    return $this->statement->fetch();
  }

  // wrap fetch with error handling
  public function findOrFail() {
    $result = $this->find();

    if (!$result) {
      abort();
    }
    
    return $result;
  }

  // wrap fetchAll()
  public function get() {
    return $this->statement->fetchAll();
  }
}