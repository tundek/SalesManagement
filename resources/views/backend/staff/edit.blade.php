@extends('backend.layouts.master')
@section('title')
     Edit Page
@endsection
@section('css')

@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Staff Management </h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 75px;">
                            <div class="input-group">
                                <a href="{{route('staff.list')}}" class="btn btn-success">View staff</a>
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
                            <h2>Edit Staff Details</h2>
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
                            <form action="{{route('staff.update',$staff->id)}}" method="post">
                                {{ csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Name*</label>
                                    <input type="text" value="{{$staff->name}}" class="form-control" id="name" name="name"
                                           placeholder="Enter name">
                                    <span class="error"><b>
                                           @if($errors->has('name'))
                                                {{$errors->first('name')}}
                                            @endif</b>
                                     </span>
                                </div>
                                <div class="form-group">
                                    <label for="phone">phone*</label>
                                    <input type="text" value="{{$staff->phone}}" class="form-control" id="phone" name="phone" placeholder="Enter Staff's Phone Number">
                                    <span class="error"><b>
                                         @if($errors->has('phone'))
                                                {{$errors->first('phone')}}
                                            @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label for="designation">Designation*</label>
                                    <input type="text" class="form-control" id="designation" value="{{$staff->designation}}" name="designation" placeholder="Enter designation">
                                    <span class="error"><b>
                                         @if($errors->has('designation'))
                                                {{$errors->first('designation')}}
                                            @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label for="salary">Salary*</label>
                                    <input type="number" class="form-control" value="{{$staff->salary}}" id="salary" name="salary" placeholder="Enter sallery Monthly sallery">
                                    <span class="error"><b>
                                         @if($errors->has('salary'))
                                                {{$errors->first('salary')}}
                                            @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    @if($staff->status == 1)
                                        <input type="radio" name="status" value="1" id="Active" checked=""><label for="Active"> Working</label>
                                        <input type="radio" name="status" id="deactive" value="0"><label for="deactive">Leave</label>
                                    @else
                                        <input type="radio" name="status" value="1" id="Active" ><label for="Active"> Working</label>
                                        <input type="radio" name="status" id="deactive" value="0" checked=""><label for="deactive">Leave</label>
                                    @endif
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="btnCreate" class="btn btn-primary" >Update staff Details</button>
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
    <script src="/backend/plugins/ckeditor/ckeditor.js"></script>
@endsection