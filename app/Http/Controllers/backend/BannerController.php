<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Session;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkpermission('banner-list');
        $banner = Banner::orderBy('created_at')->paginate(10);
        return view('backend.banner.list', compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkpermission('banner-create');
        return view('backend.banner.create');
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
            'image' => 'mimes:jpeg,jpg,png,gif,png|required|max:5000',//5 mb around
        ]);
        $image = $request->file('image');
        $name = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move('images', $name);

        $msg = Banner::create([
            'short_description' => $request->short_description,
            'image' => $name,
            'status' => $request->status,
            'slider_key' => $request->slider_key,
            'created_by' => Auth::user()->username,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        if ($msg) {
            return redirect()->route('banner.list')->with('success_message', 'successfully created ');
        } else {
            return redirect()->route('banner.create')->with('error_message', 'Failed To create');
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
        $this->checkpermission('banner-edit');
        $banner = Banner::find($id);
        return view('backend.banner.edit', compact('banner'));
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
            'image' => 'mimes:jpeg,jpg,png,gif,png|max:5000',//5 mb around
        ]);
        $banner = Banner::find($id);
        if (!empty($request->file('image'))) {
            $image = $request->file('image');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $name);
            $banner->image = $name;
        } else {
            $name = '';
        }
        $banner->short_description = $request->short_description;
        $banner->status = $request->status;
        $banner->slider_key = $request->slider_key;
        $banner->modified_by = Auth::user()->username;
        $banner->updated_at = date('Y-m-d H:i:s');
        $message = $banner->update();
        if ($message) {
            return redirect()->route('banner.list')->with('success_message', 'successfully updated');
        } else {
            return redirect()->route('banner.update')->with('error_message', 'failed to  update');
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
        $this->checkpermission('banner-delete');
        $banner = Banner::find($id);
        $banner->delete();
        return redirect()->route('banner.list')->with('success_message', 'successfully deleted');
    }
}
