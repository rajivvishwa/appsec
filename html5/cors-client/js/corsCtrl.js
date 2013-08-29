
angular.module('CorsTest', ['ngResource']).controller('corsCtrl', function ($scope, $http, $resource) {
    $http.defaults.useXDomain = true;
    /*
     * AJAX request are also send with the X-Requested-With header, 
     * which indicate them as being AJAX. Removing the header is necessary, 
     * so the server is not rejecting the incoming request.
     */

    // var urlA2="../cors-server/test.json"; 
    //  var urlA1="http://ricardohbin.com/cors/testcors.php";

    delete $http.defaults.headers.common['X-Requested-With'];


    var urlA="http://rajivvishwa.kd.io/appsec/html5/cors-server/";
    var urlNA="http://api.twitter.com/help/test.json";
    var CORS_ERROR = "Error - Cors Not Enabled";
        
    $scope.isAllowed = function() {
        $http.get(url=urlA)
            .success(function(data,status) {
                $scope.corsData = data;
                $scope.corsURL = url;
                $scope.corsStatus = status;
            });
    };

    $scope.isNotAllowed = function() {
        $http.get(url=urlNA)
            .success(function(data) {
                $scope.corsData = data;
            })
            .error(function(data, status) {
                $scope.corsData = CORS_ERROR;
                $scope.corsURL = url;
                $scope.corsStatus = status;

            });
    };

    $scope.useResource = function() {
        var User = $resource(url=urlA1, {
            userId: '@id'
        });
        User.get({
            userId: 123
        }, function(data) {
            alert(data.ok);
        });
    };
});