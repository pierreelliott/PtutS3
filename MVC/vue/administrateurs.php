<hr class="invisible-separator">
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-offset-3 col-sm-6">
				<div class="input-group">
			      	<input type="text" id="rechercheUser" name="rechercheUser" placeholder="Rechercher un utilisateur" class="form-control">
			      	<span class="input-group-btn">
			        	<button type="button" class="btn btn-default">
							<span class="glyphicon glyphicon-search"></span>
						</button>
			      	</span>
				</div>
			</div>
	    </div>
		<div class="row">
			<div class="col-sm-offset-3 col-sm-6">
				<ul id="autoCompleteList"></ul>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="adminGererAdmin">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
				<h4 class="modal-title">Gérer les administrateurs</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="/modifier-admin" id="modifAdmin" accept-charset="utf-8" enctype="multipart/form-data">
					<fieldset>
						<input type="hidden" id="pseudoAdmin" name="pseudoAdmin">
						<p></p>
						<div class="radio">
							<input type="radio" id="radioAdmin" name="typeUser" value="admin"></label for="radioAdmin">Administrateur</label>
						</div>
						<div class="radio">
							<input type="radio" id="radioUser" name="typeUser" value="user"></label for="radioUser">Utilisateur</label>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
				<button type="submit" form="modifAdmin" class="btn btn-primary">Modifier utilisateur</button>
			</div>
		</div>
	</div>
</div>
