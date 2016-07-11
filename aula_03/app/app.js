var app = angular.module("myPizza");
// controller de configurações
app.controller("appCtrl", function($scope) {
    $scope.appName = "My Pizza!";
    $scope.appVersion = "0.0.1";
});
// dados dos clientes
app.controller("clientesCtrl", function($scope) {
    $scope.index = null;
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
        $scope.editando = false;
        $scope.clientes.push(angular.copy(cliente));
        $scope.clearForm(cliente);
    };

    // editando um elemento
    $scope.editar = function(cliente) {
        $scope.editando = true;
        $scope.cliente = cliente;
    };

    // limpa o formulário
    $scope.clearForm = function(cliente) {
        delete $scope.cliente;
    };

    // salva a edição de clientes
    $scope.salvar = function(cliente) {
        $scope.editando = false;
        cliente = angular.copy($scope.cliente);
        $scope.clearForm(cliente);
    };

    // solicita ao usuário a confirmação de exclusão
    $scope.confirmExcluir = function(cliente) {
        $scope.index = $scope.clientes.indexOf(clientes);
        $scope.nomeRegistro = cliente.nome;
    };

    // exclui registros
    $scope.excluir = function() {
        $scope.clientes.splice($scope.index, 1);
    };
});
