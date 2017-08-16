<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
		<h4 class="modal-title">Modifier le commentaire</h4>
	</div>
	<div class="modal-body">
        <p></p>
		<form method="post" id="formModif" action="/edit-comment">
			<input  type="hidden" name="numAvis" value="">
        	<textarea class="vresize" name="commentaire"></textarea>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
		<button type="submit" form="formModif" class="btn btn-danger">Modifier<span class="glyphicon glyphicon-remove"></span></button>
	</div>
</div>
