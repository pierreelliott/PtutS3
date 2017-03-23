$(function()
{
	$('button').click(function(e) {
		var produit = $(this).data('produit');
		var action = $(this).data('action');
		var qte = $(this).data('qte');
		var parentDiv = $(this).parents("div#"+ produit);
		$.post('/get-infos-panier',
		{
			action: action,
			produit: produit,
			qte: qte,
			isAjax: true
		},
		function(data, status)
		{
			console.log(data);
			infosPanier = JSON.parse(data);

			if(infosPanier.panierVide === 1)
			{
				$('.panier').html(
					'<div class="row">' +
						'<h1>Votre panier est vide</h1>' +
					'</div>' +
					'<hr/>' +
					'<div class="row">' +
						'<div class="col-lg-6 col-lg-offset-3">' +
							'<a class="btn btn-success btn-block" href="/carte"><h2>Commander quelque chose !</h2></a>' +
						'</div>' +
					'</div>'
				);
			}
			var qteProduit = parseInt(parentDiv.find(".qte").text().substr(11), 10);
			if(qteProduit === 0)
			{
				$('#' + produit).remove();
			}
			else
			{
				$('#' + produit + ' .qte').text('Quantité : ' + (qteProduit+qte));
				parentDiv.find('.prixNow').text( (qteProduit+qte) * infosPanier.prixProduit+ ' €')
			}

			$('.prix').text('Prix du panier : ' + infosPanier.prixPanier + ' €');

			$('#qtePanier').text(infosPanier.qtePanier);
		});
	});
});
