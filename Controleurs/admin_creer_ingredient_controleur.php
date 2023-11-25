<?php

if (isset($_SESSION['Admin'])) {
    
    $Securiter = new Securiter();

    $Id_Admin = $_SESSION['Admin']->getId_Admin();
    $Admin = Admin::getInfoAdmin($Id_Admin);
    $droit = $Admin->getRole();

    if ($droit == 1 || $droit == 2) {

        // Appeler la fonction pour récupérer la liste des unités
        $liste_unites = Unite::getAllUnite();

        if(!empty($_POST['Nom_Ingredient']) && !empty($_POST['Photo']) && !empty($_POST['Unite_recette'])
        && !empty($_POST['Conditionnement_achat']) && !empty($_POST['Prix_achat']) && !empty($_POST['Unite_achat'])){

            $Securiter->verifyCsrfToken($_POST['csrf_token']);
            
            // Patch XSS
            $Nom_Ingredient =  htmlspecialchars(trim(strip_tags($_POST['Nom_Ingredient'])));
            $Photo =  htmlspecialchars(trim(strip_tags($_POST['Photo'])));
            $Unite_recette =  htmlspecialchars(trim(strip_tags($_POST['Unite_recette'])));
            $Conditionnement_achat =  htmlspecialchars(trim(strip_tags($_POST['Conditionnement_achat'])));
            $Prix_achat =  htmlspecialchars(trim(strip_tags($_POST['Prix_achat'])));
            $Unite_achat =  htmlspecialchars(trim(strip_tags($_POST['Unite_achat'])));


            $bdd = bddconnexion::getInstance();
            // Instanciation de la classe Ingredient
            $Ingredient = new Ingredient(NULL, $Nom_Ingredient, $Photo, $Unite_recette, $Conditionnement_achat, $Prix_achat, $Unite_achat);

            // Vérifie si la Catégorie existe déjà
            $Nom_IngredientExiste = Ingredient::checkNomIngredientExists($Nom_Ingredient);
                        
            if(sizeof($Nom_IngredientExiste) == 0) {
                // Création de la Catégorie
                echo "Création de la Catégorie...<br>";
                $Ingredient->createIngredient();
                echo "Catégorie créée avec succès.<br>";

                // Redirection vers la page d'accueil
                header('Location:./index.php?uc=admin_liste_ingredient');
            } else {
                echo "La Catégorie existe déjà.<br>";
                header('Location:./index.php?uc=admin_creer_ingredient');
            }
        } else {
            $csrf_token = $Securiter->generateCsrfToken();
            include './Vues/admin_creer_ingredient_vue.php';
        }
    } else {
        header('Location: index.php?uc=admin_accueil');
        exit();
    }
} else {
    header('Location:./index.php?uc=admin_connexion');
}

?>
<script type="text/javascript" src="./Vues/JS/ingredient_creer.js"></script>
