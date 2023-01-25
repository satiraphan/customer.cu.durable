$("#tblIssue").data( "selected", [] );
$("#tblIssue").DataTable({
	responsive: true,
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/task/store/store-issue.php",	
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"sClass":"hidden-xs text-center",	"sWidth": "20px"  },
		{"bSort":true			,"data":"type"	},
		{"bSort":true			,"data":"title"	},
		{"bSort":true			,"data":"asset_id"	},
		{"bSort":true			,"data":"issued"	},
		{"bSort":true			,"data":"issuer"	},
		{"bSort":true			,"data":"counting_item_id"	},
		{"bSort":true			,"data":"remark"	},
		{"bSortable":false		,"data":"id"		,"sClass":"text-center" , "sWidth": "120px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblIssue").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox("chk_issue",data[0],selected));
		s = '';
		s += fn.ui.button("btn btn-xs btn-dark mr-1","fa fa-rotate","fn.app.task.issue.dialog_action_relocation("+data[0]+")");
		s += fn.ui.button("btn btn-xs btn-dark mr-1","fa fa-screwdriver-wrench","fn.app.task.issue.dialog_action_repair("+data[0]+")");
		s += fn.ui.button("btn btn-xs btn-dark mr-1","fa fa-empty-set","fn.app.task.issue.dialog_action_change_status_lost("+data[0]+")");
		
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","fa-solid fa-check-double","fn.app.task.issue.dialog_close("+data[0]+")");
		$("td", row).eq(8).html(s);
	}
});
fn.ui.datatable.selectable("#tblIssue","chk_issue");
