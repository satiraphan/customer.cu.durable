
fn.app.counting.report = function (id) {

    var form = $('form[name=export_report]');
    form.attr("method","post");
    form.attr("action",'apps/counting/doc/report_'+id+'_xlsx.php');
    form.attr("target","_blank");
    form.attr("onsubmit","");
    form.submit();

    return false;

}
