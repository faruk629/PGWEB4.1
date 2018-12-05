<?php 
DECLARE(strict_types=1);
require_once("PDOConnect.php");
require_once('Eleve.php');
require_once("Tuteur.php");
require_once("EleveHasTuteur.php");
require_once("EleveHasTuteurDAO.php");
$elev = new Eleve;
$elev->setNom("Oner");
$elev->setPrenom("Zeyd");
$elev->setSexe("M");
$elev->setNRegistreNational("91080149782");
$elev->setDateNaissance(new \DateTime("1991-08-01"));
$elev->setRue("chaussee");
$elev->setNRue("160");
$elev->setCodePostal("6042");
$elev->setVille("lodelinsart");
$elev->setDateCreation((new DateTime('now'))->format('Y-m-d'));
$ann = new Annee ; 
$ann->setAcronyme("1A");
$ann->setLibelle("1ère secondaire A");
$elev->setAnnee($ann);

$tuteur = new Tuteur;
$tuteur->setNom("Oner");
$tuteur->setPrenom("Faruk");
$tuteur->setSexe("M");
$tuteur->setNRegistreNational("91080149782");
$tuteur->setEmail("faruk629@hotmail.com");
$tuteur->setMobile("0485585848");

$tuteur->setTelephone("071308869");
$tuteur->setDateCreation((new DateTime('now'))->format('Y-m-d'));

$assoc = new EleveHasTuteur;
$assoc->setEleve($elev);
$assoc->setTuteur($tuteur);
$assoc->setLienDeParente("Pére");

$flag=false;

try{
    $pdo= getPDOConnect();
    $pdo->setAttribute(\PDO::ATTR_AUTOCOMMIT, false); // par défaut PDO autocommit à true
    $pdo->beginTransaction();
$test = new EleveHasTuteurDAO($pdo);
$test->insert($assoc);
$pdo->commit();
$flag=true;
echo "encodé";
}catch(\PDOException $e) {
    echo $e->getMessage();
}catch(Exception $e){
    echo $e->getMessage();
}Finally {
    if ( $flag === false ) {
        $pdo->rollBack();
        echo "insertion et roolback";
    }
}
