var modules = {
		dialog_add : fn.noaccess,
		add : fn.noaccess,
		dialog_edit : fn.noaccess,
		edit : fn.noaccess,
		lookup : fn.noaccess,
		manage : fn.noaccess,
		dialog_close : fn.noaccess,
		close : fn.noaccess,
		dialog_location_lookup : fn.noaccess,
		select_location : fn.noaccess,
		dialog_user_lookup : fn.noaccess,
		select_user : fn.noaccess,
		save_manage : fn.noaccess,
		start : fn.noaccess,
		report : fn.noaccess
};
$.extend(fn.app,{counting:modules});
