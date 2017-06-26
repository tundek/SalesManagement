@extends('backend.layouts.master')
@section('title')
    Salary Page
@endsection
@section('css')
    <link rel="stylesheet" href="/backend/plugins/select2.min.css"/>
@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Salary Management </h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 120px;">
                            <div class="input-group">
                                <a href="{{route('salary.list')}}" class="btn btn-success">View salary List</a>
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
                            <h2>Paid Salary Of Staff</h2>
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
                            <form id="btnSave" action="{{route('salary.store')}}" method="POST">
                                {{ csrf_field()}}
                                <div class="form-group">
                                    <label for="staff_id">Chose Staff</label>
                                    <select class="form-control js-example-basic-single" id="staff_id" name="staff_id" data-placeholder="--Search Staff--" >
                                        <option value="" selected>--Select staff--</option>
                                        @foreach($staff as $m)
                                            <option value="{{$m->id}}">{{$m->name}} Phone : {{$m->phone}} Salary: {{$m->salary}} /month</option>
                                        @endforeach
                                    </select>
                                    <span class="error"><b>
                                       @if($errors->has('staff_id'))
                                              {{$errors->first('staff_id')}}
                                       @endif</b>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="paid_amount">Paid Amount</label>
                                    <input type="number" class="form-control" id="paid_amount" name="paid_amount" placeholder="Enter Paid Aamount">
                                    <span class="error"><b>
                                         @if($errors->has('paid_amount'))
                                                {{$errors->first('paid_amount')}}
                                         @endif</b></span>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="btnSave" class="btn btn-primary">Paid Salary</button>
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
    <script src="/backend/plugins/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".js-example-basic-single").select2();
        });
    </script>
@endsection