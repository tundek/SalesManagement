@extends('backend.layouts.master')
@section('title')
    Expenses Tracking Page
@endsection
@section('css')
    <link rel="stylesheet" href="/backend/plugins/select2.min.css" />
    <link  href="{{asset('backend/plugins/datepicker/datepicker.css')}}" rel="stylesheet">
@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Expenses Management</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 120px;">
                            <div class="input-group">
                                <a href="{{route('expenses.list')}}" class="btn btn-success">View expenses</a>
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
                            <h2>Expenses Tracking</h2>
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
                            <form action="{{route('expenses.store')}}" method="post">
                                {{ csrf_field()}}
                                <div class="form-group">
                                    <label for="expenses_name">Expenses Name</label>
                                    <input type="text" class="form-control" name="expenses_name" id="expenses_name" placeholder="Enter Expenses Name eg;- rent paid electricity">
                                    <span class="error"><b>
                                         @if($errors->has('expenses_name'))
                                              {{$errors->first('expenses_name')}}
                                         @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label for="party_name">Party Name</label>
                                    <input type="text" class="form-control" id="party_name" name="party_name" placeholder="Enter party_name">
                                    <span class="error"><b>
                                         @if($errors->has('party_name'))
                                              {{$errors->first('party_name')}}
                                         @endif</b></span>
                                </div>
                                <div class="form-group">
                                <label for="totalamount">Total Amount*</label>
                                    <input type="number" class="form-control" name="totalamount" id="totalamount" placeholder="Enter totalamount">
                                    <span class="error"><b>
                                         @if($errors->has('totalamount'))
                                                {{$errors->first('totalamount')}}
                                            @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label for="paidamount">Paid Amount*</label>
                                    <input type="number" class="form-control" name="paidamount" id="paidamount" placeholder="Enter paidamount">
                                    <span class="error"><b>
                                         @if($errors->has('paidamount'))
                                                {{$errors->first('paidamount')}}
                                            @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label for="product_name">Product Name*</label>
                                    <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter product_name">
                                    <span class="error"><b>
                                         @if($errors->has('product_name'))
                                                {{$errors->first('product_name')}}
                                            @endif</b></span>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="btnSave" class="btn btn-primary" >Make Purchase</button>
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
    <script src="backend/plugins/datepicker/datepicker.js"></script>
    <script type="text/javascript">
        $('[data-toggle="start"]').datepicker({
            format: 'yyyy-mm-dd'
        });

        $('[data-toggle="end"]').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
    <script src="/backend/plugins/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".js-example-basic-single").select2();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#product_id').on('change',function(){
                var prdid = $(this).val();
                var path = 'getprice';
                $.ajax({
                    url:path,
                    method:'post',
                    data:{'product_id' :prdid,'_token':$('input[name=_token]').val()},
                    dataType:'text',
                    success:function(resp){
                        console.log(resp);
                        //$('#price').empty();
                        $('#price').val(resp);
                    }
                });
            });

        });
    </script>
@endsection