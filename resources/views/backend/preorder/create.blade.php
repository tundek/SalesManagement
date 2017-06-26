@extends('backend.layouts.master')
@section('title')
    PreOrder Page
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
                    <h3>PreOrder Management</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 120px;">
                            <div class="input-group">
                                <a href="{{route('preorder.list')}}" class="btn btn-success">View Preorder</a>
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
                            <h2>PreOrder Product</h2>
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
                            <form action="{{route('preorder.store')}}" method="post">
                                {{ csrf_field()}}
                                <div class="form-group">
                                    <label for="product_id">Chose Product</label>
                                    <select class="form-control js-example-basic-single" id="product_id" name="product_id" data-placeholder="--Search Product--">
                                        <option value="">--Select Product--</option>
                                        @foreach($product as $m)
                                            <option value="{{$m->id}}" >{{$m->name}} Price : {{$m->price}} /pices</option>
                                        @endforeach
                                    </select>
                                    <span class="error"><b>
                                       @if($errors->has('product_id'))
                                              {{$errors->first('product_id')}}
                                       @endif</b>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price*</label>
                                    <input type="number" class="form-control" name="price" id="price" placeholder="price">
                                    <span class="error"><b>
                                         @if($errors->has('price'))
                                              {{$errors->first('price')}}
                                         @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity">
                                    <span class="error"><b>
                                         @if($errors->has('quantity'))
                                              {{$errors->first('quantity')}}
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
                                    <label for="customer_name">Customer Name*</label>
                                    <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Enter customer_name">
                                    <span class="error"><b>
                                         @if($errors->has('customer_name'))
                                                {{$errors->first('customer_name')}}
                                            @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label for="customer_phone">Customer Phone*</label>
                                    <input type="number" class="form-control" name="customer_phone" id="customer_phone" placeholder="Enter customer_phone">
                                    <span class="error"><b>
                                         @if($errors->has('customer_phone'))
                                                {{$errors->first('customer_phone')}}
                                            @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label for="order_pick">Order Pick Date*</label>
                                    <input type="text" class="form-control" data-toggle="start"  name="order_pick" id="order_pick" placeholder="Enter order_pick">
                                    <span class="error"><b>
                                         @if($errors->has('order_pick'))
                                                {{$errors->first('order_pick')}}
                                         @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label for="message">Name On Cake / Message*</label>
                                    <input type="text" class="form-control" name="message" id="message" placeholder="Enter message">
                                    <span class="error"><b>
                                         @if($errors->has('message'))
                                                {{$errors->first('message')}}
                                            @endif</b></span>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="btnSave" class="btn btn-primary" >Make Sales</button>
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