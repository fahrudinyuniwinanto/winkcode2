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
                    <h2 style="margin-top:0px"><?php echo $button ?> Sy_link </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="varchar">Rel <?php echo form_error('rel') ?></label>
            <input type="text" class="form-control" name="rel" id="rel" placeholder="Rel" value="<?php echo $rel; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tbl1 <?php echo form_error('tbl1') ?></label>
            <input type="text" class="form-control" name="tbl1" id="tbl1" placeholder="Tbl1" value="<?php echo $tbl1; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tbl2 <?php echo form_error('tbl2') ?></label>
            <input type="text" class="form-control" name="tbl2" id="tbl2" placeholder="Tbl2" value="<?php echo $tbl2; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Tblid1 <?php echo form_error('tblid1') ?></label>
            <input type="text" class="form-control" name="tblid1" id="tblid1" placeholder="Tblid1" value="<?php echo $tblid1; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Tblid2 <?php echo form_error('tblid2') ?></label>
            <input type="text" class="form-control" name="tblid2" id="tblid2" placeholder="Tblid2" value="<?php echo $tblid2; ?>" />
        </div>
	    <div class="form-group">
            <label for="note">Note <?php echo form_error('note') ?></label>
            <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo $note; ?></textarea>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('sy_link') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>