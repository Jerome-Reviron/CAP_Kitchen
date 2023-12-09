<?php
$Securiter = new Securiter();

if(!empty($_POST['Pseudo']) && !empty($_POST['Password'])) {

    $Securiter->verifyCsrfToken($_POST['csrf_token']);

    $Pseudo = htmlspecialchars($_POST['Pseudo']);
    $Password = htmlspecialchars($_POST['Password']);

    // Vérifier si les informations de connexion sont valides et récupérer l'utilisateur correspondant
    $user = Admin::getCoAdmin($Pseudo, $Password);
    
    // Créer une session pour l'utilisateur
    if($user){
        $_SESSION['Admin'] = $user;
        header('Location: index.php?uc=admin_accueil');
        exit(); // N'oubliez pas de quitter le script après une redirection
    }else{
        header('Location: index.php?uc=admin_connexion&login_err=connexion');
        exit(); // N'oubliez pas de quitter le script après une redirection
    }

} else {
    // Génère et stocke un nouveau jeton CSRF dans la session
    $csrf_token = $Securiter->generateCsrfToken();
    
    include './Vues/admin_connexion_vue.php';
}
?>
<script type="text/javascript" src="./Vues/JS/connexion_admin.js"></script>
