var modules = {
		view : fn.noaccess,
		validate : fn.noaccess,
		dialog_close : fn.noaccess,
		close : fn.noaccess,
		dialog_task: fn.noaccess,
		task : fn.noaccess,
		dialog_valuate_all : fn.noaccess,
		validate_all : fn.noaccess,
		dialog_check_all : fn.noaccess,
		check_all : fn.noaccess
};
$.extend(fn.app,{validator:modules});
