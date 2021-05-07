<?php 

$string = "<!doctype html>
<!--Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode-->
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class=\"col-lg-12\">
    <div class=\"ibox float-e-margins\">
        <div class=\"ibox-title\">
            <h2 style=\"margin-top:0px\">".ucfirst($table_name)." Read</h2>
            <div class=\"ibox-tools\">
            </div>
        </div>
        <div class=\"ibox-content\">
        
        <table class=\"table\">";
foreach ($non_pk as $row) {
    $string .= "\n\t    <tr><td>".label($row["column_name"])."</td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}
$string .= "\n\t    <tr><td></td><td><a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-default\">Cancel</a></td></tr>";
$string .= "\n\t</table>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>";



$hasil_view_read = createFile($string, $target."views/backend/" . $c_url . "/" . $v_read_file);

?>