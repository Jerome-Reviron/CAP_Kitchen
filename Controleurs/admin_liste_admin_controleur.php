<?php
if (isset($_SESSION['Admin'])) {
        $Id_Admin = $_SESSION['Admin']->getId_Admin(); 
        $Admin = Admin::getInfoAdmin($Id_Admin);
        $droit = $Admin->getRole();

        if ($droit == 1) {

                echo '
                <div class="liste_admin">
                        <form class="form">
                                <h2 class="adminh2">Liste des Admins</h2>
                                <table id="myTable">
                                        <thead>
                                                <tr>
                                                        <th class="sortable">Id Admin</th>
                                                        <th class="sortable">Nom</th>
                                                        <th class="sortable">Prénom</th>
                                                        <th class="sortable">Pseudo</th>
                                                        <th class="sortable">Password</th>
                                                        <th class="sortable">Adresse</th>
                                                        <th class="sortable">Téléphone</th>
                                                        <th class="sortable">Email</th>
                                                        <th class="sortable">Role</th>
                                                        <th class="sortable">Id Entreprise</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                </tr>
                                        </thead>
                                        <tbody>';

                // Récupération des données de la base de données
                $Admins = Admin::getAllAdmin();

                // Fonction de comparaison pour trier les Admins par Id_Admin
                function compareId_Admin($a, $b) {
                        return $a->getId_Admin() - $b->getId_Admin();
                }

                // Tri des Admins par Id_Admin
                usort($Admins, 'compareId_Admin');

                // Utilisez une boucle foreach pour inclure le fichier 'admin_liste_Admin.php'
                foreach ($Admins as $Admin) {                        
                        include './Vues/admin_liste_admin_vue.php';
                }

                echo '                  </tbody>
                                </table>
                                <p>
                                        <a class="top-rectangle-button" href="./index.php?uc=admin_inscription">Créer</a>
                                        <a class="top-rectangle-button" href="./index.php?uc=admin_accueil">Retour</a>
                                </p>
                        </form>
                </div>';
        } else {
                header('Location: index.php?uc=admin_accueil');
        }
} else {
        header('Location:./index.php?uc=admin_connexion');
}
?>
<script type="text/javascript" src="./Vues/JS/admin_liste.js"></script>
