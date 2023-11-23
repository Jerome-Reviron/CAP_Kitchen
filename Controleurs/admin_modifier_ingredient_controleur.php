<?php 
if (isset($_SESSION['Admin'])) {
    
    $Securiter = new Securiter();

    $Id_Admin = $_SESSION['Admin']->getId_Admin();
    $Admin = Admin::getInfoAdmin($Id_Admin);
    $droit = $Admin->getRole();

    if ($droit == 1 || $droit == 2) {

        if (isset($_GET['Id'])) {
            $Id = htmlspecialchars($_GET['Id']);
            $Ingredient = Ingredient::getInfoIngredient($Id);

            // Validation des données
            if(!empty($_POST['Nom_Ingredient']) && !empty($_POST['Photo']) && !empty($_POST['Unite_recette'])
            && !empty($_POST['Conditionnement_achat']) && !empty($_POST['Prix_achat']) && !empty($_POST['Unite-achat'])){

                $Securiter->verifyCsrfToken($_POST['csrf_token']);
                
                // Patch XSS
                $Nom_Ingredient =  htmlspecialchars(trim(strip_tags($_POST['Nom_Ingredient'])));
                $Photo =  htmlspecialchars(trim(strip_tags($_POST['Photo'])));
                $Unite_recette =  htmlspecialchars(trim(strip_tags($_POST['Unite_recette'])));
                $Conditionnement_achat =  htmlspecialchars(trim(strip_tags($_POST['Conditionnement_achat'])));
                $Prix_achat =  htmlspecialchars(trim(strip_tags($_POST['Prix_achat'])));
                $Unite_achat =  htmlspecialchars(trim(strip_tags($_POST['Unite_achat'])));

                // Mise à jour des données dans la base de données
                $Ingredient->postInfoIngredient($Id, $Nom_Ingredient, $Photo, $Unite_recette, $Conditionnement_achat, $Prix_achat, $Unite_achat);

                // Redirection vers une autre page
                header("Location: index.php?uc=admin_modifier_ingredient");
            }
        } else {
            header("Location: index.php?uc=admin_liste_ingredient");
        }
        // Génère et stocke un nouveau jeton CSRF dans la session
        $csrf_token = $Securiter->generateCsrfToken();
        include './Vues/admin_modifier_ingredient_vue.php';
    } else {
        header('Location: index.php?uc=admin_accueil');
        exit();
    }
} else {
    header('Location:./index.php?uc=admin_connexion');
}
?>
