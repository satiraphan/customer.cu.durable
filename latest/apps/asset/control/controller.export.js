	fn.app.asset.export = function(){
		let category = $("select[name=filter-category]").val();
		$.post("apps/asset/xhr/action-export.php",{cat_id: category},function(response){
			if(response.success){
				window.open(response.src);
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
