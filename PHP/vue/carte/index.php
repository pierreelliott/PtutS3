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
        <div class="container">
            
            <?php include("include/header.php"); ?>

            <div class="cover-container">
                <div class="site-wrapper">
                    <div class="site-wrapper-inner">
                        <div class="inner cover">
                            <table class='table table-bordered'>
                                <?php
                                    echo "<tr>
                                            <th>Produit</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Ajout panier</th>
                                          </tr>";
                                    foreach($tabRows as $key => $row)
                                    {
                                        echo "<tr>
                                                  <td>".$row["libelle"]."</td>
                                                  <td>".$row["description"]."</td>
                                                  <td><img src=".$row["sourceMoyen"]." alt='Image du produit'></td>
                                                  <td><a href='index.php'><img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'></a></td>
                                              </tr>";
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include("include/footer.php"); ?>
            
        </div>
    </body>
</html>