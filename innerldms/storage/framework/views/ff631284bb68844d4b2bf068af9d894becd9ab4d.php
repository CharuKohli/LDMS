<div class="table-responsive">
<table class="table table-bordered">
<thead class="thead">
<tr >
<th align="center"><center>Sl.No.</center></th>
<th align="center"><center>Name</center></th>
<th align="center"><center>Purpose</center></th>
<th align="center"><center>Date</center></th>
<th align="center"><center>Renewal Date</center></th>
<th align="center"><center>#License Renewed</center></th>
<th align="center"><center>Amount</center></th>
<th align="center"><center>Doc shared with</center></th>
<th align="center"><center>Document</center></th>
<th align="center"><center>Actions</center></th>

</tr>
</thead>
<tbody >
<?php $i=1;
?>
<?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$reg_date=null;
$renewal_date=null;
$imgpath=null;
if($doc->reg_date!=null){
$reg_date=date('d-m-Y',strtotime($doc->reg_date));
}
if($doc->renewal_date!=null){
  $renewal_date=date('d-m-Y',strtotime($doc->renewal_date));
}
$imgpath=$doc->doc_image_path;
echo $imgpath;
?>
<tr style="background-color:white;text-align:justify">
<td><?php echo e($i++); ?></td>
<td><?php echo e($doc->doc_name); ?></td>
<td><?php echo e($doc->purpose); ?></td>
<td><?php echo e($reg_date); ?></td>
<td><?php echo e($renewal_date); ?></td>
<td><?php echo e($doc->count_doc_renewed); ?></td>
<td><?php echo e($doc->amount); ?></td>
<td><?php echo e($doc->doc_shared_to); ?></td>
<td>
  <button type="button" class="btn btn-primary btn-xs showdocuments" value="<?php echo e($doc->id); ?>">View/Edit</button>

  <!-- <?php if($imgpath!=null): ?>
  <button type="button" class="btn btn-primary btn-xs showbill" value="<?php echo e($doc->id); ?>">View/Edit</button>
    <?php endif; ?> -->
</td>
<td>
<button type="button"  class="btn btn-warning btn-xs editdoc" value="<?php echo e($doc->id); ?>"><span class="glyphicon glyphicon-pencil"></span> </button>
<button type="button"  class="btn btn-danger btn-xs deletedoc" value="<?php echo e($doc->id); ?>"><span class="glyphicon glyphicon-trash"></span> </button>
</td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
$('.deletedoc').click(function(){
  var res=confirm("Are you sure to delete this record?");
	if(res==true){
var id=$(this).val();
//alert(id);
$.ajax({
  method:'get',
   url:'deletedoc/'+id,
   success:function(data){
       alert("record deleted successfully");
       $('#docdetails').html(data.html);
     }
});
}
});

$('.editdoc').click(function(){
  var res=confirm("Are you sure to edit this record?");
	if(res==true){
var id=$(this).val();
//alert(id);
$.ajax({
  method:'get',
   url:'editdoc/'+id,
   success:function(data){
           $('#Section2').hide();
           $('#Section1').show();
           var regdate=(data.docrecord[0].reg_date).split('-');
           regdate=regdate[2]+"-"+regdate[1]+"-"+regdate[0];
           var renewal_date=(data.docrecord[0].renewal_date).split('-');
           renewal_date=renewal_date[2]+"-"+renewal_date[1]+"-"+renewal_date[0];
           $('input[name=regname]').val(data.docrecord[0].doc_name);
           $('input[name=purpose]').val(data.docrecord[0].purpose);
           $('input[name=date]').val(regdate);
           $('input[name=renewaldate]').val(renewal_date);
           $('input[name=number]').val(data.docrecord[0].count_doc_renewed);
           $('input[name=amount]').val(data.docrecord[0].amount);
           $('input[name=sharedwith]').val(data.docrecord[0].doc_shared_to);
           $('input[name=alertdays]').val(data.docrecord[0].alertdays);
           $('input[name=id]').val(data.docrecord[0].id);
           $('#btndoc').html('Update');
           $('#btndoc').val('Update');
   }
 });
}
});

$('.showdocuments').click(function(){
var id=$(this).val();
$.ajax({
  method:'get',
   url:'showdocuments/'+id,
   success:function(data){
       var docimages=data.html;
      $('#docs').html(docimages);
       $('#myModal').modal('show');
     }
});
});
</script>
