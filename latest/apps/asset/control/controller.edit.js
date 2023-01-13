	fn.app.asset.edit = function(){
		$.post("apps/asset/xhr/action-edit.php",$("form[name=form_edit_asset]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
