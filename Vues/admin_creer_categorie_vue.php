<div class="Panel_boss_inscription">
    <div class="Administrateur">
        <form class="form" action="index.php?uc=admin_creer_categorie" method="post">
            <h2 class="admintitleh2">Créer une Catégorie</h2>
            <div class="inputBox">
                <input type="text" name="Nom_Categorie" required="required" autocomplete="off">
                <i class="fa-solid fa-hashtag"></i>
                <span>Nom</span>
            </div>
            <div class="inputBox">
                <select style="width: 300px" name="Genre" required="required">
                    <option value="Ingrédient">Ingrédient</option>
                    <option value="Recette">Recette</option>
                </select>       
                <i class="fa-solid fa-tags"></i>      
                <span>Genre</span>
            </div>
            <div class="inputBox">
                <input type="submit" value="Inscription">
            </div>
            <a class="login" href="./index.php?uc=admin_liste_categorie">Retour</a>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
    </div>
</div>