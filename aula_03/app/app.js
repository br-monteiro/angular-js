var app = angular.module("myPizza");
// controller de configurações
app.controller("appCtrl", function($scope) {
    $scope.appName = "My Pizza!";
    $scope.appVersion = "0.0.1";
});
// dados dos clientes
app.controller("clientesCtrl", function($scope) {
    // objeto de clientes
    $scope.clientes = [
        {nome: "Bruno Monteiro", telefone: "1234-5678", endereco: "Rua teste1", email: "teste@teste.com"},
        {nome: "Paula Matias", telefone: "1234-5678", endereco: "Rua teste1", email: "teste@teste.com"},
        {nome: "Heitor Monteiro", telefone: "1234-5678", endereco: "Rua teste1", email: "teste@teste.com"},
        {nome: "Francisco Monteiro", telefone: "1234-5678", endereco: "Rua teste1", email: "teste@teste.com"},
        {nome: "Helena Monteiro", telefone: "1234-5678", endereco: "Rua teste1", email: "teste@teste.com"}
    ];

    // adiciona clientes
    $scope.add = function(cliente) {
        $scope.clientes.push(angular.copy(cliente));
        cliente.nome = null;
        cliente.telefone = null;
        cliente.endereco = null;
        cliente.email = null;
    };
});
