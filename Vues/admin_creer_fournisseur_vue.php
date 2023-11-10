<div class="Panel_boss_inscription">
    <div class="Administrateur">
        <form class="form" action="index.php?uc=admin_creer_fournisseur" method="post">
            <h2 class="admintitleh2">Créer un Fournisseur</h2>
            <div class="inputBox">
            <select name="Forme_Juridique" required="required">
                    <option value="EI">EI</option>
                    <option value="EIRL">EIRL</option>
                    <option value="SA">SA</option>
                    <option value="SARL">SARL</option>
                    <option value="SAS">SAS</option>
                    <option value="SASU">SASU</option>
                </select>
                <i class="fa-solid fa-user-gear"></i>
                <span>Forme Juridique</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Nom_Fournisseur" required="required" autocomplete="off">
                <i class="fa-solid fa-user"></i>
                <span>Nom</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Adresse" required="required" autocomplete="off">
                <i class="fa-solid fa-street-view"></i>
                <span>Adresse</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Telephone" required="required" autocomplete="off" title="Ex: 0123456789 ">
                <i class="fa-solid fa-phone"></i>
                <span>Téléphone</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Email" required="required" autocomplete="off">
                <i class="fa-regular fa-envelope"></i>
                <span>Email</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Numero_SIRET" required="required" autocomplete="off">       
                <i class="fa-solid fa-id-card-clip"></i>      
                <span>Numéro SIRET</span>
            </div>
            <div class="inputBox">
                <input type="submit" value="Inscription">
            </div>
            <a class="login" href="./index.php?uc=admin_liste_fournisseur">Retour</a>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
    </div>
</div>