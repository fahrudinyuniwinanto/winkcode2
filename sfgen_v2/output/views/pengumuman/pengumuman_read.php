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
        <h2 style="margin-top:0px">Pengumuman Read</h2>
        <table class="table">
	    <tr><td>Judul</td><td><?php echo $judul; ?></td></tr>
	    <tr><td>Perihal</td><td><?php echo $perihal; ?></td></tr>
	    <tr><td>Isi</td><td><?php echo $isi; ?></td></tr>
	    <tr><td>Tgl Pengumuman</td><td><?php echo $tgl_pengumuman; ?></td></tr>
	    <tr><td>Jam Pengumuman</td><td><?php echo $jam_pengumuman; ?></td></tr>
	    <tr><td>Created By</td><td><?php echo $created_by; ?></td></tr>
	    <tr><td>Update By</td><td><?php echo $update_by; ?></td></tr>
	    <tr><td>Created At</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td>Update At</td><td><?php echo $update_at; ?></td></tr>
	    <tr><td>Isactive</td><td><?php echo $isactive; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pengumuman') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>