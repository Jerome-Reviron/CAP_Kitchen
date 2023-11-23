<div class="Panel_boss_inscription">
    <div class="Administrateur">
        <form class="form" action="index.php?uc=admin_modifier_ingredient&Id=<?php echo ($Ingredient->getId_Ingredient()); ?>" method="POST">
            <h2 class="admintitleh2">Modifier une Catégorie</h2>
            <div class="inputBox">
                <input type="text" name="Nom_Ingredient" value="<?php echo ($Ingredient->getNom_Ingredient()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Nom</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Photo" value="<?php echo ($Ingredient->getPhoto()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Photo</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Unite_recette" value="<?php echo ($Ingredient->getUnite_recette()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Unité de la ecette</span>
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
                <input type="submit" value="Modifier">
            </div>
            <a class="login" href="./index.php?uc=admin_liste_ingredient">Retour</a>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
    </div>
</div>