<div class="Panel_boss_inscription">
    <div class="Administrateur">
        <form class="form" action="index.php?uc=admin_modifier_unite&Id=<?php echo ($Unite->getId_Unite()); ?>" method="POST">
            <h2 class="admintitleh2">Modifier une Unité</h2>
            <div class="inputBox">
                <input type="text" name="Nom_Unite" value="<?php echo ($Unite->getNom_Unite()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-user"></i>
                <span>Nom</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Chiffre" value="<?php echo ($Unite->getChiffre()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-user"></i>
                <span>Chiffre</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Valeur" value="<?php echo ($Unite->getValeur()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-user"></i>
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