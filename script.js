$('.popover-markup>.trigger').popover({
	html: true,
	/*
	title: function () {
	return $(this).parent().find('.head').html();
	},
	*/
	content: function () {
		return $(this).parent().find('.content').html();
	}
});

$('ul.navbar-nav li').on('mouseenter mouseleave', function(){
	$(this).toggleClass('btn-violet');
});

$('a.cache').click( function(){
	$('form.cache').toggleClass('hidden').toggleClass('show');
});
/*
$(document).click(function(event) { 
	if(!$(event.target).closest('.popover-markup').length) {
		$('.popover-markup>.trigger').popover('hide');
    }
})
*/