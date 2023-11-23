<div class="Panel_boss_inscription">
    <div class="Administrateur">
        <form class="form" action="index.php?uc=admin_creer_categorie" method="post">
            <h2 class="admintitleh2">Créer un Ingrédient</h2>
            <div class="inputBox">
                <input type="text" name="Nom_Ingredient" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Nom</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Photo" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Photo</span>
            </div>
            <div class="inputBox">
                <select style= "width: 300px;" name="Valeur" required="required">
                    <?php
                    // Récupérer les Valeurs depuis la base de données
                    $Valeurs = Unite::getValeursFromDatabase();

                    // Parcourir les Valeurs pour les afficher comme options dans la liste déroulante
                    foreach ($Valeurs as $Valeur) {
                        echo "<option value='{$Valeur}'>{$Valeur}</option>";
                    }
                    ?>
                </select>
                <i class="fa-solid fa-hashtag"></i>
                <span>Unité de la recette</span>
            </div>
            <div class="inputBox">
                <select style="width: 300px;" name="Conditionnement_achat" required="required">
                    <?php
                    // Récupérer les Conditionnements depuis la base de données
                    $Conditionnements = Unite::getConditionnementsFromDatabase();

                    // Parcourir les Conditionnements pour les afficher comme options dans la liste déroulante
                    foreach ($Conditionnements as $Conditionnement) {
                        // Créer une chaîne avec les valeurs de Nom_Unite, Chiffre, et Valeur
                        $optionValue = "{$Conditionnement['Nom_Unite']} {$Conditionnement['Chiffre']} {$Conditionnement['Valeur']}";

                        // Afficher l'option avec la chaîne créée
                        echo "<option value='{$optionValue}'>{$optionValue}</option>";
                    }
                    ?>
                </select>
                <i class="fa-solid fa-hashtag"></i>
                <span>Conditionnement d'achat</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Prix_achat" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Prix d'achat</span>
            </div>
            <div class="inputBox">
                <select style="width: 300px;" name="Unite_achat" required="required">
                    <?php
                    // Récupérer les Unites depuis la base de données
                    $Unites = Unite::getUnitesFromDatabase();

                    // Parcourir les Unites pour les afficher comme options dans la liste déroulante
                    foreach ($Unites as $Unite) {
                        echo "<option value='{$Unite}'>{$Unite}</option>";
                    }
                    ?>
                </select>  
                <i class="fa-solid fa-hashtag"></i>
                <span>Unité d'achat</span>
            </div>
            <div class="inputBox">
                <input type="submit" value="Inscription">
            </div>
            <a class="login" href="./index.php?uc=admin_liste_ingredient">Retour</a>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
    </div>
</div>