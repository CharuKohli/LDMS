<?php if(session('loggedinuser')): ?>

 <div style="background:#006064" style="margin-top:10px;">
  <div class="row"style="padding-left:10px;padding-right:10px;padding-top:10px;color:white"   >
   <div class="col-md-7">
     <h4>Project Name</h4>
     <!-- <img class="img2" src="<?php echo e(asset('assets/images/logo.png')); ?>" class="img-responsive" alt="logo" style="margin-bottom:2px;margin-top:6px;margin-left:15px;"> -->

</div>

<div class="col-md-3" align="right" style="color:white;">
  <span class="glyphicon glyphicon-user" ></span> Welcome  <?php echo e(session('loggedinuser')); ?>


</div >
<!-- <div class="col-md-1" align="right" style="color:white;text-align:right;display:inline-block;padding-top:8px" >
    <a  href="<?php echo e(url('dashboard')); ?>" style="display:inline-block;color:white"><i class="fa fa-bell-o fa-lg" style="display:inline-block;color:white">
    </i> <span class="notifycount"><span id="count"></span></span> </a>

  </div> -->
<div class="col-md-1" align="right">
  <a href="<?php echo e(url('/')); ?>" style="display:inline-block;color:white">
      <?php echo e(__('Logout')); ?> <span class="glyphicon glyphicon-log-out" ></span>
</a>
</div>
</div>
</div>
<?php endif; ?>

<nav class="navbar" id="navbar">
 <div class="navbar-header">

 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" >
	 <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>

      </button>

    <h4 class="bodyheader"> </h4>
    </div>

	 <div class="navbar-collapse collapse" id="myNavbar" style="margin-right:50px" >
	 <ul class="nav navbar-nav navbar-right" >
	 <li><a href="<?php echo e(url('docreg')); ?>">Documents Reg</a></li>
  <li><a href="<?php echo e(url('foreign')); ?>">Foreign Nationals</a></li>
  <li><a href="<?php echo e(url('director')); ?>">Directors Master</a></li>
  <li><a href="<?php echo e(url('insurance')); ?>">Insurance Master</a></li>
  <li><a href="<?php echo e(url('alerts')); ?>">Notifications</a></li>

 </ul>
  </div>
</nav>
