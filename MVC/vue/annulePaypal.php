<?php
    $title = "Paiement annulé";

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->

    <div class='row'>
            <div class='col-lg-offset-3 col-lg-6 site-wrapper'>
                    <h1>Paiement annulé</h1>
                    <p>Le paiement a été annulé. En espérant que vous changerez d'avis, nous vous adressons nos salutations les plus sincères.</p>
            </div>
    </div>

<!-- ======== Fin Code HTML ======== -->
<?php
    /*********************************************/
    /* Faire la requête pour annuler la commande */
    /*********************************************/

    $contenu = ob_get_clean();

    require("layout/site.php");
?>