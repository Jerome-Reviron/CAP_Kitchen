<?php
if (isset($_SESSION['Admin'])) {
        $Id_Admin = $_SESSION['Admin']->getId_Admin(); 
        $Admin = Admin::getInfoAdmin($Id_Admin);
        $droit = $Admin->getRole();

        if ($droit == 1 || $droit == 2) {

                echo '
                <div class="liste_admin">
                        <form class="form">
                                <h2 class="adminh2">Liste des Unités</h2>
                                <table id="myTable">
                                        <thead>
                                                <tr>
                                                        <th class="sortable">Id Unité</th>
                                                        <th class="sortable">Nom</th>
                                                        <th class="sortable">Genre</th>
                                                        <th class="sortable">Chiffre</th>
                                                        <th class="sortable">Valeur</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                </tr>
                                        </thead>
                                        <tbody>';

                // Récupération des données de la base de données
                $Unites = Unite::getAllUnite($Admin->getId_Entreprise());

                // Fonction de comparaison pour trier les Unites par Id_Unite
                function compareId_Unite($a, $b) {
                        return $a->getId_Unite() - $b->getId_Unite();
                }

                // Tri des Unites par Id_Unite
                usort($Unites, 'compareId_Unite');

                // Utilisez une boucle foreach pour inclure le fichier 'admin_liste_Unite_vue.php'
                foreach ($Unites as $Unite) {                        
                        include './Vues/admin_liste_unite_vue.php';
                }

                echo '                  </tbody>
                                </table>
                                <p>
                                        <a class="top-rectangle-button" href="./index.php?uc=admin_creer_unite">Créer</a>
                                        <a class="top-rectangle-button" href="./index.php?uc=admin_accueil">Retour</a>
                                </p>
                        </form>
                </div>';
                echo '<script type="text/javascript">var droit = ' . $droit . ';</script>';
        } else {
                header('Location: index.php?uc=admin_accueil');
        }
} else {
        header('Location:./index.php?uc=admin_connexion');
}
?>
<script type="text/javascript" src="./Vues/JS/unite_liste.js"></script>
