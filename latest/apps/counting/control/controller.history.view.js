	fn.app.counting.history.dialog_view = function(id) {
		$.ajax({
			url: "apps/counting/view/dialog.history.view.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_view_history"});
			}
		});
	};

	fn.app.counting.history.view = function(){
		$.post("apps/counting/xhr/action-view-history.php",$("form[name=form_viewhistory]").serialize(),function(response){
			if(response.success){
				$("#tblHistory").DataTable().draw();
				$("#dialog_view_history").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
