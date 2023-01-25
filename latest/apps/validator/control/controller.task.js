	fn.app.validator.dialog_task = function(id) {
		var item_selected = $("#tblValidator").data("selected");
		$.ajax({
			url: "apps/validator/view/dialog.task.php",
			type: "POST",
			data: {id:id},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_task_validator"});
			}
		});
	};

	fn.app.validator.task = function(){
		$.post("apps/validator/xhr/action-task.php",$("form[name=form_task_validator]").serialize(),function(response){
			if(response.success){
				$("#tblValidator").data("selected",[]);
				$("#tblValidator").DataTable().draw();
				$("#dialog_task_validator").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
