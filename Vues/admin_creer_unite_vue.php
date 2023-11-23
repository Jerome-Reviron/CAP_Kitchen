<div class="Panel_boss_inscription">
    <div class="Administrateur">
        <form class="form" action="index.php?uc=admin_creer_unite" method="post">
            <h2 class="admintitleh2">Créer une Unité</h2>
            <div class="inputBox">
                <input type="text" name="Nom_Unite" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Nom</span>
            </div>
            <div class="inputBox">
                <select style="width: 300px" name="Genre" required="required">
                    <option value="Unité de recette">Unité de recette</option>
                    <option value="Conditionnement d\'achat">Conditionnement d'achat</option>
                </select>
                <i class="fa-solid fa-hashtag"></i>
                <span>Genre</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Chiffre" required="required" autocomplete="off">
                <i class="fa-solid fa-plus-minus"></i>
                <span>Chiffre</span>
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
                <i class="fa-solid fa-sliders"></i>
                <span>Valeur</span>
            </div>
            <div class="inputBox">
                <input type="submit" value="Inscription">
            </div>
            <a class="login" href="./index.php?uc=admin_liste_unite">Retour</a>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
    </div>
</div>