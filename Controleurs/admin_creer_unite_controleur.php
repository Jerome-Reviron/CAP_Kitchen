<?php

if (isset($_SESSION['Admin'])) {
    
    $Securiter = new Securiter();

    $Id_Admin = $_SESSION['Admin']->getId_Admin();
    $Admin = Admin::getInfoAdmin($Id_Admin);
    $droit = $Admin->getRole();

    if ($droit == 1 || $droit == 2) {

        if(!empty($_POST['Nom_Unite']) && !empty($_POST['Chiffre']) && !empty($_POST['Valeur'])){

            $Securiter->verifyCsrfToken($_POST['csrf_token']);
            
            // Patch XSS
            $Nom_Unite =  htmlspecialchars(trim(strip_tags($_POST['Nom_Unite'])));
            $Genre =  htmlspecialchars(trim(strip_tags($_POST['Genre'])));
            $Chiffre =  htmlspecialchars(trim(strip_tags($_POST['Chiffre'])));
            $Valeur =  htmlspecialchars(trim(strip_tags($_POST['Valeur'])));

            $Chiffre = str_replace(',', '.', $Chiffre);
            $Chiffre = number_format($Chiffre, 2, '.', '');

            $bdd = bddconnexion::getInstance();
            // Instanciation de la classe Unite
            $Unite = new Unite(NULL, $Nom_Unite, $Genre, $Chiffre, $Valeur);

            // Vérifie si la Catégorie existe déjà
            $Nom_UniteExiste = Unite::checkNomUniteExists($Nom_Unite, $Admin->getId_Entreprise());
            
            if (empty($Nom_UniteExiste)) {
                $Unite->createUnite($Id_Admin);
                // Redirection vers la page d'accueil
                header('Location:./index.php?uc=admin_liste_unite');
            } else {
                // L' Unite existe déjà pour cette entreprise
                echo "L'Unite existe déjà pour cette entreprise.<br>";
                header('Location:./index.php?uc=admin_creer_unite');
                exit();
            }
        } else {
            $csrf_token = $Securiter->generateCsrfToken();
            $valeurs = Unite::getValeursFromDatabase();
            include './Vues/admin_creer_unite_vue.php';
        }
    } else {
        header('Location: index.php?uc=admin_accueil');
        exit();
    }
} else {
    header('Location:./index.php?uc=admin_connexion');
}

?>