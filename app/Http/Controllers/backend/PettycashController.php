<?php

namespace App\Http\Controllers\backend;

use App\Models\Pettycash;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PettycashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pettycash = Pettycash::all();
        $withdraw = Withdraw::all();
        $totalcash = 0;
        if ($pettycash) {
            foreach ($pettycash as $pt) {
                $cash = $pt->totalcash;
                $totalcash += $cash;
            }

        }
        $totalwithdraw = 0;
        if ($withdraw){
            foreach ($withdraw as $w){
                $with = $w->totalwithdraw;
                $totalwithdraw += $with;

            }
        }
        return view('backend.pettycash.list', compact('pettycash', 'withdraw','totalcash','totalwithdraw'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pettycash.create');
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
            'totalcash' => 'required',
        ]);
        $message = Pettycash::create([
            'totalcash' => $request->totalcash,
            'created_by' => Auth::user()->username,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        if ($message) {
            return redirect()->route('petty-cash.list')->with('success_message', 'successfully Leave');
        } else {
            return redirect()->route('petty-cash.create')->with('error_message', 'Failed To create');
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
        $pettycash = Pettycash::find($id);
        return view('backend.pettycash.edit', compact('pettycash'));
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
        $this->validate($request, [
            'totalcash' => 'required',
        ]);
        $pettycash = Pettycash::find($id);
        $pettycash->totalcash = $request->totalcash;
        $message = $pettycash->update();
        if ($message) {
            return redirect()->route('petty-cash.list')->with('success_message', 'successfully updated');
        } else {
            return redirect()->route('petty-cash.update')->with('error_message', 'failed to  update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = $this->checkpermission('product-delete');
        if ($check) {
            $this->checkpermission('product-delete');
        } else {
            $pettycash = Pettycash::find($id);
            $message = $pettycash->delete();
            if ($message) {
                return redirect()->route('petty-cash.list')->with('success_message', 'successfully Deleted');
            } else {
                return redirect()->route('petty-cash.update')->with('error_message', 'failed to  Delete');
            }
        }
    }
}
