<form method="POST" action="frontController.php?controller=utilisateur&action=inscription">
    <img src="img/formpic.jpg" alt="Image d'illustration">

    <fieldset>


        <div>
            <legend>S'incrire</legend>
            <div class="formSubtitle">
                Vous aussi rejoignez la bande!
            </div>
        </div>

        <div class="Formulaire">
        <p>
        <?php

        use App\eCommerce\Model\Repository\UtilisateurRepository;

        if (isset($_POST['login']) && $_POST['login'] != "") {

            $login = $_POST['login'];
            if (UtilisateurRepository::getUtilisateurByLogin($login) != null) {

                echo "<label for='login'>Login</label> ";
                echo "<input type=text  name=login id=login value='$login' required/>";
                echo "<p>Le login est déjà utilisé</p>";
            } else {
                //Remettre le login dans le champ
                echo "<label for='login'>Login</label>";
                echo "<input type=text  name=login id=login value='$login' required/>";
            }
        } else {
            echo "<label for='login'>Login</label>";
            echo "<input type=text  name=login id=login required/>";
        }

        ?>
        </p>
        <p>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required/>
        </p>

        <p>
            <label for="password">Verification password</label>
            <input type="password" name="passwordVerif" id="passwordVerif" required/>
        </p>

            <?php

        if(isset($_POST['password']) && $_POST['password'] != "" && isset($_POST['passwordVerif']) && $_POST['passwordVerif'] != ""){
            $password = $_POST['password'];
            $passwordVerif = $_POST['passwordVerif'];
            if($password != $passwordVerif){
                echo "<p>Les mots de passe ne correspondent pas</p>";
            }
        }


        ?>
        <p>
            <?php

            if (isset($_POST['nom']) && $_POST['nom'] != "") {

                $nom = $_POST['nom'];
                //Remettre le prenom dans le champ
                echo "<label for='nom'>Nom</label>";
                echo " <input type=text  name=nom id=nom value='$nom' required/>";
            }
            else{
                echo "<label for='nom'>Nom</label>";
                echo " <input type=text  name=nom id=nom required/>";
            }
            ?>
        </p>

        <p>
            <?php

            if (isset($_POST['prenom']) && $_POST['prenom'] != "") {

                $prenom = $_POST['prenom'];


                //Remettre le prenom dans le champ
                echo "<label for='prenom'>Prenom</label>";
                echo " <input type=text  name=prenom id=prenom value='$prenom' required/>";
            }
            else
            {
                echo "<label for='prenom'>Prenom</label>";
                echo " <input type=text  name=prenom id=prenom required/>";
            }
            ?>
        </p>

        <p>
            <?php

            if (isset($_POST['adresseMail']) && $_POST['adresseMail'] != "") {

                $adresseMail = $_POST['adresseMail'];
                if (UtilisateurRepository::getUtilisateurByAdresseMail($adresseMail) != null) {
                    echo "<label for='mail'>Adresse mail</label>";
                    echo " <input type=email  name=adresseMail id=adresseMail value='$adresseMail' required/>";
                    echo "<p>L'adresse mail est déja utilisé</p>";
                } else {
                    //Remettre le login dans le champ
                    echo "<label for='mail'>Adresse mail</label> ";
                    echo " <input type=email  name=adresseMail id=adresseMail value='$adresseMail' required/>";
                }
            }
            else {
                echo "<label for='mail'>Adresse mail</label>";
                echo " <input type=email  name=adresseMail id=adresseMail required/>";
            }


        ?>
        </p>
        <p>
            <?php

            if (isset($_POST['adresseClient']) && $_POST['adresseClient'] != "") {

                $adresseClient = $_POST['adresseClient'];

                //Remettre le prenom dans le champ
                echo "<label for='prenom'>Adresse Client</label>";
                echo " <input type=text  name=adresseClient id=adresseClient value='$adresseClient' required/>";

            }
            else
            {
                echo "<label for='prenom'>Adresse Client</label>";
                echo " <input type=text  name=adresseClient id=adresseClient required/>";
            }
            ?>
        </p>

        <p>
            <input type="submit" name="inscription" value="Inscription"/>
        </p>
        </div>
        <div>
            <p>
                Vous avez déjà un compte?
            <a href="frontController.php?controller=utilisateur&action=affichePageConnexion">Se connecter</a>
            </p>
        </div>
    </fieldset>

</form>