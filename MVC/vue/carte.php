<?php
    $title = "Carte";

    ob_start();

		echo '<div class="row">
                <div class="col-lg-offset-3 col-lg-6 site-wrapper">
                    <table class="table table-hover">
                        <tr>
                            <th>Produit</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Ajout panier</th>
                        </tr>';

        foreach($tabRows as $key => $row)
		{
			echo '<tr>
				<td>'.$row["libelle"].'</td>
				<td>'.$row["description"]."</td>
				<td><img src='".$row["sourceMoyen"]."' alt='Image du produit'></td>
				<td><a href='panier.php?action=ajout&produit=".implode(',', $row)."'>
					<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'></a></td>
			</tr>";
		}

		echo '</table>
                </div>
            </div>';


	$contenu = ob_get_contents();
    ob_end_clean();

    require("layout/site.php");
?>
