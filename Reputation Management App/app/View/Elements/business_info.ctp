<div class="businesses">


<h1 class="business-heading">Business Information</h1>

<div class="main-form-start">
<form class="form-horizontal"  enctype="multipart/form-data" accept-charset="utf-8" method="post" id="BusinessInfo" action="<?php echo HTTP_ROOT?>dashboard/business_info/<?php echo $busid; ?>">

	<input type="hidden" name="data[Business][id]" value="<?php echo $bus_data['Business']['id']?>">	
 	<input type="hidden" name="data[Business][user_Id]" value="<?php echo $bus_data['Business']['user_Id']?>">
	<input type="hidden" name="data[Business][business_logo1]" value="<?php echo $bus_data['Business']['business_logo']?>">

	<div class="form-group">
      <label class="control-label col-sm-4">Business Name</label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-back" placeholder="Business name" name="data[Business][businessname]" value="<?php echo $bus_data['Business']['businessname']?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4">First Name</label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-back" placeholder="Enter First Name" name="data[User][firstname]" value="<?php echo $bus_data['User']['firstname']?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4">Last Name</label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-back" id="CustomerLastname" placeholder="Enter Last Name" name="data[User][lastname]" value="<?php echo $bus_data['User']['lastname']?>">
      </div>
    </div>

    <div class="form-group">
       <label class="control-label col-sm-4" for="email">Main Business Category:</label>
         <div class="col-sm-4">
            <select class="form-selected form-control" id="BusinessBusinessCategoryId" name="data[Business][business_category_id]">
                <option value=""><?php echo "Select Bussiness Category"?></option>
                     <?php foreach($businessCategories as $key=>$val){?>
                     	<option value="<?php echo $key?>" <?php if($key == $bus_data['Business']['business_category_id']) {?>selected="selected" <?php } ?> ><?php echo $val?></option>
                                <?php } ?>
             </select></br>
         </div>
     </div>

    <div class="form-group">
        <label class="control-label col-sm-4" for="email">Street Address:</label>
        <div class="col-sm-4">
        <input type="text" class="form-control form-back" maxlength="255" id="BusinessAddressline" placeholder="Enter Street Address" name="data[Business][addressline1]" value="<?php echo $bus_data['Business']['addressline1']?>">
        </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Street Address Line 2:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-back" maxlength="255" id="BusinessAddressline2" placeholder="Enter Street Address Line 2" name="data[Business][addressline2]" value="<?php echo $bus_data['Business']['addressline2']?>">
      </div>
    </div>

    
 <div class="form-group">
       <label class="control-label col-sm-4" for="email">Country:</label>
           <div class="col-sm-4">
              <select class="form-selected form-control" id="find_country" name="data[Business][country]">
                           <option value=""><?php echo "Select Country"?></option>
                          <!--  <option value="<?php echo 1 ?>"><?php echo $countries[1] ?></option> -->
                           <?php
                                foreach($countries as $key=>$val){
                               //   if($key == 1) { continue; }
                                    ?>
                                      <option <?php if($bus_data['Business']['country']==$key){?>selected="selected"<?php }?> value="<?php echo $key?>"><?php echo $val?></option>
                                  <?php } ?>
                  </select></div>
         </div>








   <div class="form-group">
     <label class="control-label col-sm-4">City:</label> 
      <div class="col-sm-4">
       
       <input type="text" class="form-control form-back" required="required"  placeholder="Enter City" name="data[Business][city]" value="<?php echo @$bus_data['Business']['city']?>">
     </div>
      </div>



      <div class="form-group">
          <label class="control-label col-sm-4">State/Province:</label> 
          <div class="col-sm-4">
        <select class="form-selected form-control" required="required" id="find_state" name="data[Business][state]">
              <option value="">Select State</option>
              <?php foreach($states as $key=>$val){?>
                      <option <?php if($bus_data['Business']['state']==$key){?>selected="selected"<?php }?> value="<?php echo $key?>"><?php echo $val?></option>
              <?php } ?>
            </select>
           </div>
      </div>




    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Zip:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-back" maxlength="20" id="BusinessZip" placeholder="Enter zip" name="data[Business][zip]" value="<?php echo $bus_data['Business']['zip']?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Phone:</label>
      <div class="col-sm-4">
        <input type="tel" class="form-control form-back" maxlength="255" id="BusinessPhone" placeholder="Enter Phone" name="data[Business][phone]" value="<?php echo $bus_data['Business']['phone']?>">
      </div>
    </div>

    

    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Company Web address</label>
      <div class="col-sm-4">
        <input type="tel" class="form-control form-back" placeholder="Enter web address" name="data[Business][companywebaddress]" value="<?php echo $bus_data['Business']['companywebaddress']?>" >
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Employee</label>
      <div class="col-sm-4">
        <select class="form-selected form-control">
          <option>Select Employee</option>
          <?php foreach ($emp as $key=>$value) { ?>
           <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="email">&nbsp;</label>
      <div class="col-sm-4">
       <input type="button" value="Add Employee" class="btn btn-primary first_ad" data-toggle="modal" data-target="#Addemp-model">
       <input type="button" value="Delete Employee" class="btn btn-primary red" data-toggle="modal" data-target="#emailcontent-model">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Company Email address</label>
      <div class="col-sm-4">
       	 <input type="tel" class="form-control form-back" placeholder="Enter email" name="data[User][email]" value="<?php echo $bus_data['User']['email']?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="email">External Review URL</label>
      	<div class="col-sm-4">
       <label><a class="pb_link form-control" target="_blank" href="<?php echo HTTP_ROOT.'Public/external_review/'.$bus_data['Business']['id'];?>"><?php echo HTTP_ROOT.'Public/external_review/'.$bus_data['Business']['id'];?></a></label>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="email">External Visibility URL</label>
      	<div class="col-sm-4">
       <label id="visibility"><a class="pb_link form-control" target="_blank" href="<?php echo HTTP_ROOT.'Public/external_visibility/'.$bus_data['Business']['id'];?>"><?php echo HTTP_ROOT.'Public/external_visibility/'.$bus_data['Business']['id'];?></a></label>
      </div>
    </div>


     <div class="form-group">
      <label class="control-label col-sm-4" for="email">&nbsp;</label>
      <div class="col-sm-4">
        <a href="javascript:void(0)" id="preview" class="preview first_ad" onclick="newPopupV();" type="button" >Preview</a>
       
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-4" for="email">External Review page Content</label>
      	<div class="col-sm-4">
     		<textarea name="data[Business][external_review_content]" id="Extreview"><?php echo @$bus_data['Business']['external_review_content']?></textarea>
      </div>
    </div>

   <!-- <div class="form-group">
      <label class="control-label col-sm-4" for="email">Additional Email Notifications</label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-back" maxlength="20" id="BusinessZip" placeholder="" >
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Additional Email Notifications</label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-back" maxlength="20" id="BusinessZip" placeholder="">
      </div>
    </div> -->

    <div class="form-group">
 		 <label class="control-label col-sm-4">Logo</label>
     <div class="col-sm-4">
 		<?php if(!empty($bus_data['Business']['business_logo'])){?>
 		 <img style="width:220px;height:70px;" src="<?php echo HTTP_ROOT ?>img/<?php echo $bus_data['Business']['business_logo']?>"/>		
		<?php }else{ ?>
 			</br>
		<?php	} ?> 	
    </div>	
 	</div>


 	<div class="form-group">
 		<label class="control-label col-sm-4">&nbsp;</label>
    <div class="col-sm-4">
    <div class="fileUploaded btn">
        
        <input type="file" class="upload valid form-control" name="image">
		<button class="btn blue">Upload</button>
        </div>
 		 <!-- <input type="file" name="image" /> -->
     </div>
 	</div>

 	<!--<div class="form-group">
      <label class="control-label col-sm-4" for="email">Signature</label>
      	<div class="col-sm-4">
       <textarea name="data[EmailTemplate][signature]" id="Signature"><?php echo @$emailtemplate['AgencyTemplate']['emailcontent']?></textarea>
      </div>
  </div> -->

    <div class="form-group">
	    <label class="control-label col-sm-4" for="email">&nbsp;</label>
	    <div class="col-sm-4">
	     <input type="button" value="Get Merge Fields" class="btn btn-primary first_ad" data-toggle="modal" data-target="#emailcontent-model">	     
	    </div>
    </div>


	 <div class="form-group">
	    	<label class="control-label col-sm-4" for="email">&nbsp;</label>  
	    		<div class="col-sm-4 submitting"> 
	        <input type="submit" class="submit btn btn-primary first_ad" value="Save Settings">
	        <input type="Reset" class="btn btn-danger first_ad" value="Cancel">
		 </div> 
	</div>

</form>

   <div class="modal fade" id="Addemp-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Add New Employee</h4>
          </div>
         <form class="form-horizontal"  accept-charset="utf-8" method="post" id="BusinessAddForm" action="<?php echo HTTP_ROOT?>businesses/addemployee">

         <input type="hidden" name="data[Business][id]" value="<?php echo $bus_data['Business']['id']?>"> 

            <div class="form-group">
              <label class="control-label col-sm-4" >First Name:</label>
              <div class="col-sm-4">
                <input type="text" class="form-control form-back" placeholder="Enter First Name" name="data[User][firstname]">
              </div>
            </div>
             

             <div class="form-group">
              <label class="control-label col-sm-4" > Last Name:</label>
              <div class="col-sm-4">
                <input type="text" name="data[User][lastname]" placeholder="Enter Last Name" class="form-control form-back">
              </div>
             </div>

              <div class="form-group">
                <label class="control-label col-sm-4" for="email"> Email Id:</label>
                <div class="col-sm-4">
                  <input type="email" id="UserEmail" name="data[User][email]" placeholder="Enter Email Id" class="form-control form-back">
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-sm-4" for="email">Password:</label>
                <div class="col-sm-4">
                  <input type="password" class="field text full required form-control form-back" id="pwd"  placeholder="Enter Password" name="data[User][password]" required="required">
                </div>
               </div>

               <div class="form-group">
                <label class="control-label col-sm-4" for="email">Confirm Password:</label>
                <div class="col-sm-4">
                  <input type="password" class="field text full required form-control form-back" id="confirmpwd"  placeholder="Enter Password" name="data[User][cpassword]" required="required">
                </div>
               </div>
         
            <div class="modal-footer">
              <input type="submit" value="Submit" class="submit btn btn-primary" />
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>

</div></div>

<script type="text/javascript">
// Popup window code
function newPopupV(url) {
  var myContent = $('#visibility').text();
  popupWindow = window.open(
    url,'popUpWindow','height=500,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
  popupWindow.document.write(myContent);
}

function copyTxt(){
  $('#preview').copy();
}
</script>

<script>
		CKEDITOR.replace( 'Extreview',
	{
		filebrowserBrowseUrl :ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserImageBrowseUrl : ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserFlashBrowseUrl :ajax_url+'/filemanager_in_ckeditorjs/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserUploadUrl  :ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
		filebrowserImageUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
		filebrowserFlashUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	});

		CKEDITOR.replace( 'Signature',
	{
		filebrowserBrowseUrl :ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserImageBrowseUrl : ajax_url+'filemanager_in_ckeditor/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserFlashBrowseUrl :ajax_url+'/filemanager_in_ckeditorjs/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector='+ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserUploadUrl  :ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
		filebrowserImageUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
		filebrowserFlashUploadUrl : ajax_url+'/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	});

</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#BusinessInfo').validate({
          onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
             "data[Business][businessname]":
                {
                    required:true
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
                
                "data[Business][business_category_id]":
                {
                    required:true
                },
                "data[Business][addressline1]":
                {
                    required:true
                },
                "data[Business][addressline2]":
                {
                   // required:true
                },
                "data[Business][state]":
                {
                    required:true
                },
                "data[Business][city]":
                {
                    required:true,
                    accept: "[a-zA-Z]+"
                },
                "data[Business][zip]":
                {
                     required:true,
                    number:true,
                    minlength:5
                },
                "data[Business][country]":
                {
                    required:true
                    
                },
                "data[Business][state]":
                {
                    required:true
                     
                },
                "data[Business][phone]":
                {
                    required:true,
                    number:true
                },
                
                "data[Business][companywebaddress]":
                {
                    required:true,
                    url:true
                }

            },
            messages:
            {
               
                "data[Business][businessname]":
                {
                    required:"This field is required."
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
                "data[Business][business_category_id]":
                {
                    required:"This field is required."
                },
                "data[Business][addressline1]":
                {
                    required:"This field is required."
                },
                "data[Business][addressline2]":
                {
                    required:"This field is required."
                },
                "data[Business][country]":
                {
                    required:"This field is required."
                },
                "data[Business][state]":
                {
                    required:"This field is required."
                },
                "data[Business][city]":
                {
                    required:"This field is required.",
                     accept :"Please enter only characters "
                },
                "data[Business][zip]":
                {
                    required:"This field is required.",
                    number:"Please enter digit.",
                    minlength: 'Zip code must be 5 digit long'
                },
                "data[Business][phone]":
                {
                    required:"This field is required.",
                    number:"Please enter digit."
                },
                "data[Business][companywebaddress]":
                {
                    required:"This field is required.",
                    url:"Please enter a valid Web addredd URl"
                }
                  
                
            }
        
        
        });
        
    
    });
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#BusinessAddForm').validate({
          onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
             
                "data[User][firstname]":
                {
                    required:true,
                     accept: "[a-zA-Z]+",
                     maxlength:20
                },
                 "data[User][email]":
                {
                    required:true,
                    email:true,
                    remote:ajax_url+'users/validUserEmail'
                },
                "data[User][lastname]":
                {
                    required:true,
                    accept: "[a-zA-Z]+",
                   maxlength:20
                },
                "data[User][password]":
                {
                    required:true,
                    minlength: 8
                },
                "data[User][cpassword]":
                {
                    required:true,
                    equalTo:'#pwd'
                }
            },
            messages:
            {
               
               
                "data[User][firstname]":
                {
                    required:"This field is required.",
                    accept :"Please enter only characters "
                },
                "data[User][email]":
                {
                    required:'Please enter email.',
                    email:'Please enter valid email.',
                    remote:'Email address already exists.'
                },
                "data[User][lastname]":
                {
                    required:"This field is required.",
                     accept :"Please enter only characters "
                },
                "data[User][password]":
                {
                    required:"This field is required.",
                    minlength: 'Password should be atleast 8 characters long.'
                },
                "data[User][cpassword]":
                {
                    required:"This field is required.",
                    equalTo:'Password and confirm password does not match.'
                },
          }
        
        
        });
        
    
    });
</script>
