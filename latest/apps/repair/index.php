<?php
	session_start();
	@ini_set('display_errors',1);
	include "../../config/define.php";
	include "../../include/db.php";
	include "../../include/oceanos.php";
	include "../../include/iface.php";

	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	$panel = new ipanel($dbc,$os->auth);

	$panel->setApp("repair","Repair");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'view');

	$panel->setMeta(array(
		array("view","View","fa fa-wrench"),
		array("lookup","Lookup","fa fa-eye"),
	));
	$panel->PageBreadcrumb();
	$panel->EchoViewInterface();
?>
<script>
	var plugins = [
		'apps/repair/include/interface.js',
		'plugins/datatables/dataTables.bootstrap4.min.css',
		'plugins/datatables/responsive.bootstrap4.min.css',
		'plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js',
		'plugins/select2/css/select2.min.css',
		'plugins/select2/js/select2.min.js',
		'plugins/moment/moment.min.js'
	];
	App.loadPlugins(plugins, null).then(() => {
		App.checkAll()
	<?php
		switch($panel->getView()){
			case "view":
				include "control/controller.view.js";
				if($os->allow("repair","edit"))include "control/controller.edit.js";
				if($os->allow("repair","return"))include "control/controller.return.js";
				break;
			case "lookup":
				if($os->allow("repair","lookup"))include "control/controller.lookup.js";
				break;
		}
	?>
	}).then(() => App.stopLoading())
</script>
