<h3>Liste des Utilisateurs</h3>
<table>
    <thead>
    <tr>
        <th colspan="5">Utilisateurs</th>
    </tr>
    </thead>
    <tbody>
    <tr class="firstRow">
        <td>login</td>
        <td>statut</td>
        <td>modification</td>
        <td>modifier le statut</td>
        <td>suppression</td>
    </tr>
<?php
$boolStatutAJour = false;


//Si ce n'est pas un fondateur ni un admin, on redirige vers la page d'accueil
if ($_SESSION['status'] != "fondateur" && $_SESSION['status'] != "admin") {
    header('Location: frontController.php?controller=produit&action=affichePageAcceuil');
}

use App\eCommerce\Controller\ControllerAdmin;
use App\eCommerce\Model\Repository\UtilisateurRepository;


$listeUtilisateurs = UtilisateurRepository::getUtilisateurs();
//  echo '<script>window.location.reload();</script>';

foreach ($listeUtilisateurs as $utilisateur) {



    $idClient = $utilisateur->getIdClient();
    $loginClient = $utilisateur->getLoginClient();
    $statusClient = UtilisateurRepository::getStatusClient($idClient);


    //Ici le fondateur peut mettre un utilisateur en admin
    if ($_SESSION['status'] == "fondateur") {
        if ($statusClient == "fondateur") {
            echo "<tr>
        <td>$loginClient</td>
        <td>$statusClient</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
";

        }
        if ($statusClient != "fondateur") {

            echo "    
    <tr>
        <td>$loginClient</td>
        <td>$statusClient</td>
        <td><a href='frontController.php?controller=admin&action=afficheFormModifUtilisateur&id=$idClient'>Modifier</a></td>
        <td>
            <form method='POST'>
                <input type='hidden' name='idClient' value='$idClient'>
                <select name='changementStatus'>
                    <option value=''>---</option>
                    <option value='client'>Client</option>
                    <option value='admin'>Admin</option>
                </select>
                <input type='submit' value='Valider'>
            </form>";

            if (isset($_POST['changementStatus']) && $_POST['changementStatus'] != '' && $_POST['idClient'] == $idClient) {
                if ($_POST['changementStatus'] == 'admin') {
                    UtilisateurRepository::mettreAdmin($idClient);
                    $boolStatutAJour = true;

                    //On peut refresh la page avec la ligne juste en dessous mais c'est plus lent que la deuxième solution
                    //echo "<meta http-equiv='refresh' content='1;URL=frontController.php?controller=admin&action=afficheListeUtilisateur'>";

                    //Pour refresh la page :
                    echo "<script type='text/javascript'>document.location.replace('frontController.php?controller=admin&action=afficheListeUtilisateur');</script>";

                } else if ($_POST['changementStatus'] == 'client') {
                    UtilisateurRepository::mettreClient($idClient);
                    $boolStatutAJour = true;
                    echo "<script type='text/javascript'>document.location.replace('frontController.php?controller=admin&action=afficheListeUtilisateur');</script>";

                    //echo "<meta http-equiv='refresh' content='1;URL=frontController.php?controller=admin&action=afficheListeUtilisateur'>";

                }

            }

            echo "     
        </td>
        <td><a href='frontController.php?controller=admin&action=supprimeUnUtilisateur&id=$idClient'>Supprimer</a></td>
    </tr>";


        } else if ($_SESSION['status'] == "admin") {
            echo $utilisateur->getLoginClient() . "   " . "   Client" . "<a href='frontController.php?controller=admin&action=supprimeUnUtilisateur&id=
      $idClient'>Supprimer</a>";
        }


    }
}

if (isset($messageModif)) {
    echo $messageModif;
}
echo "</tbody> </table>";
//Affiche le status de l'utilisateur

echo "<p> Vous êtes connecté en tant que " . $_SESSION['status'] . "</p>";


?>