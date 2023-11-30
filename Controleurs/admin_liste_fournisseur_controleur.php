<?php
if (isset($_SESSION['Admin'])) {
        $Id_Admin = $_SESSION['Admin']->getId_Admin(); 
        $Admin = Admin::getInfoAdmin($Id_Admin);
        $droit = $Admin->getRole();

        if ($droit == 1 || $droit == 2) {

                echo '
                <div class="liste_admin">
                        <form class="form">
                                <h2 class="adminh2">Liste des Fournisseurs</h2>
                                <table id="myTable">
                                        <thead>
                                                <tr>
                                                        <th class="sortable">Id Fournisseur</th>
                                                        <th class="sortable">Forme Juridique</th>
                                                        <th class="sortable">Nom</th>
                                                        <th class="sortable">Adresse</th>
                                                        <th class="sortable">Téléphone</th>
                                                        <th class="sortable">Email</th>
                                                        <th class="sortable">Numéro SIRET</th>

                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                </tr>
                                        </thead>
                                        <tbody>';

                // Récupération des données de la base de données
                $Fournisseurs = Fournisseur::getAllFournisseur($Admin->getId_Entreprise());

                // Fonction de comparaison pour trier les Fournisseurs par Id_Fournisseur
                function compareId_Fournisseur($a, $b) {
                        return $a->getId_Fournisseur() - $b->getId_Fournisseur();
                }

                // Tri des Fournisseurs par Id_Fournisseur
                usort($Fournisseurs, 'compareId_Fournisseur');

                // Utilisez une boucle foreach pour inclure le fichier 'admin_liste_Fournisseur_vue.php'
                foreach ($Fournisseurs as $Fournisseur) {                        
                        include './Vues/admin_liste_fournisseur_vue.php';
                }

                echo '                  </tbody>
                                </table>
                                <p>
                                        <a class="top-rectangle-button" href="./index.php?uc=admin_creer_fournisseur">Créer</a>
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
<script type="text/javascript" src="./Vues/JS/fournisseur_liste.js"></script>
