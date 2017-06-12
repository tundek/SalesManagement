<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Models\Productcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    public function create()
    {
        $productcategory = Productcategory::all();
        return view('backend.sales.create', compact('productcategory', 'product'));
    }

    public function getproduct()
    {
        $product = Product::where('productcategory_id', $_POST['id'])->get();
        if (count($product) > 0) {
            $opt = "<option>---Select Product---</option>";
            foreach ($product as $p) {
                $opt .= "<option value='$p->id'>$p->name</option>";
            }
        } else {
            $opt = "<option>No Product Available for This Category</option>";
        }
        echo $opt;
    }
    public function getquantity(Request $request)
    {
        $product = Product::where('id', $request->product_id)->get();
        $q = $product[0]->stock;
        $quantity =  $product[0]->quantity-$q;
        echo $quantity;
    }
    public function getprice(Request $request)
    {
        $product = Product::where('id', $request->product_id)->get();
        echo  $product[0]->price;
    }

}
