<?php 
DECLARE(strict_types=1);
class EleveHasTuteur {
  private $idEleveHasTuteurDAO =0; //int
  private $eleve ; //Eleve 
  private $tuteur ; //Tuteur
  private $lienDeParente= null; // string 
  
  public function setIdEleveHasTuteurDAO(int $idEleveHasTuteurDAO) {
    $this->idEleveHasTuteurDAO = $idEleveHasTuteurDAO;
  }
  public function getIdEleveHasTuteurDAO():int {
    return $this->idEleveHasTuteurDAO;
  }
  public function setEleve(Eleve $eleve) {
    $this->eleve = $eleve;
  }
  public function getEleve():Eleve {
    return $this->eleve;
  }
  public function setTuteur(Tuteur $tuteur) {
    $this->tuteur = $tuteur;
  }
  public function getTuteur():Tuteur {
    return $this->tuteur;
  }
  public function setLienDeParente(string $lienDeParente) {
    $this->lienDeParente = $lienDeParente;
  }
  public function getLienDeParente():string {
    return $this->lienDeParente;
  }
}
?>
