

<div class="Couverture">
    <img src="img/coverAccueil.jpg" alt="Image d'illustration de vinyle">
    <h1>Vinyl Avenue</h1>
    <h2>tout pour le vinyle</h2>

</div>

<?php

if (!isset($retourConnexion)) {

}
else{
    echo "<p>$retourConnexion</p>";
}
?>
<h3 class="TitreTypeProduit">Nos Vinyles</h3>

<div class="NosVinyles">

    <div class="lesVinyles">

        <div class="VinyleAccueil">
            <img src="img/albums/rumors.jpg" alt="Rumors-Cover-Art">
            <div>Fleetwood Mac</div>
            <div>Rumors</div>
        </div>

        <div class="VinyleAccueil">
            <img src="img/albums/abbeyroad.jpg" alt="abbeyroad-Cover-Art">
            <div>The Beatles</div>
            <div>Abbey Road</div>
        </div>

        <div class="VinyleAccueil">
            <img src="img/albums/londoncalling.jpg" alt="londoncalling-Cover-Art">
            <div>The Clash</div>
            <div>London Calling</div>
        </div>

        <div class="VinyleAccueil">
            <img src="img/albums/nevermind.jpg" alt="Nevermind-Cover-Art">
            <div>Nirvana</div>
            <div>Nevermind</div>
        </div>

    </div>

    <a href="frontController.php?controller=produit&action=affichePageVinyles">Et bien plus...</a>

</div>

<h3 class="TitreTypeProduit">Notre matériel</h3>

<div class="ProduitsVendus">

    <div class="EncadrementProduits">
        <h3>Amplificateurs</h3>
        <img src="img/produits/ampli.jpg" alt="Amplificateur">
        <a href="frontController.php?controller=produit&action=affichePageAmplis">Acheter</a>
    </div>

    <div class="EncadrementProduits">
        <h3>Enceintes</h3>
        <img src="img/produits/enceinte.jpg" alt="enceinte">
        <a href="frontController.php?controller=produit&action=affichePageEnceintes">Acheter</a>
    </div>

    <div class="EncadrementProduits">
        <h3>Platines</h3>
        <img src="img/produits/platine.webp" alt="Platine Vinyle">
        <a href="frontController.php?controller=produit&action=affichePagePlatine">Acheter</a>
    </div>

</div>

<div class="BlackPanel">
    <h4>Vous ne savez pas comment choisir?</h4>

    <h5>Pas de panique ! Chez Vinyl Avenue nous sommes là pour vous aider à vous lancer.</h5>
    <div>
        <div>
            <img src="img/quechoisir.webp" alt="Image d'une chaine hifi">
        </div>
        <div>
            <p>Le disque vinyle est un support de musique emblématique qui est apprécié par de nombreux collectionneurs
                et
                mélomanes pour sa qualité sonore exceptionnelle et son charme vintage. Si vous êtes intéressé par
                l'écoute de
                vinyles, il est important de comprendre comment fonctionne le matériel et les vinyles pour en tirer le
                meilleur
                parti.</p>

            <p> Heureusement, nous avons préparé un guide complet pour vous aider à tout comprendre sur le vinyle. Dans
                ce
                guide, vous découvrirez comment fonctionne le matériel, comment prendre soin de vos disques et comment
                choisir
                les meilleurs vinyles pour votre collection. Nous proposons également différents packs prêts à l'emploi
                adaptés
                à différents budgets et envies de nos clients.</p>

            <p> Pour en savoir plus sur l'écoute de vinyles et découvrir notre sélection de packs prêts à l'emploi,
                rendez-vous
                sur notre page dédiée. Nous espérons que ce guide vous aidera à profiter pleinement de votre collection
                de
                vinyles et à découvrir de nouvelles musiques.</p>
        </div>
    </div>
    <a href="guide.html">En savoir plus</a>
</div>

<h4>Nos packs prêts à l’emploi</h4>

<div class="ParagrapheAccueil">
    <p>N’hésitez pas à choisir un de nos pack afin de vous lancer dans l’écoute des vinyles. Chaque pack correspond à
        une
        personne. Que vous soyez débutant, avancé ou aimez les nouvelles technologies, il y a un pack pour vous.
    </p>
    <p>Chaque pack comprend le matériel annoncé et un vinyle de votre choix.</p>
</div>

<div class="ProduitsVendus">

    <div class="EncadrementProduits">
        <h3>Pack Découverte</h3>
        <img src="img/produits/packdecouverte.jpg" alt="Platine tout en un avec enceinte integree">
        <a href="frontController.php?controller=produit&action=affichePageAmplis">Acheter</a>
    </div>

    <div class="EncadrementProduits">
        <h3>Pack Pro</h3>
        <img src="img/produits/packpro.webp" alt="Pack professionnel platine et enceinte triangle">
        <a href="frontController.php?controller=produit&action=affichePageEnceintes">Acheter</a>
    </div>

    <div class="EncadrementProduits">
        <h3>Pack Connecté</h3>
        <img src="img/produits/packconnecte.jpg" alt="Platine Vinyle avec fonction bluetooth">
        <a href="frontController.php?controller=produit&action=affichePagePlatine">Acheter</a>
    </div>

</div>