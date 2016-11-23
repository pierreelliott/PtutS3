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
        <!--<link href="css/connexion.css" rel="stylesheet">-->



        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
	
    </head>

    <body>
	<div class="container">

	<?php include("include/header.php"); ?>
                   
        <div class="row">
            <div class="col-lg-offset-2 col-lg-8">
                <div class="col-lg-12 site-wrapper">
                    <div class="row">
                        <h1 class="col-lg-offset-2 col-lg-8">Connexion à Sushinos</h1>
                    </div>
                    
                    <div class="row">
                        <form action="connexion.php" method="post" name="login" role="form" accept-charset="utf-8">
                            <div class="row">
                                <div class="form-group has-error">
                                    <?php if(isset($message)) echo "<span class='help-block'>".$message."</span>"; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo ou Adresse mail" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn btn-success">Connexion</button>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <p>Pas encore inscrit ? Inscription par <a href="inscription.php">ici !</a></p>
                    </div>
                </div>
            </div>
        </div>
            
        <?php include("include/footer.php"); ?>
            
        </div>
    </body>
</html>