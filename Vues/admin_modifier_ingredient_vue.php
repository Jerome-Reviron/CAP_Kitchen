<div class="Panel_boss_inscription">
    <div class="Administrateur">
        <form class="form" action="index.php?uc=admin_modifier_ingredient&Id=<?php echo ($Ingredient->getId_Ingredient()); ?>" method="POST" enctype="multipart/form-data">
            <h2 class="admintitleh2">Modifier un Ingrédient</h2>
            <div class="inputBox">
                <input type="text" name="Nom_Ingredient" value="<?php echo ($Ingredient->getNom_Ingredient()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Nom</span>
            </div>
            <div class="inputBox">
                <input type="file" name="Photo" accept="image/*">
                <i class="fa-solid fa-hashtag"></i>
                <span>Photo</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Unite_recette" value="<?php echo ($Ingredient->getUnite_recette()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Unité de la recette</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Conditionnement_achat" value="<?php echo ($Ingredient->getConditionnement_achat()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Conditionnement d'achat</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Prix_achat" value="<?php echo ($Ingredient->getPrix_achat()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Prix d'achat</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Unite_achat" value="<?php echo ($Ingredient->getUnite_achat()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Unité d'achat</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Allergene" value="<?php echo htmlspecialchars($AllergenesString); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Allergene</span>
            </div>
            <div class="inputBox">
            <input type="text" name="Categorie" value="<?php echo htmlspecialchars($CategoriesString); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Categorie</span>
            </div>
            <div class="inputBox">
            <input type="text" name="Fournisseur" value="<?php echo htmlspecialchars($FournisseursString); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Fournisseur</span>
            </div>
            <div class="inputBox">
                <input type="submit" value="Modifier">
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

            // Récupérer l'unité de recette associée à l'ingrédient et la diviser en tableau
            $Unite_recetteIngredient = explode(" / ", $Ingredient->getUnite_recette());

            // Parcourir les Unite_recettes pour les afficher comme cases à cocher
            foreach ($Unite_recettes as $Unite_recette) {
                $checked = in_array($Unite_recette, $Unite_recetteIngredient) ? 'checked' : '';
                echo "<label><input type='checkbox' name='Unite_recettes[]' value='{$Unite_recette}' $checked> {$Unite_recette}</label><br>";
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

            // Récupérer le Conditionnement_achat actuel de l'ingrédient
            $currentConditionnement = $Ingredient->getConditionnement_achat();

            // Parcourir les Conditionnement_achats pour les afficher comme boutons radio
            foreach ($Conditionnement_achats as $Conditionnement_achat) {
                $optionValue = "{$Conditionnement_achat['Nom_Unite']} {$Conditionnement_achat['Chiffre']} {$Conditionnement_achat['Valeur']}";
                $checked = ($optionValue == $currentConditionnement) ? 'checked' : '';
                echo "<label><input type='radio' name='Conditionnement_achats' value='{$optionValue}' {$checked}> {$optionValue}</label><br>";
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

            // Récupérer l'Unite_achat actuel de l'ingrédient
            $currentUniteAchat = $Ingredient->getUnite_achat();

            // Parcourir les Unite_achats pour les afficher comme boutons radio
            foreach ($Unite_achats as $Unite_achat) {
                $checked = ($Unite_achat == $currentUniteAchat) ? 'checked' : '';
                echo "<label><input type='radio' name='Unite_achats' value='{$Unite_achat}' {$checked}> {$Unite_achat}</label><br>";
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

            // Créer une liste des ID des allergènes associés à l'ingrédient
            $IdsAllergenesAssocies = array_map(function($Allergene) {
                return $Allergene->getId_Allergene();
            }, $AllergenesAssocies);

            // Parcourir les Allergenes pour les afficher comme cases à cocher
            foreach ($Allergenes as $Allergene) {
                $Id_Allergene = $Allergene['Id_Allergene'];
                $Nom_Allergene = $Allergene['Nom_Allergene'];
                $checked = in_array($Id_Allergene, $IdsAllergenesAssocies) ? 'checked' : '';
                echo "<label><input type='checkbox' name='Allergenes[]' data-id='{$Id_Allergene}' value='{$Nom_Allergene}' {$checked}> {$Nom_Allergene}</label><br>";
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

            // Créer une liste des ID des allergènes associés à l'ingrédient
            $IdsCategoriesAssocies = array_map(function($Categorie) {
                return $Categorie->getId_Categorie();
            }, $CategoriesAssocies);

            // Parcourir les Categories pour les afficher comme cases à cocher
            foreach ($Categories as $Categorie) {
                $Id_Categorie = $Categorie['Id_Categorie'];
                $Nom_Categorie = $Categorie['Nom_Categorie'];
                $checked = in_array($Id_Categorie, $IdsCategoriesAssocies) ? 'checked' : '';
                echo "<label><input type='radio' name='Categories[]' data-id='{$Id_Categorie}' value='{$Nom_Categorie}' {$checked}> {$Nom_Categorie}</label><br>";
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

            // Créer une liste des ID des allergènes associés à l'ingrédient
            $IdsFournisseursAssocies = array_map(function($Fournisseur) {
                return $Fournisseur->getId_Fournisseur();
            }, $FournisseursAssocies);

            // Parcourir les Fournisseurs pour les afficher comme cases à cocher
            foreach ($Fournisseurs as $Fournisseur) {
                $Id_Fournisseur = $Fournisseur['Id_Fournisseur'];
                $Nom_Fournisseur = $Fournisseur['Nom_Fournisseur'];
                $checked = in_array($Id_Fournisseur, $IdsFournisseursAssocies) ? 'checked' : '';
                echo "<label><input type='checkbox' name='Fournisseurs[]' data-id='{$Id_Fournisseur}' value='{$Nom_Fournisseur}' {$checked}> {$Nom_Fournisseur}</label><br>";
            }
            ?>
        </div>
        <button id="FournisseursButton" class="FournisseursButton">Valider</button>
    </div>
</div>
