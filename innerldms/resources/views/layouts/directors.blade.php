@extends('layouts.mainpage')

@section('content')
<div class="container" >
    <div class="row">
      <div class="panel panel-info">
         <div class="panel-heading userhead">Directors Master</div>
       <div class="panel-body">
        <div class="col-md-12">
                <!-- Nav tabs -->
                <button onclick="tab1()" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-plus-sign"> Create</span></button>
                <button onclick="tab2()"  class="btn btn-info btn-sm" ><span class="glyphicon glyphicon-eye-open"> View</span></button>

                <div  id="Section2"><br>
                  <div class="content1" name="resulttablen">
                  <div id="directordetails" ></div>
                   </div>
                    </div>
										<div  id="Section1" >
                      <div  id="rstable" style="padding-top:30px;padding-bottom:40px;padding-left:40px;padding-right:40px;background-color:white;border:solid 1px #LightGray;">
                            <div class="content1" name="resulttablen" style="" >
								<form class="form-horizontal" id="director" method="post">
								{{csrf_field()}}
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Director Name </label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="name" placeholder="name" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Digital Signature Number </label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="digi_sign_num" placeholder="Digital Signature Number " required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Expiry Date </label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="exp_date" id="exp_date" placeholder="Expiry Date" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Advance Alert(No.of days) </label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="alertdays" placeholder="Advance Alert" required>
                  </div>
                </div>
                <input class="form-control" type="hidden"   name="id">

									<div class="form-group text-center">
											<button type="submit" class="btn btn-primary"  value="Save" id="btndirector">Save</button>
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
$('#exp_date').datetimepicker({
  format:"DD-MM-YYYY"
});

$('#Section2').hide();
dispDirector();
function tab1(){
$('#Section1').show();
$('#Section2').hide();
}

function tab2(){
  $('#Section2').show();
	$('#Section1').hide();
  $('#btndirector').html('Save');
  $('#btndirector').val('Save');
  $('#director')[0].reset();
  dispDirector();
}
function dispDirector(){
$.ajax({
  method:'get',
   url:'dispdirector',
   success:function(data){
       $('#directordetails').html(data.html);
     }
});
}
</script>
@endsection
