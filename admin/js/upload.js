$(document).ready(function() {
	var limit = false;

	function upload() {
		$('#btnUpload').hide();
		addInputFile();
	}

	function uploadOne() {
		if( $('.js-file-existed').length > 0
			|| $('.js-file-uploaded').length > 0 )
		if( !confirm($('#uploadTip').html()) )
			return;
		limit = true;
		removeInputFile();
		$('.js-file-existed').remove();
		$('.js-file-uploaded').remove();
		addInputFile();
	}

	function addInputFile() {
		$('#uploadFlag').before('<div id="uploadLine" class="row" style="clear:both;"><input class="js-picupload" type=file id=uploadfile name=uploadfile></div>');
	}

	function removeInputFile() {
		$('#uploadLine').remove();
	}

	function rebuildInputFile() {
		removeInputFile();
		if( !limit )
		addInputFile();
	}

	function showUploaded(uploaded) {
		var adshow = typeof(uploaded.adshow) != "undefined" ? '<input value="'+uploaded.val+'" type=checkbox id="adshow_'+uploaded.num+'" name="adshow_'+uploaded.num+'"><label for="adshow_'+uploaded.num+'" style="display:inline;">'+$('#adshow').html()+'</label>&nbsp;&nbsp;' : '';
		var mainpic = typeof(uploaded.adshow) != "undefined" ? '<input value="'+uploaded.val+'" type=checkbox id="mainpic_'+uploaded.num+'" name="mainpic_'+uploaded.num+'"><label for="mainpic_'+uploaded.num+'" style="display:inline;">'+$('#mainpic').html()+'</label>&nbsp;&nbsp;' : '';
		var newproduct = typeof(uploaded.newproduct) != "undefined" ? '<input value="'+uploaded.val+'" type=checkbox id="newproduct_'+uploaded.num+'" name="newproduct_'+uploaded.num+'"><label for="newproduct_'+uploaded.num+'" style="display:inline;">'+$('#newproduct').html()+'</label>&nbsp;&nbsp;' : '';
		if( adshow != '' )
		$('#uploadLine').before('<div class="row js-file-uploaded"><input type=hidden value="'+uploaded.txt+'" name="label_'+uploaded.num+'"><input type=hidden value="'+uploaded.val+'" name="uploaded_'+uploaded.num+'"><ul class="uploaded"><li><img src="'+uploaded.imgsrc+'"></li><li><div class="uploadedText">'+uploaded.txt+'</div>'+adshow+newproduct+mainpic+'<a href="javascript:void(0)"><span class="js-btn-del btnSpan">' + $('#textBtnDelete').html() + '</span></a></li></ul></div>');
		else
		$('#uploadLine').before('<div class="row js-file-uploaded"><input type=hidden value="'+uploaded.txt+'" name="label_'+uploaded.num+'"><input type=hidden value="'+uploaded.val+'" name="uploaded_'+uploaded.num+'"><img src="'+uploaded.imgsrc+'"><span class="uploadedText">'+uploaded.txt+'</span>'+adshow+newproduct+mainpic+'<a href="javascript:void(0)"><span class="js-btn-del btnSpan">' + $('#textBtnDelete').html() + '</span></a></div>');
	}

	function uploadSubmit() {
		$('#uploadLine').hide();
		$('#uploadLine').before('<div id="uploadingTip"><table><tr><td width=45><img src="'+$('#processingImgSrc').html()+'"></td><td><label>'+$('#uploadingTextTip').html()+'</label></td></tr></table></div>');
		var id = $(this).attr('id');
		$.ajaxFileUpload({
			url: $('#uploadUrl').html(),
			secureuri: false,
			fileElementId: id,
			dataType: 'json',

			success: function (data, status) {
				$('#uploadingTip').remove();
				if( data.code != "success" ) {
					rebuildInputFile();
					alert($('#uploadFailed').html());
					return;
				}
				showUploaded(data.uploaded);
				rebuildInputFile();
			},

			error: function (data, status, e) {
				$('#uploadingTip').remove();
				rebuildInputFile();
				alert($('#uploadFailed').html());
			}
		});
	}

	function removeUploaded() {
		var n = this.parentNode;
		while( n.nodeName.toLowerCase() != 'div' )
			n = n.parentNode;
		if( n.nodeName.toLowerCase() == 'div' )
			$(n).remove();
	}

	$('#btnFormSubmit').live('click', function(){
		if( $('#uploadingTip').html() ) {
			alert($('#uploadingSubmitDeny').html());
			return;
		}
		var n = this.parentNode;
		while( n ) {
			if( n.nodeName.toLowerCase() == "form" ) {
				$(n).submit();
				break;
			}
			n = n.parentNode;
		}
	});

	$('.js-btn-del').live('click', removeUploaded);
	$('.js-picupload').live('change', uploadSubmit);
	$('#btnUpload').bind('click', upload);
	$('#btnUploadOne').bind('click', uploadOne);

});