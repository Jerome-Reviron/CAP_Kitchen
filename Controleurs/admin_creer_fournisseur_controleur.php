<?php
if (isset($_SESSION['Admin'])) {
    $Id_Admin = $_SESSION['Admin']->getId_Admin();
    $Admin = Admin::getInfoAdmin($Id_Admin);
    $droit = $Admin->getRole();

    $Securiter = new Securiter();

    if ($droit == 1 || $droit == 2) {

        // Si les variables existent et qu'elles ne sont pas vides
        if(!empty($_POST['Forme_Juridique']) && !empty($_POST['Nom_Fournisseur'])
        && !empty($_POST['Adresse']) && !empty($_POST['Telephone'])
        && !empty($_POST['Email']) && !empty($_POST['Numero_SIRET']))
        {   
            $Securiter->verifyCsrfToken($_POST['csrf_token']);

            // Patch XSS
            $Forme_Juridique =htmlspecialchars(trim(strip_tags($_POST['Forme_Juridique'])));
            $Nom_Fournisseur =  htmlspecialchars(trim(strip_tags($_POST['Nom_Fournisseur'])));
            $Adresse = htmlspecialchars(trim(strip_tags($_POST['Adresse'])));
            $Telephone = htmlspecialchars(trim(strip_tags($_POST['Telephone'])));
            $Email = strtolower(htmlspecialchars(trim(strip_tags($_POST['Email']))));
            $Numero_SIRET = htmlspecialchars(trim(strip_tags($_POST['Numero_SIRET'])));
            
            // Récupération des informations du fournisseur existant (s'il existe)
            $existing_Fournisseur = Fournisseur::Nom_FournisseurExists($Nom_Fournisseur);       

            // Si un fournisseur existant a été trouvé
            if($existing_Fournisseur){
                if (ctype_digit($Telephone)) {
                    if(strlen($Email) <= 30){ // On vérifie que la longueur du mail <= 30
                        if(filter_var($Email, FILTER_VALIDATE_EMAIL)){ // Si l'Email est de la bonne forme
                            if(strlen($Adresse) <= 250){ // On vérifie que la longueur du adresse <= 250
                                
                                // Crée un nouvel objet Fournisseur avec les paramètres donnés
                                $Fournisseur =  new Fournisseur($Forme_Juridique,$Nom_Fournisseur,$Adresse,$Telephone,$Email,$Numero_SIRET);

                                // Envoie une requête à la base de données
                                $stmt = $Fournisseur->postInscription();
                                
                                if ($stmt) {
                                    // On redirige avec le message de succès
                                    header('Location: index.php?uc=admin_liste_fournisseur');
                                    exit();
                                } else {
                                    // On redirige vers la page de creer fournisseur avec le message d'erreur
                                    header('Location: index.php?uc=admin_creer_fournisseur&reg_err=failed');
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
                header('Location: index.php?uc=admin_creer_fournisseur&reg_err=already');
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
