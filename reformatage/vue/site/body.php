<?php

	function afficherBody($corpsDePage)
	{
		echo '<body>
        <div class="container-fluid">';
		
		include("header.php");
		
		if(isset($corpsDePage))
		{
			switch($corpsDePage)
			{
				case "panier":
					afficherPanier();
					break;
				case "inscription":
					afficherPageInscription();
					break;
				case "connexion":
					afficherPageConnexion();
					break;
				case "deconnexion":
					afficherPageDeconnexion();
					break;
				case "carte":
					afficherCarte();
					break;
			}
		}
		else
		{
			echo '<div class="row">
                <div class="col-lg-offset-3 col-lg-6 site-wrapper">
                    <div class="col-lg-12">
                        <div class="row">
                            <h1 class="col-lg-offset-2 col-lg-8">Bienvenue chez Sushinos !</h1>
                        </div>
                        <div class="row">
                            <p class="lead">Tous nos produits sont 100% naturels, composés avec les meilleurs ingrédients. Nous vous offrons une large gamme de produits, menus, desserts.</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-offset-4 col-lg-4">
                                <a href="carte.php" class="btn btn-lg btn-default">Découvrir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
		}
		
		include("include/footer.php");
		
		echo '</div>';
		
		include("bootstrapJavascript.php");
		
		echo '</body>';
	}