$(function()
{
    $('#signalModal').on('show.bs.modal', function (event)
    {
        var button = $(event.relatedTarget);
        var numAvis = button.data('num-avis');
        var pseudo = "De " + button.data('pseudo');
        var commentaireAvis = button.data('commentaire-avis');
        var modal = $(this);
        modal.find('.modal-pseudo').text(pseudo);
        modal.find('.commentaireAvis').text(commentaireAvis);
        $("#numAvis").val(numAvis);
    });

    $('#signalModal').on('show.bs.modal', function (event)
    {
        $('#remarque').val('');
    });

    $("#btnSignal").click(function(event)
    {
        //event.preventDefault();
        var numAvis = $("#numAvis").val();
        var remarque = $("#remarque").val();

        $.post("/report-advice",
        {
            numAvis: numAvis,
            remarque: remarque
        },
        function(data, status)
        {
            $(".modal").modal("hide");

            if(data === "false")
            {
                var fenAlert = $('.alert');
    			fenAlert.removeClass('hidden')
    			setTimeout(function()
    			{
    				fenAlert.addClass('hidden');
    			}, 2500);
            }
        });
    });


});
