<?php
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
switch ($action) {
    case 'selectionnerAnnee': {
            $lAnnee = $_POST['lstAnnee'];
            $lesFraisAnnuels = $pdo->getLesFraisAnnuels($idVisiteur, $lAnnee);
            include("vues/v_statAnnee.ajx.php");
        }
}
?>