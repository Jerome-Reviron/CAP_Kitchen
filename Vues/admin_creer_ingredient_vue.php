<div class="Panel_boss_inscription">
    <div class="Administrateur">
        <form class="form" action="index.php?uc=admin_creer_ingredient" method="post" enctype="multipart/form-data">
            <h2 class="admintitleh2">Créer un Ingrédient</h2>
            <div class="inputBox">
                <input type="text" name="Nom_Ingredient" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Nom</span>
            </div>
            <div class="inputBox">
                <input type="file" name="Photo" accept="image/*" required="required">
                <i class="fa-solid fa-hashtag"></i>
                <span class="Phantome">Photo</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Unite_recette" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Unité de la recette</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Conditionnement_achat" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Conditionnement d'achat</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Prix_achat" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Prix d'achat</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Unite_achat" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Unité d'achat</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Allergene" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Allergene</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Categorie" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Categorie</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Fournisseur" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Fournisseur</span>
            </div>
            <div class="inputBox">
                <input type="submit" value="Inscription">
            </div>
            <a class="login" href="./index.php?uc=admin_liste_ingredient">Retour</a>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
    </div>
    <div id="optionsUnite_recettesDiv" class="optionsUnite_recettesDiv">
        <div class="scrollable-container">
            <?php
            // Récupérer les Unite_recettes depuis la base de données
            $Unite_recettes = Unite::getUnite_recettesFromDatabase();

            // Parcourir les Unite_recettes pour les afficher comme cases à cocher
            foreach ($Unite_recettes as $Unite_recette) {
                echo "<label><input type='checkbox' name='Unite_recettes[]' value='{$Unite_recette}'> {$Unite_recette}</label><br>";
            }
            ?>
        </div>
        <button id="Unite_recettesButton" class="Unite_recettesButton">Valider</button>
    </div>
    <div id="optionsConditionnement_achatsDiv" class="optionsConditionnement_achatsDiv">
        <div class="scrollable-container">
            <?php
            // Récupérer les Conditionnement_achats depuis la base de données
            $Conditionnement_achats = Unite::getConditionnement_achatsFromDatabase();

            // Parcourir les Conditionnement_achats pour les afficher comme boutons radio
            foreach ($Conditionnement_achats as $Conditionnement_achat) {
                $optionValue = "{$Conditionnement_achat['Nom_Unite']} {$Conditionnement_achat['Chiffre']} {$Conditionnement_achat['Valeur']}";
                echo "<label><input type='radio' name='Conditionnement_achats' value='{$optionValue}'> {$optionValue}</label><br>";
            }
            ?>
        </div>
        <button id="Conditionnement_achatsButton" class="Conditionnement_achatsButton">Valider</button>
    </div>
    <div id="optionsUnite_achatsDiv" class="optionsUnite_achatsDiv">
        <div class="scrollable-container">
            <?php
            // Récupérer les Unite_achats depuis la base de données
            $Unite_achats = Unite::getUnite_achatsFromDatabase();

            // Parcourir les Unite_achats pour les afficher comme boutons radio
            foreach ($Unite_achats as $Unite_achat) {
                echo "<label><input type='radio' name='Unite_achats' value='{$Unite_achat}'> {$Unite_achat}</label><br>";
            }
            ?>
        </div>
        <button id="Unite_achatsButton" class="Unite_achatsButton">Valider</button>
    </div>
    <div id="optionsAllergenesDiv" class="optionsAllergenesDiv">
        <div class="scrollable-container">
            <?php
            // Récupérer les Allergenes depuis la base de données
            $Allergenes = Allergene::getAllergenesFromDatabase();

            // Parcourir les Allergenes pour les afficher comme boutons checkbox
            foreach ($Allergenes as $Allergene) {
                $Nom_Allergene = $Allergene['Nom_Allergene'];
                echo "<label><input type='checkbox' name='Allergenes[]' value='{$Nom_Allergene}'> {$Nom_Allergene}</label><br>";
            }
            ?>
        </div>
        <button id="AllergenesButton" class="AllergenesButton">Valider</button>
    </div>
    <div id="optionsCategoriesDiv" class="optionsCategoriesDiv">
        <div class="scrollable-container">
            <?php
            // Récupérer les Categories depuis la base de données
            $Categories = Categorie::getCategoriesFromDatabase();

            // Parcourir les Categories pour les afficher comme boutons radio
            foreach ($Categories as $Categorie) {
                $Nom_Categorie = $Categorie['Nom_Categorie'];
                echo "<label><input type='radio' name='Categories[]' value='{$Categorie['Id_Categorie']}'> {$Nom_Categorie}</label><br>";
            }            
            ?>
        </div>
        <button id="CategoriesButton" class="CategoriesButton">Valider</button>
    </div>
    <div id="optionsFournisseursDiv" class="optionsFournisseursDiv">
        <div class="scrollable-container">
            <?php
            // Récupérer les Fournisseurs depuis la base de données
            $Fournisseurs = Fournisseur::getFournisseursFromDatabase();

            // Parcourir les Fournisseurs pour les afficher comme boutons checkbox
            foreach ($Fournisseurs as $Fournisseur) {
                $Nom_Fournisseur = $Fournisseur['Nom_Fournisseur'];
                echo "<label><input type='checkbox' name='Fournisseurs[]' value='{$Nom_Fournisseur}'> {$Nom_Fournisseur}</label><br>";
            }
            ?>
        </div>
        <button id="FournisseursButton" class="FournisseursButton">Valider</button>
    </div>
</div>