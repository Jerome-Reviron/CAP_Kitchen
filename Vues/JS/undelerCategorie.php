<?php
include '../../Modeles/bdd_connexion.php';
include '../../Modeles/Categorie.php';

$Id = $_GET['Id_Categorie'];
$Categorie = Categorie::getInfoCategorie($Id);

if ($Categorie !== false) {
    if ($Categorie->deleteCategorieById()) {
        echo "Catégorie effacé\n";
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'message' => 'Catégorie non effacé!');
    }
} else {
    $response = array('success' => false, 'message' => 'Catégorie non trouvé!');
}
?>