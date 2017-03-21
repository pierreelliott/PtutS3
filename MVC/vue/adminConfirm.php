<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
		<h4 class="modal-title">Supprimer le commentaire</h4>
	</div>
	<div class="modal-body">
        <p class="modalCommentaire"></p>

	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
		<form method="post" action="/deleteCommentaire">
			<input  type="hidden" value="">
			<button type="submit"  class="btn btn-danger supprCommentaire">Supprimer<span class="glyphicon glyphicon-remove"></span></button>

		</form>

	</div>
</div>
