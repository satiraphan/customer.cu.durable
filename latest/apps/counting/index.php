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

	$panel->setApp("counting","Counting");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'view');

	$panel->setMeta(array(
		array("lookup","Lookup","fa fa-lookup"),
		array("manage","Manage","fa fa-manage"),
	));
	$panel->PageBreadcrumb();
	$panel->EchoViewInterface();
?>
<script>
	var plugins = [
		'apps/counting/include/interface.js',
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
				if($os->allow("counting","add"))include "control/controller.add.js";
				if($os->allow("counting","edit"))include "control/controller.edit.js";
				if($os->allow("counting","edit"))include "control/controller.close.js";
				if($os->allow("counting","edit"))include "control/controller.start.js";
				break;
				break;
			case "lookup":
				if($os->allow("counting","view"))include "control/controller.lookup.js";
				break;
			case "manage":
				include "control/controller.manage.js";
				break;
		}
	?>
	}).then(() => App.stopLoading())
</script>
