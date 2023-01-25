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

	$panel->setApp("location","Location");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'building');

	$panel->setMeta(array(
		array("building","อาคาร","far fa-building"),
		array("floor","ชั้น/พื้นที่","far fa-layer-group"),
		array("room","ห้อง","far fa-person-shelter"),
	));
?>
<?php
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
		'apps/location/include/interface.js',
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
		include "control/controller.location.js";
		switch($panel->getView()){
			case "building":
				include "control/controller.building.view.js";
				if($os->allow("location","add"))include "control/controller.building.add.js";
				if($os->allow("location","edit"))include "control/controller.building.edit.js";
				if($os->allow("location","remove"))include "control/controller.building.remove.js";
				break;
			case "floor":
				include "control/controller.floor.view.js";
				if($os->allow("location","add"))include "control/controller.floor.add.js";
				if($os->allow("location","edit"))include "control/controller.floor.edit.js";
				if($os->allow("location","remove"))include "control/controller.floor.remove.js";
				break;
			case "room":
				include "control/controller.room.view.js";
				if($os->allow("location","add"))include "control/controller.room.add.js";
				if($os->allow("location","edit"))include "control/controller.room.edit.js";
				if($os->allow("location","remove"))include "control/controller.room.remove.js";
				break;
				
}
	?>
	}).then(() => App.stopLoading())
</script>
