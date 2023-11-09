<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAP_Kitchen</title>
    <link rel="stylesheet" type="text/css" href="Vues/CSS/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="./Vues/JS/script.js"></script>
</head>
<body>
<?php

    // Inclure les fichiers nécessaires
    include './Modeles/bdd_connexion.php'; 
    include './Modeles/Admin.php'; 
    include './Modeles/Securiter.php'; 
    include './Modeles/Ingredient.php'; 
    include './Modeles/Unite.php'; 
    include './Modeles/Categorie.php'; 
    include './Modeles/Fournisseur.php'; 

    if(!isset($_SESSION)){
        session_start();
    }

    if (isset($_GET['uc']) && preg_match('/^[\wà-ú\/-]+$/', $_GET['uc'])) {
        $uc = htmlspecialchars($_GET['uc'], ENT_QUOTES, 'UTF-8');
        $controllerPath = "./Controleurs/" . $uc . "_controleur.php";
        
        if (file_exists($controllerPath)) {
            include $controllerPath;
        } else {
            include "./Controleurs/admin_inscription_controleur.php"; 
        }
    } else {
        // Gérer le cas où 'uc' n'est pas spécifié ou ne correspond pas à une expression valide
        include "./Controleurs/notfound_controleur.php"; 
    }
?>
</body>
</html>
