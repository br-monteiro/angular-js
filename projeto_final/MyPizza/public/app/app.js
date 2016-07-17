var app = angular.module("myPizza");
// controller de configurações
app.controller("appCtrl", function($scope) {
    $scope.appName = "My Pizza!";
    $scope.appVersion = "0.0.1";
});
// dados dos clientes
app.controller("clientesCtrl", function($scope, $http) {
    $scope.index = null;
    $scope.ordem = false;
    $scope.campo = 'nome';
    // objeto de clientes
    $scope.clientes = [];

    // retorna todos os registros
    var findAll = function() {
        $http.get('http://localhost:8000/all').success(function(data, status) {
            console.log(data);
            console.log(status);
            $scope.clientes = data;
        });
    };
    // adiciona um registro
    var addCliente = function(cliente) {
        $http.post('http://localhost:8000/add', cliente).success(function(data, status) {
            console.log(data);
            console.log(status);
        });
    };
    // delea um registro do banco de dados
    var deleteCliente = function(id) {
        $http.delete('http://localhost:8000/del/' + id).success(function(data, status) {
            console.log(data);
            console.log(status);
        });
    };
    // altera um registro no banco de dados
    var updateCliente = function(cliente) {
        $http.put('http://localhost:8000/put/' + cliente.id, cliente).success(function(data, status) {
            console.log(data);
            console.log(status);
        });
    };
    findAll();

    // adiciona clientes
    $scope.add = function(cliente) {
        $scope.editando = false;
        //$scope.clientes.push(angular.copy(cliente));
        addCliente(angular.copy(cliente));
        $scope.clearForm(cliente);
        findAll();
        // fecha o modal
        $('.modalForm').modal().modal('toggle');
    };

    // editando um elemento
    $scope.editar = function(cliente) {
        $scope.editando = true;
        $scope.cliente = angular.copy(cliente);
    };

    // limpa o formulário
    $scope.clearForm = function(cliente) {
        $scope.formCliente.$setPristine();
        delete $scope.cliente;
    };

    // salva a edição de clientes
    $scope.salvar = function(cliente) {
        $scope.editando = false;
        updateCliente(angular.copy($scope.cliente));
        $scope.clearForm(cliente);
        findAll();
        // fecha o modal
        $('.modalForm').modal().modal('toggle');
    };

    // solicita ao usuário a confirmação de exclusão
    $scope.confirmExcluir = function(cliente) {
        $scope.nomeRegistro = cliente.nome;
        $scope.index = cliente.id;
    };

    // exclui registros
    $scope.excluir = function() {
        deleteCliente($scope.index);
        findAll();
    };

    // ordenador de registro
    $scope.orderBy = function(campo) {
        $scope.campo = campo;
        $scope.ordem = !$scope.ordem;
    };
});
