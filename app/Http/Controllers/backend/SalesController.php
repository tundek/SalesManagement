<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
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
        $product = Product::where('stock', '>=', 1)->get();
        $sales = Sale::join('products', 'products.id', '=', 'sales.product_id')
            ->select('sales.*', 'products.name')
            ->where('flag', '=', 1)
            ->get();
        return view('backend.sales.create', compact('product', 'sales'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'price' => 'required',
            'sales_quantity' => 'required',
        ]);
        if ($request->ajax()) {
            $sales = new Sale();
            $sales->product_id = $request->product_id;
            $sales->quantity = $request->sales_quantity;
            $sales->price = $request->price;
            $sales->sales_status = $request->sales_status;
            $sales->saller_name = Auth::user()->username;
            $sales->sales_date = date('Y-m-d H:i:s');
            if ($sales->save()) {
                $product = Product::find($request->product_id);
                $product->stock = $product->stock - $request->sales_quantity;
                if ($product->update()) {
                    return response(['success_message' => 'SuccessFully Make sales']);
                }
            }
        } else {
            return response(['success_message' => 'Filed To Make sales']);
        }

    }

    public function index()
    {
        $sales = Sale::join('products', 'products.id', '=', 'sales.product_id')
            ->select('sales.*', 'products.name')
            ->orderBy('sales.created_at', 'DEC')
            ->where('sales.flag', '=', 1)
            ->get();
        return view('backend.sales.list', compact('sales'));
    }

    public function ajaxlist()
    {
        $sales = Sale::join('products', 'products.id', '=', 'sales.product_id')
            ->select('sales.*', 'products.name')
            ->orderBy('sales.created_at', 'DEC')
            ->where('sales.flag', '=', 1)
            ->get();
        return view('backend.sales.ajaxlist', compact('sales'));
    }

//    public function getajaxproduct()
//    {
//        $product = Product::where('stock', '>=', 1)->get();
//        return view('backend.sales.getajaxproduct', compact('product'));
//    }

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

    public function gettotalprice(Request $request)
    {
        $quantity = $request->sales_quantity;
        $price = $request->price;
        $total = $quantity * $price;
        echo $total;
    }

    public function getproductname(Request $request)
    {
        $product = Product::where('id', $request->product_id)->get();
        echo $product[0]->name;

    }

    public function getallpdf()
    {
        $report = Sale::join('products', 'products.id', '=', 'sales.product_id')
            ->select('sales.*', 'products.name')
            ->get();
        $pdf = PDF::loadView('backend.pdfbill.salesbill', compact('report'));
        return $pdf->loadFile('customer.pdf');
    }

    public function getcustomreport(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $report = Sale::join('products', 'products.id', 'sales.product_id')
            ->select('sales.*', 'products.name')
            ->whereBetween('sales.sales_date', [$start, $end])
            ->get();
        $pdf = PDF::loadview('backend.pdfbill.allreport', compact('report', 'start', 'end'));
        return $pdf->download('salesreport.pdf');
    }

}
