<div class="table-responsive">
<table class="table table-bordered">
<thead class="thead">
<tr >
<th align="center"><center>Sl.No.</center></th>
<th align="center"><center>Name</center></th>
<th align="center"><center>Visa Exp Date</center></th>
</tr>
</thead>
<tbody style="font-family:Times New Roman;font-size: 1.7rem;">
<?php
$i=1;
$count=count($expdates);
?>
<?php for($j=0;$j<$count;$j++): ?>
<?php
$date=date('d-m-Y',strtotime($expdates[$j]));
?>
<tr style="background-color:white;text-align:justify">
<td><?php echo e($i++); ?></td>
<td><?php echo e($names[$j]); ?></td>
<td><?php echo e($date); ?></td>
</tr>
<?php endfor; ?>

</tbody>
</table>
</div>
