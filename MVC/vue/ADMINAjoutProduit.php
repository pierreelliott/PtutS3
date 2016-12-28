<?php

	$title = "";

	echo '<div class="row">
                <div class="col-lg-offset-3 col-lg-6 site-wrapper">
                    <form method="post" action="administration.php?action=ajout" name="ajoutProduit" accept-charset="utf-8">
                        <fieldset>
                            <legend>Ajouter un produit</legend>
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
                                        <button type="submit" class="btn btn-success btn btn-success">Ajouter à la base de données <span class="glyphicon glyphicon-ok"></span></button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>';

	$contenu = ob_get_contents();
	ob_end_clean();

	require("layout/site.php");
?>
