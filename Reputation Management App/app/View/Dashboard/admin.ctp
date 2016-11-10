<script src="http://cdnjs.cloudflare.com/ajax/libs/zeroclipboard/2.1.6/ZeroClipboard.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#adminuploadban').validate({
        onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
                "data[AgencysiteSetting][bannerurl]":
                {
                    //required:true,
                    url:true,
                   // remote:ajax_url+'users/validUserEmail'
                }
            },
            messages:
            {
                "data[AgencysiteSetting][bannerurl]":
                {
                    //required:'Please enter email.',
                    url:'Please enter valid url.',
                    //remote:'Email address already exists.'
                }
            }
        
        
        });
jQuery.validator.addMethod("emailordomain", function(value, element) {
  return this.optional(element) || /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(value) || /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/.test(value);
}, "Please specify the correct url/email");
        $('#admintab').validate({
        onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
                "data[AgencysiteSetting][companywebaddress]":
                {
                        required:true,
            url:true
                  
                },
                "data[User][email]":
                {
                    required:true,
                    email:true,
                    remote:ajax_url+'dashboard/validEmail'
                },
                "data[AgencysiteSetting][additionalemailnotification]":
                {
                    required:true,
                    email:true
                   // remote:ajax_url+'dashboard/addvalidEmail'
                   
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
                "data[AgencysiteSetting][agencyname]":
                {
                    required:true
                   
                },
        "data[AgencysiteSetting][addressline1]":
                {
                    required:true
                   
                },
                "data[AgencysiteSetting][subdomainname]":
                {
                    required:true,
                    emailordomain:true
                },
                "data[AgencysiteSetting][zip]":
                {
                    required:true,
            minlength:5,
                    number:true
                },
                "data[AgencysiteSetting][phone]":
                {
                    required:true,
                    number:true,
                },
        "data[AgencysiteSetting][country_id]":
                {
                    required:true,
                },
                "data[AgencysiteSetting][state_id]":
                {
                    required:true,
                },
                "data[AgencysiteSetting][city_id]":
                {
                    required:true,
                    accept: "[a-zA-Z]+"
                },

            },
            messages:
            {
                "data[AgencysiteSetting][companywebaddress]":
                {
                    required:'This field is required.',
                url:'Please enter valid url.'
                    
                },
        "data[AgencysiteSetting][phone]":
                {
                    required:'This field is required.',
                    number:'Please enter a valid number.',
                },
                "data[User][email]":
                {
                    required:'This is required field.',
                    email:'Please enter a valid email.',
                    remote:'Email is already exist.'
                    
                },
                "data[AgencysiteSetting][additionalemailnotification]":
                {
                    required:'This is required field.',
                    email:'Please enter a valid email.',
                   // remote:'Email is already exist.'
                  
                    
                },
                "data[User][firstname]":
                {
                    required:'This is required field.',
            accept :"Please enter only characters "
                   
                },
                "data[User][lastname]":
                {
                    required:'This is required field.',
                  accept :"Please enter only characters "
                   
                },
                "data[AgencysiteSetting][agencyname]":
                {
                    required:'This is required field.'
                   
                },
                "data[AgencysiteSetting][subdomainname]":
                {
                    required:'This is required field.',
                    emailordomain:'PLease enter valid domain name'
                },
                "data[AgencysiteSetting][zip]":
                {
                    required:'This is required field.',
                    number:'Please enter a valid number.'
                },
         "data[AgencysiteSetting][country_id]":
                {
                    required:'This is required field.'
                },
                "data[AgencysiteSetting][state_id]":
                {
                    required:'This is required field.'
                },
                "data[AgencysiteSetting][city_id]":
                {
                    required:'This is required field.',
                    accept :"Please enter only characters "
                }

            }
        
        
        });
        $('#emailtalk').validate({
        onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
                "data[AgencysiteSetting][emailtalk]":
                {
                    required:true,
                    email:true,
                  
                }
            },
            messages:
            {
                "data[AgencysiteSetting][emailtalk]":
                {
                    required:'Please enter email.',
                    email:'Please enter valid email.',
                    
                }
            }
        
        
        });
         $('#changepass').validate({
        onfocusout: function (element) {
             $(element).valid();
            },
            rules:
            {
                "data[User][oldpass]":
                {
                    required:true,
                    remote:ajax_url+'dashboard/checkValidPass'
                  
                },
                "data[User][password]":
                {
                    required:true,
                    minlength: 8
                },
                "data[User][cpassword]":
                {
                    required:true,
                    equalTo:'#UserPassword'
                }
            },
            messages:
            {
                "data[User][oldpass]":
                {
                    required:'Please enter current password.',
                    remote:'Please enter valid current password'
                    
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
            <?php echo $design['AgencysiteSetting']['sitetitle']; ?> - Tools
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo HTTP_ROOT?>">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Tools</a>
                    </li>
                </ul>
                <div class="page-toolbar">
                    
                </div>
            </div>
            <!-- END PAGE HEADER-->
        
        <div class="row">
          <div class="col-sm-12">
            <div id="content-wrapper">

              <div class="wrapTab">
           
           
             
            <div class="bodyTaab">
            <!--start the section-->
<div class="col-md-10">
                <!-- BEGIN PORTLET-->
                    <div class="portlet box reforce-red">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-user"></i>Change Password
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
                            <div class="table-toolbar">
                            
                                
                            
                            
                                <div class="row">
                                
                                    <div class="col-md-12">
                                                                            
                                    </div>  
                                                                
                                </div>
                            
                        
                        
                                </div>
                    <!-- START FIELDS -->
                    <form class="form-horizontal" accept-charset="utf-8" method="post" enctype= "multipart/form-data" id="changepass" action="<?php echo HTTP_ROOT?>dashboard/admin/changepass">
      
                        <input type="hidden" name="data[Agency][id]" value="<?php echo @$agency['AgencysiteSetting']['id']?>">

                        <div class="form-group">
                        <label class="control-label col-sm-4" for="email">Current Password:</label>
                        <div class="col-sm-4">
                        <input class="form-control account-back" type="password" id="oldpass" name="data[User][oldpass]">
                        </div>
                        </div>


                        <div class="form-group">
                        <label class="control-label col-sm-4" for="email">New Password:</label>
                        <div class="col-sm-4">
                        <input class="form-control account-back" type="password" required="required" id="UserPassword" name="data[User][password]">
                        </div>
                        </div>

                        <div class="form-group">
                        <label class="control-label col-sm-4" for="email">Confirm Password:</label>
                        <div class="col-sm-4">
                        <input class="form-control account-back" type="password" required="required" id="cpass" name="data[User][cpassword]">
                        </div>
                        </div>

                        <div class="form-group">
                        <label class="control-label col-sm-4" for="email">&nbsp;</label>
                        <div class="col-sm-4 submitting">
                        <input type="submit" class="submit btn btn-primary" value="Submit">
                        </div>
                        </div>

                    </form>
                    </div>
                    <!-- END PORTLET-->
                </div>
                <!-- BEGIN PORTLET-->
                    <div class="portlet box reforce-red">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-user"></i>Agency Information
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
                            <div class="table-toolbar">
                            
                                
                            
                            
                                <div class="row">
                                
                                    <div class="col-md-12">
                                                                            
                                    </div>  
                                                                
                                </div>
                            
                        
                        
                                </div>
                    <!-- START FIELDS -->
                    <form class="form-horizontal" accept-charset="utf-8" method="post" enctype= "multipart/form-data" id="admintab" action="<?php echo HTTP_ROOT?>dashboard/admin">
                    <input type="hidden" name="data[Agency][id]" value="<?php echo @$agency['AgencysiteSetting']['id']?>">
                        <div class="col-md-11 col-md-offset-1"><h3 class="form-section">Contact Info</h3></div>
                        <div class="col-md-6">
                        <div class="form-group">
                         <label class="control-label col-sm-6" for="email">Email Address:</label>
                        <div class="col-md-6">
                         <input class="form-control account-back" type="text"  id="agencyemail" name="data[User][email]" value="<?php echo @$user['User']['email']?>" readonly>
                        </div>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label col-sm-6" for="email">Additional Email Notification:</label> 
                        <div class="col-md-6">
                        <input class="form-control account-back" type="text" id="aditionalemail" name="data[AgencysiteSetting][additionalemailnotification]" value="<?php echo @$agency['AgencysiteSetting']['additionalemailnotification']?>">
                        </div>
                        </div>
                        </div>

                        
                        <div class="col-md-6">
                        <div class="form-group">
                         <label class="control-label col-sm-6" for="email">First Name:</label>
                         <div class="col-md-6">
                        <input class="form-control account-back" type="text" id="ufirstname" name="data[User][firstname]" value="<?php echo @$user['User']['firstname']?>">
                        </div>
                        </div>
                        </div>


                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label col-sm-6" for="email">Last Name:</label>
                        <div class="col-md-6">
                        <input class="form-control account-back" type="text" id="ulastname" name="data[User][lastname]" value="<?php echo @$user['User']['lastname']?>">
                        </div>
                        </div>
                        </div>

                        <div class="col-md-11 col-md-offset-1"><h3 class="form-section">Agency Info</h3></div>
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label col-sm-6" for="email">Agency Name:</label>
                        <div class="col-lg-6">
                        <input class="form-control account-back" type="text" id="agencyemail" name="data[AgencysiteSetting][agencyname]" value="<?php echo @$agency['AgencysiteSetting']['agencyname']?>">
                        </div>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label col-sm-6" for="email">Street Address:</label>
                        <div class="col-md-6">
                        <input class="form-control account-back"  id="AddressLine1" name="data[AgencysiteSetting][addressline1]" value="<?php echo @$agency['AgencysiteSetting']['addressline1']?>">
                        </div>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label col-sm-6" for="email">Address Line 2:</label>
                        <div class="col-sm-6">
                        <input class="form-control account-back" id="AddressLine2" name="data[AgencysiteSetting][addressline2]" value="<?php echo @$agency['AgencysiteSetting']['addressline2']?>">
                        </div>
                        </div>
                        </div>


                       <div class="col-md-6">
                       <div class="form-group">
                       <label class="control-label col-sm-6" for="email">Country:</label>
                       <div class="col-sm-6">
                       <select class="account-selected form-control" id="find_country" name="data[AgencysiteSetting][country_id]">
                        <option value=""><?php  echo "Select Country"?></option>
                                                   <?php foreach($countries as $key=>$val){?>
                                                        <option <?php if(@$agency['AgencysiteSetting']['country_id']==$key){?>selected="selected"<?php }?> value="<?php echo $key?>"><?php echo $val?></option>
                                                    <?php } ?>
                       </select>

                       </div>
                       </div>
                       </div>


                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label col-sm-6" for="email">State/Province:</label>
                        <div class="col-sm-6">
                        <select class="account-selected form-control" id="find_state" name="data[AgencysiteSetting][state_id]">
                                            <option value="">Select State</option>
                                            <?php foreach($states as $key=>$val){?>
                                                        <option <?php if(@$agency['AgencysiteSetting']['state_id']==$key){?>selected="selected"<?php }?> value="<?php echo $key?>"><?php echo $val?></option>
                                            <?php } ?>
                        </select>

                        </div>
                        </div>
                        </div>



                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label col-sm-6" for="email">City:</label>
                        <div class="col-lg-6">
                        <input class="form-control account-back" type="text" id="find_city" name="data[AgencysiteSetting][city_id]" value="<?php echo @$agency['AgencysiteSetting']['city_id']?>">
                        
                        </div>
                        </div>
                        </div>

                        
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label col-sm-6" for="email">Zip:</label>
                        <div class="col-sm-6">
                        <input class="form-control account-back" type="text" id="AgencyZip" maxlength="20" name="data[AgencysiteSetting][zip]" value="<?php echo @$agency['AgencysiteSetting']['zip']?>">

                        </div>
                        </div>
                        </div>


                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label col-sm-6" for="email">Phone:</label>
                        <div class="col-sm-6">
                        <input class="form-control account-back" type="tel" id="AgencyPhone" maxlength="255" name="data[AgencysiteSetting][phone]" value="<?php echo @$agency['AgencysiteSetting']['phone']?>">
                        </div>
                        </div>
                        </div>

                        <div class="col-md-11 col-md-offset-1"><h3 class="form-section">Website Info</h3></div>
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label col-sm-6" for="email">Company Web Address:</label>
                        <div class="col-sm-6">
                        <input class="form-control account-back" type="text" id="Agencywebaddress" maxlength="100" name="data[AgencysiteSetting][companywebaddress]" value="<?php echo @$agency['AgencysiteSetting']['companywebaddress']?>">
                        </div>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label col-sm-6" for="email">Agency Subdomain:</label>
                        <div class="col-sm-6">
                        <input class="form-control account-back" type="text" maxlength="20" id="AgencySubdomain" name="data[AgencysiteSetting][subdomainname]" value="<?php echo @$agency['AgencysiteSetting']['subdomainname']?>">
                          <p>Name Servers:(ns1.example.com,ns2.example.com)</p>
                        </div>

                        </div>
                        </div>

                        <div class="col-md-6 col-md-offset-6">
                        <div class="form-group">
                        <label class="control-label col-sm-6" for="email">Agency Domain:</label>
                        <div class="col-sm-6">
                        <input class="form-control account-back" type="text" maxlength="20" id="Agencydomain" name="data[AgencysiteSetting][domainname]" value="<?php echo @$agency['AgencysiteSetting']['domainname']?>">
                        </div>
                        </div>
                        </div>
                        
                        <div class="col-md-11 col-md-offset-1"><h3 class="form-section">Manage Logo</h3></div>
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label col-sm-6" for="email">Agency Logo:</label>
                        <div class="col-sm-6">

                        <div class="fileUpload btn">
        
                        <input type="file" class="upload form-control" id="agencylogo" name="data[AgencysiteSetting][agencylogo]"/>
                        </div>


                        <!-- <input type="file" id="agencylogo" name="data[AgencysiteSetting][agencylogo]"> -->
                        </div>
                        </div>
                        </div>


                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label col-sm-6" for="email">Logo:</label>
                        <div class="col-sm-6">
                        <?php if(isset($agency['AgencysiteSetting']['agencylogo'])){?><img src="<?php echo HTTP_ROOT;?>/img/agencylogo/medium/<?php echo @$agency['AgencysiteSetting']['agencylogo'] ?>" style="width:20%;height:100px;float:left"/><?php }?>
                        <input type="hidden" id="logoag" name="data[Agency][logoname]" value="<?php echo @$agency['AgencysiteSetting']['agencylogo']?>">

                        </div>
                        </div>
                        </div>



                        
                        <div class="form-group">
                        <label for="email" class="control-label col-sm-4">&nbsp;</label>  
                        <div class="col-sm-4 submitting"> 
                            <input type="submit" value="Submit" class="submit btn btn-primary">
                         </div> 
                        </div>
                    </form>
                    </div>
                    <!-- END PORTLET-->
                    </div>


                    <!-- BEGIN PORTLET  For Agency Logo-->
                    <div class="portlet box reforce-red">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-user"></i>Agency Logo Settings
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
                            <div class="table-toolbar">
                            
                                
                            
                            
                                <div class="row">
                                
                                    <div class="col-md-12">
                                                                            
                                    </div>  
                                                                
                                </div>
                            
                        
                        
                                </div>
                    <!-- START FIELDS -->
                            <form class="form-horizontal" accept-charset="utf-8" method="post" enctype= "multipart/form-data" id="adminuploadban" action="<?php echo HTTP_ROOT?>dashboard/admin/uploadbanner">
                               
                               <input type="hidden" name="data[Agency][id]" value="<?php echo @$agency['AgencysiteSetting']['id']?>">


                               <div class="form-group">
                               <label class="control-label col-sm-4" for="email">Upload Banner:</label>
                               <div class="col-sm-4">

                               <div class="fileUpload btn">
                                <input type="file" class="upload form-control" id="agencybanner" name="data[AgencysiteSetting][banner]"/>
                                </div> 

                               <!-- <input type="file" id="agencybanner" name="data[AgencysiteSetting][banner]"> -->
                               </div>
                               </div>


                               <div class="form-group">
                               <label class="control-label col-sm-4" for="email">Current Banner:</label>
                               <div class="col-sm-4">
                               <?php if(isset($agency['AgencysiteSetting']['banner'])){?><img src="<?php echo HTTP_ROOT;?>/img/banner/medium/<?php echo @$agency['AgencysiteSetting']['banner'] ?>" width="120"/><?php }?>
                               </div>
                               </div>
                                <input type="hidden" id="bannerag" name="data[Agency][banner]" value="<?php echo @$agency['AgencysiteSetting']['banner']?>">

                               <div class="form-group">
                               <label class="control-label col-sm-4" for="email">Logo Anchor Link:</label>
                               <div class="col-sm-4"> 
                               <input class="form-control account-back" type="text" maxlength="50" id="bannerurl" name="data[AgencysiteSetting][bannerurl]" value="<?php echo @$agency['AgencysiteSetting']['bannerurl']?>">
                               </div>
                               </div>
                                

                               <div class="form-group">
                               <label class="control-label col-sm-4" for="email">&nbsp;</label>
                               <div class="col-sm-4 submitting">
                               <input type="submit" class="submit btn btn-primary" value="Submit">
                               </div>
                               </div>


                            </form>
                        </div>
                    <!-- END PORTLET-->
                    </div>


                    <!-- BEGIN PORTLET-->
                    <div class="portlet box reforce-red">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-user"></i>Email Settings
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
                            <div class="table-toolbar">
                            
                                
                            
                            
                                <div class="row">
                                
                                    <div class="col-md-12">
                                                                            
                                    </div>  
                                                                
                                </div>
                            
                        
                        
                                </div>
                    <!-- START FIELDS EMAIL -->
                        <form class="form-horizontal" accept-charset="utf-8" method="post" enctype= "multipart/form-data" id="register-emailNotification" action="<?php echo HTTP_ROOT?>dashboard/admin/regEmail">

                            <input type="hidden" name="data[Agency][id]" value="<?php echo @$agency['AgencysiteSetting']['id']?>">
                            <input type="hidden" name="data[Template][id]" value="<?php echo @$emailtemplate['AgencyTemplate']['id']?>">
                             <input type="hidden" name="data[Template][name]" value="Registered email notification.">


                            <div class="form-group"> 
                            <label class="control-label col-sm-4" for="email">Business Owner Signup Link:</label> 
                            <div class="col-sm-7">  
                            <div id="signupurl">
                            <div id="clipboard-text" class="form-control" style="background-color: initial;" name="clipboard-text" onclick="this.select();">
                            <?php echo HTTP_ROOT.'users/registerBusinessUser/'.base64_encode(@$agency['AgencysiteSetting']['user_id'])?>
                            </div>
                            </div>
                            </div>
                            </div>



                            <div class="form-group">
                            <label class="control-label col-sm-4" for="email">&nbsp;</label>  
                            <div class="col-sm-2">
                           <?php echo $this->Html->link('Preview', '/users/registerBusinessUser/'.base64_encode(@$agency['AgencysiteSetting']['id']), array('target' => '_blank','class'=>"preview form-control btn")); ?>
                            </div>
                            <div class="col-sm-2">
                            <input class="copy-field form-control btn" data-clipboard-target="clipboard-text" id="btn-To-Copy" value="Copy" type="button">
                            </div>
                            </div>



                            <div class="form-group" id="new-chk">
                            <label class="control-label col-sm-5" for="email">&nbsp;</label>
                            
                           <div class="col-sm-7">  
                            
                            <div class="checkbox">
                            <label for="signuplink" name="checkbox2_lbl" class="">Show Business Owner Link:
                            <div class="checker">
                            <span>
                            <input type="checkbox" id="signuplink" checked="checked" name="data[link]" checked="checked"/>
                            </span>
                            </div>
                            </label>
                            </div>



                            <!-- <input type="checkbox" id="signuplink" name="data[link]" checked="checked"> -->
                            </div>
                            </div>

                           <div class="form-group"> 
                           <label class="control-label col-sm-4" for="email">Email Subject:</label> 
                          <div class="col-sm-7">           
                           <input class="form-control account-back" type="text" id="email-subject" name="data[AgencyTemplate][emailsubject]" value="<?php echo @$emailtemplate['AgencyTemplate']['emailsubject']?>">
                           </div>
                           </div>

                           <div class="form-group"> 
                           <label class="control-label col-sm-4" for="email">Sender Name:</label>
                          <div class="col-sm-7">  
                           <input class="form-control account-back" type="text" id="sender-name" name="data[AgencyTemplate][sendername]" value="<?php echo @$emailtemplate['AgencyTemplate']['sendername']?>">
                           </div>
                           </div>

                           <div class="form-group">
                           <label class="control-label col-sm-4" for="email">Sender email:</label>
                          <div class="col-sm-7">  
                           <input class="form-control account-back" type="text" id="sender-email" name="data[AgencyTemplate][senderemail]" value="<?php echo @$emailtemplate['AgencyTemplate']['senderemail']?>">
                           </div>
                           </div>





                           <div class="form-group">
                           <label class="control-label col-sm-4" for="email">Email Content:</label>
                           <div class="col-sm-7">  
                           <textarea name="data[AgencyTemplate][emailcontent]" id="cktext"><?php echo @$emailtemplate['AgencyTemplate']['emailcontent']?></textarea>
                           </div>
                           </div>



                           <div class="form-group">
                            <label class="control-label col-sm-4" for="email">&nbsp;</label>
                            <div class="col-sm-7">  
                            
                             <input type="button" value="Merge Fields" class="btn btn-primary" data-toggle="modal" data-target="#emailcontent-model">
                            <input class="restore-default btn yellow pull-right" onclick="InsertText();" type="button" value="Restore Default">
                            </div>
                            </div>



                            <div class="modal fade" id="emailcontent-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel">Click Insert button to mearge field</h4>
                                  </div>
                                  <div class="modal-body">
                                      <?php $fields=explode(',',@$defaultemplate['DefaultTemplate']['mergefields'])?>
                                      <table>
                                        <?php foreach ($fields as $key => $value) { ?>
                                             <tr><td><?php echo $value?></td><td style="margin-left:100px">
                                             <input type="button" value="Insert" class="insbtncon">
                                             </td></tr>
                                        <?php }?>
                                      </table>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                            <label class="control-label col-sm-4" for="email">Email Signature:</label>
                            <div class="col-sm-7">  
                            <textarea id="cktext1" name="data[AgencyTemplate][signature]"><?php echo @$emailtemplate['AgencyTemplate']['signature']?></textarea>
                            </div>
                            </div>

                            <div class="form-group">
                            <label class="control-label col-sm-4" for="email">&nbsp;</label>
                            <div class="col-sm-7">  
                            
                            <input type="button" value="Merge Fields" class="btn btn-primary" data-toggle="modal" data-target="#sgnature-model">
                            <input class="restore-default btn yellow pull-right" onclick="InsertText1();" type="button" value="Restore Default">
                            </div>
                            </div>


                            <div class="modal fade" id="sgnature-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel">Click Insert button to merge field</h4>
                                  </div>
                                  <div class="modal-body">
                                      <?php $fields=explode(',',@$defaultemplate['DefaultTemplate']['mergefields'])?>
                                      <table>
                                        <?php foreach ($fields as $key => $value) { ?>
                                             <tr><td><?php echo $value?></td><td style="margin-left:100px">
                                             <input type="button" value="Insert" class="insbtn">
                                             </td></tr>
                                        <?php }?>
                                      </table>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>



                          


 </div>
            </div>



            <div class="form-group">
            <label class="control-label col-sm-3" for="email">&nbsp;</label>
            <div class="col-sm-9">
            <button type="submit" class="submit btn btn-primary">Submit</button>
            </div>
            </div>


           
           <textarea cols="100" id="txtArea" rows="3" style="display:none;" name="data[DefaultTemplate][content]"><?php echo @$defaultemplate['DefaultTemplate']['content']?></textarea>
           <textarea cols="100" id="dfltsign" rows="3" style="display:none;" name="data[DefaultTemplate][signature]"><?php echo @$defaultemplate['DefaultTemplate']['signature']?></textarea> 

</textarea>
     
      </form>
      </div> 


<script>
$('document').ready(function(){
    $('#signuplink').click(function() {
    if( $(this).is(':checked')) {
        $("#signupurl").show();
    } else {
        $("#signupurl").hide();
    }
}); 
});
</script>
<script type="text/javascript">
        var client = new ZeroClipboard(document.getElementById("btn-To-Copy"));
        client.on("ready", function (readyEvent) {
            client.on("aftercopy", function (event) {
           });
        });
</script>
<script>
     $(document).ready(function(){
        $("#mergfields").click(function(){
          $("#mrgArea").show();
          
        });
        $("#mergfieldsdflt").click(function(){
          $("#mrgAreadflt").show();
          
        });
         var validator = $("#register-emailNotification").validate(
            {
              ignore: [],
              rules: { 
                    "data['AgencyTemplate']['emailcontent']":{
                            required: function() 
                            {
                                CKEDITOR.instances.cktext.updateElement();
                                
                            }
                          
                    },
                    "data[AgencyTemplate][signature]":{
                            required: function() 
                            {
                                CKEDITOR.instances.cktext1.updateElement();
                                
                            }
                          
                    },
                    "data[AgencyTemplate][emailsubject]":{
                            required:true
                        },
                    "data[AgencyTemplate][sendername]":{
                            required:true
                        },
                    "data[AgencyTemplate][senderemail]":{
                            required:true,
                            email:true
                        }     
                },
                messages:
                    {

                    "data['AgencyTemplate']['emailcontent']":{
                        required:"This is required field",
                    },
                    "data['AgencyTemplate']['signature']":{
                        required:"This is required field",
                    },
                    "data[AgencyTemplate][emailsubject]":{
                           required:"This is required field.",
                        },
                    "data[AgencyTemplate][sendername]":{
                            required:"This is required field.",
                        },
                    "data[AgencyTemplate][senderemail]":{
                            required:"This is required field.",
                            email:"Please enter valid email.",
                        }      
                },
                errorPlacement: function(error, $elem) {
                    if ($elem.is('textarea')) {
                        $elem.next().css('border', '1px solid red');
                        error.insertAfter($elem.next());
                        CKEDITOR.instances.cktext.focus();
                    }else{
                         error.insertAfter($elem); 
                    }
                },
            }); 
        validator.focusInvalid = function() {
            if( this.settings.focusInvalid ) {
                try {
                    var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);
                    if (toFocus.is("textarea")) {
                         if(CKEDITOR.instances.cktext.getData()==''){
                            CKEDITOR.instances.cktext.focus();
                         }else{
                            CKEDITOR.instances.cktext1.focus();
                         }
                    } else {
                        toFocus.filter(":visible").focus();
                    }
                } catch(e) {
                }
            }
        }
    });
</script>
<script type="text/javascript">
   window.onload = function()
   {
      CKEDITOR.replace( 'cktext' , {
        resize_enabled: false,
        removeButtons: 'Save,NewPage,Preview,Templates',
        width: '100%'});
      CKEDITOR.replace( 'cktext1', {
        resize_enabled: false,
        removeButtons: 'Save,NewPage,Preview,Templates',
        width: '100%' });

      CKEDITOR.instances.cktext.on('contentDom', function() {
        CKEDITOR.instances.cktext.document.on('keyup', function(event) {
           if(CKEDITOR.instances.cktext.getData()==''){
                $("[for='cktext']").css('display','block');
                $('#cktext').removeClass('valid');
                $('#cktext').addClass('error');
                $('#cktext').next().css('border','1px solid red');
           }else{
                $("[for='cktext']").css('display','none');
                $('#cktext').removeClass('error');
                $('#cktext').addClass('valid');
                $('#cktext').next().css('border','none');
           }
        });
    });

    CKEDITOR.instances.cktext1.on('contentDom', function() {
        CKEDITOR.instances.cktext1.document.on('keyup', function(event) {
           if(CKEDITOR.instances.cktext1.getData()==''){
                $("[for='cktext1']").css('display','block');
                $('#cktext1').removeClass('valid');
                $('#cktext1').addClass('error');
                $('#cktext1').next().css('border','1px solid red');
           }else{
                $("[for='cktext1']").css('display','none');
                $('#cktext1').removeClass('error');
                $('#cktext1').addClass('valid');
                $('#cktext1').next().css('border','none');
           }
        });
    });  
   };
   function InsertText() {
        var editor = CKEDITOR.instances.cktext;
        var value = document.getElementById( 'txtArea' ).value;
         $("[for='cktext']").css('display','none');
                    $('#cktext').removeClass('error');
                    $('#cktext').addClass('valid');
                    $('#cktext').next().css('border','none');
        if ( editor.mode == 'wysiwyg' )
        {
            editor.setData( value );
         
        }
        else
            alert( 'You must be in WYSIWYG mode!' );
    }
    function InsertText1() {
        var editor = CKEDITOR.instances.cktext1;
        var value = document.getElementById('dfltsign').value;
         $("[for='cktext1']").css('display','none');
                    $('#cktext1').removeClass('error');
                    $('#cktext1').addClass('valid');
                    $('#cktext1').next().css('border','none');
        if ( editor.mode == 'wysiwyg' )
        {
            editor.setData( value );
         
        }
        else
            alert( 'You must be in WYSIWYG mode!' );
    }

     $('document').ready(function(){
        $('.insbtn').on('click',function(){
            var value=$(this).parent().prev().html();
            var editor = CKEDITOR.instances.cktext1;
            if ( editor.mode == 'wysiwyg' )
            {
                editor.insertHtml( value );
                 $('.close').click();
               
            }
            else
                alert( 'You must be in WYSIWYG mode!' );
             CKEDITOR.instances.cktext1.focus();
        });
        $('.insbtncon').on('click',function(){
            var value=$(this).parent().prev().html();
            console.log(value);
            var editor = CKEDITOR.instances.cktext;
            if ( editor.mode == 'wysiwyg' )
            {
                editor.insertHtml( value );
                $('.close').click();
                
            }
            else
                alert( 'You must be in WYSIWYG mode!' );
            CKEDITOR.instances.cktext.focus();
        });
    });

</script>

<!--end section-->
                        
          
            </div>
          </div>
         
        </div>
        <?php echo $this->element('reviewsidebar')?>
        </div>
       
</div>
 
   
       
       </div></div></div>
