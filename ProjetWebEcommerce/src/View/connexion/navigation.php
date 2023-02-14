<nav>

    <ul>
        <li><a id="acceuil" href="frontController.php?controller=produit&action=affichePageAcceuil">Vinyl Avenue</a>
        </li>
        <div id="partieDroite">
            <li><a id="top" href="frontController.php?controller=produit&action=affichePageAmplis">Amplis</a></li>
            <li><a href="frontController.php?controller=produit&action=affichePageEnceintes">Enceintes</a></li>
            <li><a href="frontController.php?controller=produit&action=affichePagePlatines">Platines</a></li>
            <li><a href="frontController.php?controller=produit&action=affichePageVinyles">Vinyles</a></li>


            <?php

            if (isset($_SESSION['login'])) {

                if ($_SESSION['status'] == "admin" || $_SESSION['status'] == "fondateur") {
                    //Partie admin

                    echo "<li id='adminNav'><a>Admin</a>
                
                    <ul id = 'listeAdmin'>
                    <a href=\"frontController.php?controller=admin&action=afficheListeUtilisateur\">Utilisateurs</a>
                    <a href=\"frontController.php?controller=admin&action=afficheListeProduit\">Produits</a>
                    <a href=\"frontController.php?controller=admin&action=afficheListeCommandes\">Commandes</a>
                    </ul>
                </li>";


                }


                //echo "<li><a href=\"frontController.php?controller=utilisateur&action=affichePageChangementMDP\">Changer de mot de passe</a></li>";

                echo "<li id='compte'><a href='frontController.php?controller=utilisateur&action=consulterMonCompte'>" . $_SESSION['login'] . "</a></li>";

                echo '<li><a href="frontController.php?controller=utilisateur&action=deconnexion"><img src="../web/img/deconnexion.png"></a></li>';

            } else {

                echo '<li><a href="frontController.php?controller=utilisateur&action=affichePageConnexion">Se connecter</a></li>';
            } ?>

            <li id="barreRecherche"><a><img src="../web/img/loupe.png"></a>

                <ul id=listeBarreRecherche>

                    <form method="post"
                          action="frontController.php?controller=produit&action=affichePageResultatRecherche">
                        <input type="search" name="requete" placeholder="Rechercher un produit">
                        <button type="submit">Rechercher</button>
                    </form>
                </ul>
            </li>


            <li><a href="frontController.php?controller=panier&action=affichePanier"><img src="../web/img/panier.png"></a></li>


        </div>
    </ul>


</nav>
