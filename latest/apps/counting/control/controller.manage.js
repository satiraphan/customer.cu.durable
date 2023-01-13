	fn.app.counting.save_manage = function(){
		$.post("apps/counting/xhr/action-save-manage.php",$("form[name=form_manage_counting]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};


	fn.app.counting.dialog_location_lookup = function() {
		var selected_member = [];
		$("tr[cname=tr-location]").each(function(){
			selected_member.push($(this).attr("data-id"));
		});
		
		$.ajax({
			url: "apps/counting/view/dialog.location.lookup.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_location_lookup"});
				$("#tblLocationLookup").data( "selected",[]);
				$('#tblLocationLookup').DataTable({
					"bStateSave": true,
					"autoWidth" : true,
					"processing": true,
					"serverSide": true,
					"ajax": "apps/counting/store/store-location.php",
					"aoColumns": [
						{"bSortable": false	,"data":"id"		,"sWidth": "20px", "sClass" : "hidden-xs text-center"},
						{"bSortable": false	,"data":"code"		,"sClass" : "text-center"},
						{"bSortable": false	,"data":"name"	,"sClass" : "hidden-xs text-center"},
						{"bSortable" : true	,"data":"type"	,"sClass" : "text-center"}
					],"order": [[ 2, "desc" ]],
					"createdRow": function ( row, data, index ) {
						var selected = false,checked = "",s = '';
						if ( $.inArray(data.DT_RowId, selected_member) !== -1 ) {
							$(row).addClass('hidden');
							$('td', row).eq(0).html('<span class="badge badge-dark">Selected</span>');
						}else{
							if ( $.inArray(data.DT_RowId, $("#tblLocationLookup").data("selected")) !== -1 ) {
								$(row).addClass('selected');
								selected = true;
							}
							$('td', row).eq(0).html(fn.ui.checkbox("chk_location",data[0],selected,true));
						}
					}
				});
				fn.ui.datatable.selectable('#tblLocationLookup','chk_location',true);
			}	
		});
		return false;
	}

	fn.app.counting.select_location = function() {
		var selected_member = $("#tblLocationLookup").data("selected");
		if(selected_member.length==0){
			fn.engine.alert("No selected","Please select item!");
		}else{
			$.post("apps/counting/xhr/action-load-location.php",{id:$("#tblLocationLookup").data("selected")},function(json){
				let s = '';
				for(i in json){
					s += '<tr data-id="'+json[i].id+'" cname="tr-location">';
						s += '<td class="text-center">';
							s += '<button class="btn btn-xs btn-danger" onclick="$(this).parent().parent().remove()">Remove</button>';
							s += '<input type="hidden" name="location[]" value="'+json[i].id+'">';
						s +'</td>';
						s += '<td class="text-center">'+json[i].code+'</td>';
						s += '<td class="text-center">'+json[i].name+'</td>';
						s += '<td class="text-center">'+json[i].type+'</td>';
					s += '</tr>';
				}
				$("#tblSelectedLocation tbody").append(s);
				$("#dialog_location_lookup").modal('hide');
			},'json');
		}
	}

	
	fn.app.counting.dialog_user_lookup = function() {
		var selected_member = [];
		$("tr[cname=tr-user]").each(function(){
			selected_member.push($(this).attr("data-id"));
		});
		
		$.ajax({
			url: "apps/counting/view/dialog.user.lookup.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_user_lookup"});
				$("#tblUserLookup").data( "selected",[]);
				$('#tblUserLookup').DataTable({
					"bStateSave": true,
					"autoWidth" : true,
					"processing": true,
					"serverSide": true,
					"ajax": "apps/counting/store/store-user.php",
					"aoColumns": [
						{"bSortable": false	,"data":"id"		,"sWidth": "20px", "sClass" : "hidden-xs text-center"},
						{"bSortable": false	,"data":"username"		,"sClass" : "text-center"},
						{"bSortable": false	,"data":"fullname"		,"sClass" : "text-center"},
						{"bSortable": false	,"data":"email"		,"sClass" : "text-center"},
						{"bSortable": false	,"data":"phone"		,"sClass" : "text-center"}
					],"order": [[ 2, "desc" ]],
					"createdRow": function ( row, data, index ) {
						var selected = false,checked = "",s = '';
						if ( $.inArray(data.DT_RowId, selected_member) !== -1 ) {
							$(row).addClass('hidden');
							$('td', row).eq(0).html('<span class="badge badge-dark">Selected</span>');
						}else{
							if ( $.inArray(data.DT_RowId, $("#tblUserLookup").data("selected")) !== -1 ) {
								$(row).addClass('selected');
								selected = true;
							}
							$('td', row).eq(0).html(fn.ui.checkbox("chk_user",data[0],selected,true));
						}
					}
				});
				fn.ui.datatable.selectable('#tblUserLookup','chk_user',true);
			}	
		});
		return false;
	}

	fn.app.counting.select_user = function() {
		var selected_member = $("#tblUserLookup").data("selected");
		if(selected_member.length==0){
			fn.engine.alert("No selected","Please select item!");
		}else{
			$.post("apps/accctrl/xhr/action-load-user.php",{id:$("#tblUserLookup").data("selected")},function(json){
				let s = '';
				for(i in json){
					s += '<tr data-id="'+json[i].id+'" cname="tr-user">';
						s += '<td class="text-center">';
							s += '<button class="btn btn-xs btn-danger" onclick="$(this).parent().parent().remove()">Remove</button>';
							s += '<input type="hidden" name="user[]" value="'+json[i].id+'">';
						s +'</td>';
						s += '<td class="text-center">'+json[i].username+'</td>';
						s += '<td class="text-center">'+json[i].display+'</td>';
						s += '<td class="text-center">'+json[i].group+'</td>';
					s += '</tr>';
				}
				$("#tblSelectedUser tbody").append(s);
				$("#dialog_user_lookup").modal('hide');
			},'json');
		}
	}
		
