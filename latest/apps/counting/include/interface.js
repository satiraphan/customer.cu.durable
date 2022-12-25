var modules = {
	count : {
		dialog_lookup : fn.noaccess,
		dialog_add : fn.noaccess,
		dialog_edit : fn.noaccess,
		dialog_remove : fn.noaccess,
		dialog_assign : fn.noaccess,
		dialog_start : fn.noaccess,
		dialog_end : fn.noaccess,
		add : fn.noaccess,
		edit : fn.noaccess,
		remove : fn.noaccess,
		assign : fn.noaccess,
		start : fn.noaccess,
		end : fn.noaccess
	},
	manage : {
		dialog_lookup : fn.noaccess,
		dialog_add : fn.noaccess,
		dialog_edit : fn.noaccess,
		dialog_remove : fn.noaccess,
		dialog_approve : fn.noaccess,
		add : fn.noaccess,
		edit : fn.noaccess,
		remove : fn.noaccess,
		approve : fn.noaccess
	},
	history : {
		dialog_lookup : fn.noaccess,
		dialog_view : fn.noaccess,
		view : fn.noaccess
	},
};
$.extend(fn.app,{counting:modules});
