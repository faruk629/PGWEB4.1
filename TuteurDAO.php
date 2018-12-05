<?php
DECLARE(strict_types=1);
require_once("DAO.php");
require_once("Tuteur.php");
class TuteurDAO extends DAO {
  public function insert($object):void {
    if(!isset($object)) {
      throw new Exception("Attention objet vide");
    }else if( !($object instanceOF Tuteur)) {
      throw new Exception("Attention l'objet n'est pas de type Tuteur"); 
    }else if ($object->getIdTuteur() != 0) {
      throw new Exception("Attention le Tuteur est déjà enregistré");
    }
      $sqlInsert = ("INSERT INTO tuteur VALUES(null,:nom,:prenom,:sexe,:nRegistreNational,:email,:mobile,:telephone,:dateCreation)");
      $pst = $this->pdo->prepare($sqlInsert);
      $pst->bindValue(':nom', $object->getNom(), PDO::PARAM_STR);
      $pst->bindValue(':prenom', $object->getPrenom(), PDO::PARAM_STR);
      $pst->bindValue(':sexe', $object->getSexe(), PDO::PARAM_STR);
      $pst->bindValue(':nRegistreNational', $object->getNRegistreNational(), PDO::PARAM_STR);
      $pst->bindValue(':email', $object->getEmail(), PDO::PARAM_STR);
      $pst->bindValue(':mobile', $object->getMobile(), PDO::PARAM_STR);
      $pst->bindValue(':telephone', $object->getTelephone(), PDO::PARAM_STR);
      $pst->bindValue('dateCreation',$object->getDateCreation(),PDO::PARAM_STR);
      $pst->execute();

      $keyTuteur = $this->pdo->lastInsertId();
      $object->setIdTuteur((int)$keyTuteur);
  }
  public function findId($object):void{}
}
