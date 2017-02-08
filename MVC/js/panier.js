$(function()
{
	$('button').click(function(e) {
		var produit = $(this).data('produit');
		var action = $(this).data('action');
		var qte = $(this).data('qte');
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

			if(infosPanier.panierVide === "1")
			{
				$('.panier').html('Votre panier est vide');
			}

			if(infosPanier.qtePanier === 0)
			{
				$('#' + produit).remove();
			}
			else
			{
				$('#' + produit + ' .qte').text('Quantité : ' + infosPanier.qtePanier);
			}

			$('.prix').text('Prix du panier : ' + infosPanier.prixPanier + '€');

			$('#qtePanier').text(infosPanier.qtePanier);
		});
	});
});
