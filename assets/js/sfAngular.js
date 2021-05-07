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

app.directive('stringToNumber', function() { //untuk menampilkan number ke input number
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, ngModel) {
            ngModel.$parsers.push(function(value) {
                return '' + value;
            });
            ngModel.$formatters.push(function(value) {
                return parseFloat(value, 10);
            });
        }
    };
});



app.directive('convertToNumber', function() { //untuk menampilkan number ke select atau radio
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, ngModel) {
            ngModel.$parsers.push(function(val) {
                return parseInt(val, 10);
            });
            ngModel.$formatters.push(function(val) {
                return '' + val;
            });
        }
    };
});


app.directive('format', ['$filter', function($filter) {
    /*
    cara pakai :
     <input type="text" ng-model="..." ng-pattern="/[0-9.,]+/" format="number">
     atau yg baru pakai :
     <input type="text" ng-model="..." ng-pattern="[0-9]+([\.,][0-9]+)*" format="number">
    */
    return {
        require: '?ngModel',
        link: function(scope, elem, attrs, ctrl) {
            if (!ctrl) return;


            ctrl.$formatters.unshift(function(a) {
                return $filter(attrs.format)(ctrl.$modelValue)
            });


            ctrl.$parsers.unshift(function(viewValue) {
                var plainNumber = viewValue.replace(/[^\d|\-+|\.+]/g, '');
                elem.val($filter(attrs.format)(plainNumber));
                return plainNumber;
            });
        }
    };
}]);


app.directive('ngThumb', ['$window', function($window) {
    var helper = {
        support: !!($window.FileReader && $window.CanvasRenderingContext2D),
        isFile: function(item) {
            return angular.isObject(item) && item instanceof $window.File;
        },
        isImage: function(file) {
            var type = '|' + file.type.slice(file.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
    };

    return {
        restrict: 'A',
        template: '<canvas/>',
        link: function(scope, element, attributes) {
            if (!helper.support) return;

            var params = scope.$eval(attributes.ngThumb);

            if (!helper.isFile(params.file)) return;
            if (!helper.isImage(params.file)) return;

            var canvas = element.find('canvas');
            var reader = new FileReader();

            reader.onload = onLoadFile;
            reader.readAsDataURL(params.file);

            function onLoadFile(event) {
                var img = new Image();
                img.onload = onLoadImage;
                img.src = event.target.result;
            }

            function onLoadImage() {
                var width = params.width || this.width / this.height * params.height;
                var height = params.height || this.height / this.width * params.width;
                canvas.attr({ width: width, height: height });
                canvas[0].getContext('2d').drawImage(this, 0, 0, width, height);
            }
        }
    };
}]);

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

    this.httpGet = function(url, param, fn, isSilentMode) {
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

    this.httpPost = function(url, param, fn, isSilentMode) {
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

    this.get = function(url, param, fn, isSilentMode) {
        this.httpGet(url, param, fn, isSilentMode);
    }

    this.post = function(url, param, fn, isSilentMode) {
        this.httpPost(url, param, fn, isSilentMode);
    }
    this.typeahead = function(url, param, fn) {
        return $http.get(url, {
            params: param
        }).then(function(jdata) {
            return jdata.data;
        }, function(error) {
            return [];
        });

    }

}]);

app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', '$cookies',
    function($scope, $http, NgTableParams, SfService, $cookies) {}
]);

app.controller('topCtrl', ['$scope', '$http', 'NgTableParams', 'SfService',
    function($scope, $http, NgTableParams, SfService) {
        $scope.notif = [{
            subj: 'Welcome',
            body: 'SF3 Framework',
            note: "You're running with Angular & Laravel",
            icon: 'fa fa-envelope bg-blue',
            url: ''
        }];
    }
]);