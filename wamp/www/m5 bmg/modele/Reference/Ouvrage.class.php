<?php
/** 
 * 
 * BMG
 * © GroSoft, 2016
 * 
 * References
 * Classes métier
 *
 *
 * @package 	default
 * @author 	 DANG
 * @version    	1.0
 */


/*
 *  ====================================================================
 *  Classe Client : représente un client
 *  ====================================================================
*/

class Ouvrage {
    private $_no_ouvrage;
    private $_titre;
    private $_salle;
    private $_rayon;
    private $_codegenre;
    private $_date_acquisition;
    
    private $_auteur;
    private $_disponibilite;
    private $_dernier_pret;
    /**
     * Constructeur 
    */				
    public function __construct(
            $p_no_ouvrage,
            $p_titre,
            $p_salle,
            $p_rayon,
            $p_codegenre,
            $p_date_acquisition
                                
    ) {
        $this->setNoOuvrage($p_no_ouvrage);
        $this->setTitre($p_titre);
        $this->setSalle($p_salle);
        $this->setRayon($p_rayon);
        $this->setCodeGenre($p_codegenre);
        $this->setAcquisition($p_date_acquisition);
    }  
    
    /**
     * Accesseurs
    */

    public function getNoOuvrage() {
        return $this->_no_ouvrage;
    }

    public function getTitre () {
        return $this->_titre;
    }
	
    public function getSalle() {
        return $this->_salle;
    }
	
    public function getRayon () {
        return $this->_rayon;
    }
	
    public function getCodeGenre () {
        return $this->_codegenre;
    }
    
    public function getAcquisition () {
        return $this->_date_acquisition;
    }
    
    /**
     * Mutateurs
    */
    
    public function setNoOuvrage ($p_no_ouvrage) {
        $this->_no_oucrage = $p_no_ouvrage;
    }

    public function setTitre ($p_titre) {
        $this->_titre = $p_titre;
    }
	
    public function setSalle ($p_salle) {
        $this->_salle = $p_salle;
    }
	
    public function setRayon ($p_rayon) {
        $this->_rayon = $p_rayon;
    }
	
    public function setCodeGenre ($p_codegenre) {
        $this->_codep = $p_codegenre;
    }
    
    public function setAcquisition ($p_date_acquisition) {
        $this->_ville = $p_date_acquisition;
    }
    
    
    public function getAuteurs()
    {
        $tab = OuvrageDal::loadAuteursByOuvrage($this->getNo());
        $res = array();
        foreach ($tab as $ligne) {
            $unAuteur = AuteurDal::loadAuteurByID($ligne->id_auteur);
            $lAuteur = new Auteur($unAuteur[0]->id_auteur,
                                  $unAuteur[0]->nom_auteur,
                                  $unAuteur[0]->prenom_auteur,
                                  $unAuteur[0]->alias,
                                  $unAuteur[0]->notes);
            array_push($res, $lAuteur);
        }
        return $res;
    }
}


