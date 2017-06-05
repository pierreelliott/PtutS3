<!-- Popup d'information succès ajout produit -->
<div class="alert alert-success hidden">
    Produit correctement ajouté !
</div>
<!-- fin popup -->
<div class="row">
    <div class="col-lg-offset-2 col-lg-8 site-wrapper">
        <?php if($rechercheVide) { ?>
            <div class="row">
                <h1>Aucun produit ne correspond à la recherche</h1>
            </div>
            <hr/>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <a class="btn btn-success btn-block" href="/accueil">Revenir à l'accueil</a>
                </div>
            </div>
        <?php } else { ?>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#produits" data-toggle="tab">Nos produits</a></li>
                <li><a href="#menus" data-toggle="tab">Nos menus</a></li>
            </ul>
            <div class="tab-content">
                <!-- Affichage des produits seuls -->
                <div class="tab-pane active" id="produits">
                    <hr class="invisible-separator"/>
                    <?php foreach($produits as $produit) {

                        include("include/affichageProduit.php");

                    } ?>
                    <div class="modal fade" id="produitModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    <h4 class="modal-title">Produit</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <img src="images/sushi.png" alt="Image du produit" id="imgModal" class="img-responsive">
                                        </div>
                                        <div class="col-xs-8">
                                            <p id="descriptionProduit"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <p id="prixProduit" class="text-center"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Affichage des menus -->
                <div class="tab-pane" id="menus">
                    <?php foreach($menus as $menu) {

                        include("include/affichageMenu.php");

                    } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
