<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
		<h4 class="modal-title">Supprimer le commentaire</h4>
	</div>
	<div class="modal-body">
        <p class="modalCommentaire"></p>
		<form method="post" id="formConfirm" action="/delete-comment">
			<input  type="hidden" name="numAvis" value="">
		</form>

	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>

		<button type="submit"  form="formConfirm" class="btn btn-danger supprCommentaire">Supprimer<span class="glyphicon glyphicon-remove"></span></button>

	</div>
</div>
