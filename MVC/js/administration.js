$('[data-toggle="popover"]').popover();

$(function()
{
	$('[data-toggle="tooltip"]').tooltip()

	// Lorsqu'on choisi une image dans l'input file
	$('#imageProduitAjout, #imageMenuAjout, #imageProduitModif, #imageMenuModif').change(function (e1)
	{
		var filename = e1.target.files[0];
		var fr = new FileReader();

		fr.onload = function (e2) {
		  	$('.apercuImage').attr('src', e2.target.result);
		};

		fr.readAsDataURL(filename);
	});

	// On efface l'image et on vide les champs quand la fenêtre modale se ferme
	$('#adminProduitAjout, #adminMenuAjout, #adminProduitModif, #adminMenuModif').on('hidden.bs.modal', function(e)
	{
		$(this).find('input, textarea').val('');
		$('.apercuImage').attr('src', '');
		$('#produitsAjout, #produitsModif').empty();
	});


	// Lorsque l'on clique sur le bouton Modifier produit
	$('.modifProduit').click(function(e)
	{
		var numProduit = $(this).data('num-produit');

		$.post("/get-produit-admin",
		{
			numProduitAdmin: numProduit,
			isAjax: true
		},
		function(data, status)
		{
			var produit = JSON.parse(data);

			// Si le produit est un menu
			if(produit.typeProduit.split('.')[0] === 'Menu')
			{
				$('#numMenuModif').val(produit.numProduit);
				$('.apercuImage').attr('src', produit.sourceMoyen);
				$('#libelleMenuModif').val(produit.libelle);
				$('#typeMenuModif').val(produit.typeProduit);
				$('#prixMenuModif').val(produit.prix);
				$('#descriptionMenuModif').val(produit.description);

				// On récupère la liste des produits
				$.post("/get-produits-admin",
				{
					isAjax: true
				},
				function(data, status)
				{
					var listeProduits = JSON.parse(data);

					produit.produits.forEach(function(prod, index)
					{
						$('#produitsModif').append(
							'<div id="produit' + index + '" class="col-lg-12">' +
								'<div class="col-lg-8">' +
									'<div class="form-group">' +
										'<select id="produitMenu' + index + '" name="produitMenu' + index + '" class="form-control" required>' +
											// On ajoutera ici tous les produits dans des balises options
										'</select>' +
									'</div>' +
								'</div>' +
								'<div class="col-lg-2">' +
									'<div class="form-group">' +
										'<input type="number" id="produitMenuQte' + index + '" name="produitMenuQte' + index + '" min="1" value="1" class="form-control" required>' +
									'</div>' +
								'</div>' +
								'<div class="col-lg-2">' +
									'<button type="button" id="supprProduitMenu' + index + '" class="glyphicon glyphicon-remove btn btn-danger"></button>' +
								'</div>' +
							'</div>'
						);

						// Ajout des produits dans des balises options
						listeProduits.forEach(function(listeProd)
						{
							var select = $('#produitMenu' + index);
							select.append('<option value="' + listeProd.numProduit + '">' + listeProd.numProduit + '-' + listeProd.libelle + '</option>');
							select.val(prod.numProduit);
						});

						$('#supprProduitMenu' + index).click(function(e)
						{
							var num = $(this).attr('id').substr(16);

							$('#produit' + num).remove();
						});
					});
				});
			}
			// Si c'est un produit
			else
			{
				$('#numProduitModif').val(produit.numProduit);
				$('.apercuImage').attr('src', produit.sourceMoyen);
				$('#libelleProduitModif').val(produit.libelle);
				$('#typeProduitModif').val(produit.typeProduit);
				$('#prixProduitModif').val(produit.prix);
				$('#descriptionProduitModif').val(produit.description);
			}
		});
	});


	// Lorsque l'on clique sur le bouton Supprimer produit
	$('.supprProduit').click(function(e)
	{
		var numProduit = $(this).data('num-produit');

		$('tbody').html(
			'<tr>' +
			'<th>Libellé</th>' +
			'<th>Description</th>' +
			'<th>Image</th>' +
			'<th>Prix</th>' +
			'<th>Type de produit</th>' +
			'</tr>'
		);

		$.post("/get-produit-admin",
		{
			numProduitAdmin: numProduit,
			isAjax: true
		},
		function(data, status)
		{
			var produit = JSON.parse(data);

			$('#numProduitSuppr').val(produit.numProduit);
			$('tbody').append(
				'<tr>\n' +
				'\t<td>' + produit.libelle + '</td>' +
				'\t<td>' + produit.description + '</td>' +
				'\t<td><img src="' + produit.sourceMoyen + '" alt="image" class="img-responsive"></td>' +
				'\t<td>' + produit.prix + '</td>' +
				'\t<td>' + produit.typeProduit + '</td>' +
				'</tr>'
			);
		});
  	});

	$('#ajoutProduitMenu, #modifProduitMenu').click(function(e)
	{
		var bouton = $(this).attr('id').substr(0, 5);
		bouton = bouton.charAt(0).toUpperCase() + bouton.substr(1);

		var nbProduits = $('#produits' + bouton + ' select:last').length;
		if(nbProduits != 0)
		{
			nbProduits = parseInt($('#produits' + bouton + ' select:last').attr('id').substr(11)) + 1;
		}

		$.post("/get-produits-admin",
		{
			isAjax: true
		},
		function(data, status)
		{
			var produits = JSON.parse(data);

			$('#produits' + bouton).append(
				'<div id="produit' + nbProduits + '" class="col-lg-12">' +
					'<div class="col-lg-8">' +
						'<div class="form-group">' +
							'<select id="produitMenu' + nbProduits + '" name="produitMenu' + nbProduits + '" class="form-control" required>' +
								// On ajoutera ici tous les produits dans des balises options
							'</select>' +
						'</div>' +
					'</div>' +
					'<div class="col-lg-2">' +
						'<div class="form-group">' +
							'<input type="number" id="produitMenuQte' + nbProduits + '" name="produitMenuQte' + nbProduits + '" min="1" value="1" class="form-control" required>' +
						'</div>' +
					'</div>' +
					'<div class="col-lg-2">' +
						'<button type="button" id="supprProduitMenu' + nbProduits + '" class="glyphicon glyphicon-remove btn btn-danger"></button>' +
					'</div>' +
				'</div>'
			);

			// Ajout des produits dans des balises options
			produits.forEach(function(produit)
			{
				$('#produitMenu' + nbProduits).append('<option value="' + produit.numProduit + '">' + produit.numProduit + '-' + produit.libelle + '</option>');
			});

			$('#supprProduitMenu' + nbProduits).click(function(e)
			{
				var num = $(this).attr('id').substr(16);

				$('#produit' + num).remove();
			});
		});
	});
});
