<?php
if (isset($_SESSION['Admin'])) {
        $Id_Admin = $_SESSION['Admin']->getId_Admin(); 
        $Admin = Admin::getInfoAdmin($Id_Admin);
        $droit = $Admin->getRole();

        if ($droit == 1 || $droit == 2) {

                echo '
                <div class="liste_admin">
                        <form class="form">
                                <h2 class="adminh2">Liste des Catégories</h2>
                                <table id="myTable">
                                        <thead>
                                                <tr>
                                                        <th class="sortable">Id Catégorie</th>
                                                        <th class="sortable">Nom</th>
                                                        <th class="sortable">Genre</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                </tr>
                                        </thead>
                                        <tbody>';

                // Récupération des données de la base de données
                $Categories = Categorie::getAllCategorie($Admin->getId_Entreprise());

                // Fonction de comparaison pour trier les Categories par Id_Categorie
                function compareId_Categorie($a, $b) {
                        return $a->getId_Categorie() - $b->getId_Categorie();
                }

                // Tri des Categories par Id_Categorie
                usort($Categories, 'compareId_Categorie');

                // Utilisez une boucle foreach pour inclure le fichier 'admin_liste_categorie_vue.php'
                foreach ($Categories as $Categorie) {                        
                        include './Vues/admin_liste_categorie_vue.php';
                }

                echo '                  </tbody>
                                </table>
                                <p>
                                        <a class="top-rectangle-button" href="./index.php?uc=admin_creer_categorie">Créer</a>
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
<script type="text/javascript" src="./Vues/JS/categorie_liste.js"></script>
