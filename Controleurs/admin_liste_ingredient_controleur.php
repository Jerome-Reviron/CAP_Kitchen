<?php
if (isset($_SESSION['Admin'])) {
        $Id_Admin = $_SESSION['Admin']->getId_Admin(); 
        $Admin = Admin::getInfoAdmin($Id_Admin);
        $droit = $Admin->getRole();

        if ($droit == 1 || $droit == 2 || $droit == 3 || $droit == 4) {

                echo '
                <div class="liste_admin">
                        <form class="form">
                                <h2 class="adminh2">Liste des Ingredients</h2>
                                <table id="myTable">
                                        <thead>
                                                <tr>
                                                        <th class="sortable">Nom</th>
                                                        <th class="sortable">Photo</th>
                                                        <th class="sortable">Unite de recette</th>
                                                        <th class="sortable">Conditionnement d\'achat</th>
                                                        <th class="numeric">Prix d\'achat</th>
                                                        <th class="sortable">Unite d\'achat</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                </tr>
                                        </thead>
                                        <tbody>';

                // Récupération des données de la base de données
                $Ingredients = Ingredient::getAllIngredient();

                // Fonction de comparaison pour trier les Ingredients par Id_Ingredient
                function compareId_Ingredient($a, $b) {
                        return $a->getId_Ingredient() - $b->getId_Ingredient();
                }

                // Tri des Ingredients par Id_Ingredient
                usort($Ingredients, 'compareId_Ingredient');

                // Utilisez une boucle foreach pour inclure le fichier 'admin_liste_Ingredient_vue.php'
                foreach ($Ingredients as $Ingredient) {                        
                        include './Vues/admin_liste_ingredient_vue.php';
                }

                echo '                  </tbody>
                                </table>
                                <p>
                                        <a class="top-rectangle-button" href="./index.php?uc=admin_creer_ingredient">Créer</a>
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
<script type="text/javascript" src="./Vues/JS/ingredient_liste.js"></script>