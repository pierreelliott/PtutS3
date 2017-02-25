$('[data-toggle="popover"]').popover();

$(function()
{
	$('[data-toggle="tooltip"]').tooltip()

	// Lorsqu'on choisi une image dans l'input file
	$('#imageProduitAjout, #imageMenuAjout, #imageProduitModif').change(function (e1)
	{
		var filename = e1.target.files[0];
		var fr = new FileReader();

		fr.onload = function (e2) {
		  	$('.apercuImage').attr('src', e2.target.result);
		};

		fr.readAsDataURL(filename);
	});

	// On efface l'image quand la fenêtre modale se ferme
	$('#adminProduitAjout, #adminMenuAjout, #adminProduitModif').on('hidden.bs.modal', function(e)
	{
		$(this).find('input, textarea').val('');
		//$(this).find('input[type=number]').val(0);
		$('.apercuImage').attr('src', '');
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
			produit = JSON.parse(data);

			$('#numProduitModif').val(produit.numProduit);
			$('.apercuImage').attr('src', produit.sourceMoyen);
			$('#libelleModif').val(produit.libelle);
			$('#typeProduitModif').val(produit.typeProduit);
			$('#prixModif').val(produit.prix);
			$('#descriptionModif').val(produit.description);
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
			produit = JSON.parse(data);

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

	$('#ajoutProduitMenu').click(function(e)
	{
		var nbProduits = $('.produits select').length;

		$.post("/get-produits-admin",
		{
			isAjax: true
		},
		function(data, status)
		{
			produits = JSON.parse(data);

			$('.produits').append(
				'<div class="col-lg-12">' +
					'<div class="col-lg-8">' +
						'<div class="form-group">' +
							'<select id="produitMenu' + nbProduits + '" name="produitsMenu' + nbProduits + '" class="form-control" required>' +
							'</select>' +
						'</div>' +
					'</div>' +
					'<div class="col-lg-2">' +
						'<div class="form-group">' +
							'<input type="number" id="produitMenuQte' + nbProduits + '" name="produitsMenuQte' + nbProduits + '" min="1" value="1" class="form-control" required>' +
						'</div>' +
					'</div>' +
					'<div class="col-lg-2">' +
						'<button type="button" class="glyphicon glyphicon-remove btn btn-danger supprProduitMenu" data-num="' + nbProduits + '"></button>' +
					'</div>' +
				'</div>'
			);

			produits.forEach(function(produit)
			{
				$('#produitMenu' + nbProduits).append('<option value="' + produit.numProduit + '">' + produit.numProduit + '-' + produit.libelle + '</option>');
			});
		});
	});
});
