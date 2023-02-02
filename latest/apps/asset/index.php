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

	$panel->setApp("asset","Asset");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'view');

	$panel->setMeta(array(
		array("add","Add","fa fa-circle-plus"),
		array("edit","Edit","fa fa-pen"),
		array("view","View","fa fa-eye"),
	));
	$panel->PageBreadcrumb();
	$panel->EchoViewInterface();
?>
<script>
	var plugins = [
		'apps/asset/include/interface.js',
		'plugins/datatables/dataTables.bootstrap4.min.css',
		'plugins/datatables/responsive.bootstrap4.min.css',
		'plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js',
		'plugins/select2/css/select2.min.css',
		'plugins/select2/js/select2.min.js',
		'plugins/moment/moment.min.js',
		'plugins/davidshimjs/qrcode.min.js'
	];
	App.loadPlugins(plugins, null).then(() => {
		App.checkAll()
	<?php
		switch($panel->getView()){
			case "add":
				if($os->allow("asset","add"))include "control/controller.add.js";
				break;
			case "edit":
				if($os->allow("asset","edit"))include "control/controller.edit.js";
				break;
			case "view":
				include "control/controller.view.js";
				if($os->allow("asset","edit"))include "control/controller.photo.js";
				if($os->allow("asset","remove"))include "control/controller.remove.js";
				break;
			case "lookup":
				include "control/controller.lookup.js";
				break;
			case "tags":
				include "control/controller.tag.js";
				break;
			case "gallery":
				include "control/controller.gallery.js";
				break;
		}
	?>
	}).then(() => App.stopLoading())
</script>
