	fn.app.counting.dialog_edit = function(id) {
		
		$.ajax({
			url: "apps/counting/view/dialog.edit.php",
			type: "POST",
			data: {id:id},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_counting"});
			}
		});
	};

	fn.app.counting.edit = function(){
		$.post("apps/counting/xhr/action-edit.php",$("form[name=form_edit_counting]").serialize(),function(response){
			if(response.success){
				$("#tblCounting").data("selected",[]);
				$("#tblCounting").DataTable().draw();
				$("#dialog_edit_counting").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
