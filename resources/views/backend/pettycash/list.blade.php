@extends('backend.layouts.master')
@section('title')
   Petty Cash Listing Page
@endsection
@section('css')

@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Petty cash Management</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 140px;">
                            <div class="input-group">
                                <a href="{{route('petty-cash.create')}}" class="btn btn-success">Leave cash</a>
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
                            <h2>petty Cash Details</h2>
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
                                    <th>totalcash</th>
                                    <th>Leaved By</th>
                                    <th>Leaved Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1 ?>
                                @foreach($pettycash as $pc)
                                    <tr>
                                        <th> {{$i++}}</th>
                                        <td>{{$pc->totalcash}} </td>
                                        <td>{{$pc->created_by}} </td>
                                        <td>{{$pc->created_at}} </td>
                                        <td><a href="{{route('petty-cash.edit',$pc->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>

                                            <form action="{{route('petty-cash.delete' ,$pc->id)}}" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{ csrf_field()}}
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('are you sure to delete?')" ><i class="fa fa-trash-o"></i> Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="">Total Leave Cash</td>
                                    <td>
                                        {{$totalcash}}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="">Total Remaining Petty Cash</td>
                                    <td>
                                        {{$totalcash - $totalwithdraw}}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                         <br>
                        <h2>Petty Cash Withdraw transaction Details</h2>
                        <hr>
                        <div class="x_content">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="categorytable">
                                <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Purpose</th>
                                    <th>WithDraw Mount</th>
                                    <th>WithDraw By</th>
                                    <th>WithDraw Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1 ?>
                                @foreach($withdraw as $pc)
                                    <tr>
                                        <th> {{$i++}}</th>
                                        <td>{{$pc->purpose}} </td>
                                        <td>{{$pc->totalwithdraw}} </td>
                                        <td>{{$pc->created_by}} </td>
                                        <td>{{$pc->created_at}} </td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2">Total Withdraw</td>
                                    <td>
                                       {{$totalwithdraw}}
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tfoot>
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

@endsection