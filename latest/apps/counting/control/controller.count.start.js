	fn.app.counting.count.dialog_start = function(id) {
		$.ajax({
			url: "apps/counting/view/dialog.count.start.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_start_count"});
			}
		});
	};

	fn.app.counting.count.start = function(){
		$.post("apps/counting/xhr/action-start-count.php",$("form[name=form_startcount]").serialize(),function(response){
			if(response.success){
				$("#tblCount").DataTable().draw();
				$("#dialog_start_count").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
