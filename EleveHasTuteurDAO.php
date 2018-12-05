<?php
DECLARE(strict_types=1);
require_once("EleveDAO.php");
require_once("TuteurDAO.php");
class EleveHasTuteurDAO extends DAO
{
    public function insert($object):void
    {
        if (!isset($object)) {
            throw new Exception("Attention objet vide");
        } else if (!($object instanceOF EleveHasTuteur)) {
            throw new Exception("Attention l'objet n'est pas de type EleveHasTuteur");
        } else if ($object->getIdEleveHasTuteurDAO() != 0) {
            throw new Exception("Attention l'objet EleveHasTuteur est déjà enregistré");
        }
        if($object->getEleve()->getIdEleve()==0) {
            $eleveTmp = new \EleveDAO($this->pdo);
            $eleveTmp->insert($object->getEleve());
        }
        $tuteurTmp = new \TuteurDAO($this->pdo);
        $tuteurTmp->insert($object->getTuteur());

        $sqlInsert = ("INSERT INTO eleveHasTuteur VALUES(null,:idEleve,:idTuteur,:lienDeParente)");
        $pst = $this->pdo->prepare($sqlInsert);
        $pst->bindValue(':idEleve', $object->getEleve()->getIdEleve(), PDO::PARAM_INT);
        $pst->bindValue(':idTuteur', $object->getTuteur()->getIdTuteur(), PDO::PARAM_INT);
        $pst->bindValue(':lienDeParente', $object->getLienDeParente(), PDO::PARAM_STR);
        $pst->execute();

        $keyEleveHasTuteur = $this->pdo->lastInsertId();
        $object->setIdEleveHasTuteurDAO((int)$keyEleveHasTuteur);
    }

    public function findId($object): void
    {
        // TODO: Implement findId() method.

    }
}
