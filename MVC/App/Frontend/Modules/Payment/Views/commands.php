<div class="row">
	<div class="col-lg-offset-3 col-lg-6 site-wrapper">
		<?php if($estVide) { ?>
			<div class="row">
				<h1>Vous n'avez pas encore commandé</h1>
			</div>
			<hr/>
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<a class="btn btn-success btn-block" href="/menu"><h2>Commander !</h2></a>
				</div>
			</div>
		<?php } else { ?>
    		<div class="row">
    			<?php foreach($commandes as $commande) { ?>
    				<div class="panel panel-default">
    					<div class="panel-heading texte-commande">
    						<h1>Commande du <?= $commande['date'] ?></h1>
    					</div>
    					<div class="panel-body text-dark">
    						<p class="lead">Nombre de produits : <?= $commande["nbProduits"] ?></p>
    						<p class="lead">Prix de la commande : <?= $commande["prix"] ?> &euro;</p>
                            <p class="lead">Type de la commande : <?= $commande["typeCommande"] ?></p>
                            <p class="lead">
                                <?= '<a class="text-primary" href="/commande-'.$commande['numCommande'].'"> Afficher la commande</a>' ?>
                            </p>
    					</div>
    				</div>
                <?php } ?>
            </div>
    	<?php } ?>
	</div>
</div>
