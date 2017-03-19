$(function()
{
	var divPseudo = $('#divPseudo');

	$('#btnModifPseudo').click(function(e)
	{
		$(this).addClass('hidden');
		divPseudo.find('#affichePseudo').addClass('hidden');
		divPseudo.find('#pseudo').removeClass('hidden');
		divPseudo.find('#btnValiderPseudo').removeClass('hidden');
	});
});
