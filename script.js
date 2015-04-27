//Fixe la classe active à l'endroit voulu sur le header
function headerActive(elem){
	$('ul.navbar-nav>li').removeClass('active');
	$(elem).addClass('active');
}
//Animation de couleur lors du survol du menu
$('ul.navbar-nav li').on('mouseenter mouseleave', function(){
	$(this).toggleClass('btn-violet');
});
function compteLecteur(){
	$('#compte a').attr('href','compteLecteur.php');
}
function compteBibliothecaire(){
	$('#compte a').attr('href','compteBibli.php');
}
//Ouverture du popover de connexion
function connexionPopover(){
	$('.popover-markup>.trigger').popover({
		html: true,
		content: function () {
			return $(this).parent().find('.content').html();
		}
	});
}
//Fermeture du popover de connexion lorsque l'on clique en dehors
$('html').click(function(event) { 
	if(!$(event.target).closest('.popover-markup').length) {
		$('.popover-markup>.trigger').popover('hide');
	}
})
//Découvre ou cache des éléments ayant la class .cache
$('a.cache').click( function(){
	$('form.cache').toggleClass('hidden').toggleClass('show');
});
//Formulaire d'ajout de livre
$('input[type=radio][name=typeLivre]').change(function() {
	$('#ISBN').toggleClass('hidden').toggleClass('show');
	$('#coteLivre').toggleClass('hidden').toggleClass('show');
	$('#lienPDF').toggleClass('hidden').toggleClass('show');
});
