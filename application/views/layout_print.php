<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?=data_app()?>
    </title>
    <link href="<?=base_url()?>assets/vendor/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendor/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/print.css" rel="stylesheet">
    <script src="<?=base_url()?>assets/vendor/inspinia/js/jquery-2.1.1.js"></script>
    <script src="<?=base_url()?>assets/js/angular/sf3.js"></script>
</head>

<body>
    <div class="wrapper wrapper-content" ng-app="sfApp" ng-controller="mainCtrl" id="mainCtrl">
        <div class="text-center no-print" style="padding-top: 20px;">
            <a href="<?=base_url()?>backend" class="btn btn-sm btn-info"><i class="fa fa-arrow-left"></i>Kembali Ke
                Dashboard</a>
            <button type="button" class="btn btn-sm btn-primary" onclick="window.print()"> <i class="fa fa-print"></i>
                Cetak</button>
            <button type="button" class="btn btn-sm btn-primary" onclick="SfExportExcel('laporan_rkat')"> <i
                    class="fa fa-file"></i>
                Excel</button>
            <hr>
        </div>
        <?php $this->load->view($content);?>
    </div>
</body>

</html>