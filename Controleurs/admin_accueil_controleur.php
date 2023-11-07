<?php

// Vérifie si une session 'Admin' est active
if (isset($_SESSION['Admin'])) {
    
    // Récupère l'identifiant du membre du personnel à partir de la session
    $Id_Admin = $_SESSION['Admin']->getId_Admin();
    
    // Récupère les informations du membre du personnel à partir de l'identifiant
    $Admin = Admin::getInfoAdmin($Id_Admin);
    
    // Vérifie si l'autorisation du membre du personnel est égale à 1
    $droit = $Admin->getRole();
    
     // Charge la vue en fonction du niveau d'autorisation
    if ($droit == 1) {
        include "./Vues/admin_accueil_droit1_vue.php";
    } elseif ($droit == 2) {
        include "./Vues/admin_accueil_droit2_vue.php";
    } elseif ($droit == 3) {
        include "./Vues/admin_accueil_droit3_vue.php";
    }
} else {
    header('Location:./index.php?uc=admin_connexion');
}

?>

<script type="text/javascript" src="./Vues/JS/accueil_admin.js"></script>
