<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Client;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;


class SaleController extends Controller
{
    //Retorna o index com todos objetos 'sale' (venda) armazenados no banco de dados
    public function index() {
        $sales = Sale::all();
        return view('sales.index', ['sales' => $sales]);
    }

    //Retorna view de criação de venda (Com todos os clientes e produtos do banco de dados)
    public function create() {
        $clients = Client::all();
        $products = Product::all();

        return view('sales.create', ['clients' => $clients, 'products' => $products]);
    }
    //Trata e armazena os dados
    public function store(Request $request) {
        if ($request->client == null) {
            return back()->withErrors('Especifique um cliente');
        }
        #Instancia um novo model
        $sale = new Sale;
        #Define a data da venda
        $sale->selldate = $request->selldate;

        #Loop de tamanho variável (com base em quantos produtos diferentes foram recebidos pelo $request)
        for ($i = 1;  $i <= (int)$request->counter; $i++) {
            if ($request->input('product'.$i) == null) {
                return back()->withErrors('Selecione um produto válido');
            }
            #Encontra o produto com id do $request
            $product = Product::findOrFail((int)$request->input('product'.$i));
            
            #Checa se a quantidade de produtos armazenadas no bdd é menor que a quantidade solicitada
            if ($product->quantity < $request->input('quantity'.$i)) {
                #Caso sim, retorna a página anterior com erros
                return back()->withErrors('Quantidade indisponível');
            } else {
                #Calcula o valor total da venda de acordo com o valor de cada produto e a quantidade solicitada
                $sale->totalvalue += $product->sellprice * $request->input('quantity'.$i);

                #Atualiza o banco de dados, diminuindo a quantidade do produto de acordo com a quantidade solicitada
                $newQuantity = $product->quantity - $request->input('quantity'.$i);
                $product->update(['quantity' => $newQuantity]);
            }
        }
        #Define o id do cliente e do usuário atrelados a venda
        $sale->user_id = $request->user;
        $sale->client_id = $request->client;
        #Salva no bdd
        $sale->save();
        
        #Mais um loop de tamanho relativo a quantidade de produtos distintos
        for ($i = 1;  $i <= (int)$request->counter; $i++) {
            #Encontra o produto com id correto
            $product = Product::findOrFail((int)$request->input('product'.$i));
            #Atrela o determinado produto a venda, passando também a quantidade e o valor
            $sale->products()->attach($request->input('product'.$i), ['quantity' => $request->input('quantity'.$i), 'value' => $product->sellprice * $request->input('quantity'.$i)]);
        }

        #Redireciona para o index com mensagem de sucesso
        return redirect('/sales')->with('msg', 'Venda realizada com sucesso');
    }

    //Deleta uma venda
    public function destroy($id){
        $sale = Sale::findOrFail($id);
        #Remove as relações com os produtos
        $sale->products()->detach();
        $sale->delete();
        
        return redirect('/sales')->with('msg', 'Venda deletada com sucesso');
    }

    //Gera um PDF comprovante
    public function generatePDF($id){
        $sale = Sale::findOrFail($id);
        #Carrega uma view (sales/receipt) em um pdf, passando uma váriavel com a venda determinada
        $pdf = Pdf::loadView('sales.receipt', compact('sale'));
        #Retorna um stream do pdf gerado, com nome de "Comprovante_venda_id-X.pdf"
        return $pdf->setPaper(array(0, 0, 396, 612), 'landscape')->stream('Comprovante_venda_id-'.$sale->id.'.pdf');
    }
}
