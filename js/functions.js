window.onload=function(){
	$('#successful').hide();
	$('#failed').hide();
	var param = document.URL.split('#')[1];
	if(param == "successful"){
		$('#successful').show();
	} else if (param == "failed"){
		$('#failed').show();
	}
};
