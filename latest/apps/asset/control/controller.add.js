	fn.app.asset.add = function(){
		$.post("apps/asset/xhr/action-add.php",$("form[name=form_add_asset]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
