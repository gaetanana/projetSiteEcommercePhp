<form method="post" action="frontController.php?controller=utilisateur&action=connexion">
    <img src="img/formpic.jpg" alt="Image d'illustration">

    <fieldset>
        <div class="TitreSousTitre">
            <?php
            if(isset($messageDoitEtreConnecte)){
                echo "<p>$messageDoitEtreConnecte</p>";
            }
            ?>
        <legend>Se connecter</legend>
        <div class="formSubtitle">
            A votre compte Vinyl Avenue
        </div>
        </div>
        <div class="Formulaire">
        <p>
            <label for="login">Login</label>
            <input type="text" placeholder="" name="login" id="login" required/>
        </p>
        <p>
            <label for="marque">Password</label>
            <input type="password" name="password" id="password" required/>
        </p>


        <p>
            <input type="submit" name="connexion" value="Connexion"/>
        </p>
        </div>
        <div class="texteEnBas">
            <?php

            use App\eCommerce\Model\Repository\UtilisateurRepository;

            if(isset($retourChangementMDPRenitialisation)){
                if($retourChangementMDPRenitialisation == true){
                    echo "<p>Mot de passe changé</p>";
                }else{
                    echo "<p>Mot de passe non changé</p>";
                }
            }

            $bool = UtilisateurRepository::confirmationMail();

            if ($bool) {
                echo "<p>Votre compte a bien été créé, vous pouvez vous connecter</p>";
            }


            ?>
        <p>
            Vous avez oublié votre mot de passe?
            <a href="frontController.php?controller=utilisateur&action=affichePageMailMDP"> Mot de passe oublié</a>
        </p>

        <p>
            Vous ne faites pas encore partie du groupe?
        <a href="frontController.php?controller=utilisateur&action=affichePageInscription"> Inscription</a>
        </p>
        </div>

    </fieldset>
</form>


