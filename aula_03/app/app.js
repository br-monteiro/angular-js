var app = angular.module("myPizza");
// controller de configurações
app.controller("appCtrl", function($scope) {
    $scope.appName = "My Pizza!";
    $scope.appVersion = "0.0.1";
});
