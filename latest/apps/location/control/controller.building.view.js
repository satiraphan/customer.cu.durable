$("#tblBuilding").data( "selected", [] );
$("#tblBuilding").DataTable({
	responsive: true,
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/location/store/store-building.php",	
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"sClass":"hidden-xs text-center",	"sWidth": "20px"  },
		{"bSort":true			,"data":"code"	},
		{"bSort":true			,"data":"name"	},
		{"bSort":true			,"data":"status","sClass":"text-center"	},
		{"bSortable":false		,"data":"id"		,"sClass":"text-center" , "sWidth": "80px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblBuilding").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox("chk_building",data[0],selected));
		s = '';

		$("td", row).eq(3).html(fn.ui.switchbox(data.status=="1"?true:false,"fn.app.location.change_status("+data.id+")"));


		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark","far fa-pen","fn.app.location.building.dialog_edit("+data[0]+")");
		$("td", row).eq(4).html(s);
	}
});
fn.ui.datatable.selectable("#tblBuilding","chk_building");
