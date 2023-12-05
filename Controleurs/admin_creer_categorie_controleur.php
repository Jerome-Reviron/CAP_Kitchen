<?php

if (isset($_SESSION['Admin'])) {

    $Id_Admin = $_SESSION['Admin']->getId_Admin();
    $Admin = Admin::getInfoAdmin($Id_Admin);
    $droit = $Admin->getRole();
    
    $Securiter = new Securiter();

    if ($droit == 1 || $droit == 2 || $droit == 3) {

        if(!empty($_POST['Nom_Categorie']) && !empty($_POST['Genre'])){

            $Securiter->verifyCsrfToken($_POST['csrf_token']);
            
            // Patch XSS
            $Nom_Categorie =  htmlspecialchars(trim(strip_tags($_POST['Nom_Categorie'])));
            $Genre =  htmlspecialchars(trim(strip_tags($_POST['Genre'])));

            $bdd = bddconnexion::getInstance();
            // Crée un nouvel objet Categorie avec les paramètres donnés
            $Categorie = new Categorie(NULL, $Nom_Categorie, $Genre);

            // Vérifie si la Catégorie existe déjà
            $Nom_CategorieExiste = Categorie::checkNomCategorieExists($Nom_Categorie,$Admin->getId_Entreprise());
                        
            if(empty($Nom_CategorieExiste)) {
                $Categorie->createCategorie($Id_Admin);
                // Redirection vers la page d'accueil
                header('Location:./index.php?uc=admin_liste_categorie');
            } else {
                // La Categorie existe déjà pour cette entreprise
                echo "La Categorie existe déjà pour cette entreprise.<br>";
                header('Location:./index.php?uc=admin_creer_categorie');
                exit();
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