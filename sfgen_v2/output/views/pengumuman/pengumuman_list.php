<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Pengumuman List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('pengumuman/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('pengumuman/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pengumuman'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Judul</th>
		<th>Perihal</th>
		<th>Isi</th>
		<th>Tgl Pengumuman</th>
		<th>Jam Pengumuman</th>
		<th>Created By</th>
		<th>Update By</th>
		<th>Created At</th>
		<th>Update At</th>
		<th>Isactive</th>
		<th>Action</th>
            </tr><?php
            foreach ($pengumuman_data as $pengumuman)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $pengumuman->judul ?></td>
			<td><?php echo $pengumuman->perihal ?></td>
			<td><?php echo $pengumuman->isi ?></td>
			<td><?php echo $pengumuman->tgl_pengumuman ?></td>
			<td><?php echo $pengumuman->jam_pengumuman ?></td>
			<td><?php echo $pengumuman->created_by ?></td>
			<td><?php echo $pengumuman->update_by ?></td>
			<td><?php echo $pengumuman->created_at ?></td>
			<td><?php echo $pengumuman->update_at ?></td>
			<td><?php echo $pengumuman->isactive ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('pengumuman/read/'.$pengumuman->id_pengumuman),'Read'); 
				echo ' | '; 
				echo anchor(site_url('pengumuman/update/'.$pengumuman->id_pengumuman),'Update'); 
				echo ' | '; 
				echo anchor(site_url('pengumuman/delete/'.$pengumuman->id_pengumuman),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>