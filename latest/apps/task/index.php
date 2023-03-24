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

	$panel->setApp("task","Task");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'issue');

	$panel->setMeta(array(
		//array("count","ตรวจสอบรายงาน","far fa-user"),
		array("issue","Issue","far fa-user"),
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
		'apps/task/include/interface.js',
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
				include "control/controller.count.view.js";
				if($os->allow("task","add"))include "control/controller.count.add.js";
				if($os->allow("task","edit"))include "control/controller.count.edit.js";
				if($os->allow("task","remove"))include "control/controller.count.remove.js";
				if($os->allow("task","edit"))include "control/controller.count.check.js";
				if($os->allow("task","edit"))include "control/controller.count.create_task.js";
				break;
			case "issue":
				include "control/controller.issue.view.js";
				//if($os->allow("task","add"))include "control/controller.issue.add.js";
				if($os->allow("task","edit"))include "control/controller.issue.edit.js";
				if($os->allow("task","remove"))include "control/controller.issue.remove.js";
				if($os->allow("task","approve"))include "control/controller.issue.close.js";
				if($os->allow("task","approve"))include "control/controller.issue.action.js";
				break;
		}
	?>
	}).then(() => App.stopLoading())
</script>
