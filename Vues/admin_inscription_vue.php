<div class="Panel_boss_inscription">
    <div class="Administrateur">
        <form class="form" action="index.php?uc=admin_inscription" method="post">
            <h2 class="admintitleh2">Inscrire un Admin</h2>
            <div class="inputBox">
                <input type="text" name="Nom" required="required" autocomplete="off">
                <i class="fa-solid fa-user"></i>
                <span>Nom</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Prenom" required="required" autocomplete="off">
                <i class="fa-regular fa-user"></i>
                <span>Prenom</span>
            </div>
            <div class="inputBox">
                <input type="text" name="Pseudo" required="required" autocomplete="off">
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
                <select name="Role" required="required">
                    <?php
                        // Utilisez une boucle foreach pour générer les options
                        foreach ($optionsRoles as $value => $label) {
                            echo "<option value=\"$value\">$label</option>";
                        }
                    ?>
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
                <input type="submit" value="Inscription">
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