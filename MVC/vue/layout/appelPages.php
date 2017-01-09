<!-- Formulaires 'invisibles' pour l'appel des pages -->

<script>
		function go(page)
		{
				switch(page)
				{
					case "connexion":
						document.getElementById("connexion").submit();
						break;
					case "avis":
						document.getElementById("avis").submit();
						break;
					case "deconnexion":
						document.getElementById("deconnexion").submit();
						break;
					case "contact":
						document.getElementById("contact").submit();
						break;
					case "inscription":
						document.getElementById("inscription").submit();
						break;
					case "panier":
						document.getElementById("panier").submit();
						break;
					case "utilisateur":
						document.getElementById("utilisateur").submit();
						break;
					case "accueil":
						document.getElementById("accueil").submit();
						break;
					case "carte":
						document.getElementById("carte").submit();
						break;
					case "administration":
						document.getElementById("ADMINAjoutProduit").submit();
						break;
					default:
						document.getElementById("404").submit();
				}
		}
</script>
<div class="hidden">
	<?php
			// Liste des pages
			$pages = [
				"avis",
				"connexion",
				"deconnexion",
				"contact",
				"inscription",
				"carte",
				"panier",
				"utilisateur",
				"404",
				"accueil",
				"administration"
			];

			// On crée les formulaires cachés
			foreach($pages as $page)
			{
				echo "<form type='hidden' id='".$page."' method='post' action='index.php'>\n".
				"<input type='hidden' name='page' value='".$page."'>\n".
				"</form>\n\n";
			}
	?>
</div>
