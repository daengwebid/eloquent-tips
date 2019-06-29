<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;

class APIController extends Controller
{
    public function getDataByUser()
    {
        // $users = User::orderBy('created_at', 'DESC')->get();
        // $users = User::with(['product'])->orderBy('created_at', 'DESC')->get();
        // $users = User::with(['product', 'product.comments'])->orderBy('created_at', 'DESC')->get();
        // $users = User::with(['product', 'product.comments' => function($q) {
        //     $q->orderBy('created_at', 'DESC');
        // }])->orderBy('created_at', 'DESC')->get();

        // $users = User::with(['product:id,user_id,name,slug,price', 'product.comments:id,product_id,comment,created_at'])->orderBy('created_at', 'DESC')->get();
        $users = User::with(['product', 'product.comments' => function($q) {
            $q->orderBy('created_at', 'DESC')->select('id', 'product_id', 'comment', 'created_at');
        }])->orderBy('created_at', 'DESC')->get();
        return response()->json(['data' => $users]);
    }

    public function getDataByProduct()
    {
        // $product = Product::orderBy('created_at', 'DESC')->get();
        // $product->load('user');
        // $product->load('user:id,name,email');

        $filter = 'suscipit';
        // $product = Product::with(['comments'])->whereHas('comments', function($q) use($filter) {
        //     $q->where('comment', 'LIKE', '%' . $filter . '%');
        // })->get();

        $product = Product::with(['comments' => function($q) use($filter) {
            $q->where('comment', 'LIKE', '%' . $filter . '%');
        }])->get();
        return response()->json(['data' => $product]);
    }
}
