<?php
include '../../Modeles/bdd_connexion.php';
include '../../Modeles/Fournisseur.php';

$Id = $_GET['Id_Fournisseur'];
$Fournisseur = Fournisseur::getInfoFournisseur($Id);

if ($Fournisseur !== false) {
    if ($Fournisseur->deleteFournisseurById()) {
        echo "Fournisseur effacé\n";
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'message' => 'Fournisseur non effacé!');
    }
} else {
    $response = array('success' => false, 'message' => 'Fournisseur non trouvé!');
}
?>