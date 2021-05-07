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
                    <h2 style="margin-top:0px"><?php echo $button ?> Konfigurasi </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="varchar">Conf Name <?php echo form_error('conf_name') ?></label>
            <input type="text" class="form-control" name="conf_name" id="conf_name" placeholder="Conf Name" value="<?php echo $conf_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="conf_val">Conf Val <?php echo form_error('conf_val') ?></label>
            <textarea class="form-control" rows="3" name="conf_val" id="conf_val" placeholder="Conf Val"><?php echo $conf_val; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="note">Note <?php echo form_error('note') ?></label>
            <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo $note; ?></textarea>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('konfigurasi') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>