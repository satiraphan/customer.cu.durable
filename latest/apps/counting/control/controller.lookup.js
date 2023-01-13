	fn.app.counting.lookup = function(){
		$.post("apps/counting/xhr/action-lookup.php",$("form[name=form_lookup_counting]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
