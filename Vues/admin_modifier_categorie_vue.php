<div class="Panel_boss_inscription">
    <div class="Administrateur">
        <form class="form" action="index.php?uc=admin_modifier_categorie&Id=<?php echo ($Categorie->getId_Categorie()); ?>" method="POST">
            <h2 class="admintitleh2">Modifier une Catégorie</h2>
            <div class="inputBox">
                <input type="text" name="Nom_Categorie" value="<?php echo ($Categorie->getNom_Categorie()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-user"></i>
                <span>Nom</span>
            </div>
            <div class="inputBox">
                <select style="width: 300px" name="Genre" required="required">
                    <option value="Ingrédient">Ingrédient</option>
                    <option value="Recette">Recette</option>
                </select>       
                <i class="fa-solid fa-check"></i>        
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