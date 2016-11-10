<?php echo $this->element('nav_business_user')?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<div class="page-content">
 
<!-- BEGIN PAGE HEADER-->
      <h3 class="page-title">
      <?php echo $this->element('welcome')?> - Visibility Report
      </h3>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo HTTP_ROOT?>">Home</a>
            <i class="fa fa-angle-right"></i>
          </li>
          <li>
            <a href="#">Visibility Report</a>
          </li>
        </ul>
        <div class="page-toolbar">
                
        </div>
      </div>
      <!-- END PAGE HEADER-->
<div class="row"> 
  <div class="col-lg-10 col-md-9 col-sm-8">
   <div id="content-wrapper">

  <div class="row">      
    <div class="col-md-6">        
        
            <div class="portlet box reforce-red">
                        <div class="portlet-title">
                          <div class="caption">
                            Visibility Percentage
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
                        
                        <div class="portlet-body grey">

                 <section id="visibility-top">
               
                 
                 <div class="row">
                 <div class="col-md-5 col-md-offset-1"><h2>Visibility Percentage:</h2></div>
                 <div class="col-md-6"><h2 class="makebold"><?php echo $percentage .'%'?></h2></div>
                 </div>
            
            </div>
            </div>
            
            
            <div class="portlet box reforce-red">
                <div class="portlet-title">
                  <div class="caption">
                    Visibility Breakdown
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
                
                <div class="portlet-body grey">
                 <div class="visibility-state">
                  
                  <div class="table-scrollable">
                  <table class="table table-condensed table-hover table-bordered" id="visBreakdown">
                  <tr class="info">
                  <th>Found Accurate </th>
                  <th>Possible Errors</th>
                  <th>Missing        </th>
                  </tr>

                  <tr>
                  <td class="success"><?php echo $accurate;?></td>
                  <td class="warning"><?php echo $error;?></td>
                  <td class="danger"><?php echo $missing;?></td>
                  </tr>
                  
                  </table>
                  </div>
                  </div>  
                 
               
                 </div>
            </div>
    </div>
    
    <div class="col-md-6">
    <div class="portlet box reforce-red">
                <div class="portlet-title">
                  <div class="caption">
                    Business Information
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
                
        <div class="portlet-body grey">
      

         
         <div class="contact-info">
        
         <table class="table table-hover table-light" id="visBizInfo">
          <tr>
          <td>Name</td>
          <td><?php echo $businessUser['Business']['businessname']?></td>
          </tr>

          <tr>
          <td>Address</td>
          <td><?php echo $businessUser['Business']['addressline1'].' '.$businessUser['Business']['addressline2']?></td>
          </tr>

          <tr>
          <td>City</td>
          <td><?php echo $businessUser['Business']['cityname']?></td>
          </tr>

          <tr>
          <td>State/Provience</td>
          <td><?php echo $businessUser['Business']['statename']?></td>
          </tr>

          <tr>
          <td>Postal/Zip</td>
          <td><?php echo $businessUser['Business']['zip']?></td>
          </tr>

          <tr>
          <td>Phone</td>
          <td><?php echo $businessUser['Business']['phone']?></td>
          </tr> 

          <tr>
          <td>Website</td>
          <td><?php echo $businessUser['Business']['companywebaddress']?></td>
          </tr>

          <tr>
          <td>Business Category</td>
          <td><?php echo $businessUser['Business']['category']?></td>
          </tr>

          </table>
          </div>
      </div>
      </div>
      </div>
      
      <div class="col-md-4">
         
         </div>
        </div>
        </section>


    <div class="portlet box reforce-red">
                <div class="portlet-title">
                  <div class="caption">
                    Search Engines
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
                
                <div class="portlet-body grey">
        <section id="search-engine">

       

        <div class="row">
        <div class="col-md-12">
        <table class="table table-striped">
    <?php foreach($SearchEngine as $key=>$value)
     {
       
     ?>
          <?php $mn= $value['SocialMedia']['mediasitename'];?>
          <tr>
              <td class="bing-local hometic-style">
              <div class="socil-img">
                <img src="<?php echo $this->webroot; ?>img/social-icons/<?php echo $value['SocialMedia']['mediasitename'];?>.png" alt="<?php echo $mn?> icon">
              </div>
              <?php echo $mn; ?>
              <p><a href="javascript:void(0);" data-toggle="modal" data-target="#<?php echo str_replace(' ','',str_replace('.','', str_replace("'",'', $mn)));?>-modelSE" >Notes |</a><a style="cursor:pointer;" data-toggle="modal" data-target="#<?php echo str_replace(' ','',str_replace('.','', $mn));?>-model" ><?php echo in_array($mn, $media) && isset($media[$mn]) && $media[$mn]?'Edit Account Url':'Add Account Url'?>  </a><?php if(in_array($mn, $media) && isset($media[$mn]) && $media[$mn]){?>|<a href="<?php echo HTTP_ROOT.'dashboard/dismissSite/'.array_search($mn, $media)?>">Dismiss</a><?php }?></p></td>
                 <?php 
                    if(in_array($mn, $media) && isset($media[$mn]) && $media[$mn]){
                        if($media[$mn.'status']=='visible'){ ?>
                             <td class="found-status"><img src="<?php echo $this->webroot; ?>img/green-check.png" alt="green check icon"></td>
                     <?php   }else{ ?>
                                <td class="found-status"><img src="<?php echo $this->webroot; ?>img/warning-icon.png" alt="Warning icon"></td>
                    <?php    }
                    }else{ ?>
                          <td class="found-status"><img src="<?php echo $this->webroot; ?>img/Red_Cross.png" alt="Red Cross icon"></td>
                  <?php  }
                 ?>
             
              <td class="hometic-style">
              <?php 
                if(in_array($mn, $media) && isset($media[$mn]) && $media[$mn]){
                  if($media[$mn.'status']=='visible'){
                    echo 'You are listed on '.$mn.'.';
                  }elseif ($media[$mn.'status']=='error') {
                     echo 'We did not find your visibility on '.$mn.'. Please try again.';
                  }else{
                    echo 'You are not listed on '.$mn;
                  }
                }else{
                  echo 'You are not listed on '.$mn;
                }
              ?></td>
          </tr>
           <div class="modal fade" id="<?php echo str_replace(' ','',str_replace('.','', $mn));?>-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="exampleModalLabel">Enter <?php echo $mn;?> Url</h4>
                        </div>
                        <div class="modal-body">
                           <form id="<?php echo str_replace(' ','',$mn);?>" method="post" action="<?php echo HTTP_ROOT?>dashboard/visibility/<?php echo str_replace(' ', '', str_replace('.','', $mn))?>/<?php echo $busid?>">
                            <?php if(in_array($mn, $media)){?>
                              <input type="hidden" name="data[Visibility][id]" value="<?php echo array_search($mn, $media)?>"/>  
                              <input type="hidden" name="data[Visibility][checker_type]" value="<?php echo $media[$mn.'checker']=='SocialSite'?'socialchecker':'visibilitychecker'?>"/>
                              <input type="hidden" name="data[Business][id]" value="<?php echo $businessUser['Business']['id']?>"/>  
                            <?php } else {?> 
                              <input type="hidden" name="data[Business][id]" value="<?php echo $businessUser['Business']['id']?>"/>  
                            <?php }?>
                            <input type="text" name="data[Visibility][prefixurl]" value="<?php echo $value['SocialMedia']['prefixurl']?>" id="prefixurltxt" readonly/>
                            <input type="text" name="data[Visibility][url]" value="<?php echo in_array($mn, $media)?@$media[$mn]:''?>" id="urltxt" required="required"/>
                            <input type="submit" value="Submit"/>
                           </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                </div>
                <!--Starting SearchEngine Note PopUp-->
            
                 <div class="modal fade" id="<?php echo str_replace(' ','',str_replace('.','', str_replace("'",'', $mn)));?>-modelSE" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="NotesModalLabel">Enter <?php echo $mn;?> Notes</h4>
                        </div>
                        <div class="modal-body">
                           <form id="<?php echo str_replace(' ','',$mn);?>" method="post" action="<?php echo HTTP_ROOT.'dashboard/saveNotes'?>">
                           
                           <input type="hidden" name="data[BusinessSocialMedia][id]" value="<?php echo $value['BusinessSocialMedia']['id']?>"/>

                            <input type="text" name="data[BusinessSocialMedia][notes]" value="<?php echo $value['BusinessSocialMedia']['notes']?>" required="required"/>
                            <input type="submit" value="Submit"/>
                           </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- Ending Note PopUp -->
  <?php } ?>
                    

         

        </table>
        </div>


      </section>
       </div>
        </div>
        </div>
    <div class="portlet box reforce-red">
                <div class="portlet-title">
                  <div class="caption">
                    Review Sites
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
                
                <div class="portlet-body grey">
        <section id="review-engine">
       

        <div class="row">
        <div class="col-md-12">
        <table class="table table-striped">
        <?php foreach($reviewsite as $key=>$value)
          {
          ?>
           <?php $mn= $value['SocialMedia']['mediasitename'];?>
          <tr>
              <td class="bing-local hometic-style">
              <div class="socil-img">
                <img src="<?php echo $this->webroot; ?>img/social-icons/<?php echo $value['SocialMedia']['mediasitename'];?>.png" alt="<?php echo $mn?> icon">
              </div>
              <?php echo $mn; ?>
              <p> <a href="javascript:void(0);" data-toggle="modal" data-target="#<?php echo str_replace(' ','',str_replace('.','', str_replace("'",'', $mn)));?>-modelN" >Notes |</a><a style="cursor:pointer;" data-toggle="modal" data-target="#<?php echo str_replace(' ','',str_replace('.','', str_replace("'",'', $mn)));?>-model" ><?php echo in_array($mn, $media) && isset($media[$mn]) && $media[$mn]?'Edit Account Url':'Add Account Url'?>  </a><?php if(in_array($mn, $media) && isset($media[$mn]) && $media[$mn]){?>|<a href="<?php echo HTTP_ROOT.'dashboard/dismissSite/'.array_search($mn, $media)?>">Dismiss</a><?php }?></p></td>
                 <?php 
                    if(in_array($mn, $media) && isset($media[$mn]) && $media[$mn]){
                        if($media[$mn.'status']=='visible'){ ?>
                             <td class="found-status"><img src="<?php echo $this->webroot; ?>img/green-check.png" alt="green check icon"></td>
                     <?php   }else{ ?>
                                <td class="found-status"><img src="<?php echo $this->webroot; ?>img/warning-icon.png" alt="Warning icon"></td>
                    <?php    }
                    }else{ ?>
                          <td class="found-status"><img src="<?php echo $this->webroot; ?>img/Red_Cross.png" alt="Red Cross icon"></td>
                  <?php  }
                 ?>
             
              <td class="hometic-style">
              <?php 
                if(in_array($mn, $media) && isset($media[$mn]) && $media[$mn]){
                  if($media[$mn.'status']=='visible'){
                    echo 'You are listed on '.$mn.'.';
                  }elseif ($media[$mn.'status']=='error') {
                    echo 'We did not find your visibility on '.$mn.'. Please try again.';
                  }else{
                    echo 'You are not listed on '.$mn;
                  }
                }else{
                  echo 'You are not listed on '.$mn;
                }
              ?></td>
          </tr>
           <div class="modal fade" id="<?php echo str_replace(' ','',str_replace('.','', str_replace("'",'', $mn)));?>-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="exampleModalLabel">Enter <?php echo $mn;?> Url</h4>
                        </div>
                        <div class="modal-body">
                           <form id="<?php echo str_replace(' ','',$mn);?>" method="post" action="<?php echo HTTP_ROOT?>dashboard/visibility/<?php echo str_replace(' ', '', str_replace('.','', $mn))?>/<?php echo $busid?>">
                            <?php if(in_array($mn, $media)){?>
                              <input type="hidden" name="data[Visibility][id]" value="<?php echo array_search($mn, $media)?>"/>  
                              <input type="hidden" name="data[Visibility][checker_type]" value="<?php echo $media[$mn.'checker']=='SocialSite'?'socialchecker':'visibilitychecker'?>"/>
                              <input type="hidden" name="data[Business][id]" value="<?php echo $businessUser['Business']['id']?>"/>  
                            <?php } else {?> 
                              <input type="hidden" name="data[Business][id]" value="<?php echo $businessUser['Business']['id']?>"/>  
                            <?php }?>
                            <input type="text" name="data[Visibility][prefixurl]" value="<?php echo $value['SocialMedia']['prefixurl']?>" id="prefixurltxt" readonly/>
                            <input type="text" name="data[Visibility][url]" value="<?php echo in_array($mn, $media)?@$media[$mn]:''?>" id="urltxt" required="required"/>
                            <input type="submit" value="Submit"/>
                           </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                </div>
                 <!--Starting Review Site Note PopUp-->
                 <div class="modal fade" id="<?php echo str_replace(' ','',str_replace('.','', str_replace("'",'', $mn)));?>-modelN" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="NotesModalLabel">Enter <?php echo $mn;?> Notes</h4>
                        </div>
                        <div class="modal-body">
                           <form id="<?php echo str_replace(' ','',$mn);?>" method="post" action="<?php echo HTTP_ROOT.'dashboard/saveNotes'?>">
                           
                           <input type="hidden" name="data[BusinessSocialMedia][id]" value="<?php echo $value['BusinessSocialMedia']['id']?>"/>

                            <input type="text" name="data[BusinessSocialMedia][notes]" value="<?php echo $value['BusinessSocialMedia']['notes']?>" required="required"/>
                            <input type="submit" value="Submit"/>
                           </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- Ending Note PopUp -->
        <?php } ?> 
        </table>
      </div> 
      </section> 
      </div>
    </div>

        <div class="portlet box reforce-red">
                <div class="portlet-title">
                  <div class="caption">
                    Social Sites
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
                
                <div class="portlet-body grey">
        <section id="social-engine">
        

        <div class="row">
        <div class="col-md-12">
        <table class="table table-striped">
        
        <?php
       
     foreach($socialsite as $key=>$value)
        { ?>
        <?php $mn= $value['SocialMedia']['mediasitename'];?>
          <tr>
              <td class="bing-local hometic-style">
              <div class="socil-img">
                <img src="<?php echo $this->webroot; ?>img/social-icons/<?php echo $value['SocialMedia']['mediasitename'];?>.png" alt="<?php echo $mn?> icon">
              </div>
              <?php echo $mn; ?>
              <p><a href="javascript:void(0);" data-toggle="modal" data-target="#<?php echo str_replace(' ','',str_replace('.','', str_replace("'",'', $mn)));?>-modelSS" >Notes |</a><a style="cursor:pointer;" data-toggle="modal" data-target="#<?php echo str_replace(' ','',str_replace('.','', $mn));?>-model" ><?php echo in_array($mn, $media) && isset($media[$mn]) && $media[$mn]?'Edit Account Url':'Add Account Url'?>  </a><?php if(in_array($mn, $media) && isset($media[$mn]) && $media[$mn]){?>|<a href="<?php echo HTTP_ROOT.'dashboard/dismissSite/'.array_search($mn, $media)?>">Dismiss</a><?php }?></p></td>
                 <?php 
                    if(in_array($mn, $media) && isset($media[$mn]) && $media[$mn]){
                        if($media[$mn.'status']=='visible'){ ?>
                             <td class="found-status"><img src="<?php echo $this->webroot; ?>img/green-check.png" alt="green check icon"></td>
                     <?php   }else{ ?>
                                <td class="found-status"><img src="<?php echo $this->webroot; ?>img/warning-icon.png" alt="Warning icon"></td>
                    <?php    }
                    }else{ ?>
                          <td class="found-status"><img src="<?php echo $this->webroot; ?>img/Red_Cross.png" alt="Red Cross icon"></td>
                  <?php  }
                 ?>
             
              <td class="hometic-style">
              <?php 
                if(in_array($mn, $media) && isset($media[$mn]) && $media[$mn]){
                  if($media[$mn.'status']=='visible'){
                    echo 'You are listed on '.$mn.'.';
                  }elseif ($media[$mn.'status']=='error') {
                    echo 'We did not find your visibility on '.$mn.'. Please try again.';
                  }else{
                    echo 'You are not listed on '.$mn;
                  }
                }else{
                  echo 'You are not listed on '.$mn;
                }
              ?></td>
          </tr>
           <div class="modal fade" id="<?php echo str_replace(' ','',str_replace('.','', $mn));?>-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="exampleModalLabel">Enter <?php echo $mn;?> Url</h4>
                        </div>
                        <div class="modal-body">
                           <form id="<?php echo str_replace(' ','',$mn);?>" method="post" action="<?php echo HTTP_ROOT?>dashboard/visibility/<?php echo str_replace(' ', '', str_replace('.','', $mn))?>/<?php echo $busid?>">
                            <?php if(in_array($mn, $media)){?>
                              <input type="hidden" name="data[Visibility][id]" value="<?php echo array_search($mn, $media)?>"/>  
                              <input type="hidden" name="data[Visibility][checker_type]" value="<?php echo $media[$mn.'checker']=='SocialSite'?'socialchecker':'visibilitychecker'?>"/>
                              <input type="hidden" name="data[Business][id]" value="<?php echo $businessUser['Business']['id']?>"/>  
                            <?php } else {?> 
                              <input type="hidden" name="data[Business][id]" value="<?php echo $businessUser['Business']['id']?>"/>  
                            <?php }?>
                            <input type="text" name="data[Visibility][prefixurl]" value="<?php echo $value['SocialMedia']['prefixurl']?>" id="prefixurltxt" readonly/>
                            <input type="text" name="data[Visibility][url]" value="<?php echo in_array($mn, $media)?@$media[$mn]:''?>" id="urltxt" required="required"/>
                            <input type="submit" value="Submit"/>
                           </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                </div>
                 <!--Starting SocailSite Note PopUp-->
            
                 <div class="modal fade" id="<?php echo str_replace(' ','',str_replace('.','', str_replace("'",'', $mn)));?>-modelSS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="NotesModalLabel">Enter <?php echo $mn;?> Notes</h4>
                        </div>
                        <div class="modal-body">
                           <form id="<?php echo str_replace(' ','',$mn);?>" method="post" action="<?php echo HTTP_ROOT.'dashboard/saveNotes'?>">
                           
                           <input type="hidden" name="data[BusinessSocialMedia][id]" value="<?php echo $value['BusinessSocialMedia']['id']?>"/>

                            <input type="text" name="data[BusinessSocialMedia][notes]" value="<?php echo $value['BusinessSocialMedia']['notes']?>" required="required"/>
                            <input type="submit" value="Submit"/>
                           </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- Ending Note PopUp -->
         <?php } ?>
                   

         

        </table>
        </div>
      </section>
