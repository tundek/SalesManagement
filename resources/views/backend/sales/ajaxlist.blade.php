
<table width="100%" class="table table-striped table-bordered table-hover" id="categorytable">
    <thead>
    <tr>
        <th>S.N.</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>sales Date</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1 ?>
    @foreach($sales as $pc)
        <tr>
            <th> {{$i++}}</th>
            <td>{{$pc->name}} </td>
            <td> {{$pc->quantity}}</td>
            <td>{{$pc->price}} </td>
            <td> {{$pc->sales_date}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3">Grand Total</td>
        <td>
            <?php $total=0 ?>
                @if($sales)
                    @foreach($sales as $s)
                        @php
                        $price = $s->price;
                        $total += $price;
                        @endphp
                    @endforeach
                    {{$total}}
                @endif
        </td>
        <td></td>
    </tr>
    </tbody>
</table>
