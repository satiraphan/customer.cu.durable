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
	fn.app.asset.report = function (type) {
		var item_selected = $("#tblAsset").data("selected");
		$.ajax({
			type: "POST",
			dataType: "html",
			success: function (html) {
				var s = '';
				window.location = '#apps/asset/index.php?view=' + type+'&id='+item_selected;
				// for (i in json) {
				//     s += json;
				// }
				// $("#report tbody").html(s);
			}
		});
	}