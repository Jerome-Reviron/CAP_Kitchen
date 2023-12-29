<?php

if (isset($_SESSION['Admin'])) {
    
    $Securiter = new Securiter();

    $Id_Admin = $_SESSION['Admin']->getId_Admin();
    $Admin = Admin::getInfoAdmin($Id_Admin);
    $droit = $Admin->getRole();

    if ($droit == 1 || $droit == 2 || $droit == 3 || $droit == 4) {

        $Categories = Categorie::getCategoriesFromDatabase();
        $Fournisseurs = Fournisseur::getFournisseursFromDatabase();
        $Allergenes = Allergene::getAllergenesFromDatabase();

        if(!empty($_POST['Nom_Ingredient']) && !empty($_POST['Unite_recette'])
        && !empty($_POST['Conditionnement_achat']) && !empty($_POST['Prix_achat']) && !empty($_POST['Unite_achat'])){
            // Vérifiez si un fichier a été téléchargé
            if (isset($_FILES["Photo"]) && $_FILES["Photo"]["error"] == UPLOAD_ERR_OK) {
                // Lisez le contenu du fichier
                $Photo = file_get_contents($_FILES["Photo"]["tmp_name"]);

                // Vérifiez le type MIME du fichier
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($fileInfo, $_FILES["Photo"]["tmp_name"]);
                finfo_close($fileInfo);

                if (in_array($mimeType, $allowedTypes)) {
                
                    $Securiter->verifyCsrfToken($_POST['csrf_token']);

                    // Patch XSS
                    $Nom_Ingredient =  htmlspecialchars(trim(strip_tags($_POST['Nom_Ingredient'])));
                    $Unite_recette =  htmlspecialchars(trim(strip_tags($_POST['Unite_recette'])));
                    $Conditionnement_achat =  htmlspecialchars(trim(strip_tags($_POST['Conditionnement_achat'])));
                    $Prix_achat =  htmlspecialchars(trim(strip_tags($_POST['Prix_achat'])));
                    $Unite_achat =  htmlspecialchars(trim(strip_tags($_POST['Unite_achat'])));

                    $Prix_achat = str_replace(',', '.', $Prix_achat);
                    $Prix_achat = number_format($Prix_achat, 2, '.', '');

                    // Récupération de l'ID de la catégorie
                    $Id_Categorie = isset($_POST['Id_Categorie']) ? filter_var($_POST['Id_Categorie'], FILTER_VALIDATE_INT) : null;

                    // Vérification de la validité de l'ID de catégorie
                    if ($Id_Categorie === false || $Id_Categorie === null) {
                        // Gestion de l'erreur, par exemple redirection vers une page d'erreur
                        echo "Type Id_Catégorie non autorisé.<br>";
                        header('Location: index.php?uc=admin_creer_ingredient&reg_err=TypeCategorie');
                        exit();
                    }

                    // Récupération et validation des IDs des allergènes
                    $AllergeneIds = isset($_POST['Id_Allergene']) ? explode(" / ", $_POST['Id_Allergene']) : [];
                    foreach ($AllergeneIds as $Id_Allergene) {
                        if (!filter_var($Id_Allergene, FILTER_VALIDATE_INT)) {
                            echo "Type Id_Allergene non autorisé.<br>";
                            header('Location: index.php?uc=admin_creer_ingredient&reg_err=TypeAllergene');
                            exit();
                        }
                    }

                    // Récupération et validation des IDs des fournisseurs (si applicable)
                    $FournisseurIds = isset($_POST['Id_Fournisseur']) ? explode(" / ", $_POST['Id_Fournisseur']) : [];
                    foreach ($FournisseurIds as $Id_Fournisseur) {
                        if (!filter_var($Id_Fournisseur, FILTER_VALIDATE_INT)) {
                            echo "Type Id_Fournisseur non autorisé.<br>";
                            header('Location: index.php?uc=admin_creer_ingredient&reg_err=TypeFournisseur');
                            exit();
                        }
                    }

                    $bdd = bddconnexion::getInstance();
                    // Instanciation de la classe Ingredient
                    $Ingredient = new Ingredient(NULL, $Nom_Ingredient, $Photo, $Unite_recette, $Conditionnement_achat, $Prix_achat, $Unite_achat);

                    // Vérifie si l'Ingrédient existe déjà
                    $Nom_IngredientExiste = Ingredient::checkNomIngredientExists($Nom_Ingredient, $Admin->getId_Entreprise());

                    if(sizeof($Nom_IngredientExiste) == 0) {
                        // Création de l'Ingrédient
                        echo "Création de l'Ingrédient...<br>";
                        $Ingredient->createIngredient($Id_Admin, $AllergeneIds, $Id_Categorie, $FournisseurIds);
                        echo "Ingrédient créé avec succès.<br>";

                        // Redirection vers la page d'accueil
                        header('Location:./index.php?uc=admin_liste_ingredient');
                    } else {
                        echo "L'Ingrédient existe déjà.<br>";
                        header('Location:./index.php?uc=admin_creer_ingredient');
                    }
                } else {
                    echo "Fichier non autorisé.<br>";
                    header('Location: index.php?uc=admin_creer_ingredient&reg_err=fichierInterdit'); 
                    exit();
                }
            } else {
                echo "Photo non remplie.<br>";
                header('Location: index.php?uc=admin_creer_ingredient&reg_err=photoAbsente'); 
                exit();
            }
        } else {
            $csrf_token = $Securiter->generateCsrfToken();
            include './Vues/admin_creer_ingredient_vue.php';
        }
    } else {
        header('Location: index.php?uc=admin_accueil');
        exit();
    }
} else {
    header('Location:./index.php?uc=admin_connexion');
}

?>
<script type="text/javascript" src="./Vues/JS/ingredient_creer.js"></script>