<?php

/**
 *
 */
class Sql extends PDO {

    // Dados do banco
    private $conn;
    private $server   = "localhost:3306";
    private $db       = "dbphp7";
    private $user     = "root";
    private $pass     = "";
    private $tipo     = "mysql";
    private $charset  = "utf-8";



    public function __construct() {
        /*
        O curso explicou que quando trabalhamos com POO as variáveis ganham recursos
        Por exemplo $conn é um atributo da classe
        Quando estamos dentro do escopo da classe, para acessar atributos não usamos novamente $conn mas usamos: $this->conn, 
        que já está contido o valor de $conn
        */
        $this->conn = new PDO("mysql:dbname=dbphp7;host=localhost:3306","root","");
    }

    private function setParams($statment, $parameters = array()){
        foreach ($parameters as $key => $value) {
            $this->setParam($key, $value);
        }
    }

    private function setParam($statment, $key, $value) {
        $statment->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array()){
       $stmt = $this->conn->prepare($rawQuery);
       $this->setParams($stmt, $params);
       $stmt->execute();
       return $stmt;
    }


    public function select($rawQuery, $params = array())
    {
        $stmt = $this->query($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>