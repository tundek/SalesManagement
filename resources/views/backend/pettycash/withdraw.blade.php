@extends('backend.layouts.master')
@section('title')
    Petty Cash Withdraw Page
@endsection
@section('css')

@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Withdraw Management </h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 90px;">
                            <div class="input-group">
                                <a href="{{route('user.dashboard')}}" class="btn btn-success">Back To Dashboard</a>
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
                            <h2>Withdraw Petty cash</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a></li>
                                        <li><a href="#">Settings 2</a></li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form id="btnSave" action="{{route('withdraw-petty-cash.store')}}" method="POST">
                                {{ csrf_field()}}
                                <div class="form-group">
                                    <label for="totalwithdraw">Withdraw amount *</label>
                                    <input type="number" class="form-control" id="totalwithdraw" name="totalwithdraw" placeholder="Enter withdraw amount">
                                    @if($errors->has('totalwithdraw'))
                                        <span class="error">
                                            {{$errors->first('totalwithdraw')}}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="purpose">Purpose (Why withdraw ?)*</label>
                                    <input type="text" class="form-control" id="purpose" name="purpose" placeholder="Enter purpose eg Why withdraw cash">
                                    @if($errors->has('purpose'))
                                        <span class="error">
                                            {{$errors->first('purpose')}}
                                        </span>
                                    @endif
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="btnSave" class="btn btn-primary">Withdraw Cash</button>
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