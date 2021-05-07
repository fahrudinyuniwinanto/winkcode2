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
                    <h2><b>List User_group</b></h2>
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
                <?php echo anchor(site_url('user_group/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            
            
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                 <form action="<?php echo site_url('Users/index_desa'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari" name="q" id="q" value="<?=@$_GET['q']?>">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success"  onclick="lookup('<?=base_url()?>User_group/lookup')" >Cari</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr >
                <th class="text-center">No</th>
		<th class="text-center">Group Name</th>
		<th class="text-center">Note</th>
            </tr>
            </thead>
			<tbody><?php
            foreach ($user_group_data as $user_group)
            {
                ?>
                <tr onclick="setVal('<?=$idhtml?>','<?=$user_group->id?>','<?=$user_group->group_name?>')" style="cursor: pointer;">
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $user_group->group_name ?></td>
			<td><?php echo $user_group->note ?></td>
			</td>
		</tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
       
        </div>
    </div>
    </div>
    </div>
    </body>
</html>