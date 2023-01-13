	fn.app.counter.lookup = function(){
		$.post("apps/counter/xhr/action-lookup.php",$("form[name=form_lookup_counter]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
