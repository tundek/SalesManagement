<?php

namespace App\Http\Controllers\backend;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::all();
        return view('backend.staff.list', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.staff.create');
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
            'name' => 'required',
            'phone' => 'required',
            'designation' => 'required',
            'salary' => 'required',
        ]);
        $message = Staff::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'salary' => $request->salary,
            'created_by' => Auth::user()->username,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        if ($message) {
            return redirect()->route('staff.list')->with('success_message', 'successfully created ');
        } else {
            return redirect()->route('dtaff.create')->with('error_message', 'Failed To create');
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
        //$this->checkpermission('product-edit');
        $staff = Staff::find($id);
        return view('backend.staff.edit', compact('staff'));
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
            'name' => 'required',
            'phone' => 'required',
            'designation' => 'required',
            'salary' => 'required',
        ]);
        $pc = Staff::find($id);
        $pc->name = $request->name;
        $pc->phone = $request->phone;
        $pc->designation = $request->designation;
        $pc->salary = $request->salary;
        $pc->status = $request->status;
        $pc->modified_by = Auth::user()->username;
        $pc->updated_at = date('Y-m-d H:i:s');
        $message = $pc->update();
        if ($message) {
            return redirect()->route('staff.list')->with('success_message', 'successfully updated');
        } else {
            return redirect()->route('staff.update')->with('error_message', 'failed to  update');
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
            $staff = Staff::find($id);
            $message = $staff->delete();
            if ($message) {
                return redirect()->route('staff.list')->with('success_message', 'successfully Deleted');
            } else {
                return redirect()->route('staff.update')->with('error_message', 'failed to  Delete');
            }
        }
    }

}
