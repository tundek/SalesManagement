<?php

namespace App\Http\Controllers\backend;

use App\Models\Preorder;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PreorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preorder = Preorder::join('products', 'products.id', '=', 'preorders.product_id')
            ->select('preorders.*', 'products.name')
            ->where('preorders.delivered_status', '=', 0)
            ->get();
        $finalpreorder = Preorder::join('products', 'products.id', '=', 'preorders.product_id')
            ->select('preorders.*', 'products.name')
            ->where('preorders.delivered_status', '=', 1)
            ->get();
        return view('backend.preorder.list', compact('preorder', 'finalpreorder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::all();
        return view('backend.preorder.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'paidamount' => 'required',
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'order_pick' => 'required',
            'message' => 'required',
        ]);
        $totalamount = $request->price * $request->quantity;
        $message = Preorder::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'totalamount' => $totalamount,
            'paidamount' => $request->paidamount,
            'dueamount' => $totalamount - $request->paidamount,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'order_pick' => $request->order_pick,
            'message' => $request->message,
            'created_by' => Auth::user()->username,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        if ($message) {
            return redirect()->route('preorder.list')->with('success_message', 'successfully created ');
        } else {
            return redirect()->route('preorder.create')->with('error_message', 'Failed To create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $preorder = Preorder::find($id);
        return view('backend.preorder.edit', compact('preorder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $preorder = Preorder::find($id);
        $preorder->delivered_status = 1;
        if ($preorder->update()) {
            $sales = new Sale();
            $sales->product_id = $preorder->product_id;
            $sales->quantity = $preorder->quantity;
            $sales->price = $preorder->totalamount;
            $sales->sales_status = 1;
            $sales->saller_name = Auth::user()->username;
            $sales->sales_date = date('Y-m-d H:i:s');
            $sales->save();
        }
        return redirect()->back()->with('success_message', 'successfully Delivered and Register into Sales');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
