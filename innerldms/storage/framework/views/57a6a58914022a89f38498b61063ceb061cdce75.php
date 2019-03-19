<?php $__env->startSection('content'); ?>



<h3 style="text-align:center">Visa Expiry Notifications</h3>
<div class="container" >
    <div class="row">
      <div class="col-md-1"></div>
     <div class="col-md-10">
      <div class="panel panel-info">
         <div class="panel-heading userhead">Notifications</div>
       <div class="panel-body">
          <div id="visanotifications" ></div>
           </div>
             <div class="col-md-1"></div>
             </div>
           </div>
            </div>
            </div>


            <h3 style="text-align:center">Document Renewal Notifications</h3>
            <div class="container" >
                <div class="row">
                  <div class="col-md-1"></div>
                <div class="col-md-10">
                  <div class="panel panel-info">
                     <div class="panel-heading userhead">Notifications</div>
                   <div class="panel-body">
                <div id="docnotifications" ></div>
                   </div>
                         <div class="col-md-1"></div>
                         </div>
                       </div>
                        </div>
                        </div>

                        <h3 style="text-align:center">Director Expiry Date Notifications</h3>
                        <div class="container" >
                            <div class="row">
                              <div class="col-md-1"></div>
                            <div class="col-md-10">
                              <div class="panel panel-info">
                                 <div class="panel-heading userhead">Notifications</div>
                               <div class="panel-body">
                            <div id="directornotifications" ></div>
                               </div>
                                     <div class="col-md-1"></div>
                                     </div>
                                   </div>
                                    </div>
                                    </div>


<script>

getVisaNotifications();
function getVisaNotifications(){
  $.ajax({

    type:'get',
    url:'getvisanotifications',
    success:function(data){
      //alert(data.html);
      $('#visanotifications').html(data.html);
    }
  })
}
getDocNotifications();
function getDocNotifications(){
  $.ajax({

    type:'get',
    url:'getdocnotifications',
    success:function(data){
      //alert(data.html);
      $('#docnotifications').html(data.html);
    }
  })
}

getDirectorNotifications();
function getDirectorNotifications(){
  $.ajax({
    type:'get',
    url:'getdirectoralert',
    success:function(data){
      //alert(data.html);
      $('#directornotifications').html(data.html);
    }
  })
}

</script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>