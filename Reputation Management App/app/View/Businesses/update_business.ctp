<?php //pr($data);die;?>
<script type="text/javascript">
$(document).ready(function(){
	$('#BusinessAddForm').validate({
			 onfocusout: function (element) {
			     $(element).valid();
			    },
			rules:
			{
				"data[User][email]":
				{
					required:true,
					email:true,
					remote:ajax_url+'users/checkUserEmail'
				},
				
				"data[User][password]":
				{
					required:true,
					minlength: 6
				},
				"data[User][cpassword]":
				{
					required:true,
					equalTo:'#pwd'
				},
				"data[Business][businessname]":
				{
					required:true,
				},
				"data[User][firstname]":
				{
					required:true,
					accept: "[a-zA-Z]+",
					maxlength:20
				},
				"data[User][lastname]":
				{
					required:true,
					accept: "[a-zA-Z]+",
					maxlength:20
				},
                                 "data[Business][zip]":
                                 {
		                         required:true,
					 minlength:5,
			                 number:true
                                 },
				"data[Business][city]":
				 {
				    required:true,
				    accept: "[a-zA-Z]+"
				 },
				"data[Business][companywebaddress]":
				{
				    required:true,
				    url:true
				},
				"data[Business][feedbackthreshold]":
				{
				    required:true,
				},
				"data[Business][emailfrequency]":
				{
				    required:true,
				},
				"data[Business][automatedenailattempts]":
				{
				    required:true,
				}

                                


			},
			messages:
			{
				"data[User][email]":
				{
					required:'Please enter email.',
					email:'Please enter valid email.',
					remote:'Email address already exists.'
				},
				"data[User][password]":
				{
					required:"This field is required.",
					minlength: 'Password should be atleast 6 characters long.'
				},
                                "data[Business][zip]":
				{
				    required:"This field is required.",
				    number:"Please enter digit."
				},
				"data[User][cpassword]":
				{
					required:"This field is required.",
					equalTo:'Password and confirm password does not match.'
				},
				"data[Business][businessname]":
				{
					required:"This field is required.",
				},
				"data[User][firstname]":
				{
				  required:"This field is required.",	
				  accept :"Please enter only characters "
				},
				"data[User][lastname]":
				{
				  required:"This field is required.",
				  accept :"Please enter only characters "	
				},
				"data[Business][city]":
				{
				    required:"This field is required.",
				    accept :"Please enter only characters "
				},
				"data[Business][companywebaddress]":
				{
				    required:"This field is required.",
				    number:"Please enter a valid Web addredd URl"
				},
				"data[Business][feedbackthreshold]":
				{
				    required:"This field is required.",
				}

				
			}
		
		
		});
		
	
	});
</script>

