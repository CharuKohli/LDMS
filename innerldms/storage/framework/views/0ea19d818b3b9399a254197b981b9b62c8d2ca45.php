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
<tbody style="font-family:Times New Roman;font-size: 1.7rem;">
<?php $i=1;
?>
<?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$exp_date=null;

if($doc->exp_date!=null){
$exp_date=date('d-m-Y',strtotime($doc->exp_date));
}
?>
<tr style="background-color:white;text-align:justify">
<td><?php echo e($i++); ?></td>
<td><?php echo e($doc->name); ?></td>
<td><?php echo e($doc->digi_sign_num); ?></td>
<td><?php echo e($exp_date); ?></td>
<td><?php echo e($doc->alertdays); ?></td>
<td>
<button type="button"  class="btn btn-warning btn-xs editdirector" value="<?php echo e($doc->id); ?>"><span class="glyphicon glyphicon-pencil"></span> </button>
<button type="button"  class="btn btn-danger btn-xs deletedirector" value="<?php echo e($doc->id); ?>"><span class="glyphicon glyphicon-trash"></span> </button>
</td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
