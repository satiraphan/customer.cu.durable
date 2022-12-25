	fn.app.counting.count.dialog_end = function(id) {
		$.ajax({
			url: "apps/counting/view/dialog.count.end.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_end_count"});
			}
		});
	};

	fn.app.counting.count.end = function(){
		$.post("apps/counting/xhr/action-end-count.php",$("form[name=form_endcount]").serialize(),function(response){
			if(response.success){
				$("#tblCount").DataTable().draw();
				$("#dialog_end_count").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
