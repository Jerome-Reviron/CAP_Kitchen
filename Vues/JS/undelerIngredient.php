<?php
include '../../Modeles/bdd_connexion.php';
include '../../Modeles/Ingredient.php';

$Id_Ingredient = $_GET['Id_Ingredient'];

header ('Content-Type: application/json');

$result = Ingredient::deleteIngredient($Id_Ingredient); // Appel de la méthode statique

echo json_encode($result); // Retourner le résultat en JSON
?>
