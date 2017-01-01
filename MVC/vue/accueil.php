<?php
	$title = "Accueil - Sushinos";
	
	ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
        <div class="col-md-2 hidden-sm hidden-xs">
            <div class="row">
                <aside class="col-md-12">
                    Aside
                </aside>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="row">
                <div class="col-md-12 hidden-sm hidden-xs">
                    <div id="carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel" data-slide-to="1"></li>
                            <li data-target="#carousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner thumbnail">
                            <div class="item active"><img src="images/fond_index.jpg" alt=""></div>
                            <div class="item"><img src="images/fond_index.jpg" alt=""></div>
                            <div class="item"><img src="images/fond_index.jpg" alt=""></div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="site-wrapper">
                        <div class="row">
                            <h1 class="col-md-offset-2 col-md-8">Bienvenue chez Sushinos !</h1>
                        </div>
                        <div class="row">
                            <p class="lead">Tous nos produits sont 100% naturels, composés avec les meilleurs ingrédients. Nous vous offrons une large gamme de produits, menus, desserts.</p>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-4 col-md-4">
                                <a href="index.php?page=carte" class="btn btn-md btn-default">Découvrir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
        </div>
        <div class="col-md-2 hidden-sm hidden-xs">
            <div class="row">
                <aside class="col-md-12">
                    Aside
                </aside>
            </div>
        </div>
    </div>
	
<!-- ======== Fin Code HTML ======== -->
<?php
	$contenu = ob_get_clean();
	
	require("layout/site.php");
?>