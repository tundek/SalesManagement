<?php

namespace App\Http\Controllers\backend;

use App\Models\Preorder;
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
        $preorder = Preorder::all();
        return view('backend.preorder.list',compact('preorder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.preorder.create');
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
            'product_name' => 'required',
            'quantity' => 'required',
            'totalamount' => 'required',
            'paidamount' => 'required',
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'order_pick' => 'required',
            'message' => 'required',
        ]);
        $message = Preorder::create([
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'totalamount' => $request->totalamount,
            'paidamount' => $request->paidamount,
            'dueamount' => $request->totalamount - $request->paidamount,
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
        return view('backend.preorder.edit',compact('preorder'));
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
        //
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
