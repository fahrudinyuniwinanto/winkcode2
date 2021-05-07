<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
        </div>
        <h3>Daftar Konsultasi</h3>
    </div>
    <div class="ibox-content form-inline">
        <div class="input-group m-b">
            <input type="text" ng-model="f.q" class="form-control input-sm" placeholder="" ng-enter ="getList()">
            <span class="input-group-addon pointer" ng-click="getList()">Cari</span>
        </div>
        <div id="div1" class="table-responsive">
            <table ng-table="tableList" show-filter="false" class="table table-condensed table-bordered table-hover" style="white-space: nowrap;">
                <tr ng-repeat="(k,v) in $data" class="pointer" ng-click="read(v.id)">
                    <td title="'No'">{{k+1}}</td>
                    <td title="'NRK/NIP'" filter="{nip: 'text'}" sortable="'nip'">{{v.nip}}</td>
                    <td title="'Nama'" filter="{nama: 'text'}" sortable="'nama'">{{v.nama}}</td>
                    <td title="'Email'" filter="{email: 'text'}" sortable="'email'">{{v.email}}</td>
                    <td title="'Nomor Telepon'" filter="{nomor_telepon: 'text'}" sortable="'nomor_telepon'">{{v.nomor_telepon}}</td>
                    <td title="'SKPD/UKPD'" filter="{skpd: 'text'}" sortable="'skpd'">{{v.skpd}}</td>
                    <td title="'Permasalahan'" filter="{permasalahan: 'text'}" sortable="'permasalahan'">{{v.permasalahan}}</td>
                    <td title="'Uraian Permasalahan'" filter="{uraian_permasalahan: 'text'}" sortable="'uraian_permasalahan'">{{v.uraian_permasalahan}}</td>
                    <td title="'Isactive'" filter="{isactive: 'text'}" sortable="'isactive'">{{v.isactive}}</td>
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
        <h3>Form Konsultasi</h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-4">
                <label class="hide" title="id">ID</label>
                <input type="text" ng-model="h.id" class="form-control input-sm hide" >
                <label title="nip">NRK/NIP</label>
                <input type="text" ng-model="h.nip" class="form-control input-sm numeric">
                <label title="nama">Nama</label>
                <input type="text" ng-model="h.nama" class="form-control input-sm" >
                <label title="email">Email</label>
                <input type="email" ng-model="h.email" class="form-control input-sm">
                <label title="nomor_telepon">Nomor Telepon</label>
                <input type="text" ng-model="h.nomor_telepon" class="form-control input-sm numeric">
            </div>
            <div class="col-sm-6">

                <label title="skpd">SKPD/UKPD</label>
                <div class="input-group">
                    <input type="text" ng-model="h.nm_skpd" class="form-control input-sm" placeholder="" readonly>
                    <span class="input-group-addon pointer" ng-click="lookup('skpd')">Cari</span>
                </div>
                <label title="permasalahan">Permasalahan</label>
                <div class="input-group">
                    <input type="text" ng-model="h.nm_permasalahan" class="form-control input-sm" placeholder="" readonly>
                    <span class="input-group-addon pointer" ng-click="lookup('permasalahan')">Cari</span>
                </div>
                <label title="uraian_permasalahan">Uraian Permasalahan</label>
                <textarea ng-model="h.uraian_permasalahan" class="form-control input-sm" rows="4"></textarea>
                <label class="hide" title="updated_at">Updated At</label>
                <input type="text" ng-model="h.updated_at" class="form-control input-sm hide" >
                <label class="hide"  title="updated_by">Updated By</label>
                <input type="text" ng-model="h.updated_by" class="form-control input-sm hide" >
                <label class="hide"  title="isactive">Isactive</label>
                <input type="text" ng-model="h.isactive" class="form-control input-sm hide" >
            </div>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?=base_url()?>konsultasi");
    $scope.f = { crud: 'c', tab: 'list', pk: 'id' };
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
            case 'skpd':
                SfLookup("<?=base_url()?>instansi/lookup", function(id,name,json) {
                    $scope.h.skpd=id;
                    $scope.h.nm_skpd=json.nama_instansi;
                    $scope.$apply();
                });
                break;
                 case 'permasalahan':
                SfLookup("<?=base_url()?>permasalahan/lookup", function(id,name,json) {
                    $scope.h.permasalahan=id;
                    $scope.h.nm_permasalahan=json.permasalahan;
                    $scope.$apply();
                });
                break;
            default:
                swal('Pilihan tidak tersedia');
                break;
        }
    }

    $scope.getList();

}]);
</script>