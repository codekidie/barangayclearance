@extends('layouts.app')
    
@section('content')
	
	<br style="margin-top: 10px;">
	<div class="row">
	 <img src="<?php echo asset("resources/assets/img/logo.png");?>"  style="display: block;margin:0 auto;width:100px;height: 100px;" alt="Logo">
			<center><h1>{{Auth::user()->presentaddress}}</h1></center>
	</div>

	<div class="row">
        <div class="col-md-6">
            <div class="pull-left" style="margin-right: 15px;">
                    <?php if (Auth::user()->profilepic): ?>
                      <img src="<?php echo asset("storage/app/".Auth::user()->profilepic."");?>" style="width:100px;height: 100px;" alt="User Image">
                    <?php else : ?>
                      <img src="<?php echo asset("storage/app/photos/default.png");?>" class="user-image"  style="width:100px;height: 100px;" alt="User Image">
                    <?php endif ?>

            </div>
            <div style="width:300px;" class="pull-left">
            <h2>{{Auth::user()->firstname.' '.Auth::user()->middlename.' '.Auth::user()->lastname}}</h2>
            <p> Age : <strong>{{Auth::user()->age}}</strong>   </p>
            <p> Address : <strong>{{Auth::user()->presentaddress}}</strong>   </p>
            <p> Contact : <strong>{{Auth::user()->contactnumber}}</strong>   </p>
            <p> Cevil Status : <strong>{{Auth::user()->status}}</strong>   </p>
            <p> Cetizenship : <strong>{{Auth::user()->citizenship}}</strong>   </p>
            </div>
        </div>
        <div class="col-md-6">
           <div class="row">
	        	
	        		<img src="<?php echo asset("storage/app/photos/default.png");?>" id="prof1"  style="width:150px;height:100px;margin-right:5px;float: left;"  alt="">
	        		<img src="<?php echo asset("storage/app/photos/default.png");?>" id="prof2"   style="width:100px;height: 100px;margin-right:5px;float: left;" alt="">
	        		<img src="<?php echo asset("storage/app/photos/default.png");?>" id="prof3"   style="width:100px;height: 100px;float: left;" alt="">
	        		
           </div>
         	<div class="row" style="margin-top: 5px;">
	        	
	        		<img src="<?php echo asset("storage/app/photos/default.png");?>" id="prof4"  style="width:150px;height:205px;margin-right:5px;float: left;"  alt="">

	        		<div style="width: 400px;">
	        				<img src="<?php echo asset("storage/app/photos/default.png");?>" id="prof5"   style="width:100px;height: 100px;margin-right:5px;float: left;" alt="">
	        				<img src="<?php echo asset("storage/app/photos/default.png");?>" id="prof6"   style="width:100px;height: 100px;float: left;margin-right:5px" alt="">
	        				<img src="<?php echo asset("storage/app/photos/default.png");?>" id="prof7"   style="width:100px;height: 100px;float: left;margin-right:5px;margin-top:5px" alt="">
	        				<img src="<?php echo asset("storage/app/photos/default.png");?>" id="prof8"   style="width:100px;height: 100px;float: left;margin-right:5px;margin-top:5px" alt="">
	        		</div>
            </div>
          
		</div>

    </div>

    <div class="row">
      <div class="col-md-4">
    	<div id="purokleaders-wrapper"></div>
      </div>
    </div>

            
@endsection
