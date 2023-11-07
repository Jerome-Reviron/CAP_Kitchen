<?php
include '../../Modeles/bdd_connexion.php';
include '../../Modeles/Admin.php';

$Id = $_GET['Id_Admin'];
$Admin = Admin::getInfoAdmin($Id);

if ($Admin !== false) {
    if ($Admin->deleteAdminById()) {
        echo "Admin effacé\n";
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'message' => 'Admin non effacé!');
    }
} else {
    $response = array('success' => false, 'message' => 'Admin non trouvé!');
}
?>