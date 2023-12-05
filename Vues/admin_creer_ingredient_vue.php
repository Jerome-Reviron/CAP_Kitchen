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
                <input type="submit" value="Inscription">
            </div>
            <a class="login" href="./index.php?uc=admin_liste_ingredient">Retour</a>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
    </div>
    <div id="optionsValeursDiv" class="optionsValeursDiv">
        <div class="scrollable-container">
            <?php
            // Récupérer les Valeurs depuis la base de données
            $Valeurs = Unite::getValeursFromDatabase();

            // Parcourir les Valeurs pour les afficher comme cases à cocher
            foreach ($Valeurs as $Valeur) {
                echo "<label><input type='checkbox' name='Valeurs[]' value='{$Valeur}'> {$Valeur}</label><br>";
            }
            ?>
        </div>
        <button id="valeursButton" class="valeursButton">Valider</button>
    </div>
    <div id="optionsConditionnementsDiv" class="optionsConditionnementsDiv">
        <div class="scrollable-container">
            <?php
            // Récupérer les Conditionnements depuis la base de données
            $Conditionnements = Unite::getConditionnementsFromDatabase();

            // Parcourir les Conditionnements pour les afficher comme boutons radio
            foreach ($Conditionnements as $Conditionnement) {
                $optionValue = "{$Conditionnement['Nom_Unite']} {$Conditionnement['Chiffre']} {$Conditionnement['Valeur']}";
                echo "<label><input type='radio' name='Conditionnements' value='{$optionValue}'> {$optionValue}</label><br>";
            }
            ?>
        </div>
        <button id="conditionnementsButton" class="conditionnementsButton">Valider</button>
    </div>
    <div id="optionsUnitesDiv" class="optionsUnitesDiv">
        <div class="scrollable-container">
            <?php
            // Récupérer les Unites depuis la base de données
            $Unites = Unite::getUnitesFromDatabase();

            // Parcourir les Unites pour les afficher comme boutons radio
            foreach ($Unites as $Unite) {
                echo "<label><input type='radio' name='Unites' value='{$Unite}'> {$Unite}</label><br>";
            }
            ?>
        </div>
        <button id="unitesButton" class="unitesButton">Valider</button>
    </div>
</div>