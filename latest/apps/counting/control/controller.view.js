fn.ui.datatable.init();tblCounting
$("#tblCounting").data( "selected", [] );
$("#tblCounting").DataTable({
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": {
		"url": "apps/counting/store/store-counting.php",	
		"data": function ( d ) {
			d.account = $('#tblCounting').attr('account');
		}
	},
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"class":"text-center",	"sWidth": "20px"  },
		{"bSort":true					,"data":"name"	,"class":"text-center",	},
		{"bSort":true					,"data":"date_start"	,"class":"text-center",	},
		{"bSort":true					,"data":"status"	,"class":"text-center",	},
		{"bSortable":false		,"data":"id"		,"class":"text-center" , "sWidth": "120px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblCounting").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox_custom("chk_counting",data[0],selected));
		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-pen","fn.app.counting.dialog_edit("+data[0]+")");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-wrench","fn.navigate('counting','view=manage&id="+data[0]+"')");

		//s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-images","fn.app.counting.dialog_photo("+data[0]+")");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-eye","fn.navigate('counting','view=lookup&id="+data[0]+"')");
		s += fn.ui.button("btn btn-xs btn-outline-warning mr-1","far fa-play","fn.app.counting.start("+data[0]+")");
		$("td", row).eq(4).html(s);
	}
});
fn.ui.datatable.selectable_custom('#tblCounting','chk_counting',true,function(){
	let s = '';
	$.each($("#tblCounting").data("selected"), function( index, value ) {
		s += '<span class="badge rounded-pill badge-dark p-2 mr-1">'+value+'</span>';
	});
	$("#selected_item").html(s);
});
