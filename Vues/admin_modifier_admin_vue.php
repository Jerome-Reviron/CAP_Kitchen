<div class="Panel_boss_inscription">
    <div class="Administrateur">
        <form class="form" action="index.php?uc=admin_modifier_admin&Id=<?php echo ($Admin->getId_Admin()); ?>" method="POST">
            <h2 class="admintitleh2">Modifier un Admin</h2>
            <div class="inputBox">
                <input type="text" name="Nom" value="<?php echo ($Admin->getNom()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-user"></i>
                <span>Nom</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Prenom" value="<?php echo ($Admin->getPrenom()); ?>" required="required" autocomplete="off">
                <i class="fa-regular fa-user"></i>
                <span>Prenom</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Pseudo" value="<?php echo ($Admin->getPseudo()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-user-tag"></i>
                <span>Pseudo</span>
            </div>
            <div class="inputBox">
                <input type="password" name="Password" required="required" id="pswrd" onkeyup="checkPassword(this.value)" autocomplete="off">
                <i class="fa-solid fa-lock"></i>
                <span>Mot de passe</span>
            </div>
            <div class="inputBox">
                <input type="password" name="Password_retype" required="required" autocomplete="off">
                <i class="fa-solid fa-lock-open"></i>
                <span>Confirmation</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Adresse" value="<?php echo ($Admin->getAdresse()); ?>" required="required" autocomplete="off">
                <i class="fa-solid fa-street-view"></i>
                <span>Adresse</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Telephone" value="<?php echo ($Admin->getTelephone()); ?>" required="required" autocomplete="off" title="Entrez votre numéro de téléphone (ex: 06 00 00 00 00)">
                <i class="fa-solid fa-phone"></i>
                <span>Téléphone</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Email" value="<?php echo ($Admin->getEmail()); ?>" required="required" autocomplete="off">
                <i class="fa-regular fa-envelope"></i>
                <span>Email</span>
            </div>
            <div class="inputBox">
                <select name="Role" required="required">
                    <option value="1" <?php echo ($Admin->getRole() == 1) ? 'selected' : ''; ?>>Boss</option>
                    <option value="2" <?php echo ($Admin->getRole() == 2) ? 'selected' : ''; ?>>Employé</option>
                    <option value="3" <?php echo ($Admin->getRole() == 3) ? 'selected' : ''; ?>>Stagiaire</option>
                </select>       
                <i class="fa-solid fa-check"></i>        
                <span>Role</span>
            </div>
            <div class="inputBox">
                <input type="number" name="Id_Entreprise" value="<?php echo ($Admin->getId_Entreprise()); ?>" required="required" autocomplete="off" readonly>       
                <i class="fa-solid fa-id-card-clip"></i>      
                <span class="Id_E">Id_Entreprise</span>
            </div>          
            <div class="inputBox">
                <input type="submit" value="Modifier">
            </div>
            <a class="login" href="./index.php?uc=admin_liste_admin">Retour</a>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
        <span id="toggleBtn"></span>
        <div class="validation">
            <ul>
                <li id="lower">Au moins une lettre miniscule</li>
                <li id="upper">Au moins une lettre majuscule</li>
                <li id="number">Au moins un chiffre</li>
                <li id="special">Au moins un caractère spécial</li>
                <li id="length">Au moins 8 caractères</li>
            </ul>
        </div>
    </div>
</div>