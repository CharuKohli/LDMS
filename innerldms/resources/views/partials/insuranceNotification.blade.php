@if(count($expdates) <= 0)
<div class="alert alert-danger"  style="">
<strong>There are no notifications</strong>
</div>
@else
<div class="table-responsive">
<table class="table table-bordered">
<thead class="thead">
<tr >
<th align="center"><center>Sl.No.</center></th>
<th align="center"><center>Insurance Name</center></th>
<th align="center"><center>Expiry Date</center></th>
</tr>
</thead>
<tbody style="font-family:Times New Roman;font-size: 1.7rem;">
@php
$i=1;
$count=count($expdates);
@endphp
@for($j=0;$j<$count;$j++)
@php
$date=date('d-m-Y',strtotime($expdates[$j]));
@endphp
<tr style="background-color:white;text-align:justify">
<td>{{$i++}}</td>
<td>{{$names[$j]}}</td>
<td>{{$date}}</td>
</tr>
@endfor

</tbody>
</table>
</div>
@endif
