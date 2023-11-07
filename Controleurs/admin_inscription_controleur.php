<?php
if (isset($_SESSION['Admin'])) {
    $Id_Admin = $_SESSION['Admin']->getId_Admin();
    $Admin = Admin::getInfoAdmin($Id_Admin);
    $Id_Entreprise = $Admin->getId_Entreprise();
    $droit = $Admin->getRole();

    $Securiter = new Securiter();

    if ($droit == 1) {

        // Si les variables existent et qu'elles ne sont pas vides
        if(!empty($_POST['Nom']) && !empty($_POST['Prenom']) && !empty($_POST['Pseudo']) 
        && !empty($_POST['Password']) && !empty($_POST['Password_retype']) && !empty($_POST['Adresse'])
        && !empty($_POST['Telephone']) && !empty($_POST['Email']) && !empty($_POST['Role']))
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
            
            // Récupération des informations du client existant (s'il existe)
            $existing_Admin = Admin::EmailExists($Email);       

            // Si un client existant a été trouvé
            if($existing_Admin){
                if(strlen($Pseudo) <= 30){ // On vérifie que la longueur du pseudo <= 30
                    if (ctype_digit($Telephone)) {
                        if(strlen($Email) <= 30){ // On vérifie que la longueur du mail <= 30
                            if(filter_var($Email, FILTER_VALIDATE_EMAIL)){ // Si l'Email est de la bonne forme
                                if(strlen($Adresse) <= 250){ // On vérifie que la longueur du adresse <= 250
                                    if($Password == $Password_retype){ // si les deux mdp saisis sont bons
                                        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+,=!*()@%&]).{8,}$/', $Password)) {
                                            
                                            // On hash le mot de passe
                                            $Password = password_hash($Password, PASSWORD_ARGON2ID);
                                            
                                            // Crée un nouvel objet Admin avec les paramètres donnés
                                            $Admin =  new Admin($Nom,$Prenom,$Pseudo,$Password,$Adresse,$Telephone,$Email,$Role, $Id_Entreprise);

                                            // Envoie une requête à la base de données
                                            $stmt = $Admin->postInscription();
                                            
                                            if ($stmt) {
                                                // On redirige avec le message de succès
                                                header('Location: index.php?uc=admin_liste_admin');
                                                exit();
                                            } else {
                                                // On redirige vers la page d'inscription avec le message d'erreur
                                                header('Location: index.php?uc=admin_inscription&reg_err=failed');
                                                exit();
                                            }
                                        }else{ 
                                            header('Location: index.php?uc=admin_inscription&reg_err=password'); 
                                            exit();
                                        }
                                    }else{ 
                                        header('Location: index.php?uc=admin_inscription&reg_err=password'); 
                                        exit();
                                    }
                                }else{ 
                                    header('Location: index.php?uc=admin_inscription&reg_err=adresse_length'); 
                                    exit();
                                }
                            }else{ 
                                header('Location: index.php?uc=admin_inscription&reg_err=email');
                                exit();
                            }
                        }else{ 
                            header('Location: index.php?uc=admin_inscription&reg_err=email_length'); 
                            exit();
                        }
                    }else{ 
                        header('Location: index.php?uc=admin_inscription&reg_err=telephone_length'); 
                        exit();
                    }
                }else{ 
                    header('Location: index.php?uc=admin_inscription&reg_err=pseudo_length'); 
                    exit();
                }
            }else{ 
                header('Location: index.php?uc=admin_inscription&reg_err=already');
                exit();
            }
        }else{
            // Génère et stocke un nouveau jeton CSRF dans la session
            $csrf_token = $Securiter->generateCsrfToken();
            include './Vues/admin_inscription_vue.php';
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
<script type="text/javascript" src="./Vues/JS/admin_inscrit.js"></script>
