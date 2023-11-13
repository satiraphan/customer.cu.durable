
fn.app.accctrl.report = function () {

    var form = $('form[name=export_report]');
    form.attr("method","post");
    form.attr("action",'apps/accctrl/doc/report_log_xlsx.php');
    form.attr("target","_blank");
    form.attr("onsubmit","");
    form.submit();

    return false;

}
