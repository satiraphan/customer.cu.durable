
	fn.app.asset.dialog_photo = function(id) {
		var item_selected = $("#tblAsset").data("selected");
		$.ajax({
			url: "apps/asset/view/dialog.photo.php",
			type: "POST",
			data: {id:id},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_photo_asset"});

				$("form[name=form_uploader] input[type=file]").change(function(){
					var data = new FormData($("form[name=form_uploader]")[0]);
					jQuery.ajax({
						url: 'apps/asset/xhr/action-upload-photo.php',
						data: data,
						cache: false,
						contentType: false,
						processData: false,
						type: 'POST',
						dataType: 'json',
						success: function(response){
							if(response.success){
								let s = '';
								for(i in response.path){
									let path = response.path[i];
									s += '<div class="col-4">';
										s += '<input type="hidden" name="img[]" value="'+path+'">';
										s += '<img src="'+path+'" class="img-fluid img-thumbnail" alt="...">';
									s += '</div>';
								}
								$("#asset_photo_area").append(s);
								//$("#dialog_photo_asset").modal('hide');
							}else{
								fn.notify.warnbox(response.msg,"Oops...");
							}	
						}
					});
				});	


			}
		});
	};



	fn.app.asset.save_photo = function(id){
		$.post('apps/asset/xhr/action-save-photo.php',$('form[name=asset_imgs]').serialize(),function(response){
			if(response.success){
				$("#tblAsset").DataTable().ajax.reload(null,false);
				$("#dialog_photo_asset").modal('hide');
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},'json');
		return false;
	};
