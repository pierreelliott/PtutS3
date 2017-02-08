$(function()
{
	$('button').click(function(e) {
		var produit = $(this).data('produit');
		var action = $(this).data('action');
		var qte = $(this).data('qte');
		$.post('/panier',
		{
			action: action,
			produit: produit,
			qte: qte
		},
		function(data, status)
		{
			var panierVide = $(data).find('.panier').data('estVide');
			console.log('estVide : ' + panierVide);
			if(panierVide === "1")
			{
				$('.panier').text('Votre panier est vide');
			}

			var qte = $(data).find('#' + produit + ' .qte').text();
			var prix = $(data).find('.prix').text();
			console.log('qte : ' + qte);
			console.log('prix : ' + prix);
			if(qte === "")
			{
				$('#' + produit).remove();
			}
			else
			{
				$('#' + produit + ' .qte').text(qte);
			}

			$('.prix').text(prix);
		});
	});
});
