<!doctype html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/vendor/radiocheck/radioonoff.css"/>
    </head>
    <body>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h2><b>List User_access</b></h2>
                    
                </div>
                <div class="ibox-content">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-8">
            </div>
            
            
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('user_access/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('user_access'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr>
                <th class="text-center">No</th>
		<th class="text-center">Group</th>
		<th class="text-center">Akses</th>
        <th class="text-center">Note</th>
		<th class="text-center">Status Aktif</th>
            </tr>
            </thead>
			<tbody><?php
            foreach ($user_access_data as $user_access)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $user_access->group_name ?></td>
			<td><?php echo $user_access->nm_access ?></td>
			<td><?php echo $user_access->note ?></td>
            <td align="center"><!-- Rounded switch -->
<label class="switch">
  <input type="checkbox" id="cek-<?=$user_access->id?>" onclick="aktifkan(<?=$user_access->id?>,<?=$user_access->id_user_group?>,<?=$user_access->id_master_access?>)" <?=$this->User_access_model->get_isallow($user_access->id_user_group,$user_access->id_master_access)?"checked":"";?> class="onoffswitch-checkbox"/>
  <span class="slider round"></span>
</label></td>
		</tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('user_access/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </body>
    <script type="text/javascript">
        function aktifkan(iduseraccess,idgroup,kdmasteraccess){
            if($('#cek-'+iduseraccess).is(':checked')){
                ischeck=1;
            }else{
                ischeck=0;
            }
            //alert(ischeck);
            $.post("<?=base_url().'user_access/aktifkan'?>", {iduseraccess: iduseraccess,idgroup:idgroup,kdmasteraccess:kdmasteraccess,ischeck:ischeck}, function(data, textStatus, xhr) {
                toastr.success("Telah diaktifkan",iduseraccess);
            });
        }
    </script>
</html>