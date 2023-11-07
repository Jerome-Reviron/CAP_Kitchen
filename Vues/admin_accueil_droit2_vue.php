<section>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <i class='bx bxs-directions icon'></i>
                <span class="name">Panel</span>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="./index.php?uc=admin_liste_Recettes">
                            <i class='bx bxs-food-menu icon'></i>
                            <span class="link-name">Recettes</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="./index.php?uc=admin_liste_Classeur">
                            <i class='bx bxs-folder-open icon'></i>
                            <span class="link-name">Classeur</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="./index.php?uc=admin_liste_Fournisseurs">
                            <i class='bx bxs-truck icon'></i>
                            <span class="link-name">Fournisseurs</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="./index.php?uc=admin_liste_Bases">
                            <i class='bx bxs-data icon'></i>
                            <span class="link-name">Bases</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="./index.php?uc=admin_liste_Techniques">
                            <i class='bx bxs-extension icon'></i>
                            <span class="link-name">Techniques</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="./index.php?uc=admin_liste_Haccp">
                            <i class='bx bxs-check-shield icon'></i>
                            <span class="link-name">Haccp</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="./index.php?uc=admin_liste_Matériel">
                            <i class='bx bxs-dish icon'></i>
                            <span class="link-name">Matériel</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="./index.php?uc=admin_liste_Lexique">
                            <i class='bx bxs-book-bookmark icon'></i>
                            <span class="link-name">Lexique</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="./index.php?uc=admin_liste_Admin">
                            <i class='bx bxs-user-account icon'></i>
                            <span class="link-name">Admin</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="nav-link">
                    <a href="./index.php?uc=admin_deconnexion">
                        <i class='bx bx-log-out icon' id="log_out"></i>
                        <span class="link-name">Déconnexion</span>
                    </a>
                </li>
                <li class="mode">
                    <div class="moon-sun">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-name">Dark Mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>
    <section class="home">
        <div class="nav1">
            <h2>
                <?php
                    // Affiche la phrase de bienvenue
                    echo "Bonjour " . $Admin->getPseudo() . "!";
                ?>
            </h2>
            <p>CAP-Kitchen<img src="./Vues/Image/utensils.svg"></p>
        </div>
        <div class="start2">
            <h3>Bien commencer</h3>
            <ul class="menu-links">
                <li class="nav-link">
                    <a href="./index.php?uc=admin_modifier_profil&Id=<?php echo $Admin->getId_Admin() ?>">
                        <i class="fa-solid fa-1 icon"></i>
                        <div class="link-content">
                            <span class="link-name">Je consulte mon profil</span>
                            <p>Pour modifier mes informations.</p>
                        </div>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="./index.php?uc=admin_liste_unite">
                        <i class="fa-solid fa-2 icon"></i>
                        <div class="link-content">
                            <span class="link-name">Je crée mes unités</span>
                            <p>Pour mesurer mes ingrédients</p>
                        </div>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="./index.php?uc=admin_liste_categorie">
                        <i class="fa-solid fa-3 icon"></i>
                        <div class="link-content">
                            <span class="link-name">Je crée mes catégories</span>
                            <p>Pour classer mes ingredients et recettes.</p>
                        </div>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="./index.php?uc=admin_creer_ingredient">
                        <i class="fa-solid fa-4 icon"></i>
                        <div class="link-content">
                            <span class="link-name">Je crée mes ingrédients</span>
                            <p>Pour remplir ma mercuriale.</p>
                        </div>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="./index.php?uc=admin_creer_recette">
                        <i class="fa-solid fa-5 icon"></i>
                        <div class="link-content">
                            <span class="link-name">Je crée mes recettes</span>
                            <p>Pour partager mes connaissances.</p>
                        </div>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="./index.php?uc=admin_creer_fournisseur">
                        <i class="fa-solid fa-6 icon"></i>
                        <div class="link-content">
                            <span class="link-name">Je crée mes fournisseurs</span>
                            <p>Pour gérer mes commandes.</p>
                        </div>
                    </a>
                </li>
                
            </ul>
        </div>
        <div class="indicateur3"> </div>
        <div class="entree4"> </div>
        <div class="plat5"> </div>
        <div class="dessert6"> </div>
        <div class="finish7"> </div>
    </section>
</section>