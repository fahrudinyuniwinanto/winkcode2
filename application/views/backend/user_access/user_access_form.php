<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h2 style="margin-top:0px"><?php echo $button ?> User_access </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="int">Id Group <?php echo form_error('id_group') ?></label>
            <input type="text" class="form-control" name="id_group" id="id_group" placeholder="Id Group" value="<?php echo $id_group; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kd Access <?php echo form_error('kd_access') ?></label>
            <input type="text" class="form-control" name="kd_access" id="kd_access" placeholder="Kd Access" value="<?php echo $kd_access; ?>" />
        </div>
	    <div class="form-group">
            <label for="varbinary">Nm Access <?php echo form_error('nm_access') ?></label>
            <input type="text" class="form-control" name="nm_access" id="nm_access" placeholder="Nm Access" value="<?php echo $nm_access; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Is Allow <?php echo form_error('is_allow') ?></label>
            <input type="text" class="form-control" name="is_allow" id="is_allow" placeholder="Is Allow" value="<?php echo $is_allow; ?>" />
        </div>
	    <div class="form-group">
            <label for="note">Note <?php echo form_error('note') ?></label>
            <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo $note; ?></textarea>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('user_access') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>