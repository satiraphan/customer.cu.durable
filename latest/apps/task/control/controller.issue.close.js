	fn.app.task.issue.dialog_close = function(id) {
		$.ajax({
			url: "apps/task/view/dialog.issue.close.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_close_issue"});
			}
		});
	};

	fn.app.task.issue.close = function(){
		$.post("apps/task/xhr/action-close-issue.php",$("form[name=form_closeissue]").serialize(),function(response){
			if(response.success){
				$("#tblIssue").DataTable().draw();
				$("#dialog_close_issue").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
