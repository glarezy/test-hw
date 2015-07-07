$(document).ready(function () {

	var tab = ['desp','standard','performance','download'];

	$('.js-chgtab').bind('click', function(){
		var c = $(this).attr('data');
		for(var i = 0; i < tab.length; i++) {
			if( tab[i] == c ) {
				$('.js-'+tab[i]).show();
			}else{
				$('.js-'+tab[i]).hide();
			}
		}
		$('.tabSel').addClass('tab');
		$('.tabSel').removeClass('tabSel');
		$(this.parentNode).attr('class', 'tabSel');
	});


})