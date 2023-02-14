<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../web/css/navCss.css">
    <link rel="stylesheet" href="../web/css/bodyCss.css">
    <link rel="stylesheet" href="../web/css/formCss.css">
    <link rel="stylesheet" href="../web/css/adminCss.css">
    <link rel="stylesheet" href="../web/css/footerCss.css">
    <link rel="stylesheet" href="../web/css/produitCss.css">
    <link rel="stylesheet" href="../web/css/listeProduitsCss.css">
    <link rel="stylesheet" href="../web/css/tableCss.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pacifico|Montserrat:semibold,400|Lobster">
    <link rel="icon" href="img/favicon.png">

    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>
</head>
<body>
<header>


    <?php require __DIR__ . "/{$cheminVueNav}"; ?>


</header>
<main>
    <?php

    require __DIR__ . "/{$cheminVueBody}";
    ?>
</main>
<footer>
    <div>
        <a id="acceuil" href="frontController.php?controller=produit&action=affichePageAcceuil">Vinyl Avenue</a>
    </div>
    <div class="footerCopyrights">
        <p>©2023 - Vinyl Avenue</p>
        <p>Proudly created thanks to all IUT Montpellier-Sète teachers.</p>
    </div>
    <div>
        <a class="top" href="#">↑</a>
    </div>
</footer>
</body>
</html>