<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="row" style="height: 100%">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h2 style="margin-top:0px"><?php echo $button ?> Users </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="col-md-6">
        <div class="form-group">
            <label for="varchar">Fullname <?php echo form_error('fullname') ?></label>
            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Fullname" value="<?php echo $fullname; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Kosongkan jika tidak ingin merubah password" />
        </div>
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Id Group <?php echo form_error('id_group') ?></label>
            <div class="input-group">
            <input type="hidden" name="id_group" id="id_group" value="<?php echo $id_group; ?>" />
            <input type="text" class="form-control" name="nm_id_group" id="nm_id_group" placeholder="User Group" value="<?php echo $nm_id_group; ?>" readonly/>
            <div class="input-group-addon">
                <span onclick="lookup('<?=base_url()?>User_group/lookup','id_group');" style="cursor: pointer;">Cari</span>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label for="varchar">Foto <?php echo form_error('foto') ?></label>
            <input type="text" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" readonly/>
        </div>
        </div>
        <div class="col-md-6">
        
        <div class="form-group">
            <label for="varchar">Telp <?php echo form_error('telp') ?></label>
            <input type="text" class="form-control numeric" name="telp" id="telp" placeholder="Telp" value="<?php echo $telp; ?>" />
        </div>
	    <div class="form-group">
            <label for="note">Note <?php echo form_error('note') ?></label>
            <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo $note; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="int">Created By <?php echo form_error('created_by') ?></label>
            <input type="text" class="form-control" name="created_by" id="created_by" placeholder="Created By" value="<?php echo $created_by; ?>" readonly/>
        </div>
	    <div class="form-group">
            <label for="int">Updated By <?php echo form_error('updated_by') ?></label>
            <input type="text" class="form-control" name="updated_by" id="updated_by" placeholder="Updated By" value="<?php echo $updated_by; ?>" readonly/>
        </div>
	    <div class="form-group">
            <label for="datetime">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" readonly/>
        </div>
	    <div class="form-group">
            <label for="datetime">Updated At <?php echo form_error('updated_at') ?></label>
            <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" readonly/>
        </div>
	    <div class="form-group hide">
            <label for="note_1">Note 1 <?php echo form_error('note_1') ?></label>
            <textarea class="form-control" rows="3" name="note_1" id="note_1" placeholder="Note 1"><?php echo $note_1; ?></textarea>
        </div>
        </div>
	    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('users') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
        </div>
    </body>
</html>