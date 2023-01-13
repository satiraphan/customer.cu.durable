fn.ui.datatable.init();
$("#tblCategory").data( "selected", [] );
$("#tblCategory").DataTable({
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": {
		"url": "apps/category/store/store-category.php",	
		"data": function ( d ) {
			d.account = $('#tblCategory').attr('account');
		}
	},
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"class":"text-center",	"sWidth": "20px"  },
		{"bSort":true					,"data":"name"	,"class":"text-center",	},
		{"bSortable":false		,"data":"id"		,"class":"text-center" , "sWidth": "80px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblCategory").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox_custom("chk_category",data[0],selected));
		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-pen","fn.app.category.dialog_edit("+data.id+")");
		$("td", row).eq(2).html(s);
	}
});
fn.ui.datatable.selectable_custom('#tblCategory','chk_category',true,function(){
	let s = '';
	$.each($("#tblCategory").data("selected"), function( index, value ) {
		s += '<span class="badge rounded-pill badge-dark p-2 mr-1">'+value+'</span>';
	});
	$("#selected_item").html(s);
});
