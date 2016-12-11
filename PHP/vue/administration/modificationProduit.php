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
                    <form method="post" action="administration.php?action=modification" name="ajoutProduit" accept-charset="utf-8">
                        <fieldset>
                            <legend>Modifier un produit</legend>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <img src="images/achat.png">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="image" class="control-label"></label>
                                                <input type="file" id="image" name="image">
                                            </div>   
                                        </div>
                                    </div>         
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="libelle" class="control-label">Libellé :</label>
                                                <input type="text" id="libelle" name="libelle" placeholder="Libellé" class="form-control" autofocus>
                                            </div>    
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="typeProduit" class="control-label">Type de produit :</label>
                                                <select id="typeProduit" class="form-control">
                                                    <option>Sushi</option>
                                                    <option>Maki</option>
                                                    <option>...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="prix" class="control-label">Prix :</label>
                                                <input type="number" id="prix" name="prix" class="form-control">
                                            </div>
                                        </div>
                                    </div>      
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="description" class="control-label">Description</label>
                                        <textarea type="textarea" class="form-control">Ecrivez une courte decription du produit</textarea>
                                    </div>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-offset-4 col-lg-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn btn-success">Modifier le produit</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset> 
                    </form>
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