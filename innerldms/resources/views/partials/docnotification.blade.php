
@if(count($renewaldates) <= 0)
<div class="alert alert-danger"  style="">
<strong>There are no notifications</strong>
</div>
@else
<div class="table-responsive">
<table class="table table-bordered">
<thead class="thead">
<tr >
<th align="center"><center>Sl.No.</center></th>
<th align="center"><center>Document Name</center></th>
<th align="center"><center>Renewal Date</center></th>
</tr>
</thead>
<tbody style="font-family:Times New Roman;font-size: 1.7rem;">
@php
$i=1;
$count=count($renewaldates);
@endphp
@for($j=0;$j<$count;$j++)
@php
$date=date('d-m-Y',strtotime($renewaldates[$j]));
@endphp
<tr style="background-color:white;text-align:justify">
<td>{{$i++}}</td>
<td>{{$docnames[$j]}}</td>
<td>{{$date}}</td>
</tr>
@endfor

</tbody>
</table>
</div>
@endif
