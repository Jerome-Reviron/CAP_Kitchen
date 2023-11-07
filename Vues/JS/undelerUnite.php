<?php
include '../../Modeles/bdd_connexion.php';
include '../../Modeles/Unite.php';

$Id = $_GET['Id_Unite'];
$Unite = Unite::getInfoUnite($Id);

if ($Unite !== false) {
    if ($Unite->deleteUniteById()) {
        echo "Unité effacé\n";
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'message' => 'Unité non effacé!');
    }
} else {
    $response = array('success' => false, 'message' => 'Unité non trouvé!');
}
?>