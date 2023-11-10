<div class="Panel_boss_inscription">
    <div class="Administrateur">
        <form class="form" action="index.php?uc=admin_modifier_fournisseur&Id=<?php echo ($Fournisseur->getId_Fournisseur()); ?>" method="post">
            <h2 class="admintitleh2">Modifier Fournisseur</h2>
            <div class="inputBox">
                <input type="text" name="Forme_Juridique" value="<?php echo ($Fournisseur->getForme_Juridique()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-user-gear"></i>
                <span>Forme Juridique</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Nom_Fournisseur" value="<?php echo ($Fournisseur->getNom_Fournisseur()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-user"></i>
                <span>Nom</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Adresse" value="<?php echo ($Fournisseur->getAdresse()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-street-view"></i>
                <span>Adresse</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Telephone" value="<?php echo ($Fournisseur->getTelephone()); ?>" required="required" autocomplete="off" title="Ex: 0123456789 ">
                <i class="fa-solid fa-phone"></i>
                <span>Téléphone</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Email" value="<?php echo ($Fournisseur->getEmail()); ?>" required="required" autocomplete="off">
                <i class="fa-regular fa-envelope"></i>
                <span>Email</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Numero_SIRET" value="<?php echo ($Fournisseur->getNumero_SIRET()); ?>" required="required" autocomplete="off">       
                <i class="fa-solid fa-id-card-clip"></i>      
                <span>Numéro SIRET</span>
            </div>
            <div class="inputBox">
                <input type="submit" value="Modifier">
            </div>
            <a class="login" href="./index.php?uc=admin_liste_fournisseur">Retour</a>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
    </div>
</div>