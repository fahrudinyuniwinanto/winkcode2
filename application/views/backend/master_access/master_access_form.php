<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h2 style="margin-top:0px"><?php echo $button ?> Master_access </h2>
                </div>

        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="row">
        <div class="col-lg-12">
        <div class="form-group">
            <label for="varchar">Nm Access <?php echo form_error('nm_access') ?></label>
            <input type="text" class="form-control" name="nm_access" id="nm_access" placeholder="Nm Access" value="<?php echo $nm_access; ?>" />
        </div>
	    <div class="form-group">
            <label for="note">Note <?php echo form_error('note') ?></label>
            <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo $note; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="datetime">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" readonly/>
        </div>
	    <div class="form-group">
            <label for="int">Created By <?php echo form_error('created_by') ?></label>
            <input type="text" class="form-control" name="created_by" id="created_by" placeholder="Created By" value="<?php echo $created_by; ?>"  readonly/>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('master_access') ?>" class="btn btn-default">Cancel</a>
	</div>
    </div>
    </div>
            </form>
        </div>
    </body>
</html>