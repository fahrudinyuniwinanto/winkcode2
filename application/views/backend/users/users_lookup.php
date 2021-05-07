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
                    <h2><b>List Users</b></h2>
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
               
            </div>
            
            
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('users/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" id="q" value="<?php echo @$_GET['q']; ?>">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-success" onclick="lookup('<?php echo base_url()?>users/lookup')" >Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr>
                <th class="text-center">No</th>
		<th class="text-center">Fullname</th>
		<th class="text-center">Username</th>
		<th class="text-center">Password</th>
		<th class="text-center">Email</th>
		<th class="text-center">Id Group</th>
		<th class="text-center">Foto</th>
		<th class="text-center">Telp</th>
		<th class="text-center">Note</th>
		<th class="text-center">Created By</th>
		<th class="text-center">Updated By</th>
		<th class="text-center">Created At</th>
		<th class="text-center">Updated At</th>
		<th class="text-center">Note 1</th></tr>
            </thead>
			<tbody><?php
            foreach ($users_data as $users)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $users->fullname ?></td>
			<td><?php echo $users->username ?></td>
			<td><?php echo $users->password ?></td>
			<td><?php echo $users->email ?></td>
			<td><?php echo $users->id_group ?></td>
			<td><?php echo $users->foto ?></td>
			<td><?php echo $users->telp ?></td>
			<td><?php echo $users->note ?></td>
			<td><?php echo $users->created_by ?></td>
			<td><?php echo $users->updated_by ?></td>
			<td><?php echo $users->created_at ?></td>
			<td><?php echo $users->updated_at ?></td>
			<td><?php echo $users->note_1 ?></td>
		</tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </body>
</html>