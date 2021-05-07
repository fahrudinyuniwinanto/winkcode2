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
                    <h2><b>List Kecamatan
                    <?php if ($this->session->userdata('message') != '') {?>
                    <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?=$this->session->userdata('message')?> <a class="alert-link" href="#"></a>
                    </div>
                 <?php }?>
                </div>
                <div class="ibox-content">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-8">
                <?php echo anchor(site_url('users/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            
            
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('Users/index_kecamatan'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari" name="q" id="q" value="<?=@$_GET['q']?>">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success"  onclick="lookup('<?=base_url()?>Users/lookup')" >Cari</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr onclick="">
                <th class="text-center">No</th>
		<th class="text-center">Kecamatan</th>
		<th class="text-center">Email</th>
		<th class="text-center">Telp</th>
            </tr>
            </thead>
			<tbody><?php //echo "<pre>"; print_r($users_data);die();
            foreach ($users_data as $users)
            {
                ?>
                <tr onclick="setVal('<?=$idhtml?>','<?=$users->id_user?>','<?=$users->fullname?>')" style="cursor: pointer;">
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $users->fullname ?></td>
			<td><?php echo $users->email ?></td>
			<td><?php echo $users->telp ?></td>
		</tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6">
	    </div>
            <div class="col-md-6 text-right">
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </body>
</html>