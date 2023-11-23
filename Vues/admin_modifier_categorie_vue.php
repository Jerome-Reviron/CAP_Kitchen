<div class="Panel_boss_inscription">
    <div class="Administrateur">
        <form class="form" action="index.php?uc=admin_modifier_categorie&Id=<?php echo ($Categorie->getId_Categorie()); ?>" method="POST">
            <h2 class="admintitleh2">Modifier une Catégorie</h2>
            <div class="inputBox">
                <input type="text" name="Nom_Categorie" value="<?php echo ($Categorie->getNom_Categorie()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Nom</span>
            </div>
            <div class="inputBox">
                <select style="width: 300px;" name="Genre" required="required">
                    <?php
                    // Récupérer les Genres depuis la base de données
                    $Genres = Categorie::getGenresFromDatabase();

                    // Parcourir les Genres pour les afficher comme options dans la liste déroulante
                    foreach ($Genres as $Genre) {
                        // Si la Genre correspond à celle de l'unité actuelle, sélectionnez-la
                        $selected = ($Genre == $Categorie->getGenre()) ? 'selected' : '';

                        echo "<option value='{$Genre}' {$selected}>{$Genre}</option>";
                    }
                    ?>
                </select>        
                <i class="fa-solid fa-tags"></i>        
                <span>Genre</span>
            </div>
            <div class="inputBox">
                <input type="submit" value="Modifier">
            </div>
            <a class="login" href="./index.php?uc=admin_liste_categorie">Retour</a>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
    </div>
</div>
