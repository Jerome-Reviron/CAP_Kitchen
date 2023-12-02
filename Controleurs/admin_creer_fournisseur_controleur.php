<?php
if (isset($_SESSION['Admin'])) {

    $Id_Admin = $_SESSION['Admin']->getId_Admin();
    $Admin = Admin::getInfoAdmin($Id_Admin);
    $droit = $Admin->getRole();

    $Securiter = new Securiter();

    if ($droit == 1 || $droit == 2) {

        if(!empty($_POST['Forme_Juridique']) && !empty($_POST['Nom_Fournisseur'])
        && !empty($_POST['Adresse']) && !empty($_POST['Telephone'])
        && !empty($_POST['Email']) && !empty($_POST['Numero_SIRET'])){   

            $Securiter->verifyCsrfToken($_POST['csrf_token']);

            // Patch XSS
            $Forme_Juridique =htmlspecialchars(trim(strip_tags($_POST['Forme_Juridique'])));
            $Nom_Fournisseur =  htmlspecialchars(trim(strip_tags($_POST['Nom_Fournisseur'])));
            $Adresse = htmlspecialchars(trim(strip_tags($_POST['Adresse'])));
            $Telephone = htmlspecialchars(trim(strip_tags($_POST['Telephone'])));
            $Email = strtolower(htmlspecialchars(trim(strip_tags($_POST['Email']))));
            $Numero_SIRET = htmlspecialchars(trim(strip_tags($_POST['Numero_SIRET'])));
            
            // Si un fournisseur existant a été trouvé
            if (ctype_digit($Telephone)) {
                if(strlen($Email) <= 30){ // On vérifie que la longueur du mail <= 30
                    if(filter_var($Email, FILTER_VALIDATE_EMAIL)){ // Si l'Email est de la bonne forme
                        if(strlen($Adresse) <= 250){ // On vérifie que la longueur du adresse <= 250
                            
                            $bdd = bddconnexion::getInstance();
                            // Crée un nouvel objet Fournisseur avec les paramètres donnés
                            $Fournisseur =  new Fournisseur(NULL,$Forme_Juridique,$Nom_Fournisseur,$Adresse,$Telephone,$Email,$Numero_SIRET);

                            // Vérifie si la Fournisseur existe déjà
                            $Nom_FournisseurExiste = Fournisseur::checkNomFournisseurExists($Nom_Fournisseur, $Admin->getId_Entreprise());

                            if (empty($Nom_FournisseurExiste)) {
                                $Fournisseur->createFournisseur($Id_Admin);
                                // Redirection vers la page d'accueil
                                header('Location:./index.php?uc=admin_liste_fournisseur');
                            } else {
                                // Le Fournisseur existe déjà pour cette entreprise
                                echo "Le Fournisseur existe déjà pour cette entreprise.<br>";
                                header('Location:./index.php?uc=admin_creer_fournisseur');
                                exit();
                            }
                        }else{ 
                            header('Location: index.php?uc=admin_creer_fournisseur&reg_err=adresse_length'); 
                            exit();
                        }
                    }else{ 
                        header('Location: index.php?uc=admin_creer_fournisseur&reg_err=email');
                        exit();
                    }
                }else{ 
                    header('Location: index.php?uc=admin_creer_fournisseur&reg_err=email_length'); 
                    exit();
                }
            }else{ 
                header('Location: index.php?uc=admin_creer_fournisseur&reg_err=telephone_length'); 
                exit();
            }
        }else{
            // Génère et stocke un nouveau jeton CSRF dans la session
            $csrf_token = $Securiter->generateCsrfToken();
            include './Vues/admin_creer_fournisseur_vue.php';
        }
    } else {
        header('Location: index.php?uc=admin_accueil');
        exit();
    }
} else {
    header('Location: index.php?uc=admin_connexion');
    exit();
}
?>