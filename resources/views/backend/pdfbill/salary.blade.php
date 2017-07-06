<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Salary Document</title>
</head>
<body>
<h2 align="center">Salary Paid sheet</h2>
<table border="1" align="center" cellpadding="5">
    <thead>
    <tr>
        <th>S.N.</th>
        <th>staff Name</th>
        <th>Paid Date</th>
        <th>Paid Amount</th>
        <th>paid by</th>
        <th>paid Date</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1 ?>
    @foreach($allsalaryreport as $all)
    <tr>
        <td>{{$i++}}</td>
        <td>{{$all->name}}</td>
        <td>{{$all->paid_date}}</td>
        <td>{{$all->paid_amount}}</td>
        <td>{{$all->created_by}}</td>
        <td>{{$all->created_at}}</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="3">Total paid</td>
        <td>
            <?php $total=0 ?>
            @if($allsalaryreport)
                @foreach($allsalaryreport as $s)
                    @php
                     $price = $s->paid_amount;
                     $total += $price;
                    @endphp
                @endforeach
                Rs. {{$total}}
            @endif
        </td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>
</body>
</html>


