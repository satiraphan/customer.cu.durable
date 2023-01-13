	fn.app.counting.start = function(id){
		bootbox.confirm({
			message: "ต้องการที่จะเริ่มต้นการนับ",
			buttons: {
				confirm: {label: 'Yes',className: 'btn-primary'},
				cancel: {label: 'No',className: 'btn-secondary'}
			},
			callback: function (result) {
				if(result){
					$.post("apps/counting/xhr/action-start.php",{id:id},function(response){
						if(response.success){
							$("#tblCounting").data("selected",[]);
							$("#tblCounting").DataTable().draw();
							$("#dialog_close_counting").modal("hide");
						}else{
							fn.notify.warnbox(response.msg,"Oops...");
						}
					},"json");
				}
			}
		});
		return false;
	};
