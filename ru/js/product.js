$(document).ready(function () {

	var tab = ['desp','standard','performance','download'];

	$('.js-chgtab').bind('click', function(){
		var c = $(this).attr('data');
		var defclass = 'tabSel';
		if( c == 'standard' )
			defclass = 'tabSel2';
		if( c == 'performance' )
			defclass = 'tabSel3';
		for(var i = 0; i < tab.length; i++) {
			if( tab[i] == c ) {
				$('.js-'+tab[i]).show();
			}else{
				$('.js-'+tab[i]).hide();
			}
		}
		$('.tabSel').addClass('tab');
		$('.tabSel').removeClass('tabSel');
		$('.tabSel2').removeClass('tabSel2');
		$('.tabSel3').removeClass('tabSel3');
		$(this.parentNode).attr('class', defclass);
	});


})