</div>
        </div>
        <div class="portlet box reforce-red">
                <div class="portlet-title">
                  <div class="caption">
                    Directory Listings
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
                
                <div class="portlet-body grey">
        <section id="directory-engine">
       
        <div class="row">  
        <div class="col-md-12">
        <table class="table table-striped">
	<?php foreach($directory_listing as $key=>$value):?>
    <?php //pr($directory_listing);die;?>
			  <?php $mn= $value['SocialMedia']['mediasitename'];?>
          <tr>
              <td class="bing-local hometic-style">
              <div class="socil-img">
                <img src="<?php echo $this->webroot; ?>img/social-icons/<?php echo $value['SocialMedia']['mediasitename'];?>.png" alt="<?php echo $mn?> icon">
              </div>
              <?php echo $mn; ?>
              <p><a href="javascript:void(0);" data-toggle="modal" data-target="#<?php echo str_replace(' ','',str_replace('.','', str_replace("'",'', $mn)));?>-modelDL" >Notes |</a><a style="cursor:pointer;" data-toggle="modal" data-target="#<?php echo str_replace(' ','',str_replace('.', '', $mn));?>-model" ><?php echo in_array($mn, $media) && isset($media[$mn]) && $media[$mn]?'Edit Account Url':'Add Account Url'?> </a><?php if(in_array($mn, $media) && isset($media[$mn]) && $media[$mn]){?>|<a href="<?php echo HTTP_ROOT.'dashboard/dismissSite/'.array_search($mn, $media)?>">Dismiss</a><?php }?></p></td>
                 <?php 
                    if(in_array($mn, $media) && isset($media[$mn]) && $media[$mn]){
                        if($media[$mn.'status']=='visible'){ ?>
                             <td class="found-status"><img src="<?php echo $this->webroot; ?>img/green-check.png" alt="green check icon"></td>
                     <?php   }else{ ?>
                                <td class="found-status"><img src="<?php echo $this->webroot; ?>img/warning-icon.png" alt="Warning icon"></td>
                    <?php    }
                    }else{ ?>
                          <td class="found-status"><img src="<?php echo $this->webroot; ?>img/Red_Cross.png" alt="Red Cross icon"></td>
                  <?php  }
                 ?>
             
              <td class="hometic-style">
              <?php 
                if(in_array($mn, $media) && isset($media[$mn]) && $media[$mn]){
                  if($media[$mn.'status']=='visible'){
                    echo 'You are listed on '.$mn.'.';
                  }elseif ($media[$mn.'status']=='error') {
                   echo 'We did not find your visibility on '.$mn.'. Please try again.';
                  }else{
                    echo 'You are not listed on '.$mn;
                  }
                }else{
                  echo 'You are not listed on '.$mn;
                }
              ?></td>
          </tr>
           <div class="modal fade" id="<?php echo str_replace(' ','',str_replace('.', '', $mn));?>-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="exampleModalLabel">Enter <?php echo $mn;?> Url</h4>
                        </div>
                        <div class="modal-body">
                           <form id="<?php echo str_replace(' ','',$mn);?>" method="post" action="<?php echo HTTP_ROOT?>dashboard/visibility/<?php echo str_replace(' ', '', str_replace('.','', $mn))?>/<?php echo $busid?>">
                            <?php if(in_array($mn, $media)){?>
                              <input type="hidden" name="data[Visibility][id]" value="<?php echo array_search($mn, $media)?>"/>  
                              <input type="hidden" name="data[Visibility][checker_type]" value="<?php echo $media[$mn.'checker']=='SocialSite'?'socialchecker':'visibilitychecker'?>"/>
                              <input type="hidden" name="data[Business][id]" value="<?php echo $businessUser['Business']['id']?>"/>  
                            <?php } else {?> 
                              <input type="hidden" name="data[Business][id]" value="<?php echo $businessUser['Business']['id']?>"/>  
                            <?php }?>
                            <input type="text" name="data[Visibility][prefixurl]" value="<?php echo $value['SocialMedia']['prefixurl']?>" id="prefixurltxt" readonly/>
                            <input type="text" name="data[Visibility][url]" value="<?php echo in_array($mn, $media)?@$media[$mn]:''?>" id="urltxt" required="required"/>
                            <input type="submit" value="Submit"/>
                           </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                </div>
                 <!--Starting Directory Listing Note PopUp-->
            
                 <div class="modal fade" id="<?php echo str_replace(' ','',str_replace('.','', str_replace("'",'', $mn)));?>-modelDL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="NotesModalLabel">Enter <?php echo $mn;?> Notes</h4>
                        </div>
                        <div class="modal-body">
                           <form id="<?php echo str_replace(' ','',$mn);?>" method="post" action="<?php echo HTTP_ROOT.'dashboard/saveNotes'?>">
                           
                           <input type="hidden" name="data[BusinessSocialMedia][id]" value="<?php echo $value['BusinessSocialMedia']['id']?>"/>

                            <input type="text" name="data[BusinessSocialMedia][notes]" value="<?php echo $value['BusinessSocialMedia']['notes']?>" required="required"/>
                            <input type="submit" value="Submit"/>
                           </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- Ending Note PopUp -->
		<?php endforeach;?>


        </table>
      </div>  

      </section>
</div>
        </div>



       </div> 
		<?php echo $this->element('reviews_business_user')?>
		<?php echo $this->element('history')?>
		<?php echo $this->element('share')?>       
      
       </div>

    </div>
  </div>
</div>
<script>
  $('document').ready(function(){
    $('#choose').change(function(){
       if($('#choose').val()!=''){
        $('#selectbusiness').submit();
       }
      
    });
  });
</script>
