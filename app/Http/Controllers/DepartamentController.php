<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departament;

class DepartamentController extends Controller
{
    public function index() {
        $departaments = Departament::all();
        return view('products.departaments.index', ['departaments' => $departaments]);
    }

    public function create() {
        return view('products.departaments.create');
    }
    public function store(Request $request) {
        $departament = new Departament;

        $departament->name = $request->name;
        $departament->description = $request->description;

        $departament->save();

        return redirect('/products/departaments')->with('msg', 'Departamento cadastrado com sucesso');
    }

    public function destroy($id){
        $departament = Departament::findOrFail($id);
        $departament->product()->update(['departament_id' => NULL]);
        $departament->delete();
        
        return redirect('/products/departaments')->with('msg', 'Departamento deletado com sucesso');
    }

    public function edit($id){
        $departament = Departament::findOrFail($id);
        return view('products.departaments.edit', ['departament' => $departament]);
    }
    public function update(Request $request) {
        Departament::findOrFail($request->id)->update($request->all());
        return redirect('/products/departaments')->with('msg', 'Departamento editado com sucesso');
    }
}
