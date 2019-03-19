@extends('layouts.mainpage')

@section('content')
<div class="container" >
    <div class="row">
      <div class="panel panel-info">
         <div class="panel-heading userhead">Foreign Nationals</div>
       <div class="panel-body">
        <div class="col-md-12">
                <!-- Nav tabs -->
                <button onclick="tab1()" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-plus-sign"> Create</span></button>
                <button onclick="tab2()"  class="btn btn-info btn-sm" ><span class="glyphicon glyphicon-eye-open"> View</span></button>

                <div  id="Section2"><br>
                  <div class="content1" name="resulttablen">
                  <div id="foreigndetails" ></div>
                   </div>
                    </div>
										<div  id="Section1" >
                      <div  id="rstable" style="padding-top:30px;padding-bottom:40px;padding-left:40px;padding-right:40px;background-color:white;border:solid 1px #LightGray;">
                            <div class="content1" name="resulttablen" style="" >
								<form class="form-horizontal" id="foreign" method="post">
								{{csrf_field()}}
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Name </label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="name" placeholder="name" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Country</label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="country" placeholder="country" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Passport No.</label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="passport_num" placeholder="Passport No." required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Visa No.</label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="visa_num" placeholder="Visa No." required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Visa Expiry Date</label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text" id="visaexdate" name="visa_exp_date" placeholder="Visa Expiry Date " required>
                  </div>
                </div>
								<div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Embassy Address</label>
                    <div class="col-md-7 col-sm-10">
                      <textarea class="form-control" type="text"  name="embassy_addr" placeholder="Embassy Address " required></textarea>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Advance Alert(no.of days)</label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"   name="alertdays" placeholder="Advance Alert" required>
                  </div>
                </div>
                <input class="form-control" type="hidden"   name="id">

									<div class="form-group text-center">
											<button type="submit" class="btn btn-primary"  value="Save" id="btnforeign">Save</button>
									</div>
							</form>
						</div>

                                </div>
                            </div>
                </div>
            </div>
        </div>

</div>
</div>
<script>
$('#visaexdate').datetimepicker({
  format:"DD-MM-YYYY"
});
$('#Section2').hide();
dispForeignDocs();
function tab1(){
$('#Section1').show();
$('#Section2').hide();
}

function tab2(){
  $('#Section2').show();
	$('#Section1').hide();
  $('#btnforeign').html('Save');
  $('#btnforeign').val('Save');
  $('#foreign')[0].reset();
  dispForeignDocs();
}
function dispForeignDocs(){
$.ajax({
  method:'get',
   url:'dispforeignrecord',
   success:function(data){
       $('#foreigndetails').html(data.html);
     }
});
}
</script>
@endsection
