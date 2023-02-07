<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index() {
        $suppliers = Supplier::all();
        return view('products.suppliers.index', ['suppliers' => $suppliers]);
    }

    public function create() {
        return view('products.suppliers.create');
    }
    public function store(Request $request) {
        $supplier = new Supplier;

        $supplier->name = $request->name;
        $supplier->contact = $request->contact;
        $supplier->address = $request->address;

        $supplier->save();

        return redirect('/products/suppliers')->with('msg', 'Fornecedor cadastrado com sucesso');
    }

    public function destroy($id){
        $supplier = Supplier::findOrFail($id);
        $supplier->product()->update(['supplier_id' => NULL]);
        $supplier->delete();
        
        return redirect('/products/suppliers')->with('msg', 'Fornecedor deletado com sucesso');
    }

    public function edit($id){
        $supplier = Supplier::findOrFail($id);
        return view('products.suppliers.edit', ['supplier' => $supplier]);
    }
    public function update(Request $request) {
        Supplier::findOrFail($request->id)->update($request->all());
        return redirect('/products/suppliers')->with('msg', 'Fornecedor editado com sucesso');
    }
}
