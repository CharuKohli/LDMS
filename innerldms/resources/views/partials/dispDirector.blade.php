<div class="table-responsive">
<table class="table table-bordered">
<thead class="thead">
<tr >
<th align="center"><center>Sl.No.</center></th>
<th align="center"><center>Director Name</center></th>
<th align="center"><center>Digital Signature Number</center></th>
<th align="center"><center>Expiry Date </center></th>
<th align="center"><center>Advance Alert(No.of days)</center></th>

<th align="center"><center>Actions</center></th>

</tr>
</thead>
<tbody >
@php $i=1;
@endphp
@foreach($records as $doc)
@php
$exp_date=null;

if($doc->exp_date!=null){
$exp_date=date('d-m-Y',strtotime($doc->exp_date));
}
@endphp
<tr style="background-color:white;text-align:justify">
<td>{{$i++}}</td>
<td>{{$doc->name}}</td>
<td>{{$doc->digi_sign_num}}</td>
<td>{{$exp_date}}</td>
<td>{{$doc->alertdays}}</td>
<td>
<button type="button"  class="btn btn-warning btn-xs editdirector" value="{{$doc->id}}"><span class="glyphicon glyphicon-pencil"></span> </button>
<button type="button"  class="btn btn-danger btn-xs deletedirector" value="{{$doc->id}}"><span class="glyphicon glyphicon-trash"></span> </button>
</td>
</tr>
@endforeach

</tbody>
</table>
</div>

<script>
$('.deletedirector').click(function(){
  var res=confirm("Are you sure to delete this record?");
	if(res==true){
var id=$(this).val();
$.ajax({
  method:'get',
   url:'deletedirector/'+id,
   success:function(data){
       alert("record deleted successfully");
       $('#directordetails').html(data.html);
     }
});
}
});

$('.editdirector').click(function(){
  var res=confirm("Are you sure to edit this record?");
	if(res==true){
var id=$(this).val();
//alert(id);
$.ajax({
  method:'get',
   url:'editdirector/'+id,
   success:function(data){
           $('#Section2').hide();
           $('#Section1').show();
           var expdate=(data.record[0].exp_date).split('-');
           expdate=expdate[2]+"-"+expdate[1]+"-"+expdate[0];
           $('input[name=name]').val(data.record[0].name);
           $('input[name=digi_sign_num]').val(data.record[0].digi_sign_num);
           $('input[name=exp_date]').val(expdate);
           $('input[name=alertdays]').val(data.record[0].alertdays);
           $('input[name=id]').val(data.record[0].id);
           $('#btndirector').html('Update');
           $('#btndirector').val('Update');
   }
 });
}
});


</script>
