
<div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-10" style="height:500px;">
    <!-- <img src="" id="uservoucherimg" class="img-responsive"> -->

      <form class="form-horizontal" id="docupload">
      {{csrf_field()}}
     <div class="form-group">
        <label class="col-md-3 control-label" for="exampleInputFirstName2">Upload Document</label>
        <div class="col-md-5">
          <input  type="file"  name="docfile[]" id="docfile" multiple>
         <span id="invalidfile"></span>
        </div>
        <div class="col-md-2" >
          <button class="btn btn-primary" type="submit">Upload</button>
        </div>
    </div>
  </form>

<br><br>

  <div class="row" style="border:solid 1px black;overflow:scroll;overflow-x: auto;height:450px">
  <div style="margin:10px;font-weight:600">
   <p  class="dummyInline"> Document Name :<span style="color:blue">{{$doc_name}}</span></p>
 </div>
    @php
    $len=count($docid);
    @endphp
    @for($i=0;$i<$len;$i++)
    @php
         $path=$docimgpath[$i];
         $imageid=$docid[$i];
    @endphp
<div class="voucher-pic" >


<img src="{{$path}}" class="img-thumbnail" align="center"alt="no image">
<li class="delete" value="{{$imageid}}"><i class="fa fa-trash fa-lg"></i></li>

</div>

<hr>
@endfor
</div>
  </div>
  </div>
<script>

$('#docupload').submit(function(e){
  e.preventDefault();
  var file_data = $('#docfile').prop('files');

  var numof_files=file_data.length;
  //alert(numof_files);
  var finaldata=new FormData();
  for(var i=0;i<numof_files;i++){
  finaldata.append('file[]', file_data[i]);
  }

  var id='{!! $id !!}';
  var docname='{!! $doc_name !!}';
  finaldata.append('docname',docname);
  finaldata.append('id',id);
if(numof_files!=0){
  $('#invalidfile').html(null);
  $.ajax({
      type:'post',
      url:'uploaddocimage',
      data:finaldata,
      dataType : "json",
      contentType: false,
      cache: false,
      processData:false,
      success:function(data){
      alert(data.msg);
      showAllDocImages(id);
      }

  });
}else{
  $('#invalidfile').html('Please select image before uploading');
  $('#invalidfile').css('color','red');
}
});

$('.delete').click(function(){

  var imgid=$(this).val();
//  alert(imgid);
  var res=confirm("Are you sure to delete this voucher?");
  	if(res==true){
  $.ajax({
    type:'get',
    url:'deletedocimage/'+imgid,
    success:function(data){
      var id='{!! $id !!}';
      showAllDocImages(id);
    }
  });
}
});

function showAllDocImages(id){
  $.ajax({
    method:'get',
     url:'showdocuments/'+id,
     success:function(data){
         var docimages=data.html;
        $('#docs').html(docimages);
         $('#myModal').modal('show');
       }
  });
}

</script>
<style>
.voucher-pic {
	position: relative;
	display: inline-block;
}

.voucher-pic:hover .delete {
	display: block;
  opacity: 1;
}
.voucher-pic:hover img {
  opacity: 0.3;
}


.delete {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
  cursor: pointer;
}

.delete a {
	color: #000;
}

</style>
