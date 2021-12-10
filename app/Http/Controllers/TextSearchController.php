<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Product;

class TextSearchController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('product_search')) {
            $products = Product::search($request->product_search)
                ->paginate(7);
        } else {
            $products = Product::paginate(7);
        }
        return view('welcome', compact('products'));
    }

    public function fullTextSearch(Request $request)
    {
        $this->validate($request,['product_name'=>'required']);

        $products = Product::create($request->all());
        return back();
    }
}
