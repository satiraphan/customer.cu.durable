	fn.app.category.dialog_add = function() {
		var item_selected = $("#tblCategory").data("selected");
		$.ajax({
			url: "apps/category/view/dialog.add.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_category"});
			}
		});
	};

	fn.app.category.add = function(){
		$.post("apps/category/xhr/action-add.php",$("form[name=form_add_category]").serialize(),function(response){
			if(response.success){
				$("#tblCategory").data("selected",[]);
				$("#tblCategory").DataTable().draw();
				$("#dialog_add_category").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
