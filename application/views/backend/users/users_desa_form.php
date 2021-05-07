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
                    <h2 style="margin-top:0px"><?php echo $button ?> Desa </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
        <div class="col-md-6">
	    <div class="form-group">
            <label for="varchar">Nama Desa <?php echo form_error('fullname') ?></label>
            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Nama Desa" value="<?php echo $fullname; ?>" />
        </div>
	    <div class="form-group hide">
            <label for="varchar">Username Desa <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group hide">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Kosongkan jika tidak merubah password" value="" />
        </div>
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
        </div>
        <div class="form-group hide">
            <label for="varchar">Foto <?php echo form_error('foto') ?></label>
            <input type="text" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" />
        </div>

        <div class="form-group">
            <label for="varchar">Telp <?php echo form_error('telp') ?></label>
            <input type="text" class="form-control" name="telp" id="telp" placeholder="Telp" value="<?php echo $telp; ?>" />
        </div>
        </div>
        <div class="col-md-6">
	    
	    
	    <div class="form-group">
            <label for="note">Note <?php echo form_error('note') ?></label>
            <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo $note; ?></textarea>
        </div>
	    <div class="form-group hide">
            <label for="int">Created By <?php echo form_error('created_by') ?></label>
            <input type="text" class="form-control" name="created_by" id="created_by" placeholder="Created By" value="<?php echo $created_by; ?>" />
        </div>
	    <div class="form-group hide">
            <label for="int">Update By <?php echo form_error('update_by') ?></label>
            <input type="text" class="form-control" name="update_by" id="update_by" placeholder="Update By" value="<?php echo $update_by; ?>" />
        </div>
	    <div class="form-group hide">
            <label for="datetime">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div>
	    <div class="form-group hide">
            <label for="datetime">Update At <?php echo form_error('update_at') ?></label>
            <input type="text" class="form-control" name="update_at" id="update_at" placeholder="Update At" value="<?php echo $update_at; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Kecamatan <?php echo form_error('id_parent') ?></label>
            <div class="input-group">
            <input type="hidden" class="form-control" name="id_parent" id="id_parent" placeholder="Id Parent" value="<?php echo $id_parent; ?>" />
            <input type="text" class="form-control" name="nm_id_parent" id="nm_id_parent" placeholder="" value="<?=$nm_id_parent?>" readonly="" />
            <div class="input-group-addon">
                <span onclick="lookup('<?=base_url()?>Users/lookup_kecamatan','id_parent');" style="cursor: pointer;">Cari</span>
            </div>
        </div>
        </div>
        </div>
	    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('users/index_desa') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>