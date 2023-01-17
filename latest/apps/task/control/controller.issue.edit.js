	fn.app.task.issue.dialog_edit = function(id) {
		$.ajax({
			url: "apps/task/view/dialog.issue.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_issue"});
			}
		});
	};

	fn.app.task.issue.edit = function(){
		$.post("apps/task/xhr/action-edit-issue.php",$("form[name=form_editissue]").serialize(),function(response){
			if(response.success){
				$("#tblIssue").DataTable().draw();
				$("#dialog_edit_issue").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
