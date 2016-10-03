<?php
/**
 * Contrôleur secondaire chargé de la gestion des auteurs
 * @author  collectif
 * @package default (mission 4)
 */
 
// bibliothèques à utiliser
require_once ('modele/App/Application.class.php');
require_once ('modele/App/Notification.class.php');
require_once ('modele/Render/AdminRender.class.php');
require_once ('modele/Bll/Auteurs.class.php');

// récupération de l'action à effectuer
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
else {
    $action = 'listerAuteurs';
}

// si un id est passé en paramètre, créer un objet (pour consultation, modification ou suppression)
if (isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
    $unAuteur = Auteurs::chargerAuteurParID($id);
}

// charger la vue en fonction du choix de l'utilisateur
switch ($action) {
    case 'listerAuteurs' : {
        // récupérer les auteurs
        $lesAuteurs = Auteurs::chargerLesAuteurs(1);
        // afficher le nombre d'auteur 
        $nbAuteurs = count($lesAuteurs);
        include 'vues/v_listeAuteurs.php';
    } break;    
    case 'consulterAuteur' : {
        if ($unAuteur == NULL) {
            Application::addNotification(new Notification("Cet auteur n'existe pas !", ERROR));
        }
        else {
            include 'vues/v_consulterAuteur.php';
        }
    } break;
    case 'ajouterAuteur' : {
         // initialisation des variables
        $hasErrors = false;        
        $strNom = '';
        $strPrenom = '';
        $strAlias = '';
        $strNotes = '';
        // traitement de l'option : saisie ou validation ?
        if (isset($_GET["option"])) {
            $option = htmlentities($_GET["option"]);
        }
        else {
            $option = 'saisirAuteur';
        }
        switch($option) {            
            case 'saisirAuteur' : {
                include 'vues/v_ajouterAuteur.php';
            } break;
            case 'validerAuteur' : {
                // tests de gestion du formulaire
                if (isset($_POST["cmdValider"])) {
                    // test zones obligatoires
                    if (!empty($_POST["txtNom"])) {
                        // les zones obligatoires sont présentes
                        $strNom = ucfirst(htmlentities(
                                $_POST["txtNom"])
                        );
                        $strPrenom = ucfirst(htmlentities(
                                $_POST["txtPrenom"])
                        );
                        $strAlias = ucfirst(htmlentities(
                                $_POST["txtAlias"])
                        );
                        $strNotes =ucfirst(htmlentities( 
                                $_POST["txtNotes"])
                        );
                        // tests de cohérence 
                    }
                    else {
                        // une ou plusieurs valeurs n'ont pas été saisies
                        if (empty($strNom)) {                                
                            Application::addNotification(new Notification("Le nom doit être renseigné !", ERROR));
                        }
                        $hasErrors = true;
                    }
                    if (!$hasErrors) {
                        // ajout dans la base de données
                        $unAuteur = Auteurs::ajouterAuteur(array($strNom,$strPrenom,$strAlias,$strNotes));
                        Application::addNotification(new Notification("L'auteur a été ajouté !", SUCCESS));
                        include 'vues/v_consulterAuteur.php';
                    }
                    else {
                        include 'vues/v_ajouterAuteur.php';
                    }
                }
            } break;
        }        
    } break;    
    case 'modifierAuteur' : {
        // initialisation des variables
        $hasErrors = false;
        $strNom = '';
        $strPrenom = '';
        $strAlias = '';
        $strNotes = '';        
        // traitement de l'option : saisie ou validation ?
        if (isset($_GET["option"])) {
            $option = htmlentities($_GET["option"]);
        }
        else {
            $option = 'saisirAuteur';
        }
        switch($option) {            
            case 'saisirAuteur' : {
                // récupération du code
                if (isset($_GET["id"])) {
                    include("vues/v_modifierAuteur.php");
				}
                else {
                    Application::addNotification(new Notification("L'auteur est inconnu !", ERROR));
                    include("vues/v_listeAuteur.php");
                }
            } break;
            case 'validerAuteur' : {
                // si on a cliqué sur Valider
                if (isset($_POST["cmdValider"])) {
                    // récupération des valeurs saisies
                    if (!empty($_POST["txtNom"])) {
                        $strNom = ucfirst($_POST["txtNom"]);
                    }
                    if (!empty($_POST["txtPrenom"])) {
                        $strPrenom = ucfirst(($_POST["txtPrenom"]));
                    }
                    if (!empty($_POST["txtAlias"])) {
                        $strAlias = ucfirst(($_POST["txtAlias"]));
                    }
                    if (!empty($_POST["txtNotes"])) {
                        $strNotes = ucfirst($_POST["txtNotes"]);
                    }                            
                    // test zones obligatoires
                    if (!empty($strNom)) {
                        // les zones obligatoires sont présentes
                        // tests de cohérence
                    }
                    else {
                        if (empty($strNom)) {
                            Application::addNotification(new Notification("Le nom est obligatoire !", ERROR));
                        }
                        $hasErrors = true;
                    }
                    if (!$hasErrors) {
                        // mise à jour dans la base de données
                        $unAuteur->setNom($strNom);    
                        $unAuteur->setPrenom($strPrenom);
                        $unAuteur->setAlias($strAlias);
                        $unAuteur->setNotes($strNotes);
                        $res = Auteurs::modifierAuteur($unAuteur);
                        Application::addNotification(new Notification("L'auteur a été modifié ! ", SUCCESS));   
                        include 'vues/v_consulterAuteur.php';
					}
					else {
						include ("vues/v_modifierAuteur.php");
					}
				}
			} break;      
        }
    } break;
    case 'supprimerAuteur' : {
        // rechercher des ouvrages écrits par cet auteur
		if (Auteurs::nbOuvragesParAuteur($unAuteur->getId()) > 0) {
			Application::addNotification(new Notification("Cet auteur a écrit des ouvrages, impossible de le supprimer ! ", ERROR));
			include 'vues/v_consulterAuteur.php'; 
		}
		else {
			// supprimer l'auteur
			Auteurs::supprimerAuteur($unAuteur->getID());
			Application::addNotification(new Notification("L'auteur a été supprimé", SUCCESS));
			// afficher la liste
			$lesAuteurs = Auteurs::chargerLesAuteurs(1);
			$nbAuteurs = count($lesAuteurs);
			include 'vues/v_listeAuteurs.php';
		}
    } break;
}

