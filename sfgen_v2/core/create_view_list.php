<?php 

$string = "<!doctype html>
<!--Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode-->
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class=\"row\">
        <div class=\"col-lg-12\">
            <div class=\"ibox float-e-margins\">
                <div class=\"ibox-title\">
                    <h2><b>List ".ucfirst($table_name)."</b></h2>
                    <?php if (\$this->session->userdata('message') != '') {?>
                    <div class=\"alert alert-success alert-dismissable\">
                                <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                                <?=\$this->session->userdata('message')?> <a class=\"alert-link\" href=\"#\"></a>
                    </div>
                 <?php }?>
                </div>
                <div class=\"ibox-content\">
        <div class=\"row\" style=\"margin-bottom: 10px\">
            <div class=\"col-md-8\">
                <?php echo anchor(site_url('".$c_url."/create'),'Create', 'class=\"btn btn-primary\"'); ?>
            </div>
            
            
            <div class=\"col-md-1 text-right\">
            </div>
            <div class=\"col-md-3 text-right\">
                <form action=\"<?php echo site_url('$c_url/index'); ?>\" class=\"form-inline\" method=\"get\">
                    <div class=\"input-group\">
                        <input type=\"text\" class=\"form-control\" name=\"q\" value=\"<?php echo \$q; ?>\">
                        <span class=\"input-group-btn\">
                            <?php 
                                if (\$q <> '')
                                {
                                    ?>
                                    <a href=\"<?php echo site_url('$c_url'); ?>\" class=\"btn btn-default\">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class=\"btn btn-primary\" type=\"submit\">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class=\"table table-bordered table-hover table-condensed\" style=\"margin-bottom: 10px\">
            <thead class=\"thead-light\">
            <tr>
                <th class=\"text-center\">No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t<th class=\"text-center\">" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t<th class=\"text-center\">Action</th>
            </tr>
            </thead>\n\t\t\t<tbody>";
$string .= "<?php
            foreach ($" . $c_url . "_data as \$$c_url)
            {
                ?>
                <tr>";

$string .= "\n\t\t\t<td width=\"80px\"><?php echo ++\$start ?></td>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t\t<td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
}


$string .= "\n\t\t\t<td style=\"text-align:center\" width=\"200px\">"
        . "\n\t\t\t\t<?php "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/read/'.$".$c_url."->".$pk."),'Read','class=\"text-navy\"'); "
        . "\n\t\t\t\techo ' | '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/update/'.$".$c_url."->".$pk."),'Update','class=\"text-navy\"'); "
        . "\n\t\t\t\techo ' | '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/delete/'.$".$c_url."->".$pk."),'Delete','class=\"text-navy\" onclick=\"javascript: return confirm(\\'Yakin hapus data?\\')\"'); "
        . "\n\t\t\t\t?>"
        . "\n\t\t\t</td>";

$string .=  "\n\t\t</tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class=\"row\">
            <div class=\"col-md-6\">
                <a href=\"#\" class=\"btn btn-primary\">Total Record : <?php echo \$total_rows ?></a>";
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), 'Excel', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), 'Word', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF', 'class=\"btn btn-primary\"'); ?>";
}
$string .= "\n\t    </div>
            <div class=\"col-md-6 text-right\">
                <?php echo \$pagination ?>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </body>
</html>";


$hasil_view_list = createFile($string, $target."views/backend/" . $c_url . "/" . $v_list_file);

?>