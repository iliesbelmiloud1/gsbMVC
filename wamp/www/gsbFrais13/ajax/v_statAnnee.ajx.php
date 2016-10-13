<hr>
<div class="panel panel-primary">
    <div class="panel-heading">Frais remboursés de l'année <?php echo $lAnnee ?> : </div>
</div>

<div class="panel panel-info">

    <table class="table table-bordered table-responsive">
        <tr>
            <th class="date">Mois</th>
            <th class="libelle">Montant remboursé</th>
            <th class='montant'>Nombre justificatifs</th>                
        </tr>
        <?php
        $mtAnnee = 0;
        $nbJustifAnnee=0;
        foreach ($lesFraisAnnuels as $unMoisStat) {
            $mois = substr($unMoisStat['mois'], 4, 2);
            $montant = $unMoisStat['montant'];
            $nbJustificatifs = $unMoisStat['nbJustif'];
            $mtAnnee+=$montant;
            $nbJustifAnnee+=$nbJustificatifs;
            ?>
            <tr>
                <td><?php echo $mois ?></td>
                <td><?php echo number_format($montant, 2, ',', ' ') ?></td>
                <td><?php echo $nbJustificatifs ?></td>
            </tr>
            <?php
        }
        ?>
            <tr>
                <td>Totaux de l'année <?php echo $lAnnee ?></td>
                <td><?php echo number_format($mtAnnee, 2, ',', ' ') ?></td>
                <td><?php echo $nbJustifAnnee ?></td>
            </tr>
    </table>
</div>