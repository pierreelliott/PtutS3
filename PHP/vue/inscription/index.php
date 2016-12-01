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
        <div class="container-fluid">

            <?php include("include/header.php"); ?>
                   
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 site-wrapper">
                    <div class="row">
                        <form action="inscription.php" method="post" name="inscription" accept-charset="utf-8">
                            <fieldset>
                                <legend>Inscription à Sushinos</legend>
                                <span class="help-block lead">Les champs avec * sont obligatoires</span>
                                <div class="form-group has-error">
                                    <?php if(isset($message)) echo "<span class='help-block'>".$message."</span>"; ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="pseudo" class="control-label">Pseudo *</label>
                                            <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="mdp" class="control-label">Mot de passe *</label>
                                            <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="mdpConfirm" class="control-label">Confirmer mot de passe *</label>
                                            <input type="password" id="mdpConfirm" name="mdpConfirm" placeholder="Confirmer mot de passe" class="form-control"/>
                                        </div>
                                    </div>                                 
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nom" class="control-label">Nom *</label>
                                            <input type="text" id="nom" name="nom" placeholder="Nom" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="prenom" class="control-label">Prénom *</label>
                                            <input type="text" id="prenom" name="prenom" placeholder="Prénom" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email" class="control-label">Adresse mail *</label>
                                            <input type="text" id="email" name="email" placeholder="Adresse e-mail" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="tel" class="control-label">Téléphone</label>
                                            <input type="text" id="tel" name="tel" placeholder="Téléphone" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="numRue" class="control-label">N°rue</label>
                                            <input type="text" id="numRue" name="numRue" placeholder="N°rue" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="rue" class="control-label">Rue</label>
                                            <input type="text" id="rue" name="rue" placeholder="Nom de rue" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="ville" class="control-label">Ville</label>
                                            <input type="text" id="ville" name="ville" placeholder="Ville" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="codePostal" class="control-label">Code postal</label>
                                            <input type="text" id="codePostal" name="codePostal" placeholder="Code postal" class="form-control"/>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-lg-offset-8 col-lg-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn btn-success pull-right">Inscription</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            
            <?php include("include/footer.php"); ?>
            
        </div>
    </body>
</html>