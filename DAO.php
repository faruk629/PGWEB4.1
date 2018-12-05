<?php
DECLARE(strict_types=1);
abstract class DAO {
    protected $pdo = null;
    public function __construct($pdo){
        $this->pdo=$pdo;
    }
    public abstract function insert($object):void;
    public abstract function findId($object):void;  //pour encoder un record correspondant à l'entité
}