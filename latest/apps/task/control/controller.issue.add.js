	fn.app.task.issue.dialog_add = function() {
		$.ajax({
			url: "apps/task/view/dialog.issue.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_issue"});
			}
		});
	};

	fn.app.task.issue.add = function(){
		$.post("apps/task/xhr/action-add-issue.php",$("form[name=form_addissue]").serialize(),function(response){
			if(response.success){
				$("#tblIssue").DataTable().draw();
				$("#dialog_add_issue").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
	$(".btn-area").append(fn.ui.button({
		class_name : "btn btn-light has-icon",
		icon_type : "material",
		icon : "add_circle_outline",
		onclick : "fn.app.task.issue.dialog_add()",
		caption : "Add"
	}));
