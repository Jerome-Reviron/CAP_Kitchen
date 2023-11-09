<?php 
if (isset($_SESSION['Admin'])) {
    $Id_Admin = $_SESSION['Admin']->getId_Admin(); 
    $Admin = Admin::getInfoAdmin($Id_Admin);
    $droit = $Admin->getRole();
    if ($droit == 1 || $droit == 2) {

        $Securiter = new Securiter();

        if(isset($_GET['Id'])){
            $Id = htmlspecialchars($_GET['Id']);
            $Id_Fournisseur = $Id;
            $Fournisseur = Fournisseur::getInfoFournisseur($Id_Fournisseur);
            
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
                
                if (ctype_digit($Telephone)) {
                    if(strlen($Email) <= 30){ // On vérifie que la longueur du mail <= 30
                        if(filter_var($Email, FILTER_VALIDATE_EMAIL)){ // Si l'Email est de la bonne forme
                            if(strlen($Adresse) <= 250){ // On vérifie que la longueur du adresse <= 250

                                //Mise à jour des données dans la base de données
                                $updateFournisseurResult = $Fournisseur->postInfoFournisseur($Forme_Juridique,$Nom_Fournisseur,$Adresse,$Telephone,$Email,$Numero_SIRET, $Id);

                                if ($updateFournisseurResult ) {
                                    //Redirection vers une autre page
                                    header("Location: index.php?uc=admin_liste_fournisseur");
                                } else {
                                    // Afficher un message d'erreur ou rediriger vers une page d'erreur
                                    header("Location: index.php?uc=admin_modifier_fournisseur&reg_err=Loupé");
                                }
                            }else{ 
                                header('Location: index.php?uc=admin_modifier_fournisseur&reg_err=adresse_length'); 
                                exit();
                            }
                        }else{ 
                            header('Location: index.php?uc=admin_modifier_fournisseur&reg_err=email');
                            exit();
                        }
                    }else{ 
                        header('Location: index.php?uc=admin_modifier_fournisseur&reg_err=email_length'); 
                        exit();
                    }
                }else{ 
                    header('Location: index.php?uc=admin_modifier_fournisseur&reg_err=telephone_length'); 
                    exit();
                }
            } else {
                // Génère et stocke un nouveau jeton CSRF dans la session
                $csrf_token = $Securiter->generateCsrfToken();
                include './Vues/admin_modifier_fournisseur_vue.php';
            }
        }else{
            header('Location:./index.php?uc=admin_connexion'); 
        }
    } else {
        header('Location: index.php?uc=admin_accueil');
    }
} else {
    header('Location:./index.php?uc=admin_connexion');
}
?>

