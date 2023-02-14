
<form method="POST" action="frontController.php?controller=utilisateur&action=changeMotDePasse">

    <fieldset>
        <div>
            <legend>Changer de mot de passe</legend>
            <div class="formSubtitle">

            </div>
        </div>

        <p>
            <label for="password">Ancien mot de passe</label>
            <input type="password"  name="ancienPassword" id="password" required/>
        </p>

        <p>
            <label for="password">Nouveau mot de passe</label>
            <input type="password"  name="nouveauMotDePasse" id="passwordVerif" required/>
        </p>

        <p>
            <label for="password">Vérif nouveau mot de passe</label>
            <input type="password"  name="verifNouveauMotDePasse" id="passwordVerif" required/>
        </p>

        <p>
            <input type="submit" name = "inscription" value="Changer"/>
        </p>
    </fieldset>

</form>