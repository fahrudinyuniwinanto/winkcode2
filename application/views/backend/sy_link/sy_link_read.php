<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h2 style="margin-top:0px">Sy_link Read</h2>
            <div class="ibox-tools">
            </div>
        </div>
        <div class="ibox-content">
        
        <table class="table">
	    <tr><td>Rel</td><td><?php echo $rel; ?></td></tr>
	    <tr><td>Tbl1</td><td><?php echo $tbl1; ?></td></tr>
	    <tr><td>Tbl2</td><td><?php echo $tbl2; ?></td></tr>
	    <tr><td>Tblid1</td><td><?php echo $tblid1; ?></td></tr>
	    <tr><td>Tblid2</td><td><?php echo $tblid2; ?></td></tr>
	    <tr><td>Note</td><td><?php echo $note; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('sy_link') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>