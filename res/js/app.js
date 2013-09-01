/**
 * Created with JetBrains PhpStorm.
 * User: leobernard
 * Date: 26.08.13
 * Time: 20:40
 * To change this template use File | Settings | File Templates.
 */

var password = "MeinSchlüssel";

var compassMain = angular.module("compassMain", [], function($routeProvider, $locationProvider){
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

compassMain.factory('CompassData', function(){
    var data = [
        {_id: 1, name: '{"iv":"B7yUykHRU9o6vCrCvWMGPw","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"WiO0mw+ipdorX1Rb9txp6zKSxw"}', entries: [
            {
                _id: 25,
                name: '{"iv":"S6Ejup5lKH+z/p3GZEq/lA","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"qERm/ci+yzMdUbBshslxSYf+"}',
                tags: '{"iv":"7H9i9QA6kR1JNTD7Z2iOgg","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"QxDr7oSZqdM"}',
                site: '{"iv":"nn8oy+bnrDc7F2B7hxEEqw","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"sqU5pvd+62CEQnOYS86YWxC83v1Ojp9fpMomAoRMlZjO"}',
                username: '{"iv":"pIgFXZ/d8nanmLrw/F+i7g","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"CuvofAsMo5/FT2kPYqg"}',
                password: '{"iv":"5iXSM5rS9jvRv9nK1x8ISQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"Gd19m8DBT0bNiUCJQxTTxqUPAqMmOzcx5Q"}'
            },
            {
                _id: 26,
                name: '{"iv":"paXHpgKPGk3wwFQAN7yipQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"QJWd9XhdDL69+SBc70VjbYfq5cM"}',
                tags: '{"iv":"7H9i9QA6kR1JNTD7Z2iOgg","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"QxDr7oSZqdM"}',
                site: '{"iv":"TRStPZGnsg6bCCObSmEPOA","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"IbRVQBooTOS8ypaV4i+YlmBENEJ8kTjCszKTzoTNYGPyWLQQchge"}',
                username: '{"iv":"Hrs61bdhXcQgtDCB/u2mfg","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"dVYWTkhBHfs4s4xP2Wk"}',
                password: '{"iv":"5iXSM5rS9jvRv9nK1x8ISQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"Gd19m8DBT0bNiUCJQxTTxqUPAqMmOzcx5Q"}'
            },
            {
                _id: 27,
                name: '{"iv":"6yjUu8g75AW3mwdiKQG9Wg","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"AZd01e1TsLl8xapGj5VhHLsnormb+Q"}',
                tags: '{"iv":"7H9i9QA6kR1JNTD7Z2iOgg","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"QxDr7oSZqdM"}',
                site: '{"iv":"fA+WfiTPwOqdKICAUxgIoQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"5+jogWvF7sfPCR2z3yeZR4TcIiW7bbZFR2E"}',
                username: '{"iv":"jF68tvW0X3a08O10EF+t2A","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"FY2BM2iXGWsw16G0fBTurY2PS7pUr5w"}',
                password: '{"iv":"5iXSM5rS9jvRv9nK1x8ISQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"Gd19m8DBT0bNiUCJQxTTxqUPAqMmOzcx5Q"}'
            }
        ]},
        {_id: 3, name: '{"iv":"iSw5LpLoJCUH9ZwsU++Z1A","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"x8EH6afHEoND4sf/SVd8gUyXk/kM7fCODQ"}', entries: [
            {
                _id: 28,
                name: '{"iv":"S6Ejup5lKH+z/p3GZEq/lA","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"qERm/ci+yzMdUbBshslxSYf+"}',
                tags: '{"iv":"7H9i9QA6kR1JNTD7Z2iOgg","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"QxDr7oSZqdM"}',
                site: '{"iv":"LTSi6xNMhcmpx+lA2TZ+qQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"dGhnJ6IR+9UiT/+78FDnCm7W1ePRQ87pIwijd2zqaGc"}',
                username: '{"iv":"jF68tvW0X3a08O10EF+t2A","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"FY2BM2iXGWsw16G0fBTurY2PS7pUr5w"}',
                password: '{"iv":"5iXSM5rS9jvRv9nK1x8ISQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"Gd19m8DBT0bNiUCJQxTTxqUPAqMmOzcx5Q"}'
            },
            {
                _id: 29,
                name: '{"iv":"paXHpgKPGk3wwFQAN7yipQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"QJWd9XhdDL69+SBc70VjbYfq5cM"}',
                tags: '{"iv":"7H9i9QA6kR1JNTD7Z2iOgg","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"QxDr7oSZqdM"}',
                site: '{"iv":"k2pAgq0xGh5pgcxfNaLQvA","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"QubursqFeWecSWCQ+YEzfTHlaadQcrWOlWXmKcYmTFgtgv4LN4E"}',
                username: '{"iv":"jF68tvW0X3a08O10EF+t2A","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"FY2BM2iXGWsw16G0fBTurY2PS7pUr5w"}',
                password: '{"iv":"5iXSM5rS9jvRv9nK1x8ISQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"Gd19m8DBT0bNiUCJQxTTxqUPAqMmOzcx5Q"}'
            }
        ]},
        {_id: 2, name: '{"iv":"LfWwcm90krsaPbTlDS29Ig","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"I5/URRfO0Sw/ojKfEOYFWRDlUcSLYEo"}', entries: [
            {
                _id: 30,
                name: '{"iv":"S6Ejup5lKH+z/p3GZEq/lA","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"qERm/ci+yzMdUbBshslxSYf+"}',
                tags: '{"iv":"7H9i9QA6kR1JNTD7Z2iOgg","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"QxDr7oSZqdM"}',
                site: '{"iv":"Ypov/b0r/sRW3meWuD9PaQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"ekGLZLTRyH6613d5axUll1DOTsXEOnPLQG7bZTscBcXvQYA"}',
                username: '{"iv":"jF68tvW0X3a08O10EF+t2A","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"FY2BM2iXGWsw16G0fBTurY2PS7pUr5w"}',
                password: '{"iv":"5iXSM5rS9jvRv9nK1x8ISQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"Gd19m8DBT0bNiUCJQxTTxqUPAqMmOzcx5Q"}'
            },
            {
                _id: 31,
                name: '{"iv":"paXHpgKPGk3wwFQAN7yipQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"QJWd9XhdDL69+SBc70VjbYfq5cM"}',
                tags: '{"iv":"7H9i9QA6kR1JNTD7Z2iOgg","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"QxDr7oSZqdM"}',
                site: '{"iv":"LbLBgTk4Tic7SA24wep1nw","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"igcXE2+oYUIpKuKg/EcGA3hYYHZAxhDQ0is3+uk7DMfl3Qrx8A"}',
                username: '{"iv":"jF68tvW0X3a08O10EF+t2A","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"FY2BM2iXGWsw16G0fBTurY2PS7pUr5w"}',
                password: '{"iv":"5iXSM5rS9jvRv9nK1x8ISQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"Gd19m8DBT0bNiUCJQxTTxqUPAqMmOzcx5Q"}'
            }
        ]},
        {_id: 4, name: '{"iv":"ELKwa2z9gSa7c38uoMgmBw","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"N/pV+r6DKKK9bwoxTFNCMnQaklTB6wQ"}', entries: [
            {
                _id: 32,
                name: '{"iv":"S6Ejup5lKH+z/p3GZEq/lA","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"qERm/ci+yzMdUbBshslxSYf+"}',
                tags: '{"iv":"7H9i9QA6kR1JNTD7Z2iOgg","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"QxDr7oSZqdM"}',
                site: '{"iv":"M84peX3ybelnUUeLgpBuKg","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"OyjhEjk3NkaY+yjGACtv7HEDMUbuxazdeaEcOD+yVw"}',
                username: '{"iv":"jF68tvW0X3a08O10EF+t2A","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"FY2BM2iXGWsw16G0fBTurY2PS7pUr5w"}',
                password: '{"iv":"5iXSM5rS9jvRv9nK1x8ISQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"Gd19m8DBT0bNiUCJQxTTxqUPAqMmOzcx5Q"}'
            },
            {
                _id: 33,
                name: '{"iv":"paXHpgKPGk3wwFQAN7yipQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"QJWd9XhdDL69+SBc70VjbYfq5cM"}',
                tags: '{"iv":"7H9i9QA6kR1JNTD7Z2iOgg","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"QxDr7oSZqdM"}',
                site: '{"iv":"0hZsEda+N/tiuhoizEAqNw","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"Er/Py4+kN8+M1myC0xN4rPrs9iGWU5B/5hW6aVwuiNTXqBsHdg"}',
                username: '{"iv":"jF68tvW0X3a08O10EF+t2A","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"FY2BM2iXGWsw16G0fBTurY2PS7pUr5w"}',
                password: '{"iv":"5iXSM5rS9jvRv9nK1x8ISQ","v":1,"iter":1000,"ks":256,"ts":64,"mode":"ccm","adata":"","cipher":"aes","salt":"w1ycvZQ5Ni4","ct":"Gd19m8DBT0bNiUCJQxTTxqUPAqMmOzcx5Q"}'
            }
        ]}
    ];

    return data;
});

compassMain.factory('CompassSettings', function(){
    var settings = {
        lang: "en",
        debug: true
    };

    return settings;
});

function CompassController($scope, $routeParams, $route, CompassData, CompassSettings){
    $scope.data = CompassData;
    $scope.params = $routeParams;
    $scope.appSettings = CompassSettings;

    $scope.$on('$routeChangeSuccess', function(){
        $scope.params = $route.current.params;
    });

    $scope.isActiveMenuLink = function(link){
        return link == $scope.params.customer ? "active" : "";
    }
}