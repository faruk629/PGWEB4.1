<?php 
DECLARE(strict_types=1);
class Tuteur {
  private $idTuteur=0; //int 
  private $nom=null; //string 
  private $prenom=null; //string 
  private $sexe=null; //string 
  private $nRegistreNational=null; // string
  private $email=null; //string 
  private $mobile=null; //string 
  private $telephone=null; //string
  private $dateCreation = null;//string

  
  
  function setIdTuteur(int $idTuteur) {
   $this->idTuteur = $idTuteur;  
  }
  function getIdTuteur():int {
   return $this->idTuteur; 
  }
  function setNom(string $nom) {
    $this->nom = $nom;  
  }
  function getNom():string {
    return $this->nom; 
  }
  function setPrenom(string $prenom) {
    $this->prenom = $prenom;  
  }
  function getPrenom():string {
    return $this->prenom; 
  }
  function setSexe(string $sexe){
    $this->sexe = $sexe;  
  }
  function getSexe():string {
     return $this->sexe;
  }
  function setNRegistreNational(string $nRegistreNational) {
     $this->nRegistreNational = $nRegistreNational;  
  }
  function getNRegistreNational():string {
    return $this->nRegistreNational; 
  }
  function setEmail(string $email) {
   $this->email = $email;  
  }
  function getEmail():string {
    return $this->email; 
  }  
  function setMobile(string $mobile) {
   $this->mobile = $mobile;  
  }
  function getMobile():string {
    return $this->mobile; 
  } 
  function setTelephone(string $telephone) {
   $this->telephone = $telephone;  
  }
  function getTelephone():?string {
    return $this->telephone; 
  }
  function setDateCreation(string $dateCreation) {
      $this->dateCreation = $dateCreation;
  }
  function getDateCreation():string {
      return $this->dateCreation;
  }
}
?>
