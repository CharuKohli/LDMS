@extends('layouts.mainpage')
@section('content')



<h4 style="text-align:center">Visa Expiry Notifications</h4>
<div class="container" >
    <div class="row">
      <div class="col-md-1"></div>
     <div class="col-md-10">

          <div id="visanotifications" ></div>
           </div>
             <div class="col-md-1"></div>
             </div>
           </div>



            <h4 style="text-align:center">Document Renewal Notifications</h4>
            <div class="container" >
                <div class="row">
                  <div class="col-md-1"></div>
                <div class="col-md-10">

                <div id="docnotifications" ></div>
                   </div>
                         <div class="col-md-1"></div>
                         </div>
                       </div>


                        <h4 style="text-align:center">Director Expiry Date Notifications</h4>
                        <div class="container" >
                            <div class="row">
                              <div class="col-md-1"></div>
                            <div class="col-md-10">

                            <div id="directornotifications" ></div>
                               </div>
                                     <div class="col-md-1"></div>
                                     </div>
                                   </div>

  <h4 style="text-align:center">Insurance Expiry Date Notifications</h4>
                                    <div class="container" >
                                        <div class="row">
                                          <div class="col-md-1"></div>
                                        <div class="col-md-10">

                                        <div id="insurancenotifications" ></div>
                                           </div>
                                                 <div class="col-md-1"></div>
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

getInsuranceNotifications();
function getInsuranceNotifications(){
  $.ajax({
    type:'get',
    url:'getinsurancealert',
    success:function(data){
      //alert(data.html);
      $('#insurancenotifications').html(data.html);
    }
  })
}

</script>



@endsection('content')
