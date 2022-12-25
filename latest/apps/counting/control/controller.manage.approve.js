	fn.app.counting.manage.dialog_approve = function(id) {
		$.ajax({
			url: "apps/counting/view/dialog.manage.approve.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_approve_manage"});
			}
		});
	};

	fn.app.counting.manage.approve = function(){
		$.post("apps/counting/xhr/action-approve-manage.php",$("form[name=form_approvemanage]").serialize(),function(response){
			if(response.success){
				$("#tblManage").DataTable().draw();
				$("#dialog_approve_manage").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
