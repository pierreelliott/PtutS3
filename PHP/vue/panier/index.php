<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.5">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="sushis en ligne restauration rapide emporter livraison">
        <meta name="author" content="PIETRAC Nicolas - Mathis SLIMANI - PE Thiboud - Axel BERTRAND - Thomas BROUBROU">
        <link rel="icon" href="images/logo_onglet.png">

        <title>Sushinos - Sushis en ligne</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- For "index", Mathis you have to create another css for the rest of the website -->
        <link href="css/style.css" rel="stylesheet">


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
        <div class="container-fluid">
            
            <?php include("include/header.php"); ?>
            
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 site-wrapper">
                    <table class="table table-hover"> 
                        <tbody>
                            <tr> 
                                <th>Produit</th> 
                                <th>Quantité</th> 
                                <th>Prix unitaire (€)</th>
                                <th>Prix total (€)</th>
                                <th>Retirer du panier</th>
                            </tr>
                            <?php
                                $sommeMontantTotal = 0;
                                $montantTotalProduit = 0;
                                $sommeQuantite = 0;
                                foreach($_SESSION["panier"] as $key => $produit)
                                {
                                    $sommeQuantite += $produit["quantite"];
                                    $montantTotalProduit = $produit["quantite"] * $produit["prix"];
                                    $sommeMontantTotal += $montantTotalProduit;
                            ?>
                            <tr>
                                <td><?php echo $produit["libelle"]; ?></td>
                                <td><?php echo $produit["quantite"]; ?></td>
                                <td><?php echo $produit["prix"]; ?></td>
                                <td><?php echo  $montantTotalProduit; ?></td>
                                <td><a href='<?php echo 'panier.php?action=suppression&produit='.$key.','.implode(',', $produit); ?>'><img src="images/mooins2.png" alt="Retirer du panier" title="Retirer du panier"/></a></td>
                            </tr>
                            <?php
                                }
                            ?>
                            <tr>
                                <td>Total</td>
                                <td><?php echo $sommeQuantite; ?></td>
                                <td></td>
                                <td><?php echo $sommeMontantTotal; ?></td>
                                <td></td>
                            </tr>
                        </tbody> 
                    </table> 
                </div>
            </div>
            
            
            <?php include("include/footer.php"); ?>
            
        </div>

                

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>');</script>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>