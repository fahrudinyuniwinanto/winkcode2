<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h2 style="margin-top:0px">Konfigurasi Read</h2>
            <div class="ibox-tools">
            </div>
        </div>
        <div class="ibox-content">
        
        <table class="table">
	    <tr><td>Conf Name</td><td><?php echo $conf_name; ?></td></tr>
	    <tr><td>Conf Val</td><td><?php echo $conf_val; ?></td></tr>
	    <tr><td>Note</td><td><?php echo $note; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('konfigurasi') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>