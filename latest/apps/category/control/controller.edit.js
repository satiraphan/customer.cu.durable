	fn.app.category.dialog_edit = function(id) {
		$.ajax({
			url: "apps/category/view/dialog.edit.php",
			type: "POST",
			data: {id:id},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_category"});
			}
		});
	};

	fn.app.category.edit = function(){
		$.post("apps/category/xhr/action-edit.php",$("form[name=form_edit_category]").serialize(),function(response){
			if(response.success){
				$("#tblCategory").data("selected",[]);
				$("#tblCategory").DataTable().draw();
				$("#dialog_edit_category").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
