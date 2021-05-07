<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h2 style="margin-top:0px">User_access Read</h2>
            <div class="ibox-tools">
            </div>
        </div>
        <div class="ibox-content">
        
        <table class="table">
	    <tr><td>Id Group</td><td><?php echo $id_group; ?></td></tr>
	    <tr><td>Kd Access</td><td><?php echo $kd_access; ?></td></tr>
	    <tr><td>Nm Access</td><td><?php echo $nm_access; ?></td></tr>
	    <tr><td>Is Allow</td><td><?php echo $is_allow; ?></td></tr>
	    <tr><td>Note</td><td><?php echo $note; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('user_access') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>