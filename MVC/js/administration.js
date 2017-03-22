$(function()
{
	$('[data-toggle="popover"]').popover();
	$('[data-toggle="tooltip"]').tooltip();

	// Liste des produits de la base de données
	var listeProduits = [];

	// Ensemble des produits à mettre dans un menu
	var produitsMenu = [];

	$.post("/get-produits-admin",
	{
		isAjax: true
	},
	function(data, status)
	{
		listeProduits = JSON.parse(data);
	});

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
		produitsMenu = [];
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

			// Si c'est un produit
			if(produit.typeProduit.split('.')[0] !== 'Menu')
			{
				$('#numProduitModif').val(produit.numProduit);
				$('.apercuImage').attr('src', produit.sourceMoyen);
				$('#libelleProduitModif').val(produit.libelle);
				$('#typeProduitModif').val(produit.typeProduit);
				$('#prixProduitModif').val(produit.prix);
				$('#descriptionProduitModif').val(produit.description);
			}
			// Si le produit est un menu
			else
			{
				$('#numMenuModif').val(produit.numProduit);
				$('.apercuImage').attr('src', produit.sourceMoyen);
				$('#libelleMenuModif').val(produit.libelle);
				$('#typeMenuModif').val(produit.typeProduit);
				$('#prixMenuModif').val(produit.prix);
				$('#descriptionMenuModif').val(produit.description);

				// Pour chaque produit du menu (un produit = un select + input Qte + bouton suppression)
				produit.produits.forEach(function(prod, index)
				{
					// On ajoute le div contenant le select, l'input Qte et le bouton de suppression et on le stocke dans un tableau
					produitsMenu[index] = $(
						'<div class="col-lg-12">' +
							'<div class="col-lg-8">' +
								'<div class="form-group">' +
									'<select name="produitMenu' + index + '" class="form-control" required>' +
										// On ajoutera ici tous les produits dans des balises <option>
									'</select>' +
								'</div>' +
							'</div>' +
							'<div class="col-lg-2">' +
								'<div class="form-group">' +
									'<input type="number" name="produitMenuQte' + index + '" min="1" value="1" class="form-control" required>' +
								'</div>' +
							'</div>' +
							'<div class="col-lg-2">' +
								'<button type="button" class="glyphicon glyphicon-remove btn btn-danger"></button>' +
							'</div>' +
						'</div>'
					).appendTo('#produitsModif');

					// Liste des produits à ne pas afficher dans le select
					var blackListProduit = Array.from(produit.produits, x => x.numProduit);
					blackListProduit.splice(index, 1);

					// Ajout des produits dans des balises options
					listeProduits.forEach(function(listeProd)
					{
						// Si le produit est dans la blacklist on ne l'ajoute pas
						if(!blackListProduit.includes(listeProd.numProduit))
						{
							var select = produitsMenu[index].find('select');
							select.append('<option value="' + listeProd.numProduit + '">' + listeProd.numProduit + '-' + listeProd.libelle + '</option>');
							select.val(prod.numProduit);
						}
					});

					var oldValue = produitsMenu[index].find('select').val();
					var oldLibelle = produitsMenu[index].find('select option[value="' + oldValue + '"]').text().split('-')[1];

					produitsMenu[index].find('select').change(function(e)
					{
						var thisSelect = $(this);

						console.log(oldLibelle);

						produitsMenu.forEach(function(div, index)
						{
							//console.log(div.find('select').val());
							//console.log(thisSelect.val());

							// Si le select actuel correspond au select impliqué dans l'événement 'change'
							if(index !== thisSelect.index())
							{
								div.find('select option[value="' + thisSelect.val() + '"]').remove();
								div.find('select').append('<option value="' + oldValue + '">' + oldValue + '-' + oldLibelle + '</option>');
							}
						});
					});

					$('#supprProduitMenu' + index).click(function(e)
					{
						var num = $(this).attr('id').substr(16);

						$('#produit' + num).remove();
					});

					$('#lastNumProduitModif').val(index);
				});
			}
		});
	});


	// Lorsque l'on clique sur le bouton Supprimer produit
	$('.supprProduit').click(function(e)
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

			// Si c'est un produit
			if(produit.typeProduit.split('.')[0] !== 'Menu')
			{
				$('#numProduitSuppr').val(produit.numProduit);

				var form = $('#supprProduit');
				form.find('img').attr('src', produit.sourceMoyen);
				form.find('img').attr('alt', 'Image ' + produit.libelle);
				form.find('.media-heading').text(produit.libelle);
				form.find('.desc-frame p').text(produit.description);
				form.find('.price-frame').text('Prix : ' + produit.prix + ' €');
			}
			else
			{
				$('#numMenuSuppr').val(produit.numProduit);

				var form = $('#supprMenu');
				form.find('.menu-heading').text('Menu "' + produit.libelle + '"');
				form.find('.desc-frame').text(produit.description);
				form.find('.price-frame').text('Prix : ' + produit.prix + ' €');

				form.find('.panel-body.row').empty();

				produit.produits.forEach(function(prod)
				{
					form.find('.panel-body.row').append(
					'<div class="col-md-4">' +
						'<div class="panel panel-default panel-menu-product">' +
							'<div class="panel-heading">' +
								'<p class="text-muted">' + prod.libelle + '</p>' +
							'</div>' +
							'<div class="panel-body">' +
								'<img src="' + prod.sourceMoyen + '" alt="Image ' + prod.libelle + '" class="img-responsive" style="width:80px">' +
							'</div>' +
						'</div>' +
					'</div>');
				});
			}
		});
  	});

	//Lorsque l'on ajoute et modifie un commentaire
	$('#ajoutProduitMenu, #modifProduitMenu').click(function(e)
	{
		var bouton = $(this).attr('id').substr(0, 5);
		bouton = bouton.charAt(0).toUpperCase() + bouton.substr(1);

		var nbProduits = $('#produits' + bouton + ' select:last').length;
		if(nbProduits != 0)
		{
			nbProduits = parseInt($('#produits' + bouton + ' select:last').attr('id').substr(11)) + 1;
		}

		$('#lastNumProduit' + bouton).val(nbProduits);

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


	// Lorsue l'on entre une valeur dans l'input de recherche
	$('#rechercheUser').keyup(function(e)
	{
		var input = $(this);
		var autoCompleteList = $('#autoCompleteList');

		var inputValue = input.val();
		autoCompleteList.empty();

		if(inputValue !== "")
		{
			$.post('/rechercher-pseudo',
			{
				input: inputValue
			},
			function(data)
			{
				//console.log(data);
				listeUser = JSON.parse(data);
				//console.log(listeUser);

				listeUser.forEach(function(user)
				{
					var glyphTypeUser = "";
					if(user.typeUser === "ADMIN")
					{
						glyphTypeUser = "wrench";
					}
					else if(user.typeUser === "USER")
					{
						glyphTypeUser = "user";
					}

					autoCompleteList.append('<li><a href="#adminGererAdmin" data-pseudo="' + user.pseudo + '" data-typeuser="' + user.typeUser + '" data-toggle="modal" class="glyphicon glyphicon-' + glyphTypeUser + '">  ' + user.pseudo + '</a></li>');
				});
			});
		}
	});

	// Ouverture de la fenêtre modale pour l'ajout d'administrateurs
	$('#adminGererAdmin').on('show.bs.modal', function(e)
	{
		var modal = $(this);
		var typeUser = $(e.relatedTarget).data('typeuser').toLowerCase();
		var pseudo = $(e.relatedTarget).data('pseudo');

		modal.find('p').text(pseudo);
		modal.find('#pseudoAdmin').val(pseudo);

		var radio = modal.find('input[value=' + typeUser + ']').attr('checked', 'checked');
	});

	//Ouverture de la fenetre modale pour la modification du commentaire
	$('#adminAvisModif').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget);
		var commentaire = button.data('commentaire');

		var numAvis = button.data('numavis');

		var modal = $(this);
		modal.find('p').text("Commentaire :");
		modal.find('textarea').text(commentaire);
		modal.find('input').val(numAvis);
	});

	//Ouverture de la fenetre modale pour la supression du commentaire
	$('#adminAvisConfirm').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget);
		var commentaire = 'Commentaire : ' + button.data('commentaire');

		var numAvis = button.data('numavis');


		var modal = $(this);

		modal.find('.modalCommentaire').text(commentaire);
		modal.find('input').val(numAvis);
	});

	//Ouverture de la fenetre modale pour l'affichage des signalements
	$('#adminSignalement').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget);
		var numAvis = button.data('numavis');

		var modal = $(this);
		//Appel en Ajax pour recuperer les signalements
		$.post("/get-signalement",
		{
			isAjax: true,
			numAvis:numAvis
		},
		function(data, status)
		{
			var signalements = JSON.parse(data);

			var code = "";

			//Correspond au nombre de signalements
			var nbSignal = 1;
			signalements.forEach(function(signal, index)
			{

				//Si la remarque est differente de null on fais cet affichage
				if(signal.remarque != null)
				{
					var code = "<div class='row'>"+
									"<div class='panel-heading'>"+
									"<p class='text-info'>Signalement n° : "+ nbSignal +"</p>"+
									"</div>"+
									"<div class='panel panel-default'>" +
										"<div class='panel-body text-dark'>"+
											"<p >Signalé par: "+ signal.pseudo +"</p>"+
											"<p>Remarque: "+ signal.remarque +"</p>"+
										"</div>"+
									"</div>"+
								"</div>"
				}
				else {
					var code = "<div class='row'>"+
									"<div class='panel-heading'>"+
									"<p class='text-info'>Signalement n° : "+ nbSignal +"</p>"+
									"</div>"+
									"<div class='panel panel-default'>" +
										"<div class='panel-body text-dark'>"+
											"<p >Signalé par: "+ signal.pseudo +"</p>"+
										"</div>"+
									"</div>"+
								"</div>"
				}
				nbSignal ++;
				modal.find('.modal-body').append(code);
			});

		});



	});

});
