<?php
include '../../Modeles/bdd_connexion.php';
include '../../Modeles/Ingredient.php';

$Id = $_GET['Id_Ingredient'];
$Ingredient = Ingredient::getInfoIngredient($Id);

if ($Ingredient !== false) {
    if ($Ingredient->deleteIngredientById()) {
        echo "Ingrédient effacé\n";
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'message' => 'Ingrédient non effacé!');
    }
} else {
    $response = array('success' => false, 'message' => 'Ingrédient non trouvé!');
}
?>