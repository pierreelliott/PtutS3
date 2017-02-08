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
			// Faire une popup pour indiquer que le produit à bien été ajouté
			var fenAlert = $('.alert');
			fenAlert.removeClass('hidden')
			setTimeout(function()
			{
				fenAlert.addClass('hidden');
			}, 2500);
		});
	});

	$('#produitModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var numProduit = button.data('numProduit');
		var libelle = button.data('libelle');
		var sourceImg = button.data('sourceImg');
		var description = button.data('description');
		var prix = button.data('prix');
		var modal = $(this);
		modal.find('.modal-title').text(libelle);
		modal.find('#imgModal').attr('src', sourceImg);
		modal.find('#descriptionProduit').text(description);
		modal.find('#prixProduit').text('Prix : ' + prix + '€');
	});
});
