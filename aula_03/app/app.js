var app = angular.module("myPizza");
// controller de configurações
app.controller("appCtrl", function($scope) {
    $scope.appName = "My Pizza!";
    $scope.appVersion = "0.0.1";
});
// dados dos clientes
app.controller("clientesCtrl", function($scope, $http) {
    $scope.index = null;
    // objeto de clientes
    $scope.clientes = [];

    var findAll = function() {
        $http.get('http://localhost:8000').success(function(data, status) {
            //console.log(data);
            //console.log(status);
            $scope.clientes = data;
        });
    };
    findAll();

    // adiciona clientes
    $scope.add = function(cliente) {
        $scope.editando = false;
        $scope.clientes.push(angular.copy(cliente));
        $scope.clearForm(cliente);
        // fecha o modal
        $('.modalForm').modal().modal('toggle');
    };

    // editando um elemento
    $scope.editar = function(cliente) {
        $scope.editando = true;
        $scope.cliente = cliente;
    };

    // limpa o formulário
    $scope.clearForm = function(cliente) {
        $scope.formCliente.$setPristine();
        delete $scope.cliente;
    };

    // salva a edição de clientes
    $scope.salvar = function(cliente) {
        $scope.editando = false;
        cliente = angular.copy($scope.cliente);
        $scope.clearForm(cliente);
        // fecha o modal
        $('.modalForm').modal().modal('toggle');
    };

    // solicita ao usuário a confirmação de exclusão
    $scope.confirmExcluir = function(cliente) {
        $scope.nomeRegistro = cliente.nome;
        $scope.index = $scope.clientes.indexOf(cliente);
    };

    // exclui registros
    $scope.excluir = function() {
        $scope.clientes.splice($scope.index, 1);
    };

    // ordenador de registro
    $scope.orderBy = function(campo) {
        $scope.campo = campo;
        $scope.ordem = !$scope.ordem;
    };
});
