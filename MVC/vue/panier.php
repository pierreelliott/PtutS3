<?php

	$title = "Panier";

	ob_start();

	echo '<div class="row">
			<div class="col-lg-offset-3 col-lg-6 site-wrapper">
				<table class="table table-hover">
					<tbody>
						<tr>
							<th>Produit</th>
							<th>Quantité</th>
							<th>Prix unitaire (€)</th>
							<th>Prix total (€)</th>
							<th>Retirer du panier</th>
						</tr>';
	$montantTotal = 0;
	$montantTotalProduit = 0;
	for($i = 0; $i < count($_SESSION["panier"]["libelle"]); $i++)
	{
		$montantTotalProduit = $_SESSION["panier"]["quantite"][$i] * $_SESSION["panier"]["prix"][$i];
		$montantTotal += $montantTotalProduit;

	 echo '<tr>
		<td>'.$_SESSION["panier"]["libelle"][$i].'</td>
		<td>'.$_SESSION["panier"]["quantite"][$i].'</td>
		<td>'.$_SESSION["panier"]["prix"][$i].'</td>
		<td>'.$montantTotalProduit.'</td>
		<td>
			<a href="panier.php?action=suppression&produit='.'?">
			<img src="images/mooins2.png" alt="Retirer du panier" title="Retirer du panier"/>
			</a>
		</td>
		</tr>';
	}

	echo '				<tr>
                            <td>Total</td>
                            <td>'.array_sum($_SESSION["panier"]["quantite"]).'</td>
                            <td></td>
                            <td>'.$montantTotal.'</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>';
	$contenu = ob_get_contents();
	ob_end_clean();

	require("layout/site.php");
?>
