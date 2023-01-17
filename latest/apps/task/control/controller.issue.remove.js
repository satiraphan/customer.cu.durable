	fn.app.task.issue.dialog_remove = function() {
		var item_selected = $("#tblIssue").data("selected");
		$.ajax({
			url: "apps/task/view/dialog.issue.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_issue").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_issue").modal("show");
				$("#dialog_remove_issue .btnConfirm").click(function(){
					fn.app.task.issue.remove();
				});
			}
		});
	};

	fn.app.task.issue.remove = function(){
		var item_selected = $("#tblIssue").data("selected");
		$.post("apps/task/xhr/action-remove-issue.php",{items:item_selected},function(response){
			$("#tblIssue").data("selected",[]);
			$("#tblIssue").DataTable().draw();
			$("#dialog_remove_issue").modal("hide");
		});
	};
	$(".btn-area").append(fn.ui.button({
		class_name : "btn btn-light has-icon",
		icon_type : "material",
		icon : "delete",
		onclick : "fn.app.task.issue.dialog_remove()",
		caption : "Remove"
	}));
