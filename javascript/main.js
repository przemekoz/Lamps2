function inputFocus(nameId, type) {
	if (type == null) {
		type = 'small';
	}
	$('#'+nameId).css('background-image', "url('/img/fielda_"+type+".png')");
}

function inputBlur(nameId, type) {
	if (type == null) {
		type = 'small';
	}
	$('#'+nameId).css('background-image', "url('/img/field_"+type+".png')");
}



function textareaFocus(nameId, type) {
	if (type == null) {
		type = 'small';
	}
	$('#'+nameId).css('background-image', "url('/img/textareaa_"+type+".png')");
}

function textareaBlur(nameId, type) {
	if (type == null) {
		type = 'small';
	}
	$('#'+nameId).css('background-image', "url('/img/textarea_"+type+".png')");
}