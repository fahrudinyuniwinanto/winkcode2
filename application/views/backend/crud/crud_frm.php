<style type="text/css">
.code {
    background-color: #EEEEEE;
    font-family: Consolas, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New;
    font-size: x-small !important;
}
</style>
<div class="ibox">
    <div class="ibox-title">
        Table Description of Database "
        <?=$db?>"
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-6">
                <label>Table Name</label>
                <select class="form-control input-sm" ng-model="h.table">
                    <?php foreach ($tables as $k => $v): ?>
                    <option value="<?=$v['TABLE_NAME']?>">
                        <?=$v['TABLE_TYPE']?> :
                        <?=$v['TABLE_NAME']?> (
                        <?=$v['TABLE_ROWS']?> Rows)</option>
                    <?php endforeach?>
                </select>
            </div>
            <div class="col-sm-3">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-sm btn-primary btn-block" ng-click="loadFields();">Load Data</button>
            </div>
        </div>
        <hr>
        <div class="" ng-if="fields.length>0">
            <div class="tabs-container">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a class="nav-link active" data-toggle="tab" href="#tab-1">Setting</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-2">Model</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-3">Controller</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-4">View</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Primary Key</label>
                                    <select ng-model="h.pk" class="form-control input-sm ">
                                        <option ng-repeat="v in fields" ng-value="v.COLUMN_NAME">{{v.COLUMN_NAME}}</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-sm btn-primary btn-block" ng-click="loadCode();">Generate</button>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-condensed table-bordered" style="white-space: nowrap;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Field Name</th>
                                            <th>Type</th>
                                            <th>Caption</th>
                                            <th>Element</th>
                                            <th>Key</th>
                                            <th>Null</th>
                                            <th>Extra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="v in fields">
                                            <td class="text-right">{{$index+1}}</td>
                                            <td>{{v.COLUMN_NAME}}</td>
                                            <td>{{v.COLUMN_TYPE}}</td>
                                            <td class="p-0">
                                                <input type="text" ng-model="v.CAPTION" class="form-control input-sm no-border-text text-success">
                                            </td>
                                            <td class="p-0">
                                                <select ng-model="v.ELEMENT" class="form-control input-sm no-border-text">
                                                    <option ng-repeat="va in ['TEXT','EMAIL','PASSWORD','SELECT','TEXTAREA','LOOKUP','NUMBER','DATE','LABEL','NONE']" ng-value="va">{{va}}</option>
                                                </select>
                                            </td>
                                            <td>{{v.COLUMN_KEY}}</td>
                                            <td>{{v.IS_NULLABLE}}</td>
                                            <td>{{v.EXTRA}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <div class="pull-right">
                                <button type="button" class="btn btn-sm btn-primary" ng-click="writeTo('model')">Write to File</button>
                            </div>
                            <h3 class="text-success">Model</h3>
                            <div class="text-success">Path : {{res.path_model}}</div>
                            <textarea class="form-control input-sm code" ng-model="res.model" rows="20"></textarea>
                        </div>
                    </div>
                    <div role="tabpanel" id="tab-3" class="tab-pane">
                        <div class="panel-body">
                            <div class="pull-right">
                                <button type="button" class="btn btn-sm btn-primary" ng-click="writeTo('controller')">Write to File</button>
                            </div>
                            <h3 class="text-success">Controller</h3>
                            <div class="text-success">Path : {{res.path_controller}}</div>
                            <textarea class="form-control input-sm code" ng-model="res.controller" rows="20"></textarea>
                        </div>
                    </div>
                    <div role="tabpanel" id="tab-4" class="tab-pane">
                        <div class="panel-body">
                            <div class="pull-right">
                                <button type="button" class="btn btn-sm btn-primary" ng-click="writeTo('view')">Write to File</button>
                            </div>
                            <h3 class="text-success">View</h3>
                            <div class="text-success">Path : {{res.path_view}}</div>
                            <textarea class="form-control input-sm code" ng-model="res.view" rows="20"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?=base_url()?>crud");
    $scope.f = { crud: 'c', tab: 'list' };
    $scope.h = { db: "<?=$db?>", table: '' };
    $scope.res = { model: '', controller: '', form: '' };
    $scope.fields = [];

    $scope.loadFields = function() {
        SfService.get(SfService.getUrl("/getFields"), { db: $scope.h.db, table: $scope.h.table }, function(jdata) {
            $scope.fields = jdata.data.fields;
            $scope.h.pk = jdata.data.pk;
        });
    }

    $scope.loadCode = function() {
        SfService.post(SfService.getUrl("/getCode"), { h: $scope.h, fields: $scope.fields }, function(jdata) {
            $scope.res = jdata.data.res;
        });
    }

    $scope.writeTo = function(icase) {
        switch (icase) {
            case 'model':
                SfService.post(SfService.getUrl("/writeTo"), { path:$scope.res.path_model,code:$scope.res.model }, function(jdata) {
                    swal("",jdata.data,"success");
                });
                break;
            case 'controller':
                SfService.post(SfService.getUrl("/writeTo"), { path:$scope.res.path_controller,code:$scope.res.controller }, function(jdata) {
                    swal("",jdata.data,"success");
                });
                break;
            case 'view':
                SfService.post(SfService.getUrl("/writeTo"), { path:$scope.res.path_view,code:$scope.res.view}, function(jdata) {
                    swal("",jdata.data,"success");
                });
                break;
        }
    }


}]);
</script>