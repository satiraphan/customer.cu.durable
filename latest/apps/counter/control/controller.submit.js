	fn.app.counter.dialog_submit = function() {
		var item_selected = $("#tblCounter").data("selected");
		$.ajax({
			url: "apps/counter/view/dialog.submit.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_submit_counter"});
			}
		});
	};

	fn.app.counter.submit = function(){
		$.post("apps/counter/xhr/action-submit.php",$("form[name=form_submit_counter]").serialize(),function(response){
			if(response.success){
				$("#tblCounter").data("selected",[]);
				$("#tblCounter").DataTable().draw();
				$("#dialog_submit_counter").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
