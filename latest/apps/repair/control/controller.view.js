fn.ui.datatable.init();
$("#tblRepair").data( "selected", [] );
$("#tblRepair").DataTable({
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": {
		"url": "apps/repair/store/store-repair.php",	
		"data": function ( d ) {
			d.account = $('#tblRepair').attr('account');
		}
	},
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"class":"text-center",	"sWidth": "20px"  },
		{"bSort":true					,"data":"asset_id"	,"class":"text-center",	},
		{"bSort":true					,"data":"date_repair_plan"	,"class":"text-center",	},
		{"bSort":true					,"data":"task_id"	,"class":"text-center",	},
		{"bSortable":false		,"data":"id"		,"class":"text-center" , "sWidth": "80px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblRepair").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox_custom("chk_repair",data[0],selected));
		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-pen","fn.navigate('repair','view=edit&id="+data[0]+"')");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-eye","fn.navigate('repair','view=lookup&id="+data[0]+"')");
		$("td", row).eq(2).html(s);
	}
});
fn.ui.datatable.selectable_custom('#tblRepair','chk_repair',true,function(){
	let s = '';
	$.each($("#tblRepair").data("selected"), function( index, value ) {
		s += '<span class="badge rounded-pill badge-dark p-2 mr-1">'+value+'</span>';
	});
	$("#selected_item").html(s);
});
