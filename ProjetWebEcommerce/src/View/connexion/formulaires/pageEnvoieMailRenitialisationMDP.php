<form method="POST" action="frontController.php?controller=utilisateur&action=envoiMailRenitialisationMDP">
    <img src="img/formpic.jpg" alt="Image d'illustration">
    <fieldset>
        <div>
            <legend>Mot de passe oublié</legend>
            <div class="formSubtitle">
                Récupérez votre mot de passe
            </div>
        </div>
        <div class="Formulaire">
            <p>
                <label for="mail">Votre mail</label>
                <input type="email" name="mailRecuperation" id="mailRecuperation" required/>
            </p>

            <p>
                <input type="submit" name="envoieMail" value="Envoyer"/>
            </p>
        </div>
        <div>
            <p>
                Vous vouliez vous connecter ?
                <a href="frontController.php?controller=utilisateur&action=affichePageConnexion"> Connexion</a>
            </p>
            <p>
                Vous ne faites pas encore partie du groupe?
                <a href="frontController.php?controller=utilisateur&action=affichePageInscription"> Inscription</a>
            </p>
            <p>
            <?php
            if (isset($message)) {
                echo $message;
            }

            ?>
            </p>
        </div>
    </fieldset>

</form>

