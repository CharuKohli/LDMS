$(document).ready(function(){

  $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')
          }
      });

      $("#docfile").change(function() {
              var file = this.files[0];
              var imagefile = file.type;
              var imagesize=file.size;
              var inkb=Math.round((imagesize / 1024)) ;
              if(inkb<200){
              var match= ["image/png","image/jpeg","image/jpg"];
              if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
              {
                  $("#docfile").val('');
                  $('#invalidfile').html('Please select valid image file (JPEG/JPG/PNG)... ');
                  $('#invalidfile').css('color','red');
                  $('#docfile').val(null);
                  return false;
              }else{
                $('#invalidfile').html(null);
              }
            }else{
              $("#docfile").val('');
              $('#invalidfile').html('Image size should be max. 200 kB');
              $('#invalidfile').css('color','red');
              $('#docfile').val(null);
              return false;
            }
          });


          $('#signup').submit(function(e){
            e.preventDefault();
          $.ajax({
                  type: "POST",
                  url:'saveuser',
                  data:$('#signup').serialize(),
                  dataType : "json",
                  success:function(data){
                    alert(data.msg);
                   window.location=window.location.href;
                    $('#signup')[0].reset();
                  }
                });
              });

              $('#signin').submit(function(e){
                e.preventDefault();
              $.ajax({
                      type: "POST",
                      url:'loginuser',
                      data:$('#signin').serialize(),
                      dataType : "json",
                      success:function(data){
                        //alert(data.msg);
                        if(data.msg=="1"){
                          alert("login success");
						    window.location=window.location.href+"home"
                      }else if(data.msg=="0"){
                          alert("login failed");
                          $('#signin')[0].reset();
                      }

                      }
                    });
                  });


$('#postdoc').submit(function(e){
  e.preventDefault();
var btnName=$('#btndoc').val();
  var file_data = $('#docfile').prop('files');
  var numof_files=file_data.length;
var finaldata=new FormData(this);
for(var i=0;i<numof_files;i++){
finaldata.append('file[]', file_data[i]);
}

if(btnName=="Save"){
$.ajax({
        type: "POST",
        url:'savedocs',
        data:finaldata,
        dataType : "json",
			  contentType: false,
			  cache: false,
			  processData:false,
        success:function(data){
          alert(data.msg);
          $('#postdoc')[0].reset();
        }
      });
    }
    else if(btnName=="Update"){
     var finaldata=new FormData(this);
     $.ajax({
             type: "POST",
             url:'updatedocs',
             data:finaldata,
             dataType : "json",
     			  contentType: false,
     			  cache: false,
     			  processData:false,
             success:function(data){
               alert(data.msg);
               $('#postdoc')[0].reset();
               $('#btndoc').html('Save');
               $('#btndoc').val('Save');
             }
           });
    }
});


$('#foreign').submit(function(e){
  e.preventDefault();
  console.log($('#foreign').serialize());
var btnName=$('#btnforeign').val();
if(btnName=="Save"){
$.ajax({
        type: "POST",
        url:'saveforeignrecord',
        data:$('#foreign').serialize(),
        dataType : "json",
        success:function(data){
          alert(data.msg);
          $('#foreign')[0].reset();
        }
      });
    }
    else if(btnName=="Update"){
      $.ajax({
              type: "POST",
              url:'updateforeignrecord',
              data:$('#foreign').serialize(),
              dataType : "json",
              success:function(data){
                alert(data.msg);
                $('#foreign')[0].reset();
                $('#btnforeign').html('Save');
                $('#btnforeign').val('Save');
              }
            });

    }
});

$('#director').submit(function(e){
  e.preventDefault();
var btnName=$('#btndirector').val();
if(btnName=="Save"){
$.ajax({
        type: "POST",
        url:'savedirector',
        data:$('#director').serialize(),
        dataType : "json",
        success:function(data){
          alert(data.msg);
          $('#director')[0].reset();
        }
      });
    }
    else if(btnName=="Update"){
      $.ajax({
              type: "POST",
              url:'updatedirector',
              data:$('#director').serialize(),
              dataType : "json",
              success:function(data){
                alert(data.msg);
                $('#director')[0].reset();
                $('#btndirector').html('Save');
                $('#btndirector').val('Save');
              }
            });

    }
});


$('#insurance').submit(function(e){
  e.preventDefault();
var btnName=$('#btninsurance').val();
var file_data = $('#docfile').prop('files')[0];
var finaldata=new FormData(this);
finaldata.append('file', file_data);
if(btnName=="Save"){
$.ajax({
        type: "POST",
        url:'saveinsurance',
        data:finaldata,
        dataType : "json",
			  contentType: false,
			  cache: false,
			  processData:false,
        success:function(data){
          alert(data.msg);
          $('#insurance')[0].reset();
        }
      });
    }
    else if(btnName=="Update"){
      $.ajax({
              type: "POST",
              url:'updateinsurance',
              data:finaldata,
              dataType : "json",
      			  contentType: false,
      			  cache: false,
      			  processData:false,
              success:function(data){
                alert(data.msg);
                $('#insurance')[0].reset();
                $('#btninsurance').html('Save');
                $('#btninsurance').val('Save');
              }
            });

    }
});
















});
