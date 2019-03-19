<div class="table-responsive">
<table class="table table-bordered">
<thead class="thead">
<tr >
<th align="center"><center>Sl.No.</center></th>
<th align="center"><center>Name</center></th>
<th align="center"><center>Country</center></th>
<th align="center"><center>Passport No.</center></th>
<th align="center"><center>Visa No.</center></th>
<th align="center"><center>Visa Expiry Date</center></th>
<th align="center"><center>Actions</center></th>

</tr>
</thead>
<tbody >
<?php $i=1;
?>
<?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$visa_exp_date=null;
if($record->visa_exp_date!=null)
{
$visa_exp_date=date('d-m-Y',strtotime($record->visa_exp_date));
}
?>
<tr style="background-color:white;text-align:justify">
<td><?php echo e($i++); ?></td>
<td><?php echo e($record->name); ?></td>
<td><?php echo e($record->country); ?></td>
<td><?php echo e($record->passport_num); ?></td>
<td><?php echo e($record->visa_num); ?></td>
<td><?php echo e($visa_exp_date); ?></td>

<td>
<button type="button"  class="btn btn-warning btn-xs editvisa" value="<?php echo e($record->id); ?>"><span class="glyphicon glyphicon-pencil"></span> </button>
<button type="button"  class="btn btn-danger btn-xs deletevisa" value="<?php echo e($record->id); ?>"><span class="glyphicon glyphicon-trash"></span> </button>
</td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</tbody>
</table>
</div>

<script>
$('.deletevisa').click(function(){
  var res=confirm("Are you sure to delete this record?");
	if(res==true){
var id=$(this).val();
//alert(id);
$.ajax({
  method:'get',
   url:'deletevisa/'+id,
   success:function(data){
       alert("record deleted successfully");
       $('#foreigndetails').html(data.html);
     }
});
}
});

$('.editvisa').click(function(){
  var res=confirm("Are you sure to edit this record?");
	if(res==true){
var id=$(this).val();
//alert(id);
$.ajax({
  method:'get',
   url:'editvisa/'+id,
   success:function(data){
           $('#Section2').hide();
           $('#Section1').show();
           var visa_exp_date=(data.record[0].visa_exp_date).split('-');
           visa_exp_date=visa_exp_date[2]+"-"+visa_exp_date[1]+"-"+visa_exp_date[0];
           $('input[name=name]').val(data.record[0].name);
           $('input[name=country]').val(data.record[0].country);
           $('input[name=passport_num]').val(data.record[0].passport_num);
           $('input[name=visa_num]').val(data.record[0].visa_num);
           $('input[name=visa_exp_date]').val(visa_exp_date);
           $('textarea[name=embassy_addr]').val(data.record[0].embassy_addr);
           $('input[name=alertdays]').val(data.record[0].alertdays);
           $('input[name=id]').val(data.record[0].id);
           $('#btnforeign').html('Update');
           $('#btnforeign').val('Update');
        }
      });
    }
  });


</script>
