
fn.app.repair.report = function () {

    var form = $('form[name=export_report]');
    form.attr("method","post");
    form.attr("action",'apps/repair/doc/report_repair_xlsx.php');
    form.attr("target","_blank");
    form.attr("onsubmit","");
    form.submit();

    return false;

}
