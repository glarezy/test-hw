$(document).ready(function() {
	function rnd() {
　　　　rnd.seed = (rnd.seed*9301+49297) % 233280;
　　　　return rnd.seed/(233280.0);
	}

	var createOption = function() {
		var label = $('#newoption').val();
		var t = $('#optiontype1').attr('checked') ? 'radio' : 'checkbox';
		var otid = 'otid_'+rnd();
		var btnLabel = "delete";
		if( label == '' )
			return;
		$('#optionend').before("<li><input type="+t+" id="+otid+" name="+otid+" value="+otid+"><label for="+otid+">"+label+"</label><a class=\"btn js-remove-option\" href=\"javascript:void(0);\">"+btnLabel+"</a></li>");
		$('#newoption').val('');
	}

	var removeOption = function() {
		$(this.parentNode).remove();
	}

	var checkType = function() {
		if( $('#fieldtype3').attr('checked') )
			$('#optionPart').show();
		else
			$('#optionPart').hide();
	}

	$('.js-create-option').bind('click', createOption);
	$('.js-remove-option').bind('click', removeOption);
	$('.js-field-type').bind('click', checkType);
});