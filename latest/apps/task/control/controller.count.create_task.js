	fn.app.task.count.dialog_create_task = function(id) {
		$.ajax({
			url: "apps/task/view/dialog.count.create_task.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_create_task_count"});
			}
		});
	};

	fn.app.task.count.create_task = function(){
		$.post("apps/task/xhr/action-create_task-count.php",$("form[name=form_create_taskcount]").serialize(),function(response){
			if(response.success){
				$("#tblCount").DataTable().draw();
				$("#dialog_create_task_count").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
