$("form[name=importer] input[type=file]").change(function(){
	var data = new FormData($("form[name=importer]")[0]);

	jQuery.ajax({
		url: 'apps/asset/xhr/action-import.php',
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		type: 'POST',
		dataType: 'json',
		success: function(response){
			if(response.success){
				fn.notify.successbox(response.msg,"Complete");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}	
		}
	});
});	