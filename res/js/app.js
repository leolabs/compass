/**
 * Created with JetBrains PhpStorm.
 * User: leobernard
 * Date: 26.08.13
 * Time: 20:40
 * To change this template use File | Settings | File Templates.
 */

var password = "MeinSchlüssel";

var compassMain = angular.module("compassMain", ['ngResource'], function($routeProvider, $locationProvider){
    $routeProvider
        .when('/:customer', {
            templateUrl: '/res/templates/customer.html',
            controller: "CompassController"
        }).when('/:customer/:entry', {
            templateUrl: '/res/templates/detail.html',
            controller: "CompassController"
        }).otherwise({
            templateUrl: '/res/templates/welcome.html',
            controller: 'CompassController'
        })
});

compassMain.factory('CompassCat', function($resource){
    return $resource(
        "/api/categories/:id",
        {
            id: "@id"
        },
        {

        }
    )
});

compassMain.factory('CompassEntries', function($resource){
    return $resource(
        "/api/entries/:id",
        {
            id: "@id"
        },
        {

        }
    )
});

compassMain.factory('CompassUser', function($resource){
    return $resource(
        "/api/users/:id",
        {
            id: "@id"
        },
        {

        }
    )
});

compassMain.factory('CompassSettings', function(){
    var settings = {
        lang: "en",
        debug: true
    };

    return settings;
});

function CompassController($scope, $routeParams, $route, CompassCat, CompassEntries, CompassSettings){
    console.log(CompassCat.query());



    $scope.categories = CompassCat;
    $scope.entries = CompassEntries;
    $scope.params = $routeParams;
    $scope.appSettings = CompassSettings;

    $scope.$on('$routeChangeSuccess', function(){
        $scope.params = $route.current.params;
    });

    $scope.isActiveMenuLink = function(link){
        return link == $scope.params.customer ? "active" : "";
    }
}