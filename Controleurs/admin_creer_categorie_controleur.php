<?php

if (isset($_SESSION['Admin'])) {
    
    $Securiter = new Securiter();

    $Id_Admin = $_SESSION['Admin']->getId_Admin();
    $Admin = Admin::getInfoAdmin($Id_Admin);
    $droit = $Admin->getRole();

    if ($droit == 1 || $droit == 2) {

        if(!empty($_POST['Nom_Categorie'])){

            $Securiter->verifyCsrfToken($_POST['csrf_token']);
            
            // Patch XSS
            $Nom_Categorie =  htmlspecialchars($_POST['Nom_Categorie']);

            echo "Nom de la Catégorie (après htmlspecialchars) : " . $Nom_Categorie . "<br>";

            $bdd = bddconnexion::getInstance();
            // Instanciation de la classe Categorie
            $Categorie = new Categorie(NULL, $Nom_Categorie);

            // Vérifie si la Catégorie existe déjà
            $Nom_CategorieExiste = Categorie::checkNomCategorieExists($Nom_Categorie);
            
            echo "Résultat de Categorie::checkNomCategorieExists : ";
            var_dump($Nom_CategorieExiste);
            
            if(sizeof($Nom_CategorieExiste) == 0) {
                // Création de la Catégorie
                echo "Création de la Catégorie...<br>";
                $Categorie->createCategorie();
                echo "Catégorie créée avec succès.<br>";

                // Redirection vers la page d'accueil
                header('Location:./index.php?uc=admin_liste_categorie');
            } else {
                echo "La Catégorie existe déjà.<br>";
                header('Location:./index.php?uc=admin_creer_categorie');
            }
        } else {
            $csrf_token = $Securiter->generateCsrfToken();
            include './Vues/admin_creer_categorie_vue.php';
        }
    } else {
        header('Location: index.php?uc=admin_accueil');
        exit();
    }
} else {
    header('Location:./index.php?uc=admin_connexion');
}

?>
