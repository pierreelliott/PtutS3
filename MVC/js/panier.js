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

			//var panierVide = $(data).find('.panier').data('estVide');
			console.log('estVide : ' + infosPanier.panierVide);
			if(infosPanier.panierVide === "1")
			{
				$('.panier').text('Votre panier est vide');
			}

			//var qte = $(data).find('#' + produit + ' .qte').text();
			//var prix = $(data).find('.prix').text();
			console.log('qte : ' + infosPanier.qte);
			console.log('prix : ' + infosPanier.prix);
			if(infosPanier.qte === "")
			{
				$('#' + produit).remove();
			}
			else
			{
				$('#' + produit + ' .qte').text(infosPanier.qte);
			}

			$('.prix').text(infosPanier.prix);
		});
	});
});
