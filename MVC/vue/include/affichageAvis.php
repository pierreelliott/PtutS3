<div class="panel panel-default">

	<?php if(isset($admin) && $admin == true) { ?>
		<div class="panel-heading">
	        <span data-toggle="tooltip" data-placement="top" title="Supprimer Commentaire">
				<button type="button" class="glyphicon glyphicon-remove btn btn-danger btn-admin" data-toggle="modal" data-target="" ></button>
			</span>
	        <span data-toggle="tooltip" data-placement="top" title="Modifier Commentaire">
				<button type="button" class="glyphicon glyphicon-pencil btn btn-primary btn-admin" data-toggle="modal" data-target="" data-num-produit=""></button>
			</span>
	    </div>
	<?php } ?>

	<div class="panel-body">
		<div class="media">
			<div class="media-left media-top">
				<img src="images/user.png" alt="Avatar" class="media-object img-circle" style="width:80px">
			</div>
			<div class="media-body">
				<p class="text-left text-primary italic"><?php echo $avis['pseudo']; ?></p>
				<p class="text-left text-muted small italic"> - Posté le <?php echo $avis['date']; ?></p>
			</div>
		</div>
		<hr class="invisible-separator border-top"/>
		<p class="text-left padding-left">
			<?php
			for($i = 0; $i < $avis['note']/2; $i++)
			{
				echo "<span class='glyphicon glyphicon-star yellow'></span>";
			}
			for (; $i < 5 ; $i++) {
				echo "<span class='glyphicon glyphicon-star-empty yellow'></span>";
			}
			 ?></p>


		<?php if($avis["estCommente"] == 1) { // Si il y a un commentaire
		 ?>
		<p class="text-dark text-left padding-left">Commentaire: <?php echo $avis['avis']; ?></p>

		<?php if(!isset($admin) || (isset($admin) && $admin == false)) { ?>

		<hr class="invisible-separator border-top"/>
		<div class="row">
			<?php  //Si l'utilisateur est connecté
			if(!isset($message))
			{ ?>
				<div class="col-sm-1">
					<!-- Lien vers la fenetre modale !-->
					<a href='#signalModal'
						data-toggle='modal'
						data-num-avis="<?php echo $avis["numuser"]; ?>"
						data-pseudo="<?php echo $avis["pseudo"]; ?>"
						data-commentaire-avis="<?php echo $avis['avis']; ?>">
						<img src="images/signaler.png" alt="Signaler l'avis" class="img-responsive"/>
					</a>
				</div>
			<?php } ?>
			<div class="col-sm-offset-8 col-sm-1">
				<a class="btn-primary btn" <?php echo "href='/vote-1-{$avis['numuser']}'"; ?>>
					<span class="glyphicon glyphicon-thumbs-up"></span>
					<span class="badge"><?php echo $avis["pouceBleu"]; ?></span>
				</a>
			</div>
			<div class="col-sm-1">
				<a class="btn-danger btn" <?php echo "href='/vote-0-{$avis['numuser']}'"; ?>>
					<span class="glyphicon glyphicon-thumbs-down"></span>
					<span class="badge"><?php echo $avis["pouceRouge"]; ?></span>
				</a>
			</div>
		</div>
		<?php
			}
		} ?>
	</div>
</div>
