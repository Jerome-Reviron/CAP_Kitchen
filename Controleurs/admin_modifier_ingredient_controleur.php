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
            if (!empty($_POST['Nom_Ingredient']) && !empty($_POST['Unite_recette'])
                && !empty($_POST['Conditionnement_achat']) && !empty($_POST['Prix_achat']) && !empty($_POST['Unite_achat'])) {

                $Securiter->verifyCsrfToken($_POST['csrf_token']);
                
                // Patch XSS
                $Nom_Ingredient = htmlspecialchars(trim(strip_tags($_POST['Nom_Ingredient'])));
                $Unite_recette = htmlspecialchars(trim(strip_tags($_POST['Unite_recette'])));
                $Conditionnement_achat = htmlspecialchars(trim(strip_tags($_POST['Conditionnement_achat'])));
                $Prix_achat = htmlspecialchars(trim(strip_tags($_POST['Prix_achat'])));
                $Unite_achat = htmlspecialchars(trim(strip_tags($_POST['Unite_achat'])));

                $Prix_achat = str_replace(',', '.', $Prix_achat);
                $Prix_achat = number_format($Prix_achat, 2, '.', '');

                // Vérifiez si un fichier a été téléchargé
                if (isset($_FILES["Photo"]) && $_FILES["Photo"]["error"] == UPLOAD_ERR_OK) {
                    // Lisez le contenu du nouveau fichier
                    $Photo = file_get_contents($_FILES["Photo"]["tmp_name"]);

                    // Vérifiez le type MIME du fichier
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mimeType = finfo_file($fileInfo, $_FILES["Photo"]["tmp_name"]);
                    finfo_close($fileInfo);

                    if (in_array($mimeType, $allowedTypes)) {
                        // Mise à jour des données dans la base de données avec la nouvelle photo
                        $Ingredient->postInfoIngredient($Id, $Nom_Ingredient, $Photo, $Unite_recette, $Conditionnement_achat, $Prix_achat, $Unite_achat);
                    } else {
                        echo "Fichier non autorisé.<br>";
                        header('Location: index.php?uc=admin_modifier_ingredient&reg_err=fichierInterdit'); 
                        exit();
                    }
                } else {
                    // Conserver la photo actuelle
                    $Photo = $Ingredient->getPhoto();
                    // Mise à jour des données dans la base de données sans changer la photo existante
                    $Ingredient->postInfoIngredient($Id, $Nom_Ingredient, $Photo, $Unite_recette, $Conditionnement_achat, $Prix_achat, $Unite_achat);
                }

                // Redirection vers une autre page
                header("Location: index.php?uc=admin_liste_ingredient");
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
<script type="text/javascript" src="./Vues/JS/ingredient_creer.js"></script>
