<?php

/**
 * 
 * BMG
 * © GroSoft, 2016
 * 
 * Business Logic Layer
 *
 * Utilise les services des classes de la bibliothèque Reference
 * Utilise les services de la classe ClientDal
 * Utilise les services de la classe Application
 *
 * @package 	default
 * @author 	DRICI & DASTAN
 * @version    	1.0
 */


/*
 *  ====================================================================
 *  Classe Client : fabrique d'objets Client
 *  ====================================================================
 */

// sollicite les méthodes de la classe ClientDal
require_once ('./modele/Dal/OuvrageDal.class.php');
// sollicite les services de la classe Application
require_once ('./modele/App/Application.class.php');
// sollicite la référence
//require_once ('./modele/Reference/Ouvrage.class.php');

class Ouvrages {

    /**
     * Méthodes publiques
     */
    
    /**
     * récupère les Clients
     * @param   int 	$mode : 0 == tableau assoc, 1 == tableau d'objets
     * @return  un tableau de type $mode 
     */    
    public static function chargerLesOuvrages($mode) {
        $tab = OuvrageDal::loadOuvrage(0);
        if (Application::dataOK($tab)) {
            if ($mode == 0) {
                $res = array();
                foreach ($tab as $ligne) {
                    $unOuvrage = new Ouvrage(
                            $ligne->no_ouvrage, 
                            $ligne->titre,
                            $ligne->salle,
                            $ligne->rayon,
                            $ligne->code_genre,
                            $ligne->date_acquisition
                           
                            
                            
                    );
                    array_push($res, $unOuvrage);
                }
                return $res;
            }
            else {
                return $tab;
            }
        }
        return NULL;
    }

    /**
     * vérifie si un Client existe
     * @param   int $id : l'id du client à contrôler
     * @return  un booléen
     */    
    public static function ouvrageExiste($id) {
        $values = OuvrageDal::loadOuvrageByID($id, 1);
        if (Application::dataOK($values)) {
            return 1;
        }
        return 0;
    }


    
    /**
     * récupère les caractéristiques du client
     * @param   int $id : l'id du client
     * @return  un objet de la classe Client
     */
    public static function chargerOuvrageParId($id) {
        $values = OuvrageDal::loadOuvrageByID($id, 1);
        if (Application::dataOK($values)) {
            $titre = $values[0]->titre;
            $salle = $values[0]->salle;
            $rayon = $values[0]->rayon;
            $code_genre = $values[0]->code_genre;
            $date_acquisition = $values[0]->date_acquisition;
           
            return new Ouvrage ($id,$titre,$salle,$rayon,$code_genre,
                    $date_acquisition);
        }
        return NULL;
    }

    
	
}