<?php 
if (isset($_SESSION['Admin'])) {
    
    $Securiter = new Securiter();

    $Id_Admin = $_SESSION['Admin']->getId_Admin();
    $Admin = Admin::getInfoAdmin($Id_Admin);
    $droit = $Admin->getRole();

    if ($droit == 1 || $droit == 2) {

        if (isset($_GET['Id'])) {
            $Id = htmlspecialchars($_GET['Id']);
            $Unite = Unite::getInfoUnite($Id);

            // Validation des données
            if (!empty($_POST['Nom_Unite']) && !empty($_POST['Genre']) && !empty($_POST['Chiffre']) && !empty($_POST['Valeur'])) {

                $Securiter->verifyCsrfToken($_POST['csrf_token']);
                
                // Patch XSS
                $Nom_Unite = htmlspecialchars($_POST['Nom_Unite']);
                $Genre = htmlspecialchars($_POST['Genre']);
                $Chiffre = htmlspecialchars($_POST['Chiffre']);
                $Valeur = htmlspecialchars($_POST['Valeur']);

                // Mise à jour des données dans la base de données
                $Unite->postInfoUnite($Id, $Nom_Unite, $Genre, $Chiffre, $Valeur);

                // Redirection vers une autre page
                header("Location: index.php?uc=admin_modifier_unite");
            }
        } else {
            header("Location: index.php?uc=admin_liste_unite");
        }
        // Génère et stocke un nouveau jeton CSRF dans la session
        $csrf_token = $Securiter->generateCsrfToken();
        include './Vues/admin_modifier_unite_vue.php';
    } else {
        header('Location: index.php?uc=admin_accueil');
        exit();
    }
} else {
    header('Location:./index.php?uc=admin_connexion');
}
?>
