	fn.app.counting.manage.dialog_edit = function(id) {
		$.ajax({
			url: "apps/counting/view/dialog.manage.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_manage"});
			}
		});
	};

	fn.app.counting.manage.edit = function(){
		$.post("apps/counting/xhr/action-edit-manage.php",$("form[name=form_editmanage]").serialize(),function(response){
			if(response.success){
				$("#tblManage").DataTable().draw();
				$("#dialog_edit_manage").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
