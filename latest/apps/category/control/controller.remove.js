	fn.app.category.dialog_remove = function() {
		var item_selected = $("#tblCategory").data("selected");
		$.ajax({
			url: "apps/category/view/dialog.remove.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_remove_category"});
			}
		});
	};

	fn.app.category.remove = function(){
		var item_selected = $("#tblCategory").data("selected");
		$.post("apps/category/xhr/action-remove.php",{items:item_selected},function(response){
			if(response.success){
				$("#tblCategory").data("selected",[]);
				$("#tblCategory").DataTable().draw();
				$("#dialog_remove_category").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
