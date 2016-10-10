<?php
/** 
 * BMG
 * © GroSoft, 2015
 * 
 * Data Access Layer
 * Classe d'accès aux données 
 *
 * Utilise les services de la classe PdoDao
 *
 * @package 	default
 * @author 	Belmiloud&Drici
 * @version    	1.0
 */

// sollicite les services de la classe PdoDao
require_once ('PdoDao.class.php');

class OuvrageDal { 
       
    /**
     * @param  $style : 0 == tableau assoc, 1 == objet
     * @return  un objet de la classe PDOStatement
    */   
    public static function loadOuvrages($style) {
        $cnx = new PdoDao();
        $qry = 'SELECT * FROM v_ouvrages';
        $res = $cnx->getRows($qry,array(),$style);
        if (is_a($res,'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }        
        return $res;
    }

    /**
     * charge un objet de la classe Auteur à partir de son id
     * @param  int	$id : l'identifiant de l'auteur
     * @return  un objet de la classe Auteur
    */   
    public static function loadOuvrageById($id) {
        $cnx = new PdoDao();
        $qry = 'SELECT * FROM ouvrage WHERE no_ouvrage = ?';
        $res = $cnx->getRows($qry,array($id),1);
        if (is_a($res,'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    } 
    
    public static function countNbPret($id) {
        $cnx = new PdoDao();
        $qry = 'SELECT count(*) FROM pret GROUP BY no_ouvrage';
        $res = $cnx->getRows($qry,array($id),1);
        if (is_a($res,'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    } 
    
    public static function loadAuteursByOuvrage($no){
        $cnx = new PdoDao();
        $qry = 'SELECT id_auteur FROM auteur_ouvrage WHERE no_ouvrage = ?';
        $res = $cnx->getRows($qry,array($id),1);
        if (is_a($res,'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }
}