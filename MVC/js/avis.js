$(function()
{

    $('#signalModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var numAvis = button.data('numAvis');
        var pseudo = "De " + button.data('pseudo');
        var commentaireAvis = button.data('commentaire-avis');
        var modal = $(this);
        modal.find('.modal-pseudo').text(pseudo);
        modal.find('.commentaireAvis').text(commentaireAvis);
    });

});
