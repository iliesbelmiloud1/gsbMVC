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
 * @author 		Collectif
 * @version    	1.0
 */


/*
 *  ====================================================================
 *  Classe Auteur : représente un auteur d'ouvrage 
 *  ====================================================================
*/

class Auteur {
	
    private $_id;
    private $_nom;
    private $_prenom;
    private $_alias;
    private $_notes;

    /**
     * Constructeur 
    */				
    public function __construct(
            $p_id,
            $p_nom,
            $p_prenom,
            $p_alias,
            $p_notes
    ) {
        $this->setId($p_id);
        $this->setNom($p_nom);
        $this->setPrenom($p_prenom);
        $this->setAlias($p_alias);
        $this->setNotes($p_notes);
    }  
    
    /**
     * Accesseurs
    */

    public function getId () {
        return $this->_id;
    }

    public function getNom () {
        return $this->_nom;
    }
	
    public function getPrenom () {
        return $this->_prenom;
    }
	
    public function getAlias () {
        return $this->_alias;
    }
	
    public function getNotes () {
        return $this->_notes;
    }
    
    /**
     * Mutateurs
    */
    
    public function setId ($p_id) {
        $this->_id = $p_id;
    }

    public function setNom ($p_nom) {
        $this->_nom = $p_nom;
    }
	
    public function setPrenom ($p_prenom) {
        $this->_prenom = $p_prenom;
    }
	
    public function setAlias ($p_alias) {
        $this->_alias = $p_alias;
    }
	
    public function setNotes ($p_notes) {
        $this->_notes = $p_notes;
    }
}
