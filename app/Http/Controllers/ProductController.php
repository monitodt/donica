<?php


namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createProduct(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required',
            'name' => 'required',
            'description' => 'required',
            'consist' => 'required',
            'cost' => 'required',
            'real_cost' => 'required'
        ]);
        if(!UserController::hasAccess($validated['token']))
            return ['error'=>'вы не аутентифицированы'];
        unset($validated['token']);
        Product::query()
            ->create($validated);//создание нового товара
        return ['success'=>'true'];
    }
    public function listProduct(Request $request)
    {
        return Product::all();//вернуть все товары
    }
}
