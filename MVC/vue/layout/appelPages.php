<!-- Formulaires 'invisibles' pour l'appel des pages -->

<script language="javascript">
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
		default:
		case "404":
			document.getElementById("404").submit();
			break;
		case "accueil":
			document.getElementById("accueil").submit();
			break;
		case "carte":
			document.getElementById("carte").submit();
			break;
		case "ADMINAjoutProduit":
			document.getElementById("ADMINAjoutProduit").submit();
			break;
		case "ADMINModificationProduit":
			document.getElementById("ADMINModificationProduit").submit();
			break;
		case "ADMINSuppressionProduit":
			document.getElementById("ADMINSuppressionProduit").submit();
			break;
	}
}
</script>


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

<form type="hidden" id="carte" method="post" action="index.php">
<input type="hidden" name="page" value="carte">
</form>