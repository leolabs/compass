/**
 * Created with JetBrains PhpStorm.
 * User: leobernard
 * Date: 26.08.13
 * Time: 20:40
 * To change this template use File | Settings | File Templates.
 */

var compassMain = angular.module("compassMain", [], function($routeProvider, $locationProvider){
    $routeProvider
        .when('/:customer', {
            templateUrl: 'templates/customer.html',
            controller: "CompassController"
        }).otherwise({
            templateUrl: 'templates/welcome.html',
            controller: 'CompassController'
        })
});


compassMain.factory('CompassData', function(){
    var data = {
        "duplexmedia": {ID: 1, slug: "duplexmedia", name: 'Duplexmedia', entries: [
            {name: "FTP Zugang", site: 'ftp://ftp.duplexmedia.com', username: "166296", password: "encrypted"},
            {name: "MySQL Zugang", site: 'http://duplexmedia.com/sqladmin', username: "166296", password: "encrypted"},
            {name: "DF Kundenmenü", site: 'http://admin.df.eu', username: "duplexmedia.com", password: "encrypted"}
        ]},
        "martin-metzmacher": {ID: 3, slug: "martin-metzmacher", name: 'Martin Metzmacher', entries: [
            {name: "FTP Zugang", site: 'ftp://ftp.metzmacher.com', username: "166296", password: "encrypted"},
            {name: "MySQL Zugang", site: 'http://metzmacher.com/sqladmin', username: "166296", password: "encrypted"},
        ]},
        "fritz-milosevic": {ID: 2, slug: "fritz-milosevic", name: 'Fritz Milosevic', entries: [
            {name: "FTP Zugang", site: 'ftp://ftp.dotadvisors.co.za', username: "166296", password: "encrypted"},
            {name: "MySQL Zugang", site: 'http://mysql.dotadvisors.co.za', username: "166296", password: "encrypted"}
        ]},
        "antje-keyenburg": {ID: 4, slug: "antje-keyenburg", name: 'Antje Keyenburg', entries: [
            {name: "FTP Zugang", site: 'ftp://ftp.keyenburg.com', username: "166296", password: "encrypted"},
            {name: "MySQL Zugang", site: 'http://keyenburg.com/sqladmin', username: "166296", password: "encrypted"}
        ]}
    };

    return data;
});

function CompassController($scope, $routeParams, $route, CompassData){
    $scope.data = CompassData;
    $scope.params = $routeParams;


    $scope.$on('$routeChangeSuccess', function(){
        $scope.params = $route.current.params;
    });

    $scope.isActiveMenuLink = function(link){
        return link == $scope.params.customer ? "active" : "";
    }
}