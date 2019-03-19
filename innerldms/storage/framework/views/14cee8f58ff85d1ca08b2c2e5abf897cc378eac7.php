<?php $__env->startSection('content'); ?>
<div class="container" >
    <div class="row">
      <div class="panel panel-info">
         <div class="panel-heading userhead">Insurance Master</div>
       <div class="panel-body">
        <div class="col-md-12">
                <!-- Nav tabs -->
                <button onclick="tab1()" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-plus-sign"> Create</span></button>
                <button onclick="tab2()"  class="btn btn-info btn-sm" ><span class="glyphicon glyphicon-eye-open"> View</span></button>

                <div  id="Section2"><br>
                  <div class="content1" name="resulttablen">
                  <div id="insurancedetails" ></div>
                   </div>
                    </div>
										<div  id="Section1" >
                      <div  id="rstable" style="padding-top:30px;padding-bottom:40px;padding-left:40px;padding-right:40px;background-color:white;border:solid 1px #LightGray;">
                            <div class="content1" name="resulttablen" style="" >
								<form class="form-horizontal" id="foreign" method="post">
								<?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Insurance Name </label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="name" placeholder="name" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Company Name </label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="company" placeholder="Digital Signature Number " required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Date </label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="date" placeholder="Date" required>
                  </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Amount Paid </label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="amt_paid" placeholder="Amount Paid" required>
                  </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Expiry Date </label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="exp_date" placeholder="Expiry Date" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Advance Alert(No.of days) </label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="alertdays" placeholder="Advance Alert" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">No. Of Renewals Done </label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="no_of_renewals" placeholder="No. Of Renewals Done" required>
                  </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Contact Person</label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="contact_person" placeholder="Contact Person" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Contact Number </label>
                    <div class="col-md-7 col-sm-10">
                      <input class="form-control" type="text"  name="contact_number" placeholder="Contact Number" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="exampleInputFirstName2">Upload Latest copy Of Insurance</label>
                    <div class="col-md-7 col-sm-10">
                      <input  type="file"  name="ins_certificate" id="ins_certificate" >
											<span id="invalidfile"></span>
                  </div>
                </div>
                <input class="form-control" type="hidden"   name="id">

									<div class="form-group text-center">
											<button type="submit" class="btn btn-primary"  value="Save" id="btninsurance">Save</button>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>