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
                    <h2 style="margin-top:0px"><?php echo $button ?> Kategori </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="varchar">Cat Name <?php echo form_error('cat_name') ?></label>
            <input type="text" class="form-control" name="cat_name" id="cat_name" placeholder="Cat Name" value="<?php echo $cat_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="note">Note <?php echo form_error('note') ?></label>
            <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo $note; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">For Modul <?php echo form_error('for_modul') ?></label>
            <input type="text" class="form-control" name="for_modul" id="for_modul" placeholder="For Modul" value="<?php echo $for_modul; ?>" />
        </div>
	    <input type="hidden" name="id_kat" value="<?php echo $id_kat; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kategori') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>