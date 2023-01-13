
	fn.app.asset.dialog_remove = function() {
		var item_selected = $("#tblAsset").data("selected");
		$.ajax({
			url: "apps/asset/view/dialog.remove.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_remove_asset"});
			}
		});
	};

	fn.app.asset.remove = function(){
		var item_selected = $("#tblAsset").data("selected");
		$.post("apps/asset/xhr/action-remove.php",{items:item_selected},function(response){
			if(response.success){
				$("#tblAsset").data("selected",[]);
				$("#tblAsset").DataTable().draw();
				$("#dialog_remove_asset").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
