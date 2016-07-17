<?php

namespace App\Http\Controllers;

use App\Entities\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *
    public function __construct()
    {
        //
    }

    /*/
    public function index()
    {
        return view('layout');
    }

    public function findAllAction()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    public function addAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'riquired|min:3|max:50',
            'telefone' => 'riquired|min:13|max:13',
            'endereco' => 'riquired|min:10|max:255',
            'email' => 'min:10|max:100'
        ]);

        /*if ($validator->fails()) {
            return json_encode(['error' => 'Erro ao adicionar o registro']);
        }*/

        Cliente::create($request->all());
    }

    public function deleteAction($id)
    {
        Cliente::destroy($id);
    }

    public function updateAction(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'riquired|min:3|max:50',
            'telefone' => 'riquired|min:13|max:13',
            'endereco' => 'riquired|min:10|max:255',
            'email' => 'min:10|max:100'
        ]);

        /*if ($validator->fails()) {
            return json_encode(['error' => 'Erro ao adicionar o registro']);
        }*/
        $cliente = Cliente::find($id);
        $cliente->fill($request->all())->save();
    }
}
