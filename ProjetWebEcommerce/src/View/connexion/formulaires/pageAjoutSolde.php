
<form method="POST" action="frontController.php?controller=utilisateur&action=ajouteSoldeCompte">

    <fieldset>
        <div>
            <legend>Ajouter du solde à votre compte</legend>
            <div class="formSubtitle">

            </div>
        </div>
        <p>
            <label for="password">Montant en €</label>
            <input type="number"  name="montantSolde" id="montantSolde" min="1" max = "100" required/>
        </p>

        <p>
            <input type="submit" name = "" value="Ajouter"/>
        </p>
    </fieldset>

</form>