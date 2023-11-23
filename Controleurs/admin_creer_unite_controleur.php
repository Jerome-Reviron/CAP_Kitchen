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

            echo "Nom de l'Unité' (après htmlspecialchars) : " . $Nom_Unite . "<br>";

            $bdd = bddconnexion::getInstance();
            // Instanciation de la classe Unite
            $Unite = new Unite(NULL, $Nom_Unite, $Genre, $Chiffre, $Valeur);

            // Vérifie si la Catégorie existe déjà
            $Nom_UniteExiste = Unite::checkNomUniteExists($Nom_Unite);
            
            echo "Résultat de Unite::checkNomUniteExists : ";
            var_dump($Nom_UniteExiste);
            
            if(sizeof($Nom_UniteExiste) == 0) {
                // Création de la Unité
                echo "Création de la Unité...<br>";
                $Unite->createUnite();
                echo "Unité créée avec succès.<br>";

                // Redirection vers la page d'accueil
                header('Location:./index.php?uc=admin_liste_unite');
            } else {
                echo "La Unité existe déjà.<br>";
                header('Location:./index.php?uc=admin_creer_unite');
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
