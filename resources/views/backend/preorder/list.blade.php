@extends('backend.layouts.master')
@section('title')
   PreOrder Listing Page
@endsection
@section('css')

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
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 110px;">
                            <div class="input-group">
                                <a href="{{route('preorder.create')}}" class="btn btn-success">Make New Order</a>
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
                            <h2>Current PreOrder Deails</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                            <table width="100%" class="table table-striped table-bordered table-hover" id="categorytable">
                                <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Total Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Due Amount</th>
                                    <th>Pick Date</th>
                                    <th>Customer Name</th>
                                    <th>Customer Phone</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1 ?>
                                @foreach($preorder as $pc)
                                    <tr>
                                        <th> {{$i++}}</th>
                                        <td> {{$pc->name}}</td>
                                        <td> {{$pc->quantity}}</td>
                                        <td> {{$pc->totalamount}}</td>
                                        <td> {{$pc->paidamount}}</td>
                                        <td> {{$pc->dueamount}}</td>
                                        <td> {{$pc->order_pick}}</td>
                                        <td> {{$pc->customer_name}}</td>
                                        <td> {{$pc->customer_phone}}</td>
                                        <td> {{$pc->message}}</td>
                                        <td> <a href="{{route('preorder.update',$pc->id)}}" class="btn btn-info" onclick="return confirm('Does HE/SHE paid Due Amount?')"> Delivered</a> </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <h2>Delivered preorder details</h2>
                        <hr>
                        <div class="x_content">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="categorytable">
                                <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Total Amount</th>

                                    <th>Pick Date</th>
                                    <th>Customer Name</th>
                                    <th>Customer Phone</th>
                                    <th>Message</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1 ?>
                                @foreach($finalpreorder as $pc)
                                    <tr>
                                        <th> {{$i++}}</th>
                                        <td> {{$pc->name}}</td>
                                        <td> {{$pc->quantity}}</td>
                                        <td> {{$pc->totalamount}}</td>
                                        <td> {{$pc->order_pick}}</td>
                                        <td> {{$pc->customer_name}}</td>
                                        <td> {{$pc->customer_phone}}</td>
                                        <td> {{$pc->message}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
        $(document).ready(function() {
            $('#categorytable').DataTable();
        });
    </script>
@endsection