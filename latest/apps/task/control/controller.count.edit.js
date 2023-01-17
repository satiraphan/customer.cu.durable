	fn.app.task.count.dialog_edit = function(id) {
		$.ajax({
			url: "apps/task/view/dialog.count.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_count"});
			}
		});
	};

	fn.app.task.count.edit = function(){
		$.post("apps/task/xhr/action-edit-count.php",$("form[name=form_editcount]").serialize(),function(response){
			if(response.success){
				$("#tblCount").DataTable().draw();
				$("#dialog_edit_count").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
