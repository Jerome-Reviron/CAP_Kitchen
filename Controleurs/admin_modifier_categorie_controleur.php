<?php 
if (isset($_SESSION['Admin'])) {
    $Id_Admin = $_SESSION['Admin']->getId_Admin();
    $Admin = Admin::getInfoAdmin($Id_Admin);
    $droit = $Admin->getRole();

    $Securiter = new Securiter();


    if ($droit == 1 || $droit == 2) {

        if (isset($_GET['Id'])) {
            $Id = htmlspecialchars($_GET['Id']);
            $Categorie = Categorie::getInfoCategorie($Id);

            // Validation des données
            if (!empty($_POST['Nom_Categorie']) && !empty($_POST['Genre'])) {

                $Securiter->verifyCsrfToken($_POST['csrf_token']);
                
                // Patch XSS
                $Nom_Categorie = htmlspecialchars($_POST['Nom_Categorie']);
                $Genre = htmlspecialchars($_POST['Genre']);

                // Mise à jour des données dans la base de données
                $Categorie->postInfoCategorie($Id, $Nom_Categorie, $Genre);

                // Redirection vers une autre page
                header("Location: index.php?uc=admin_modifier_categorie");
            }
        } else {
            header("Location: index.php?uc=admin_liste_categorie");
        }
        // Génère et stocke un nouveau jeton CSRF dans la session
        $csrf_token = $Securiter->generateCsrfToken();
        include './Vues/admin_modifier_categorie_vue.php';
    } else {
        header('Location: index.php?uc=admin_accueil');
    }
} else {
    header('Location:./index.php?uc=admin_connexion');
}
?>
