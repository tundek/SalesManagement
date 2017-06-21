<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Models\Productcategory;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use PDF;

class SalesController extends Controller
{
    public function create()
    {
        $productcategory = Productcategory::all();
        $product = Product::where('stock', '>=', 1)->get();
        $sales = Sale::where('flag','=',1)->get();
        return view('backend.sales.create', compact('productcategory', 'product','sales'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'price' => 'required',
            'sales_quantity' => 'required',
        ]);

        $update = Sale::create([
            'product_id' => $request->product_id,
            'quantity' => $request->sales_quantity,
            'price' => $request->price * $request->sales_quantity,
            'status' => $request->status,
            'saller_name' => Auth::user()->name,
            'created_by' => Auth::user()->username,
            'sales_date' => date('Y-m-d H:i:s'),
        ]);
        if ($update) {
            $product = Product::find($request->product_id);
            $product->stock = $product->stock - $request->sales_quantity;
            $product->update();
            return redirect()->route('sales.create')->with('success_message', 'successfully Make Sales');
        }

    }

    public function index()
    {
        $sales = Sale::orderBy('created_at', 'DEC')->where('flag', '=', 1)->get();
        return view('backend.sales.list', compact('sales'));
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
        echo $product[0]->stock;

    }

    public function getprice(Request $request)
    {
        $product = Product::where('id', $request->product_id)->get();
        echo $product[0]->price;
    }

    public function getproductname(Request $request)
    {
        $product = Product::where('id', $request->product_id)->get();
        echo $product[0]->name;

    }


    public function getallpdf()
    {
        $report = Sale::all();
        $flag = new Sale();
        $flag->flag = 0;
        $flag->update();
        $pdf = PDF::loadView('backend.pdfbill.allreport', compact('report'));
        return $pdf->stream('customer.pdf');

    }

}
