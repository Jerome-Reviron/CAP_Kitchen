<div class="Panel_boss_inscription">
    <div class="Administrateur">
        <form class="form" action="index.php?uc=admin_modifier_unite&Id=<?php echo ($Unite->getId_Unite()); ?>" method="POST">
            <h2 class="admintitleh2">Modifier une Unité</h2>
            <div class="inputBox">
                <input type="text" name="Nom_Unite" value="<?php echo ($Unite->getNom_Unite()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Nom</span>
            </div>
            <div class="inputBox">
                <select style="width: 300px;" name="Genre" required="required">
                    <?php
                    // Récupérer les Genres depuis la base de données
                    $Genres = Unite::getGenresFromDatabase();

                    // Parcourir les Genres pour les afficher comme options dans la liste déroulante
                    foreach ($Genres as $Genre) {
                        // Si la Genre correspond à celle de l'unité actuelle, sélectionnez-la
                        $selected = ($Genre == $Unite->getGenre()) ? 'selected' : '';

                        echo "<option value='{$Genre}' {$selected}>{$Genre}</option>";
                    }
                    ?>
                </select>                
                <i class="fa-solid fa-hashtag"></i>
                <span>Genre</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Chiffre" value="<?php echo ($Unite->getChiffre()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-plus-minus"></i>
                <span>Chiffre</span>
            </div>
            <div class="inputBox">
                <select style="width: 300px;" name="Valeur" required="required">
                    <?php
                    // Récupérer les valeurs depuis la base de données
                    $Valeurs = Unite::getValeursFromDatabase();

                    // Parcourir les Valeurs pour les afficher comme options dans la liste déroulante
                    foreach ($Valeurs as $Valeur) {
                        // Si la Valeur correspond à celle de l'unité actuelle, sélectionnez-la
                        $selected = ($Valeur == $Unite->getValeur()) ? 'selected' : '';

                        echo "<option value='{$Valeur}' {$selected}>{$Valeur}</option>";
                    }
                    ?>
                </select>                
                <i class="fa-solid fa-sliders"></i>
                <span>Valeur</span>
            </div>
            <div class="inputBox">
                <input type="submit" value="Modifier">
            </div>
            <a class="login" href="./index.php?uc=admin_liste_unite">Retour</a>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
    </div>
</div>