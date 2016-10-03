<?php
/** 
 * Page de gestion des auteurs

 * @author 	collectif
 * @package default
*/
?>
<div id="content">
    <h2>Gestion des auteurs</h2>
    <div id="object-list">
        <div class="corps-form">
            <fieldset>
                <legend>Consulter un auteur</legend>                        
                <div id="breadcrumb">
                    <a href="index.php?uc=gererAuteurs&action=ajouterAuteur">Ajouter</a>&nbsp;
                    <a href="index.php?uc=gererAuteurs&action=modifierAuteur&option=saisirAuteur&id=<?php echo $unAuteur->getId(); ?>">Modifier</a>&nbsp;
                    <a href="index.php?uc=gererAuteurs&action=supprimerAuteur&id=<?php echo $unAuteur->getId();?>">Supprimer</a>;
                </div>
                <table>
                    <tr>
                        <td class="h-entete">
                            ID :
                        </td>
                        <td class="h-valeur">
                            <?php echo $unAuteur->getId(); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Nom :
                        </td>
                        <td class="h-valeur">
                            <?php echo $unAuteur->getNom(); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Prénom :
                        </td>
                        <td class="h-valeur">
                            <?php echo $unAuteur->getPrenom(); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Alias :
                        </td>
                        <td class="h-valeur">
                            <?php echo $unAuteur->getAlias(); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Notes :
                        </td>
                        <td class="h-valeur">
                            <?php echo $unAuteur->getNotes(); ?>
                        </td>
                    </tr>
                </table>
            </fieldset>                    
        </div>
    </div>
</div>
