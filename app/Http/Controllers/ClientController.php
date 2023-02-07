<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    //Retorna a view clients/index com todos os clientes cadastrados no banco de dados pela variável $clients
    public function index() {
        $clients = Client::all();
        return view('clients.index', ['clients' => $clients]);
    }

    //Retorna a view clients/create (formulário de cadastro)
    public function create() {
        return view('clients.create');
    }
    //Faz o tratamento dos dados, salva no banco de dados, e redireciona com uma mensagem de sucesso
    public function store(Request $request) {
        #Checa se os campos de email e telefone já existem
        $request->validate( ['email' => 'unique:clients,email', 'telephone' => 'unique:clients,telephone'] );

        #Cria um model e insere os valores do request
        $client = new Client;
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->email = $request->email;
        $client->telephone = $request->telephone;
        $client->save();

        #Redireciona com mensagem de sucesso
        return redirect('/clients')->with('msg', 'Cliente cadastrado com sucesso');
    }

    //Deleta um cliente do banco de dados
    public function destroy($id){
        $client = Client::findOrFail($id);
        #Checa se uma venda está atrelada ao cliente
        if ($client->sale()->exists()) {
            #Caso exista, retorna a página anterior com erros
            return back()->withErrors('O cliente '.$client->name.' '.$client->surname.' não pode ser deletado pois está atrelado a uma venda');
        } else {
            #Caso não exista, deleta o cliente e redireciona com mensagem de sucesso
            $client->delete();
            return redirect('/clients')->with('msg', 'Cliente removido com sucesso');
        }
    }

    //Retorna a view clients/edit (formulário de edição) com o cliente requerido
    public function edit($id){
        $client = Client::findOrFail($id);
        return view('clients.edit', ['client' => $client]);
    }
    //Atualiza o cliente com os novos dados
    public function update(Request $request) {
        $client = Client::findOrFail($request->id);
        if ($client->email != $request->email && $client->telephone != $request->telephone) {
            $request->validate( ['email' => 'unique:clients,email', 'telephone' => 'unique:clients,telephone'] );
        } elseif ($client->email != $request->email) {
            $request->validate( ['email' => 'unique:clients,email'] );
        } elseif ($client->telephone != $request->telephone) {
            $request->validate( ['telephone' => 'unique:clients,telephone'] );
        }

        $client->update($request->all());
        return redirect('/clients')->with('msg', 'Cliente editado com sucesso');
    }
}
