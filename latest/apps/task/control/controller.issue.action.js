	fn.app.task.issue.dialog_action_relocation = function(id) {
		$.ajax({
			url: "apps/task/view/dialog.issue.action_relocation.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_action"});
			}
		});
	};

	fn.app.task.issue.dialog_action_repair = function(id) {
		$.ajax({
			url: "apps/task/view/dialog.issue.action_repair.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_action"});
			}
		});
	};

	fn.app.task.issue.dialog_action_change_status_lost = function(id) {
		bootbox.confirm('ยืนยันรายการสูญหาย', function(result) {
			if(result){
				$.post("apps/task/xhr/action-change-status-lost.php",{id:id},function(response){
					if(response.success){
						$("#tblIssue").DataTable().draw();
					}else{
						fn.notify.warnbox(response.msg,"Oops...");
					}
				},"json");
			}
		});


	};
	

