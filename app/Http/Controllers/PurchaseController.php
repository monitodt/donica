<?php


namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController
{
    public function createPurchase(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required',
            'product_id' => 'required',
            'product_count' => 'required',
        ]);
        $product = Product::find($validated['product_id']);//выполняет поиск товара с заданным айди
        $validated['marginality'] = ($product->cost - $product->real_cost) * $validated['product_count'];
        $validated['summary_cost'] = $product->cost * $validated['product_count'];
        $validated['cost']=$product->cost;
        $purchase = Purchase::query()
            ->create($validated);
        return $purchase;
    }
    public function listPurchase(Request $request){
        $validated=$request->validate([
            'token'=>'required'
        ]);
        if(!UserController::hasAccess($validated['token'])){
            return ['error'=>'у вас отсутствую права доступа'];
        }
        $purchases= Purchase::query()
            ->with(['contact','product'])
            ->get();
        $sum=0;
        $marginality=0;
        foreach ($purchases as $purchase){
            $sum+=$purchase->summary_cost;
            $marginality+=$purchase->marginality;
        }
        $purchases['sum_cost']=$sum;
        $purchases['sum_marginality']=$marginality;
        return $purchases;
    }
}
