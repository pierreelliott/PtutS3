<?php
    $title = "Commande validée";

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->

    <div class='row'>
            <div class='col-lg-offset-3 col-lg-6 site-wrapper'>
                    <h1>Commande Validée</h1>
                    <p>Félicitation le paiement a été validé votre commande est en cours de traitement</p>
            </div>
    </div>

<!-- ======== Fin Code HTML ======== -->
<?php
    $contenu = ob_get_clean();

    require("layout/site.php");
?>
