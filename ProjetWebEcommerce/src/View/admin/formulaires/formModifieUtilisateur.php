<?php

use App\eCommerce\Model\Repository\UtilisateurRepository;
use App\eCommerce\Model\DataObject\Utilisateur;

if(isset($id)){
    //echo $id;
    $utilisateur = UtilisateurRepository::getUtilisateurById($id);
}
//Action du form : modifieUnUtilisateur
?>

<form method="post" action="frontController.php?controller=admin&action=modifieUnUtilisateur">
    <fieldset>
        <legend>Modification d'un utilisateur :</legend>

        <?php
        echo "<input type='hidden' name=id value=$id>";
        ?>

        <p>
            <label for="login">Login</label> :
            <input type="text"  name="login" value="<?php echo $utilisateur->getLoginClient(); ?>" required/>
        </p>

        <p>
            <label for="nom">Nom</label> :
            <input type="text"  name="nom" value="<?php echo $utilisateur->getNomClient(); ?>" required/>
        </p>
        <p>
            <label for="prenom">Prénom</label> :
            <input type="text"  name="prenom" value="<?php echo $utilisateur->getPrenomClient(); ?>" required/>
        </p>
        <p>
            <label for="email">Email</label> :
            <input type="text"  name="email" value="<?php echo $utilisateur->getAdresseMailClient(); ?>" required/>
        </p>


        <p>
            <label for="adresse">Adresse</label> :
            <input type="text"  name="adresse" value="<?php echo $utilisateur->getAdresseClient(); ?>" required/>
        </p>
        <p>
            <label for="codePostal">Code postal</label> :
            <input type="text"  name="solde" value="<?php echo $utilisateur->getSoldeClient(); ?>" required/>
        </p>



        <p>
            <input type="submit" value="Valider" />
        </p>
    </fieldset>
</form>
