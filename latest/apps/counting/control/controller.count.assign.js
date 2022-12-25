	fn.app.counting.count.dialog_assign = function(id) {
		$.ajax({
			url: "apps/counting/view/dialog.count.assign.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_assign_count"});
			}
		});
	};

	fn.app.counting.count.assign = function(){
		$.post("apps/counting/xhr/action-assign-count.php",$("form[name=form_assigncount]").serialize(),function(response){
			if(response.success){
				$("#tblCount").DataTable().draw();
				$("#dialog_assign_count").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
