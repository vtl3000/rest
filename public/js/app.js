angular.module('rest', ['ngResource']).
//config([]
    //function ($routeProvider) {
    //$routeProvider//.
    //when('/', {controller: CollectionsCtrl, templateUrl: 'templates/allCollections.html'}).
    //otherwise({redirectTo: '/'});
//}
//).
factory('Settings', function ($resource) {
    return $resource('settings/:name/:id', {}, {
        all: {method: 'GET'},
        one: {method: 'GET', isArray: true},
        create: {method: 'POST'},
        delete: {method: 'DELETE'},
        edit: {method: 'PUT'}
    });
}).
controller('CollectionsCtrl', function ($scope, Settings) {
    $scope.collections = Settings.all();
    $scope.addCollection = function () {
        var result = Settings.create({name: $scope.collectionName}, function () {
            $scope.collections = Settings.all();
        });
        $scope.result = "Collection [" + $scope.collectionName + "] " + (result.status ? "" : "can't ") + "crated.";
        $scope.collectionName = "";
    };
    $scope.deleteCollection = function (collectionName) {
        var result = Settings.delete({name: collectionName}, function () {
            $scope.collections = Settings.all();
        });
        $scope.result = "Collection [" + $scope.collectionName + "] " + (result.status ? "" : "can't ") + "deleted.";
    };
});