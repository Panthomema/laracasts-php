<?php

class Database 
{
  public $connection;

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
    $statement = $this->connection->prepare($query);
    $statement->execute($params);
    return $statement;
  }
}