
	fn.app.accctrl.group.dialog_add = function() {
		$.ajax({
			url: "apps/accctrl/view/dialog.group.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_group"});
			}	
		});
	};

	fn.app.accctrl.group.add = function(){
		$.post('apps/accctrl/xhr/action-add-group.php',$('form[name=form_addgroup]').serialize(),function(response){
			if(response.success){
				$("#tblGroup").DataTable().draw();
				$("#dialog_add_group").modal('hide');
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},'json');
		return false;
	};
	
	$(".btn-area").append(fn.ui.button({
		class_name : "btn btn-light has-icon",
		icon_type : "material",
		icon : "add_circle_outline",
		onclick : "fn.app.accctrl.group.dialog_add()",
		caption : "Add"
	}));
	



