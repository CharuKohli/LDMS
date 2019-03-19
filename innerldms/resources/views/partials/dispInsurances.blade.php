<div class="table-responsive">
<table class="table table-bordered">
<thead class="thead">
<tr >
<th align="center"><center>Sl.No.</center></th>
<th align="center"><center>Insurance Name</center></th>
<th align="center"><center>Company</center></th>
<th align="center"><center>Date</center></th>
<th align="center"><center>Amount Paid</center></th>
<th align="center"><center>Expiry Date</center></th>
<th align="center"><center># Renewals</center></th>
<th align="center"><center>Contact Person</center></th>
<th align="center"><center>Contact Number</center></th>
<th align="center"><center>Advance Alert</center></th>
<th align="center"><center>Insurance Certificate</center></th>
<th align="center"><center>Actions</center></th>

</tr>
</thead>
<tbody >
@php $i=1;
@endphp
@foreach($records as $doc)
@php
$date=null;
$exp_date=null;
if($doc->exp_date!=null){
$exp_date=date('d-m-Y',strtotime($doc->exp_date));
}
if($doc->date!=null){
  $date=date('d-m-Y',strtotime($doc->date));
}
@endphp
<tr style="background-color:white;text-align:justify">
<td>{{$i++}}</td>
<td>{{$doc->name}}</td>
<td>{{$doc->company}}</td>
<td>{{$date}}</td>
<td>{{$doc->amt_paid}}</td>
<td>{{$exp_date}}</td>
<td>{{$doc->no_of_renewals}}</td>
<td>{{$doc->contact_person}}</td>
<td>{{$doc->contact_number}}</td>
<td>{{$doc->alertdays}}</td>
<td>
  <button type="button" class="btn btn-primary btn-xs showinscertificates" value="{{$doc->id}}">View/Edit</button>
</td>
<td>
<button type="button"  class="btn btn-warning btn-xs editinsurance" value="{{$doc->id}}"><span class="glyphicon glyphicon-pencil"></span> </button>
<button type="button"  class="btn btn-danger btn-xs deleteinsurance" value="{{$doc->id}}"><span class="glyphicon glyphicon-trash"></span> </button>
</td>
</tr>
@endforeach

</tbody>
</table>
</div>
<div id="myModal" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-body">
          <div id="docs">

          </div>

          </div>
          <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     </div>
        </div>
    </div>
  </div>

<script>
$('.deleteinsurance').click(function(){
  var res=confirm("Are you sure to delete this record?");
	if(res==true){
var id=$(this).val();
//alert(id);
$.ajax({
  method:'get',
   url:'deleteinsurance/'+id,
   success:function(data){
       alert("record deleted successfully");
       $('#insurancedetails').html(data.html);
     }
});
}
});

$('.editinsurance').click(function(){
  var res=confirm("Are you sure to edit this record?");
	if(res==true){
var id=$(this).val();
//alert(id);
$.ajax({
  method:'get',
   url:'editinsurance/'+id,
   success:function(data){
           $('#Section2').hide();
           $('#Section1').show();
           var date=(data.record[0].date).split('-');
           date=date[2]+"-"+date[1]+"-"+date[0];
           var exp_date=(data.record[0].exp_date).split('-');
           exp_date=exp_date[2]+"-"+exp_date[1]+"-"+exp_date[0];
           $('input[name=name]').val(data.record[0].name);
           $('input[name=company]').val(data.record[0].company);
           $('input[name=date]').val(date);
           $('input[name=exp_date]').val(exp_date);
           $('input[name=amt_paid]').val(data.record[0].amt_paid);
           $('input[name=alertdays]').val(data.record[0].alertdays);
           $('input[name=no_of_renewals]').val(data.record[0].no_of_renewals);
           $('input[name=contact_person]').val(data.record[0].contact_person);
           $('input[name=contact_number]').val(data.record[0].contact_number);
           $('input[name=id]').val(data.record[0].id);
           $('#btninsurance').html('Update');
           $('#btninsurance').val('Update');
   }
 });
}
});

$('.showinscertificates').click(function(){
var id=$(this).val();
$.ajax({
  method:'get',
   url:'showinscertificates/'+id,
   success:function(data){
       var docimages=data.html;
      $('#docs').html(docimages);
       $('#myModal').modal('show');
     }
});
});

</script>
