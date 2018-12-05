<?php
DECLARE(strict_types=1);
require_once("MyPdo.php");
require_once("Parameters.php");

    function getPDOConnect(): \PDO
    {
        MyPdo::setParameters(Parameters::DSN, Parameters::USER, Parameters::PASSWORD);
        $pdo = MyPdo::getInstancePdo();
        $pdo->setAttribute(\PDO::ATTR_AUTOCOMMIT, false); // par défaut PDO autocommit à true
        return $pdo;
    }