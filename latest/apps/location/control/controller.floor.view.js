$("#tblFloor").data( "selected", [] );
$("#tblFloor").DataTable({
	responsive: true,
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/location/store/store-floor.php",	
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"sClass":"hidden-xs text-center",	"sWidth": "20px"  },
		{"bSort":true			,"data":"code","sClass":"text-center" 	},
		{"bSort":true			,"data":"name"	,"sClass":"text-center" },
		{"bSort":true			,"data":"building","sClass":"text-center" 	},
		{"bSort":true			,"data":"status"	,"sClass":"text-center" },
		{"bSortable":false		,"data":"id"		,"sClass":"text-center" , "sWidth": "80px"  },
		{"bSort":true			,"data":"total"	,"sClass":"text-center" }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblFloor").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox("chk_floor",data[0],selected));
		$("td", row).eq(4).html(fn.ui.switchbox(data.status=="1"?true:false,"fn.app.location.change_status("+data.id+")"));
		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark","far fa-pen","fn.app.location.floor.dialog_edit("+data[0]+")");
		$("td", row).eq(5).html(s);
	}
});
fn.ui.datatable.selectable("#tblFloor","chk_floor");
