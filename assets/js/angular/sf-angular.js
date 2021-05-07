var app = angular.module('sfApp', ['ngSanitize', 'ngTable', 'angularFileUpload', 'ngCookies', 'dynamicNumber', 'mgcrea.ngStrap']);

var token = $('meta[name="csrf-token"]').attr('content');
app.config(['$httpProvider', function($httpProvider) {
    $httpProvider.defaults.headers.common["X-CSRF-TOKEN"] = token;
}]);

app.config(['dynamicNumberStrategyProvider', function(dynamicNumberStrategyProvider) {
    /**
    https://github.com/uhlryk/angular-dynamic-number
    <input type="text" ng-trim=false ng-model="value1" class="form-control" awnum num-int=16 num-fract=3 num-thousand=true>
    <input type="text" ng-trim=false ng-model="value2" class="form-control" awnum="price">
    */
    dynamicNumberStrategyProvider.addStrategy('price', {
        numInt: 25,
        numFract: 2,
        numSep: '.',
        numPos: true,
        numNeg: true,
        // numRound: 'round',
        numThousand: true,
        numThousandSep: ','
    });
    dynamicNumberStrategyProvider.addStrategy('vol', {
        numInt: 25,
        numFract: 3,
        numSep: '.',
        numPos: true,
        numNeg: true,
        // numRound: 'round',
        numThousand: true,
        numThousandSep: ','
    });
    dynamicNumberStrategyProvider.addStrategy('default', {
        numInt: 25,
        numFract: 10,
        numSep: '.',
        numPos: true,
        numNeg: true,
        // numRound: 'round',
        numThousand: true,
        numThousandSep: ','
    });
}]);

function mainCtrl() {
    return angular.element($("#mainCtrl")).scope();
}

function topCtrl() {
    return angular.element($("#topCtrl")).scope();
}

app.directive('ngEnter', function() {
    return function(scope, element, attrs) {
        element.bind("keydown keypress", function(event) {
            if (event.which === 13) {
                scope.$apply(function() {
                    scope.$eval(attrs.ngEnter);
                });
                event.preventDefault();
            }
        });
    };
});


app.service('SfService', ['$http', function($http) {
    this.url = "";
    this.setUrl = function(param) {
        this.url = param;
    }
    this.getUrl = function(param) {
        if (param == undefined) {
            param = "";
        }
        return this.url + param;
    }

    this.save = function(selector, url, param, fn) {
        if (SfFormValidate(selector) == false) {
            swal('', 'Data not valid', 'error');
            return false;
        }
        var $btn = $('button').button('loading');
        $http.post(url, param).then(function(jdata) {
            $btn.button('reset');
            if (fn) fn(jdata);
        }, function(error) {
            $btn.button('reset');
            swal('', error.data, 'error');
        });
    }

    this.show = function(url, param, fn) {
        var $btn = $('button').button('loading');
        $http.get(url, { params: param }).then(function(jdata) {
            $btn.button('reset');
            if (fn) fn(jdata);
        }, function(error) {
            $btn.button('reset');
            swal('', error.data, 'error');
            return false;
        });
    }

    this.delete = function(url, param, fn) {
        if (param.restore == 1) {
            var str = "restore";
        } else {
            var str = "delete";
        }
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, ' + str + ' it!'
        }).then((result) => {
            if (result.value) {
                var $btn = $('button').button('loading');
                $http.delete(url, { params: param }).then(function(jdata) {
                    $btn.button('reset');
                    swal(
                        'OK ' + str + 'd!',
                        'Your file has been ' + str + 'd.',
                        'success'
                    )
                    if (fn) fn(jdata);
                }, function(error) {
                    $btn.button('reset');
                    swal('', error.data, 'error');
                    return false;
                });

            }
        })
    }

    this.get = function(url, param, fn, isSilentMode) {
        var $btn = $('button').button('loading');
        $http.get(url, {
            params: param
        }).then(function(jdata) {
            $btn.button('reset');
            if (fn) fn(jdata);
            // return jdata.data.data.data;
        }, function(error) {
            $btn.button('reset');
            if (isSilentMode != 1) {
                if (error.data.message == undefined) {
                    swal('', error.data, 'error');
                } else {
                    swal('', error.data.message, 'error');

                }
            }
        });
    }

    this.post = function(url, param, fn, isSilentMode) {
        var $btn = $('button').button('loading');
        $http.post(url, param).then(function(jdata) {
            $btn.button('reset');
            if (fn) fn(jdata);
            // return jdata.data.data.data;
        }, function(error) {
            $btn.button('reset');
            if (isSilentMode != 1) {
                if (error.data.message == undefined) {
                    swal('', error.data, 'error');
                } else {
                    swal('', error.data.message, 'error');

                }
            }
        });
    }


}]);



app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', '$cookies',
    function($scope, $http, NgTableParams, SfService, $cookies) {}
]);

app.controller('topCtrl', ['$scope', '$http', 'NgTableParams', 'SfService',
    function($scope, $http, NgTableParams, SfService) {
        $scope.notif = [];
    }
]);