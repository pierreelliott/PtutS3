<?php
		$title = "Se deconnecter";

		ob_start();

		echo '

			<body>
				<form method="post" action="deconnexion.php">
					<p>
						<button type="submit">Deconnexion</button>
					</p>
				</form>';
		/* Je ne sais pas comment ça fonctionne, donc c'est un simple copier-coller du code précédent */
		$contenu = ob_get_contents();

		ob_end_clean();

?>
