<!-- Formulaires 'invisibles' pour l'appel des pages -->

<script>
		function go(page)
		{
				switch(page)
				{
					case "connexion":
						document.getElementById("connexion").submit();
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
				"connexion",
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
<!--
<form type="hidden" id="connexion" method="post" action="index.php">
<input type="hidden" name="page" value="connexion">
</form>

<form type="hidden" id="inscription" method="post" action="index.php">
<input type="hidden" name="page"value="inscription">
</form>

<form type="hidden" id="panier" method="post" action="index.php">
<input type="hidden" name="page" value="panier">
</form>

<form type="hidden" id="utilisateur" method="post" action="index.php">
<input type="hidden" name="page" value="utilisateur">
</form>

<form type="hidden" id="404" method="post" action="index.php">
<input type="hidden" name="page" value="404">
</form>

<form type="hidden" id="accueil" method="post" action="index.php">
<input type="hidden" name="page" value="accueil">
</form>

<form type="hidden" id="ADMINAjoutProduit" method="post" action="index.php">
<input type="hidden" name="page" value="ADMINAjoutProduit">
</form>

<form type="hidden" id="ADMINSuppressionProduit" method="post" action="index.php">
<input type="hidden" name="page" value="ADMINSuppressionProduit">
</form>

<form type="hidden" id="ADMINModificationProduit" method="post" action="index.php">
<input type="hidden" name="page" value="ADMINModificationProduit">
</form>

<form type="hidden" id="carte" method="post" action="/">
<input type="hidden" name="page" value="carte">
</form>-->
