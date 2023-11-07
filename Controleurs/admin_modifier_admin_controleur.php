<?php 
if (isset($_SESSION['Admin'])) {
    $Id_Admin = $_SESSION['Admin']->getId_Admin(); 
    $Admin = Admin::getInfoAdmin($Id_Admin);
    $droit = $Admin->getRole();
    if ($droit == 1) {

        $Securiter = new Securiter();

        if(isset($_GET['Id'])){
            $Id = htmlspecialchars($_GET['Id']);
            $Id_Admin = $Id;
            $Admin = Admin::getInfoAdmin($Id_Admin);
            
           // Si les variables existent et qu'elles ne sont pas vides
            if(!empty($_POST['Nom']) && !empty($_POST['Prenom']) && !empty($_POST['Pseudo'])
            && !empty($_POST['Password']) && !empty($_POST['Password_retype']) && !empty($_POST['Adresse']) && !empty($_POST['Telephone']) 
            && !empty($_POST['Email']) && !empty($_POST['Role']) && !empty($_POST['Id_Entreprise']))
            {   
            
                $Securiter->verifyCsrfToken($_POST['csrf_token']);
                
                // Patch XSS
                $Nom =  htmlspecialchars(trim(strip_tags($_POST['Nom'])));
                $Prenom =htmlspecialchars(trim(strip_tags($_POST['Prenom'])));
                $Pseudo = htmlspecialchars(trim(strip_tags($_POST['Pseudo'])));
                $Password = htmlspecialchars(trim(strip_tags($_POST['Password'])));
                $Password_retype = htmlspecialchars(trim(strip_tags($_POST['Password_retype'])));
                $Adresse = htmlspecialchars(trim(strip_tags($_POST['Adresse'])));
                $Telephone = htmlspecialchars(trim(strip_tags($_POST['Telephone'])));
                $Email = strtolower(htmlspecialchars(trim(strip_tags($_POST['Email']))));
                $Role = htmlspecialchars(trim(strip_tags($_POST['Role'])));
                $Id_Entreprise = htmlspecialchars(trim(strip_tags($_POST['Id_Entreprise'])));
                
                if(strlen($Pseudo) <= 20){ // On vérifie que la longueur du pseudo <= 20
                    if (ctype_digit($Telephone)) {
                        if(strlen($Email) <= 30){ // On vérifie que la longueur du mail <= 30
                            if(filter_var($Email, FILTER_VALIDATE_EMAIL)){ // Si l'Email est de la bonne forme
                                if(strlen($Adresse) <= 250){ // On vérifie que la longueur du adresse <= 250
                                    if($Password == $Password_retype){ // si les deux mdp saisis sont bons
                                        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+,=!*()@%&]).{8,}$/', $Password)) {
                                                                    
                                            // On hash le mot de passe
                                            $Password = password_hash($Password, PASSWORD_ARGON2ID);

                                            //Mise à jour des données dans la base de données
                                            $updateAdminResult = $Admin->postInfoAdmin($Nom, $Prenom, $Pseudo, $Password, $Adresse, $Telephone, $Email, $Role,$Id_Entreprise, $Id);

                                            if ($updateAdminResult ) {
                                                //Redirection vers une autre page
                                                header("Location: index.php?uc=admin_liste_admin");
                                            } else {
                                                // Afficher un message d'erreur ou rediriger vers une page d'erreur
                                                header("Location: index.php?uc=admin_modifier_admin");
                                            }
                                        }else{ 
                                            header('Location: index.php?uc=admin_modifier_admin&reg_err=password1'); 
                                        }
                                    }else{ 
                                        header('Location: index.php?uc=admin_modifier_admin&reg_err=password2'); 
                                        exit();
                                    }
                                }else{ 
                                    header('Location: index.php?uc=admin_modifier_admin&reg_err=adresse_length'); 
                                    exit();
                                }
                            }else{ 
                                header('Location: index.php?uc=admin_modifier_admin&reg_err=email');
                                exit();
                            }
                        }else{ 
                            header('Location: index.php?uc=admin_modifier_admin&reg_err=email_length'); 
                            exit();
                        }
                    }else{ 
                        header('Location: index.php?uc=admin_modifier_admin&reg_err=telephone_length'); 
                        exit();
                    }
                }else{ 
                    header('Location: index.php?uc=admin_modifier_admin&reg_err=pseudo_length'); 
                    exit();
                }
            } else {
                // Génère et stocke un nouveau jeton CSRF dans la session
                $csrf_token = $Securiter->generateCsrfToken();
                include './Vues/admin_modifier_admin_vue.php';
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
<script type="text/javascript" src="./Vues/JS/admin_modif.js"></script>

