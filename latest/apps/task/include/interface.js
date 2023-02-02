var modules = {
	count : {
		dialog_lookup : fn.noaccess,
		dialog_add : fn.noaccess,
		dialog_edit : fn.noaccess,
		dialog_remove : fn.noaccess,
		dialog_check : fn.noaccess,
		dialog_create_task : fn.noaccess,
		add : fn.noaccess,
		edit : fn.noaccess,
		remove : fn.noaccess,
		check : fn.noaccess,
		create_task : fn.noaccess
	},
	issue : {
		dialog_lookup : fn.noaccess,
		dialog_add : fn.noaccess,
		dialog_edit : fn.noaccess,
		dialog_remove : fn.noaccess,
		dialog_close : fn.noaccess,
		add : fn.noaccess,
		edit : fn.noaccess,
		remove : fn.noaccess,
		close : fn.noaccess,
		dialog_action_relocation : fn.noaccess,
		dialog_action_repair : fn.noaccess,
		dialog_action_change_status_lost : fn.noaccess,
		relocation : fn.noaccess,
		repair : fn.noaccess,
		change_status_lost : fn.noaccess
	},
};
$.extend(fn.app,{task:modules});
