@extends('backend.layouts.master')
@section('title')
    Make Sales Page
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
                    <h3>Sales Management </h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 75px;">
                            <div class="input-group">
                                <a href="{{route('sales.list')}}" class="btn btn-success">View Sales Report</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            @if(Session::has('success_message'))
                <div class="alert alert-success">
                    {{ Session::get('success_message') }}<div id="msg"></div>
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
                            <h2>sales Product</h2>
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
                            <form id="btnSave" action="{{route('sales.store')}}" method="POST">
                                {{ csrf_field()}}
                                <div class="form-group">
                                    <label for="product_id">Chose Product</label>
                                    <select class="form-control js-example-basic-single" id="product_id" name="product_id" data-placeholder="--Search Product--" required>
                                        <option value="" selected>--Select Product--</option>
                                        @foreach($product as $m)
                                            <option value="{{$m->id}}">Code: {{$m->code}} {{$m->name}} Stock:{{$m->stock}} &nbsp;  Price:{{$m->price}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error"><b>
                                       @if($errors->has('product_id'))
                                              {{$errors->first('product_id')}}
                                       @endif</b>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Stock Available</label>
                                    <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock Available" disabled>
                                    <span class="error"><b>
                                         @if($errors->has('stock'))
                                                {{$errors->first('stock')}}
                                         @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price*</label>
                                    <input type="number" class="form-control" name="price" id="price" placeholder="price" required>
                                    <span class="error"><b>
                                         @if($errors->has('price'))
                                                {{$errors->first('price')}}
                                         @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label for="sales_quantity">Sales Quantity</label>
                                    <input type="number" min="1" class="form-control" id="sales_quantity" name="sales_quantity" placeholder="Quantity" required>
                                    <span class="error"><b>
                                         @if($errors->has('sales_quantity'))
                                                {{$errors->first('sales_quantity')}}
                                         @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label>Sales Status:- &nbsp;</label>
                                    <input type="radio" name="sales_status" value="1" id="Active" checked=""><label for="Active"> Cash Sales </label>
                                    <input type="radio" name="sales_status" id="deactive" value="0"><label for="deactive"> Credit Sales </label>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="btnSave" class="btn btn-primary">Make
                                        Sales
                                    </button>
                                </div>
                            </form>
                            <br><br>
                            <div id="saleslist">
                            </div>
                            <a href="{{route('sales.printall')}}" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
@section('script')
    <script type="text/javascript" src="/backend/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#categorytable').DataTable();
        });
    </script>
    <script src="/backend/plugins/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".js-example-basic-single").select2();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#product_id').on('change', function () {
                var prdid = $(this).val();
                var path = 'getquantity';
                $.ajax({
                    url: path,
                    method: 'post',
                    data: {'product_id': prdid, '_token': $('input[name=_token]').val()},
                    dataType: 'text',
                    success: function (resp) {
                        console.log(resp);
                        $('#quantity').empty();
                        $('#stock').val(resp);
                    }
                });

            });
            $('#product_id').on('change', function () {
                var prdid = $(this).val();
                var path = 'getprice';
                $.ajax({
                    url: path,
                    method: 'post',
                    data: {'product_id': prdid, '_token': $('input[name=_token]').val()},
                    dataType: 'text',
                    success: function (resp) {
                        console.log(resp);
                        $('#price').empty();
                        $('#price').val(resp);
                    }
                });
            });
//            $('#sales_quantity').keyup(function () {
//                var qty = $(this).val();
//                var price = $('#price').val();
//                var path = 'gettotalprice';
//                $.ajax({
//                    url: path,
//                    method: 'post',
//                    data: {'sales_quantity': qty, 'price': price, '_token': $('input[name=_token]').val()},
//                    dataType: 'text',
//                    success: function (resp) {
//                        console.log('keyed');
//                        //$('#price').empty();
//                        $('#price').val(resp);
//                    }
//                });
//            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CRF-TOKEN': $('meat[name = "csrf-token"]').attr('content')
                }
            });
            $('#btnSave').on('submit', function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                var data = $(this).serialize();
                $.ajax({
                    url: url,
                    type: post,
                    data: data,
                    success: function (data) {
                        readsales();
                        alert(data.success_message);
                        document.getElementById("btnSave").reset();
                    }
                });
            });
        });
        readsales();
        function readsales() {
            $.ajax({
                type: 'get',
                url: "{{url('ajaxsales-list')}}",
                dataType: 'html',
                success: function (data) {
                    $('#saleslist').html(data);
                }
            })
        }

    </script>
@endsection