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
               
            </div>
            
            
            <div class=\"col-md-1 text-right\">
            </div>
            <div class=\"col-md-3 text-right\">
                <form action=\"<?php echo site_url('$c_url/index'); ?>\" class=\"form-inline\" method=\"get\">
                    <div class=\"input-group\">
                        <input type=\"text\" class=\"form-control\" name=\"q\" id=\"q\" value=\"<?php echo @\$_GET['q']; ?>\">
                        <span class=\"input-group-btn\">
                          <button type=\"button\" class=\"btn btn-success\" onclick=\"lookup('<?php echo base_url()?>".$c_url."/lookup')\" >Search</button>
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
$string .= "</tr>
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

$string .=  "\n\t\t</tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class=\"row\">
            <div class=\"col-md-6\">
                <a href=\"#\" class=\"btn btn-primary\">Total Record : <?php echo \$total_rows ?></a>";

$string .= "\n\t    </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </body>
</html>";


$hasil_view_lookup = createFile($string, $target."views/backend/" . $c_url . "/" . $v_lookup_file);

?>