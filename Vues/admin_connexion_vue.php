<div class="co">
    <form class="administrateur" action="index.php?uc=admin_connexion" method="post">
        <h2 class="cotitleh2">Se connecter</h2>
        <div class="inputBox">
            <input type="text" name="Pseudo" required="required" autocomplete="off" >
            <i class="fa-solid fa-user"></i>
            <span>Pseudo</span>
        </div>
        <div class="inputBox">
            <input type="password" name="Password" required="required" autocomplete="off" >
            <i class="fa-solid fa-lock"></i>
            <span>Mot de passe</span>
        </div>
        <div class="inputBox">
            <input type="submit" value="Connexion">
        </div>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    </form>
</div>