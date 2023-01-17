	fn.app.task.count.dialog_check = function(id) {
		$.ajax({
			url: "apps/task/view/dialog.count.check.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_check_count"});
			}
		});
	};

	fn.app.task.count.check = function(){
		$.post("apps/task/xhr/action-check-count.php",$("form[name=form_checkcount]").serialize(),function(response){
			if(response.success){
				$("#tblCount").DataTable().draw();
				$("#dialog_check_count").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
