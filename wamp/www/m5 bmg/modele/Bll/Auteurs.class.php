<?php

/**
 * 
 * BMG
 * © GroSoft, 2016
 * 
 * Business Logic Layer
 *
 * Utilise les services des classes de la bibliothèque Reference
 * Utilise les services de la classe GenreDal
 * Utilise les services de la classe Application
 *
 * @package 	default
 * @author 		collectif
 * @version    	1.0
 */


/*
 *  ====================================================================
 *  Classe Auteurs : fabrique d'objets Auteur
 *  ====================================================================
 */

// sollicite les méthodes de la classe GenreDal
require_once ('./modele/Dal/AuteurDal.class.php');
// sollicite les services de la classe Application
require_once ('./modele/App/Application.class.php');
// sollicite la référence
require_once ('./modele/Reference/Auteur.class.php');

class Auteurs {

    /**
     * Méthodes publiques
     */
    
    /**
     * récupère les auteurs
     * @param   int 	$mode : 0 == tableau assoc, 1 == tableau d'objets
     * @return  un tableau de type $mode 
     */    
    public static function chargerLesAuteurs($mode) {
        $tab = AuteurDal::loadAuteur(1);
        if (Application::dataOK($tab)) {
            if ($mode == 1) {
                $res = array();
                foreach ($tab as $ligne) {
                    $unAuteur = new Auteur(
                            $ligne->id_auteur, 
                            $ligne->nom_auteur,
                            $ligne->prenom_auteur,
                            $ligne->alias,
                            $ligne->notes
                    );
                    array_push($res, $unAuteur);
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
     * vérifie si un auteur existe
     * @param   int $id : l'id de l'auteur à contrôler
     * @return  un booléen
     */    
    public static function auteurExiste($id) {
        $values = AuteurDal::loadAuteurByID($id, 1);
        if (Application::dataOK($values)) {
            return 1;
        }
        return 0;
    }

    /**
     * ajoute un auteur
     * @param   array 	$valeurs : le tableau des propriétés de l'auteur à ajouter
     * @return  un objet de la classe Auteur
     */
    public static function ajouterAuteur($valeurs) {
        $id = AuteurDal::addAuteur(
                $valeurs[0],
                $valeurs[1],
                $valeurs[2],
                $valeurs[3])
        ;
        return self::chargerAuteurParId($id);
    }

    /**
     * modifie un auteur
     * @param   Object $auteur : un objet de la classe Auteur
     * @return  int un code erreur revoyé par la méthode de la DAL
     */
    public static function modifierAuteur($auteur) {
        return AuteurDal::setAuteur(
            $auteur->getId(), 
            $auteur->getNom(),
            $auteur->getPrenom(),  
            $auteur->getAlias(),
            $auteur->getNotes()
        );
    }    
    
    /**
     * supprime un auteur
     * @param   int $id : l'id de l'auteur à supprimer
     * @return  int	un code erreur revoyé par la méthode de la DAL
     */    	
    public static function supprimerAuteur($id) {
        return AuteurDal::delAuteur($id);
    }    
    
    /**
     * récupère les caractéristiques d'un auteur
     * @param   int $id : l'id de l'auteur
     * @return  un objet de la classe Auteur
     */
    public static function chargerAuteurParId($id) {
        $values = AuteurDal::loadAuteurByID($id, 1);
        if (Application::dataOK($values)) {
            $id = $values[0]->id_auteur;
            $nom = $values[0]->nom_auteur;
            $prenom = $values[0]->prenom_auteur;
            $alias = $values[0]->alias;
            $notes = $values[0]->notes;
            return new Auteur ($id,$nom,$prenom,$alias,$notes);
        }
        return NULL;
    }  

    /**
     * récupère le nombre d'ouvrages écrits par un auteur
     * @param   int $id : l'id de l'auteur
     * @return  un entier
     */
    public static function nbOuvragesParAuteur($id) {
        return AuteurDal::countOuvragesAuteur($id);
    }  

	
}
