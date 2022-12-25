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
	$panel->setView(isset($_GET['view'])?$_GET['view']:'count');

	$panel->setMeta(array(
		array("count","Count","far fa-user"),
		array("manage","Manage","far fa-user"),
		array("history","History","far fa-user"),
	));
	$panel->PageBreadcrumb();
?>
<div class="row">
	<div class="col-xl-12">
	<?php
		$panel->EchoInterface();
	?>
	</div>
</div>
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
			case "count":
				//include "control/controller.count.view.js";
				if($os->allow("counting","add"))include "control/controller.count.add.js";
				if($os->allow("counting","edit"))include "control/controller.count.edit.js";
				if($os->allow("counting","remove"))include "control/controller.count.remove.js";
				//if($os->allow("counting","assign"))include "control/controller.count.assign.js";
				//if($os->allow("counting","start"))include "control/controller.count.start.js";
				//if($os->allow("counting","end"))include "control/controller.count.end.js";
				break;
			case "manage":
			//	include "control/controller.manage.view.js";
			//	if($os->allow("counting","add"))include "control/controller.manage.add.js";
			//	if($os->allow("counting","edit"))include "control/controller.manage.edit.js";
				//if($os->allow("counting","remove"))include "control/controller.manage.remove.js";
				//if($os->allow("counting","approve"))include "control/controller.manage.approve.js";
				break;
			case "history":
			//	include "control/controller.history.view.js";
				//if($os->allow("counting","view"))include "control/controller.history.view.js";
				break;
}
	?>
	}).then(() => App.stopLoading())
</script>
