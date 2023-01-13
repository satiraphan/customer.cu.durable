	fn.app.counting.dialog_add = function() {
		var item_selected = $("#tblCounting").data("selected");
		$.ajax({
			url: "apps/counting/view/dialog.add.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_counting"});
			}
		});
	};

	fn.app.counting.add = function(){
		$.post("apps/counting/xhr/action-add.php",$("form[name=form_add_counting]").serialize(),function(response){
			if(response.success){
				$("#tblCounting").data("selected",[]);
				$("#tblCounting").DataTable().draw();
				$("#dialog_add_counting").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
