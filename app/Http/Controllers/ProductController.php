<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Departament;
use App\Models\Supplier;
use App\Models\Image;

class ProductController extends Controller
{
    //Retorna a view products/index passando os produtos desejados, além de todos os departamentos e fornecedores
    public function index() {
        #Cria uma variável caso receba um search por request
        $search = request('search');
        //$filters = request('filters');

        #Checa se a variável $search existe
        if ($search) {
            #Caso sim, passa os produtos com o nome que se assemelhe ao recebido no search
            $products = Product::where([
                ['name', 'like', '%'.$search.'%']
            ])->get();
        } else {
            #Caso não, passa todos os produtos
            $products = Product::all();
        }
        $departaments = Departament::all();
        $suppliers = Supplier::all();

        return view('products.index', ['products' => $products, 'departaments' => $departaments, 'suppliers' => $suppliers, 'search' => $search]);
    }

    //Retorna a view de cadastro junto de todos os departamentos e fornecedores
    public function create() {
        $suppliers = Supplier::all();
        $departaments = Departament::all();

        return view('products.create', ['suppliers' => $suppliers, 'departaments' => $departaments]);
    }
    //Trata os dados e armazena no bdd
    public function store(Request $request) {
        $product = new product;

        $product->name = $request->name;
        $product->description = $request->description;
        $product->buyprice = $request->buyprice;
        $product->sellprice = $request->sellprice;
        $product->quantity = $request->quantity;

        #Checa se o departamento recebido é um novo departamento
        if ($request->departament == "newDep") {
            #Caso sim, trata os dados e insere o novo departamento no bdd
            $departament = new Departament;

            $departament->name = $request->depName;
            $departament->description = $request->depDesc;

            $departament->save();
            #Atrela o produto ao departamento criado
            $product->departament_id = $departament->id;
        } else {
            #Caso não, atrela o produto ao departamento recebido
            $product->departament_id = $request->departament;
        }

        #Mesma situação do departamento para o fornecedor
        if ($request->supplier == "newSup") {
            $supplier = new Supplier();

            $supplier->name = $request->supName;
            $supplier->contact = $request->supContact;
            $supplier->address = $request->supAddress;

            $supplier->save();
            $product->supplier_id = $supplier->id;
        } else {
            $product->supplier_id = $request->supplier;
        }

        #Checa se recebeu uma imagem e se a imagem é válida
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            #Caso sim, trata os dados e armazena a imagem no bdd
            $image = new image;

            $requestImage = $request->image;
            $extension = $requestImage->extension();

            $image->name = $requestImage->getClientOriginalName();
            #Cria uma nova url para a imagem, a partir de um hash do nome orignal junto da data atual
            $image->url = md5($requestImage->getClientOriginalName()) . strtotime("now") . "." . $extension;

            #Salva a imagem na pasta public/img/products, com o nome da url
            $request->image->move(public_path('img/products'), $image->url);

            $image->save();
            #Atrela o produto a imagem criada
            $product->image_id = $image->id;
        }

        #Salva o produto no bdd
        $product->save();

        return redirect('/products')->with('msg', 'Produto adicionado com sucesso');
    }

    //Deleta um produti
    public function destroy($id){
        $product = Product::findOrFail($id);
        #Checa se o produto está atrelado a uma venda
        if ($product->sales()->exists()) {
            return back()->withErrors('Este produto não pode ser deletado pois está atrelado a uma venda');
        } else {
            $product->image()->delete();
            $product->delete();
            return redirect('/products')->with('msg', 'Produto deletado com sucesso');
        }
        
    }

    //Retorna view de edição
    public function edit($id){
        $product = Product::findOrFail($id);
        $suppliers = Supplier::all();
        $departaments = Departament::all();
        return view('products.edit', ['product' => $product, 'suppliers' => $suppliers, 'departaments' => $departaments]);
    }
    //Trata os dados e atualiza o produto
    public function update(Request $request) {

        $data = $request->all();

        #Checa se recebeu uma imagem e se ela é válida
        if ($request->hasFile('image_id') && $request->file('image_id')->isValid()) {
            #Checa o produto já possuía imagem
            if (Product::findOrFail($request->id)->image()->first() != null) {
                #Caso sim, atualiza os dados da imagem
                $requestImage = $request->image_id;
                $extension = $requestImage->extension();

                $newName = $requestImage->getClientOriginalName();
                $newURL = md5($requestImage->getClientOriginalName()) . strtotime("now") . "." . $extension;
                $newImage = Product::findOrFail($request->id)->image()->first();
                $newImage->update(['name' => $newName, 'url' => $newURL]);

                $request->image_id->move(public_path('img/products'), $newURL);

                $data['image_id'] = $newImage->id;
            } else {
                #Caso não, cria uma nova imagem
                $image = new image;

                $requestImage = $request->image_id;
                $extension = $requestImage->extension();
    
                $image->name = $requestImage->getClientOriginalName();
                $image->url = md5($requestImage->getClientOriginalName()) . strtotime("now") . "." . $extension;
    
                $request->image_id->move(public_path('img/products'), $image->url);
    
                $image->save();
                $data['image_id'] = $image->id;
            }
        } 

        Product::findOrFail($request->id)->update($data);
        return redirect('/products')->with('msg', 'Produto editado com sucesso');
    }
}
