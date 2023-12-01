<?php

if (isset($_SESSION['Admin'])) {
    
    $Id_Admin = $_SESSION['Admin']->getId_Admin();
    $Admin = Admin::getInfoAdmin($Id_Admin);
    $droit = $Admin->getRole();

    $Securiter = new Securiter();

    if ($droit == 1 || $droit == 2) {

        if(!empty($_POST['Nom_Unite']) && !empty($_POST['Genre']) && !empty($_POST['Chiffre']) && !empty($_POST['Valeur'])){

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
            
            echo "Résultat de Unite::checkNomUniteExists : ";
            var_dump($Nom_UniteExiste);
            
            if(sizeof($Nom_UniteExiste) > 0) {
                // Création de la Unité
                echo "Création de la Unité...<br>";
                $Unite->createUnite($Id_Admin);
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
