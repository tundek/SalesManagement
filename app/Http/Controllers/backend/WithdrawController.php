<?php

namespace App\Http\Controllers\backend;

use App\Models\Pettycash;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gettotalcash()
    {
        $pettycash = Pettycash::all();

        $totalcash = 0;
        if ($pettycash) {
            foreach ($pettycash as $pt) {
                $cash = $pt->totalcash;
                $totalcash += $cash;
            }
            return $totalcash;

        }

    }

    public function gettotalwithdraw()
    {
        $withdraw = Withdraw::all();
        $totalwithdraw = 0;
        if ($withdraw) {
            foreach ($withdraw as $w) {
                $with = $w->totalwithdraw;
                $totalwithdraw += $with;

            }
            return $totalwithdraw;
        }
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pettycash.withdraw');
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
            'totalwithdraw' => 'required',
            'purpose' => 'required'
        ]);
        $total = $this->gettotalcash() - $this->gettotalwithdraw();
        if ($request->totalwithdraw <= $total) {
            $message = Withdraw::create([
                'totalwithdraw' => $request->totalwithdraw,
                'purpose' => $request->purpose,
                'created_by' => Auth::user()->username,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            if ($message) {
                return redirect()->route('user.dashboard')->with('success_message', 'successfully Withdraw amount Rs ' . $request->totalwithdraw);
            } else {
                return redirect()->route('withdraw-petty-cash.create')->with('error_message', 'Failed To create');
            }
        } else {
            return redirect()->route('user.dashboard')->with('error_message', 'You have no Sufficent Balance');
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
        //
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