<?php echo $this->element('nav')?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<div class="page-content">
        <!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			<?php echo $design['AgencysiteSetting']['sitetitle']; ?> - Edit Business
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Edit Business</a>
					</li>
				</ul>
				<div class="page-toolbar">
					
				</div>
			</div>
			<!-- END PAGE HEADER-->
		<div class="row">
          <div class="col-sm-12">
            <div id="content-wrapper">
			
			<span><a class="go-back btn btn-primary" href="<?php echo HTTP_ROOT?>dashboard/manageUser">Go Back</a></span><br /><br />
				<!-- BEGIN PORTLET-->
					<div class="portlet box reforce-red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i>Edit Business Details
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title="" title="">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
								</a>
								<a href="" class="fullscreen" data-original-title="" title="">
								</a>
								<a href="javascript:;" class="reload" data-original-title="" title="">
								</a>
							</div>
						</div>
						
				<div class="portlet-body form grey">

				<div class="add-business">

				<div class="main-form-start form-body">
				<form accept-charset="utf-8" class="form-horizontal" method="post" id="BusinessAddForm" action="<?php echo HTTP_ROOT?>businesses/updateBusiness">
					<input type="hidden" id="id" name="data[User][id]" value="<?php echo $data['Business']['user_Id'];?>">
					<!--Business Name :<input type="text" required="required" id="BusinessBusinessname" maxlength="255" name="data[Business][businessname]"></br>-->

					<div class="form-group">
         <label class="control-label col-sm-4">First Name:</label>   
            <div class="col-sm-4">
                 <input type="text" id="UserFirstname"  placeholder="Enter First Name" class="form-control form-back" name="data[User][firstname]" value="<?php echo @$userdata['User']['firstname'];?>">
           </div>
    </div>


   <div class="form-group">
         <label class="control-label col-sm-4">Last Name:</label>   
            <div class="col-sm-4">
                <input type="text" id="UserLastname" placeholder="Enter Last Name" class="form-control form-back" name="data[User][lastname]" value="<?php echo @$userdata['User']['lastname'];?>">
           </div>
    </div>


	<!--<input type="hidden" id="id" name="data[User][id]" value="<?php echo $data['Business']['id'];?>"> -->
	<input type="hidden" id="id" name="data[Business][id]" value="<?php echo $data['Business']['id'];?>">
	

      <div class="form-group">
         <label class="control-label col-sm-4">Business Name:</label>   
            <div class="col-sm-4">
                <input type="text" id="Businessname" class="form-control form-back" placeholder="Enter Business Name" name="data[Business][businessname]" value="<?php echo $data['Business']['businessname'];?>">
           </div>
    </div>
 <div class="form-group">
         <label class="control-label col-sm-4">Business Email:</label>   
            <div class="col-sm-4">
                <input type="text" class="form-control form-back" readonly="readonly" value="<?php echo $data['User']['email'];?>">
           </div>
    </div>


     <!--<div class="form-group">
         <label class="control-label col-sm-4">Parent Business:</label> 
	        <div class="col-sm-8">
	        <select class="form-selected" id="ParentId" name="data[Business][parent_id]">
								<option value=""><?php echo "Select Parent Bussiness"?></option>
								<?php foreach($parentBusinesses as $key=>$val){?>
								    <option <?php if($data['Business']['parent_id']==$key){?>selected="selected"<?php }?> value="<?php echo $key?>"><?php echo $val?></option>
								<?php } ?>
						   </select>
				 </div>
    </div>-->


    <div class="form-group">
         <label class="control-label col-sm-4">Main Business Category:</label> 
         <div class="col-sm-4">
	      <select class="form-selected form-control" required="required" id="BusinessBusinessCategoryId" name="data[Business][business_category_id]">
							<option value=""><?php echo "Select Bussiness Category"?></option>
								<?php foreach($businessCategories as $key=>$val){?>
								    <option <?php if($data['Business']['business_category_id']==$key){?>selected="selected"<?php }?> value="<?php echo $key?>"><?php echo $val?></option>
								<?php } ?>
		  </select>
            </div>
    </div>


   <div class="form-group">
         <label class="control-label col-sm-4">Street Address:</label>   
            <div class="col-sm-4">
              <!--  <input type="text" required="required" class="form-control form-back" placeholder="Enter Street Address" id="BusinessAddressline1" maxlength="255" name="data[Business][addressline1]" value="<?php echo $data['Business']['addressline1'];?>"> -->
	        <textarea  required="required" class="form-control form-back" placeholder="Enter Street Address" id="BusinessAddressline1" maxlength="255" name="data[Business][addressline1]" ><?php echo $data['Business']['addressline1'];?></textarea>
           </div>
    </div>


    <div class="form-group">
         <label class="control-label col-sm-4">Street Address Line 2:</label>   
            <div class="col-sm-4">
               <!-- <input type="text" required="required" class="form-control form-back" placeholder="Enter Street Address Line 2" id="BusinessAddressline2" maxlength="255" name="data[Business][addressline2]" value="<?php echo $data['Business']['addressline2'];?>">-->
		<textarea class="form-control form-back" placeholder="Enter Street Address Line 2" id="BusinessAddressline2" maxlength="255" name="data[Business][addressline2]"><?php echo $data['Business']['addressline2'];?></textarea>
           </div>
    </div>




	

    <div class="form-group">
       <label class="control-label col-sm-4">Country:</label> 
        	<div class="col-sm-4">
	   			<select class="form-selected form-control" required="required" id="find_country" name="data[Business][country]">
					<option value=""><?php echo "Select Country"?></option>
  <?php
                     if($data['Business']['country'] == 1)
                     {
                     	
                     ?>
                      <option value="<?php echo 1 ?>" selected="selected"><?php echo $countries[1] ?></option>
                     <?php
                     unset($countries[1]);
                      }
                      else
                      {
                     ?>
                     <option value="<?php echo 1 ?>"><?php echo $countries[1] ?></option>
                     <?php
                     unset($countries[1]);
                    }
                 ?>
								<?php foreach($countries as $key=>$val){?>
								    <option <?php if($data['Business']['country']==$key){?>selected="selected"<?php }?> value="<?php echo $key?>"><?php echo $val?></option>
								<?php } ?>
				</select>
        </div>
    </div>


 


	  <div class="form-group">
	       <label class="control-label col-sm-4">State/Province:</label> 
	        <div class="col-sm-4">
				<select class="form-selected form-control" required="required" id="find_state" name="data[Business][state]">
							<option value="">Select State</option>
							<?php foreach($states as $key=>$val){?>
									    <option <?php if($data['Business']['state']==$key){?>selected="selected"<?php }?> value="<?php echo $key?>"><?php echo $val?></option>
							<?php } ?>
						</select>
	    		 </div>
	    </div>









    <div class="form-group">
	   <label class="control-label col-sm-4">City:</label> 
	    <div class="col-sm-4">
			 
				 <input type="text" required="required" placeholder="Enter city" class="form-control form-back"  name="data[Business][city]" value="<?php echo $data['Business']['city'];?>">

 				 </div>
	    </div>



      <div class="form-group">
         <label class="control-label col-sm-4">Zip:</label>   
            <div class="col-sm-4">
               <input type="text" required="required" placeholder="Enter zip" class="form-control form-back" id="BusinessZip" maxlength="20" name="data[Business][zip]" value="<?php echo $data['Business']['zip'];?>">
	
           </div>
    </div>



  <div class="form-group">
         <label class="control-label col-sm-4">Phone:</label>   
            <div class="col-sm-4">
              <input class="form-control form-back" type="tel" required="required" class="form-control" placeholder="Enter Phone" id="BusinessPhone" maxlength="255" name="data[Business][phone]" value="<?php echo $data['Business']['phone'];?>">
	
           </div>
    </div>

	   <div class="form-group">
         <label class="control-label col-sm-4">Company Web Address:</label>   
            <div class="col-sm-4">
             <input type="text" required="required" class="form-control form-back" placeholder="Enter Company Web Address" id="BusinessCompanywebaddress" maxlength="100" name="data[Business][companywebaddress]" value="<?php echo $data['Business']['companywebaddress'];?>">
           </div>
    </div>


 

	 <div class="form-group">
         <label class="control-label col-sm-4">Feedback Threshold:</label>   
            <div class="col-sm-4">
	        <?php
	        $feed = $data['Business']['feedbackthreshold'];
			
	        ?>
			<select class="form-selected form-control" required="required" id="feedbackthreshold" name="data[Business][feedbackthreshold]">
			<option value="">Select</option>
			<?php $limit = 10;
			for($i = 1; $i <= $limit; $i++)
			{
			?>
		<option <?php if($i==$feed)  { ?> selected="selected" value="<?php echo $data['Business']['feedbackthreshold']; } else { ?>" value="<?php echo $i; } ?>"><?php  echo $i; ?> </option>
				<?php
			}
		?>

		</select>

  	</div>
    </div>


 <div class="form-group">
         <label class="control-label col-sm-4">Number of automated E-mail attempts :</label>   
            <div class="col-sm-4">
            <?php
            
	        $auto_email = $data['Business']['automatedenailattempts'];
	         

	        ?>

	<select class="form-selected form-control" required="required" id="automatedenailattempts" name="data[Business][automatedenailattempts]">
		<option value="">Select</option>
		 	<?php $limit_emial = 10;
			for($i = 1; $i <= $limit_emial; $i++)
			{
			?>
			<option <?php if($i==$auto_email)  { ?> selected="selected"  value="<?php echo $data['Business']['automatedenailattempts']; } else { ?>" value="<?php echo $i; } ?>"><?php  echo $i; ?> </option>
				<?php
			}
		?>
		</select>
       </div>
     </div>  


    <div class="form-group">
         <label class="control-label col-sm-4">Email Frequency:</label>   
            <div class="col-sm-4">
            	<?php
            
	        $emial_freq = $data['Business']['emailfrequency'];
	        ?>

	<select class="form-selected form-control" required="required" id="emailfrequency" name="data[Business][emailfrequency]">
					 
            <option value="">Select</option>
		 	<?php $limit_freq = 10;
			for($i = 1; $i <= $limit_freq; $i++)
			{
			?>
			<option <?php if($i==$emial_freq)  { ?> selected="selected" value="<?php echo $data['Business']['emailfrequency']; } else { ?>" value="<?php echo $i; } ?>"><?php  echo $i; ?> </option>
				<?php
			}
		?>
               


  
					</select>
             </div>
         </div>     


  <div class="form-group">
         <label class="control-label col-sm-4">Social Sharing Checker:</label>   
            <div class="col-sm-4">

	 <select class="form-selected form-control" name="data[Business][Attendees][]" multiple="multiple" id="BusinessAttendees">
						<option value=""><?php echo "Social Sharing Checker"?></option>
								<?php foreach($socialmedia as $key=>$val){ 	?>
						<option <?php if(in_array($key, $selmediaIds)){?>selected="selected"<?php }?> value="<?php echo $key?>"><?php echo $val ?></option>
						<?php     } ?>
						</select>
        </br>
    </div>
   </div> 



     <div class="form-group">
         <label class="control-label col-sm-4">Visibility Checker:</label>   
            <div class="col-sm-4">
        
	<select class="form-selected form-control" name="data[Business][visibilitychecker][]" multiple="multiple" id="BusinessAttendees">
						<option value=""><?php echo "Social Sharing Checker"?></option>
								<?php foreach($searchlist as $key=>$val){?>
								    <option <?php if(in_array($key, $selmediaIds)){?>selected="selected"<?php }?> value="<?php echo $key?>"><?php echo $val?></option>
								<?php } ?>
						</select>

					</div>
				</div>




  <div class="form-group">
    <label class="control-label col-sm-4" for="email">&nbsp;</label>  
    <div class="col-sm-8 submitting"> 
        <input type="submit" class="submit btn btn-primary" value="Submit">
     </div> 
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
</div>
 
