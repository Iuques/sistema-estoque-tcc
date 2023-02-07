<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //Retorna a view users/index com todos os usuários cadastrados no banco de dados pela variável $users
    public function index() {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    //Retorna a view de cadastro
    public function create() {
        return view('users.create');
    }
    //Tratamento e armazenamento dos dados
    public function store(Request $request) {
        #Checa se o email já está em uso
        $request->validate(['email' => 'unique:users,email']);

        #Instancia um novo model e preenche com os dados
        $user = new User;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->type = $request->type;
        $user->save();

        #Redireciona ao index com mensagem de sucesso
        return redirect('/users')->with('msg', 'Usuário cadastrado com sucesso');
    }

    //Deleta um usuário
    public function destroy($id){
        $user = User::findOrFail($id);
        #Checa se uma venda está atrelada ao usuário
        if ($user->sale()->exists()) {
            #Caso exista, retorna a página anterior com erros
            return back()->withErrors('O usuário '.$user->name.' '.$user->surname.' não pode ser deletado pois está atrelado a uma venda');
        } else {
            #Caso não exista, deleta o usuário e redireciona com mensagem de sucesso
            $user->delete();
            return redirect('/users')->with('msg', 'Usuário removido com sucesso');
        }
    }

    //Retorna view de edição
    public function edit($id){
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }
    //Tratamento de dados e atualização
    public function update(Request $request) {
        $user = User::findOrFail($request->id);
        #Checa se o email já está em uso (caso o email inserido seja diferente do anterior)
        if ($user->email != $request->email) {
            $request->validate( ['email' => 'unique:users,email'] );
        }

        #Atualiza os dados do usuário
        $user->update($request->all());
        return redirect('/users')->with('msg', 'Usuário atualizado com sucesso');
    }

    public function show($id){
        $user = User::findOrFail($id);
        $sales = $user->sale()->get();
        $clients = [];
        foreach ($sales as $sale) {
            $newClient = $sale->client()->first();
            $clients [$sale->id] = $sale->client()->first();
            foreach ($clients as $key => $client) {
                if ($client->id == $newClient->id && $key != $sale->id) {
                    unset($clients[$sale->id]); 
                }
            }
        }
        $monthSales = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0];
        foreach ($sales as $sale) {
            $timestamp = strtotime($sale->selldate);
            $month = (int)date('m', $timestamp);
            $month--;
            $monthSales[$month]++;
        }
        return view('users.profile', ['user' => $user, 'sales' => $sales, 'clients' => $clients, 'monthSales' => $monthSales]);
    }
}
