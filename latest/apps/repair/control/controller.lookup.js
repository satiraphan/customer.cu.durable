	fn.app.repair.lookup = function(){
		$.post("apps/repair/xhr/action-lookup.php",$("form[name=form_lookup_repair]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
