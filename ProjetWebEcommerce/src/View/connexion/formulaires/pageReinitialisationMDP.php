
<form method="POST" action="frontController.php?controller=utilisateur&action=renitialiseMotDePasse">

    <fieldset>
        <div>
            <legend>Réinitialisez votre mot de passe</legend>
            <div class="formSubtitle">
                les oublis ça arrive à tout le monde
            </div>
        </div>
        <p>
            <label for="login">Login</label>
            <?php
            $login = $_GET['login'];
            echo "<input type=text  name=login id=login value='$login' readonly/>";
            ?>


        </p>

        <p>
            <label for="password">Nouveau mot de passe</label>
            <input type="password"  name="nouveauMotDePasse" id="passwordVerif" required/>
        </p>

        <p>
            <label for="password">Vérification nouveau mot de passe</label>
            <input type="password"  name="verifNouveauMotDePasse" id="passwordVerif" required/>
        </p>


        <p>
            <input type="submit" name = "inscription" value="Changer"/>
        </p>
    </fieldset>

</form>

<?php
//Ce code ne sert à rien, il est juste à titre informatif pour vous montrer comment on peut récupérer des données d'une page à une autre
$login = $_GET['login'];
$key = $_GET['key'];

//echo "<p>login : $login</p>";
?>