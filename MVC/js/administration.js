$(function()
{
	// Lorsqu'on choisi une image dans l'input file
	$('#imageAjout, #imageModif').change(function (e1)
	{
		var filename = e1.target.files[0];
		var fr = new FileReader();

		fr.onload = function (e2) {
		  	$('.apercuImage').attr('src', e2.target.result);
		};

		fr.readAsDataURL(filename);
	});

	// On efface l'image quand la fenêtre modale se ferme
	$('#adminAjout, #adminModif').on('hidden.bs.modal', function(e)
	{
		$(this).find('input, textarea').val('');
		$('.apercuImage').attr('src', '');
	});


	// Lorsque l'on clique sur le bouton Modifier produit
	$('.modifProduit').click(function(e)
	{
		var numProduit = $('.tab-pane.active li.active').find('a').data('numproduit');

		$.post("/get-produit-admin",
		{
			numProduitAdmin: numProduit
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
		var numProduit = $('.tab-pane.active li.active').find('a').data('numproduit');

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
			numProduitAdmin: numProduit
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
});
