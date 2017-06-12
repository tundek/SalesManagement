@extends('backend.layouts.master')
@section('title')
    Make Sales Page
@endsection
@section('css')

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
                            <form action="" method="post">
                                {{ csrf_field()}}
                                <div class="form-group">
                                    <label for="productcategory_id">Chose ProductCategory</label>
                                    <select class="form-control" id="productcategory_id" name="productcategory_id">
                                        <option value="">--Select Productcategory--</option>
                                        @foreach($productcategory as $m)
                                            <option value="{{$m->id}}">{{$m->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error"><b>
                                       @if($errors->has('productcategory_id'))
                                                {{$errors->first('productcategory_id')}}
                                            @endif</b>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="product_id">Chose Product</label>
                                    <select class="form-control" id="product_id" name="product_id">
                                        <option value="">--Select Product--</option>
                                    </select>
                                    <span class="error"><b>
                                       @if($errors->has('product_id'))
                                                {{$errors->first('product_id')}}
                                            @endif</b>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity Available*</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity Available">
                                    <span class="error"><b>
                                         @if($errors->has('quantity'))
                                                {{$errors->first('quantity')}}
                                            @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price*</label>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter price">
                                    <span class="error"><b>
                                         @if($errors->has('price'))
                                                {{$errors->first('price')}}
                                         @endif</b></span>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="btnCreate" class="btn btn-primary" >Make Sales</button>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('#productcategory_id').change(function(){
                var catid = $(this).val();
                var path = 'getproduct';
                $.ajax({
                    url:path,
                    method:'post',
                    data:{'id' :catid,'_token':$('input[name=_token]').val()},
                    dataType:'text',
                    success:function(resp){
                        $('#product_id').empty();
                        $('#product_id').append(resp);

                    }

                });
            });
            $('#product_id').on('change',function(){
                var prdid = $(this).val();
                var path = 'getquantity';
                $.ajax({
                    url:path,
                    method:'post',
                    data:{'product_id' :prdid,'_token':$('input[name=_token]').val()},
                    dataType:'text',
                    success:function(resp){
                        console.log(resp);
                        //$('#price').empty();
                        $('#quantity').val(resp);

                    }

                });

            });
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