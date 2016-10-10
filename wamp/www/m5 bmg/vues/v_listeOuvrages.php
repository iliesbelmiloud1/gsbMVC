<?php
/** 
 * Page de gestion des ouvrages

  * @author 
  * @package default
 */
?>
<div id="content">
    <h2>Gestion des ouvrages</h2>
    <a href="index.php?uc=gererOuvrages&action=ajouterOuvrage" title="Ajouter">
        Ajouter un ouvrage
    </a>
    <div class="corps-form">
        <fieldset>	
            <legend>Ouvrages</legend>
            <div id="object-list">
                <?php
                echo '<span>'.$nbOuvrages.' ouvrage(s) trouvé(s)'
                        . '</span><br /><br />';
                // afficher un tableau des ouvrages
                if ($nbOuvrages > 0) {
                    // création du tableau
                    echo '<table>';
                    // affichage de l'entête du tableau 
                    echo '<tr>'
                            .'<th>ID</th>'
                            .'<th>Titre</th>'
                            
                            .'<th>Auteur</th>'
                            .'<th>Nombre de pret</th>'
                            .'<th>Dernier prêt</th>'
                            .'<th>Etat</th>'
                            .'</tr>';
                    // affichage des lignes du tableau
                    $n = 0;
                    foreach($lesOuvrages as $unOuvrage)  {
                        //var_dump($lesOuvrages);
                        if (($n % 2) == 1) {
                            echo '<tr class="impair">';
                        }
                        else {
                            echo '<tr class="pair">';
                        }
                        // afficher la colonne 1 dans un hyperlien
                        echo '<td><a href="index.php?uc=gererOuvrages&action=consulterOuvrage&id='
                            .$unOuvrage->no_ouvrage.'">'.$unOuvrage->no_ouvrage.'</a></td>';
                            
                        // afficher les colonnes suivantes
                        echo '<td>'.$unOuvrage->titre.'</td>';
                        //echo '<td>'.$unOuvrage->disponibilite.'<td>';
                        //echo '<td>'.$unOuvrage->auteur.'<td>';
                        echo '<td>'.$unOuvrage->auteur.'</td>';
                        echo '<td>'.$unOuvrage->no_ouvrage.'</td>';
                        /*echo '<td>'.$unOuvrage->getTitre().'</td>';
                        echo '<td>'.$auteur->getNom().'</td>';
                        echo '<td>'.$unOuvrage->getNbPret().'</td>';
                        echo '<td>'.$unOuvrage->getEtat().'</td>';
                        echo '<td>'.$unOuvrage->getEtat().'</td>';
                        /*if ($auteur->getNom() == 'Indéterminé') {
                            echo '<td class="erreur">'.$unOuvrage->getSalle().'</td>';
                        }
                        else {
                            echo '<td>'.$unOuvrage->getRayon().'</td>';
                        }
                        echo '<td>'.$unOuvrage->getRayon().'</td>';
                        echo '<td>'.$unOuvrage->getRayon().'</td>';
                        echo '<td>'.$unOuvrage->getRayon().'</td>';*/
                     echo '<td>'.$unOuvrage->dernier_pret.'</td>';
                        if ($unOuvrage->disponibilite == 'D') {
                            echo '<td class="center"><img src="img/dispo.png"</td>';
                        }
                        else {
                            echo '<td class="center"><img src="img/emprunte.png"</td>';
                        }
                        echo '</tr>';
                        $n++;
                    }
                    echo '</table>';
                }
                else {			
                    echo "Aucun ouvrage trouvé !";
                }		
                ?>
            </div>
        </fieldset>
    </div>
</div>