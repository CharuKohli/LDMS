@extends('layouts.mainpage')

@section('content')
<div class="container" >
    <div class="row">
      <div class="panel panel-info">
         <div class="panel-heading userhead">Document Registration</div>
       <div class="panel-body">
        <div class="col-md-12">
                <!-- Nav tabs -->
                <button onclick="tab1()" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-plus-sign"> Create</span></button>
                <button onclick="tab2()"  class="btn btn-info btn-sm" ><span class="glyphicon glyphicon-eye-open"> View</span></button>

                <div  id="Section2"><br>
                  <div class="content1" name="resulttablen">
                  <div id="docdetails" ></div>
                   </div>
                    </div>
										<div  id="Section1" >
                      <div  id="rstable" style="padding-top:30px;padding-bottom:40px;padding-left:40px;padding-right:40px;background-color:white;border:solid 1px #LightGray;">
                            <div class="content1" name="resulttablen" style="" >
								<form class="form-horizontal" id="postdoc" method="post">
								{{csrf_field()}}
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Registration Name</label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="regname" placeholder="name" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Registration Purpose</label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="purpose" placeholder="purpose" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Date</label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text" id="date" name="date" placeholder="date" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Renewal Date</label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text" id="renewaldate" name="renewaldate" placeholder="renewal date" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Number of times license renewed</label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="number"  name="number" placeholder="number " required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Amount</label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"   name="amount" placeholder="amount" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Upload document</label>
                    <div class="col-md-7 col-sm-10">
                      <input  type="file"  name="docfile[]" id="docfile" multiple>
											<span id="invalidfile"></span>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Document shared with</label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"   name="sharedwith" placeholder="Document shared with" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Advance Alert(no.of days)</label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"   name="alertdays" placeholder="Advance Alert" required>
                  </div>
                </div>
                <input class="form-control" type="hidden"   name="id" >


									<div class="form-group text-center">
											<button type="submit" class="btn btn-primary"  value="Save" id="btndoc">Save</button>
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
$('#date').datetimepicker({
  format:"DD-MM-YYYY"
});
$('#renewaldate').datetimepicker({
  format:"DD-MM-YYYY"
});
$('#Section2').hide();
dispDocs();
function tab1(){
$('#Section1').show();
$('#Section2').hide();
}

function tab2(){
  $('#Section2').show();
	$('#Section1').hide();
  $('#btndoc').html('Save');
  $('#btndoc').val('Save');
  $('#postdoc')[0].reset();
  dispDocs();
}
function dispDocs(){
$.ajax({
  method:'get',
   url:'dispdocs',
   success:function(data){
       $('#docdetails').html(data.html);
     }
});
}
</script>
@endsection
