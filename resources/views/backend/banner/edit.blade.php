@extends('backend.layouts.master')
@section('title')
    Banner Edit Page
@endsection
@section('css')

@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Banner Management </h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 75px;">
                            <div class="input-group">
                                <a href="{{route('banner.list')}}" class="btn btn-success">View Banner</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            @if(Session::has('success_message'))
                <div class="alert alert-success">
                    {{ Session::get('success_message') }}
                </div>
            @endif
            @if(Session::has('error_message'))
                <div class="alert alert-danger">
                    {{ Session::get('error_message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Edit Banner</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form action="{{route('banner.update',$banner->id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field()}}
                                <div class="form-group">
                                    <label for="short_description">Short Description (optional)</label>
                                    <input type="text" class="form-control" value="{{$banner->short_description}}" id="short_description" name="short_description"
                                           placeholder="Enter Short Description">
                                </div>
                                <div class="form-group">
                                    <label for="select">Image</label>
                                    <input type="file" value="select Image" id="select" name="image">
                                    <img src="/images/{{$banner->image}}" height="100" width="100">
                                    <span class="error"><b>
                                              @if($errors->has('image'))
                                                {{$errors->first('image')}}
                                            @endif</b></span>
                                </div>
                                <div class="form-group">
                                    @if($banner->status==1)
                                        <label>Status</label>
                                        <input type="radio" name="status" value="1" id="Active" checked=""><label
                                                for="Active"> Active</label>
                                        <input type="radio" name="status" id="deactive" value="0"><label for="deactive">De
                                            Active</label>
                                    @else
                                        <label>Status</label>
                                        <input type="radio" name="status" value="1" id="Active" ><label
                                                for="Active"> Active</label>
                                        <input type="radio" name="status" id="deactive" value="0" checked=""><label for="deactive">De
                                            Active</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @if($banner->slider_key==1)
                                        <label>feature Key</label>
                                        <input type="radio" name="slider_key" value="1" id="Actives" checked=""><label for="Actives">
                                            Active</label>
                                        <input type="radio" name="slider_key" id="deactives" value="0" ><label
                                                for="deactives">De Active</label>
                                    @else
                                        <label>feature Key</label>
                                        <input type="radio" name="slider_key" value="1" id="Actives"><label for="Actives">
                                            Active</label>
                                        <input type="radio" name="slider_key" id="deactives" value="0" checked=""><label
                                                for="deactives">De Active</label>
                                    @endif
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="btnCreate" class="btn btn-primary">Save  Banner Gallery</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@section('script')

@endsection