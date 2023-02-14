<form method="POST" action="frontController.php?controller=panier&action=payeEnCB">

    <fieldset>
        <div>
            <legend>Informations carte</legend>
            <!--<div class="formSubtitle">
            </div>-->
        </div>
        <p>
            <label for="numCarte">Numéro de carte :</label>
           <input type=text  name=numCarte required/>
        </p>

        <p>
            <label for="dateExpi">Date d'expiration :</label>
            <input type="text" name="dateExpi" id="dateExpi" required/>
        </p>

        <p>
            <label for="CVV">CVV :</label>
            <input type="text" name="CVV" id="CVV" required/>
        </p>

        <p>
            <label for="nomCarte">Nom sur la carte :</label>
            <input type="text" name="nomCarte" id="nomCarte" required/>
        </p>

        <p>
            <input type="submit" name="" value="Payer"/>
        </p>
    </fieldset>

</form>