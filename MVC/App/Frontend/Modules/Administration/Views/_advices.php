<?php foreach($tousAvis as $avis) : ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span data-toggle="tooltip" data-placement="top" title="Supprimer Commentaire">
    			<button type="button" class="glyphicon glyphicon-remove btn btn-danger btn-admin adminNumAvis"
                data-toggle="modal" data-target="#adminAvisConfirm" data-numavis="<?= $avis['numuser'] ?>" data-commentaire="<?= $avis['avis'] ?>" ></button>
    		</span>
            <span data-toggle="tooltip" data-placement="top" title="Modifier Commentaire">
    			<button type="button" class="glyphicon glyphicon-pencil btn btn-primary btn-admin"
                data-toggle="modal" data-target="#adminAvisModif" data-numavis="<?= $avis['numuser'] ?>" data-commentaire="<?= $avis['avis'] ?>" ></button>
    		</span>
            <span data-toggle="tooltip" data-placement="top" title="Voir les signalements">
               <button type="button" class="glyphicon glyphicon-eye-open btn btn-primary btn-admin"
               data-toggle="modal" data-target="#adminSignalement" data-numavis="<?= $avis['numuser'] ?>" ></button>
           </span>
        </div>
        <div class="panel-body">
            <div class="media">
                <div class="media-left media-top">
                    <img src="images/user.png" alt="Avatar" class="media-object img-circle" style="width:80px">
                </div>
                <div class="media-body">
                    <p class="text-left text-primary italic"><?= $avis['pseudo'] ?></p>
                    <p class="text-left text-muted small italic"> - Posté le <?= $avis['date'] ?></p>
                </div>
            </div>
            <hr class="invisible-separator border-top"/>
            <p class="text-left padding-left">
                <?php for($i = 0; $i < $avis['note']/2; $i++) :
                    echo '<span class="glyphicon glyphicon-star'.($i < $avis['note']/2 ? '' : '-empty').' yellow"></span>';
                endfor; ?>
            </p>
            <?php if($avis['estCommente'] == 1) { ?>
                <p class="text-dark text-left padding-left">Commentaire: <?= $avis['avis'] ?></p>
            <?php } ?>
            <hr class="invisible-separator border-top"/>
        </div>
    </div>
<?php endforeach; ?>
