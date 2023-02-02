	fn.app.repair.dialog_return = function() {
		var item_selected = $("#tblRepair").data("selected");
		$.ajax({
			url: "apps/repair/view/dialog.return.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_return_repair"});
			}
		});
	};

	
	fn.app.repair.return  = function(id) {
		bootbox.confirm('ยินยันการส่งมอมงาน', function(result) {
			if(result){
				$.post("apps/repair/xhr/action-return.php",{id:id},function(response){
					if(response.success){
						$("#tblIssue").DataTable().draw();
					}else{
						fn.notify.warnbox(response.msg,"Oops...");
					}
				},"json");
			}
		});


	};
	