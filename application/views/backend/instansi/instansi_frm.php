<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
        </div>
        <h3>Daftar Instansi</h3>
    </div>
    <div class="ibox-content form-inline">
        <div class="input-group m-b">
            <input type="text" ng-model="f.q" class="form-control input-sm" placeholder="" ng-enter ="getList()">
            <span class="input-group-addon pointer" ng-click="getList()">Cari</span>
        </div>
        <div id="div1" class="table-responsive">
            <table ng-table="tableList" show-filter="false" class="table table-condensed table-bordered table-hover" style="white-space: nowrap;">
                <tr ng-repeat="(k,v) in $data" class="pointer" ng-click="read(v.id_instansi)">
                    <td title="'No'">{{k+1}}</td>
                    <td title="'Id'" filter="{id_instansi: 'text'}" sortable="'id_instansi'">{{v.id_instansi}}</td>
                    <td title="'Kode Instansi'" filter="{kode_instansi: 'text'}" sortable="'kode_instansi'">{{v.kode_instansi}}</td>
                    <td title="'Nama Instansi'" filter="{nama_instansi: 'text'}" sortable="'nama_instansi'">{{v.nama_instansi}}</td>
                    <td title="'Kepala Instansi'" filter="{kepala_instansi: 'text'}" sortable="'kepala_instansi'">{{v.kepala_instansi}}</td>
                    <td title="'Alamat'" filter="{alamat: 'text'}" sortable="'alamat'">{{v.alamat}}</td>
                    <td title="'Nomor Telp'" filter="{no_telp: 'text'}" sortable="'no_telp'">{{v.no_telp}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="ibox float-e-margins" ng-show="f.tab=='frm'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-info" ng-click="f.tab='list'"><i class="fa fa-arrow-left"></i> Kembali</button>
            <button type="button" class="btn btn-sm btn-primary" ng-click="save()">Simpan</button>
            <button type="button" class="btn btn-sm btn-warning" ng-click="copy()" ng-if="f.crud=='u'">Duplikasi</button>
            <button type="button" class="btn btn-sm btn-warning" ng-click="prin()" ng-if="f.crud=='u'">Cetak</button>
            <button type="button" class="btn btn-sm btn-danger" ng-click="del()" ng-if="f.crud=='u'">Hapus</button>
        </div>
        <h3>Form Instansi</h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-4">
                <label title="id_instansi">ID</label>
                <input type="text" ng-model="h.id_instansi" class="form-control input-sm" >
                <label title="kode_instansi">Kode Instansi</label>
                <input type="text" ng-model="h.kode_instansi" class="form-control input-sm" >
                <label title="nama_instansi">Nama Instansi</label>
                <input type="text" ng-model="h.nama_instansi" class="form-control input-sm" >
                <label title="kepala_instansi">Kepala Instansi</label>
                <input type="text" ng-model="h.kepala_instansi" class="form-control input-sm" >
                <label title="alamat">Alamat</label>
                <textarea ng-model="h.alamat" class="form-control input-sm" rows="4"></textarea>
                <label title="no_telp">Nomor Telp</label>
                <input type="text" ng-model="h.no_telp" class="form-control input-sm" >
            </div>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?=base_url()?>instansi");
    $scope.f = { crud: 'c', tab: 'list', pk: 'id_instansi' };
    $scope.h = {};

    $scope.new = function() {
        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = {tanggal:moment().format('YYYY/MM/DD')};
    }

    $scope.copy=function(){
        $scope.f.crud='c';
        $scope.h[$scope.f.pk]='';
    }

    $scope.getList = function() {
        $scope.tableList = new NgTableParams({}, {
            getData: function($defer, params) {
                var $btn = $('button').button('loading');
                return $http.get(SfService.getUrl('/getList'), {
                    params: {
                    page: $scope.tableList.page(),
                    limit: $scope.tableList.count(),
                    order_by: $scope.tableList.orderBy(),
                    q: $scope.f.q
                    }
                }).then(function(jdata) {
                    $btn.button('reset');
                    $scope.tableList.total(jdata.data.total);
                    return jdata.data.data;
                }, function(error) {
                    $btn.button('reset');
                    swal('', error.data, 'error');
                });

            }
        });
    }

    $scope.save = function() {
        if (SfFormValidate('.frmEntry') == false) {
            swal('', 'Data not valid', 'error');
            return false;
        }

        SfService.post(SfService.getUrl('/save'), { f: $scope.f, h: $scope.h,fld_stat:""}, function(jdata) {
            console.log(jdata);
            $scope.f.tab = 'list';
            $scope.getList();
        });
    }

    $scope.read = function(id) {
        SfService.get(SfService.getUrl("/read/" + id), {}, function(jdata) {
            $scope.f.tab = 'frm';
            $scope.f.crud = 'u';
            $scope.h = jdata.data.h;
        });
    }

    $scope.del = function(id) {
        if (id == undefined) {
            var id = $scope.h[$scope.f.pk];
        }

        swal({
                title: "Perhatian",
                text: "Hapus data ini? id=" + id,
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false
            },
            function() {
                SfService.get(SfService.getUrl("/delete/" + id), {}, function(jdata) {
                    $scope.f.tab = 'list';
                    $scope.getList();
                    swal("Berhasil!", "Data berhasil dihapus.", "success");
                });
            });
    }

    $scope.prin = function(id) {
        if (id == undefined) {
            var id = $scope.h[$scope.f.pk];
        }
        window.open(SfService.getUrl('/prin') + "?id=" + encodeURI(id), 'print_' + id, 'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100').focus();
    }

    $scope.lookup = function(icase, fn) {
        switch (icase) {
            // case 'id_mustahik':
            //     SfLookup("<?=base_url()?>master_mustahik/lookup", function(id,name,json) {
            //         $scope.h.id_mustahik=id;
            //         $scope.h.nm_mustahik=name;
            //         $scope.$apply();
            //     });
            //     break;
            default:
                swal('Pilihan tidak tersedia');
                break;
        }
    }

    $scope.getList();

}]);
</script>