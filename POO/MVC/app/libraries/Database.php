<?php

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $pdo;
    private $stmt;


    public function __construct(){
        $dsn ='mysql:host=' .$this->host . ';dbname=' .$this->dbname. ';charset=utf8';
        try{
            $this->pdo = new PDO($dsn, $this->user, $this->pass);

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    //  méthodes perso pour la BDD

    // prepare
    public function query($sql){
        $this->stmt = $this->pdo->prepare($sql);
    }

    //bindValues
    public function bind($param, $value, $type){
        switch(true){
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->stmt->bindValue($param, $value, $type);
    }


    // fetch & fetchAll
    public function execute(){
        return $this->stmt->execute();
    }

    public function findAll(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function findOne(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }


    public function rowCount(){
        return $this->stmt->rowCount();
    }

}

