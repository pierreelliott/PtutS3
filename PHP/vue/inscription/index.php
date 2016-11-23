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
        <link href="css/index.css" rel="stylesheet">
        <link href="css/connexion.css" rel="stylesheet">



        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
	
    </head>

    <body>
    <!-- NAVBAR -->
	<div class="cover-container">

	<!-- EN TETE AVEC MENU ET IMAGE -->		
            <div id="menu">				
                <div class="dropdown" style="float:right;">
                    <div class="dropbtn">
                        <p><img src="images/burger_menu.png" alt="dropbtn"/></p>
                    </div>

                    <div class="dropdown-content" style="right:0;">				
                        <a href="index.php">Accueil</a>
                        <a href="carte.html">Carte</a>
                        <!--<a href=".html" id="active">Connexion</a>-->
                    </div>
                </div>
            </div>
        </div>
 
        <!-- NAVBAR END -->
        <div class="site-wrapper">
            <div class="site-wrapper-inner">
                <div class="inner cover"> 
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="main">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 <!-- col-sm-offset-1 -->">
                                            <h1>Inscription à Sushinos</h1>

                                            <form action="inscription.php" name="inscription" role="form" class="form-horizontal" method="post" accept-charset="utf-8">
                                                <div class="form-group">
                                                    <div class="col-md-8"><input name="pseudo" type="text" id="pseudo" placeholder="Pseudo"></div>
                                                </div> 

                                                <div class="form-group">
                                                    <div class="col-md-8"><input name="mdp" type="password" id="mdp" placeholder="Mot de passe"></div>
                                                </div> 
                                                
                                                <div class="form-group">
                                                    <div class="col-md-8"><input name="mdpConfirm" type="password" id="mdpConfirm" placeholder="Confirmer mot de passe"></div>
                                                </div> 
                                                
                                                <div class="form-group">
                                                    <div class="col-md-8"><input name="email" type="text" id="email" placeholder="Adresse e-mail"></div>
                                                </div> 

                                                <div class="form-group">
                                                    <div class="col-md-offset-0 col-md-8"><input  class="btn btn-success btn btn-success" type="submit" value="Inscription"/></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>