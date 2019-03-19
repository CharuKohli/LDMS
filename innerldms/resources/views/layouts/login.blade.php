@extends('welcome')
@section('content')
<div class="container-fluid back">
	<h2 align="center"></h2>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
	<div class="tab" style="padding:15px;width:100%;margin-top:20%;">
					<h3 align="center">Login Form</h3>
                    <form method="post" action="" id="signin" class="form-horizontal">
                      {{csrf_field()}}
                                                      <div class="form-group">
                                                          <!-- <label for="exampleInputEmail1">User Name</label> -->
                                                          <input class="form-control" id="username" autocomplete="off" name="name" type="text" placeholder="Enter User name"required autofocus>
                                                      </div>
                                                      <div class="form-group">
                                                          <!-- <label for="exampleInputPassword1">Password</label> -->
                                                          <input class="form-control" id="password"autocomplete="off"  name="password" placeholder="Enter password" required autofocus type="password">
                                                      </div>
																											<div class="form-group text-center">
																													<button type="submit" class="btn btn-primary" >Sign in</button>
																											</div>
                                                  <center>  New user? signup <a href="{{url('signup')}}">here</a></center>
                                                      <!-- <div class="form-group forgot-pass">
                                                          <a href="#">forgot your password?</a>
                                                      </div> -->
                                                  </form>




                    </div>
                      </div>
											<div class="col-md-4"></div>

                        </div>
                          </div>

@endsection
