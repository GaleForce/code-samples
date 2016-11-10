<div class="container">
   <div class="row">
 
	<div class="col-sm-10">
	 <div id="content-wrapper">

	    <div class="wrapTab" >
	    	 <section id="visibility-top">
	    	 	 <div class="row vh">
			       <h2><?php echo'Visibility Percentage '.$percentage.'%'?></h2>
			      </div>
			      <div class="row">
			      	<div class="col-md-6">
			      		<div class="contact-info">
       					 <h3>Contact Information</h3>
       					 	<div>
				  			<table>
				  			 	<tr><td>Business</td><td><?php echo $businessUser['Business']['businessname']?></td></tr>
				  			 	<tr><td>Address</td><td><?php echo $businessUser['Business']['addressline1'].' '.$businessUser['Business']['addressline1']?></td></tr>
				  			 	<tr><td>city</td><td><?php echo $businessUser['Business']['cityname']?></td></tr>
				  			 	<tr><td>State/Provience</td><td><?php echo $businessUser['Business']['statename']?></td></tr>
				  			 	<tr><td>Postal/Zip</td><td><?php echo $businessUser['Business']['zip']?></td></tr>
				  			 	<tr><td>Phone</td><td><?php echo $businessUser['Business']['phone']?></td></tr>	
				  			 	<tr><td>Website</td><td><?php echo $businessUser['Business']['companywebaddress']?></td></tr>
				  			 	<tr><td>Business Category</td><td><?php echo $businessUser['Business']['category']?></td></tr>
				  			</table>
				  		</div>
       					 </div>
			      	</div>
			      	<div class="col-md-6">
			      		  <div class="visibility-state">
					          <h3>Visibility Stats</h3>
					          <table>
					            <tr class="info">
					            <th>Found Accurate</th>
					            <th>Possible Errors</th>
					            <th>Missing</th>
					            </tr>

					            <tr>
					            <td class="first-td"><?php echo $accurate;?></td>
					            <td class="second-td"><?php echo $error;?></td>
					            <td class="third-td"><?php echo $missing;?></td>
					            </tr>
					            
					          </table>
					          </div>
			      	</div>
			      </div>
	    	 </section>
	    	 <section id="search-engine">
	    	 	 <div class="row vh">
			        <h3>Search Engines</h3>
			      </div> 
			      <div class="row vh">
			      		<table>
			      			<?php foreach($SearchEngine as $key=>$value) {?>
			      				<tr>
			      				 <?php $mn= $value['SocialMedia']['mediasitename'];?>
			      				<td class="hometic-style"> 
			      				<div class="socil-img">
				                <img src="/repmgsys/img/social-icons/<?php echo $value['SocialMedia']['mediasitename'];?>.png" alt="<?php echo $mn?> icon">
				              </div><?php echo $mn;?><!--<p><a href="">Notes |</a><a style="cursor:pointer;" data-toggle="modal" data-target="#<?php echo str_replace(' ', '', str_replace('.','', $mn))?>-model" ><?php echo in_array($mn, $media) && isset($media[$mn]) && $media[$mn]?'Edit Account Url':'Add Account Url'?> | </a><a href="">Dismiss</a></p> --></td>
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
					                    echo 'We found one or more listing on '.$mn.' that might be you.';
					                  }else{
					                    echo 'You are not listed on '.$mn;
					                  }
					                }else{
					                  echo 'You are not listed on '.$mn;
					                }
					              ?>
					             </td>
					             <div class="modal fade" id="<?php echo str_replace(' ', '', str_replace('.','', $mn))?>-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				                            <div class="modal-dialog">
				                              <div class="modal-content">
				                                <div class="modal-header">
				                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				                                  <h4 class="modal-title" id="exampleModalLabel">Enter <?php echo $mn;?> Url</h4>
				                                </div>
				                                <div class="modal-body">
				                                  <form id="<?php echo str_replace(' ', '', str_replace('.','', $mn))?>" method="post" action="<?php echo HTTP_ROOT?>dashboard/visibility/<?php echo str_replace(' ', '', str_replace('.','', $mn))?>/<?php echo $busid?>">
				                                    <?php if(in_array($mn, $media)){?>
				                                      <input type="hidden" name="data[Visibility][id]" value="<?php echo array_search($mn, $media)?>"/>  
				                                      <input type="hidden" name="data[Visibility][checker_type]" value="<?php echo $media[$mn.'checker']=='SocialSite'?'socialchecker':'visibilitychecker'?>"/>
				                                    <?php } ?> 
				                                      
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
			      			<?php }?>
					    	</table>
			      </div>
	    	 </section>
	    	  <section id="review-engine">
			      <div class="row vh">
			        <h3>Reviews Sites</h3>
			        <table>
			    		 <?php foreach($reviewsite as $key=>$value) {?>
			      				<tr>
			      				 <?php $mn= $value['SocialMedia']['mediasitename'];?>
			      				<td class="hometic-style">
			      				<div class="socil-img">
				                <img src="/repmgsys/img/social-icons/<?php echo $value['SocialMedia']['mediasitename'];?>.png" alt="<?php echo $mn?> icon">
				              </div><?php echo $mn;?><!-- <p><a href="">Notes |</a><a style="cursor:pointer;" data-toggle="modal" data-target="#<?php echo str_replace(' ','',str_replace('.','', str_replace("'",'', $mn)));?>-model" ><?php echo in_array($mn, $media) && isset($media[$mn]) && $media[$mn]?'Edit Account Url':'Add Account Url'?> | </a><a href="">Dismiss</a></p> --></td>
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
					                    echo 'We found one or more listing on '.$mn.' that might be you.';
					                  }else{
					                    echo 'You are not listed on '.$mn;
					                  }
					                }else{
					                  echo 'You are not listed on '.$mn;
					                }
					              ?>
					             </td>
					             <div class="modal fade" id="<?php echo str_replace(' ','',str_replace('.','', str_replace("'",'', $mn)));?>-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				                            <div class="modal-dialog">
				                              <div class="modal-content">
				                                <div class="modal-header">
				                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				                                  <h4 class="modal-title" id="exampleModalLabel">Enter <?php echo $mn;?> Url</h4>
				                                </div>
				                                <div class="modal-body">
				                                  <form id="<?php echo str_replace(' ','',str_replace('.','', str_replace("'",'', $mn)));?>" method="post" action="<?php echo HTTP_ROOT?>dashboard/visibility/<?php echo str_replace(' ','',str_replace('.','', str_replace("'",'', $mn)));?>/<?php echo $busid?>">
				                                    <?php if(in_array($mn, $media)){?>
				                                      <input type="hidden" name="data[Visibility][id]" value="<?php echo array_search($mn, $media)?>"/>  
				                                      <input type="hidden" name="data[Visibility][checker_type]" value="<?php echo $media[$mn.'checker']=='SocialSite'?'socialchecker':'visibilitychecker'?>"/>
				                                    <?php } ?> 
				                                      
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
			      			<?php }?>
			    		
			    	</table>
			      </div>  
		      </section>
		       <section id="social-engine">
        			<h3>Social Sites</h3>
        			<table>
				    		 <?php foreach($socialsite as $key=>$value) {?>
			      				<tr>
			      				 <?php $mn= $value['SocialMedia']['mediasitename'];?>
			      				<td class="hometic-style">
			      				<div class="socil-img">
				                <img src="/repmgsys/img/social-icons/<?php echo $value['SocialMedia']['mediasitename'];?>.png" alt="<?php echo $mn?> icon">
				              </div><?php echo $mn;?><!--<p><a href="">Notes |</a><a style="cursor:pointer;" data-toggle="modal" data-target="#<?php echo str_replace(' ', '', str_replace('.','', $mn))?>-model" ><?php echo in_array($mn, $media) && isset($media[$mn]) && $media[$mn]?'Edit Account Url':'Add Account Url'?> | </a><a href="">Dismiss</a></p>--></td>
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
					                    echo 'We found one or more listing on '.$mn.' that might be you.';
					                  }else{
					                    echo 'You are not listed on '.$mn;
					                  }
					                }else{
					                  echo 'You are not listed on '.$mn;
					                }
					              ?>
					             </td>
					             <div class="modal fade" id="<?php echo str_replace(' ', '', str_replace('.','', $mn))?>-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				                            <div class="modal-dialog">
				                              <div class="modal-content">
				                                <div class="modal-header">
				                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				                                  <h4 class="modal-title" id="exampleModalLabel">Enter <?php echo $mn;?> Url</h4>
				                                </div>
				                                <div class="modal-body">
				                                  <form id="<?php echo str_replace(' ', '', str_replace('.','', $mn))?>" method="post" action="<?php echo HTTP_ROOT?>dashboard/visibility/<?php echo str_replace(' ', '', str_replace('.','', $mn))?>/<?php echo $busid?>">
				                                    <?php if(in_array($mn, $media)){?>
				                                      <input type="hidden" name="data[Visibility][id]" value="<?php echo array_search($mn, $media)?>"/>  
				                                      <input type="hidden" name="data[Visibility][checker_type]" value="<?php echo $media[$mn.'checker']=='SocialSite'?'socialchecker':'visibilitychecker'?>"/>
				                                    <?php } ?> 
				                                      
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
			      			<?php }?>
				    	</table>
        		</section>
        		  <section id="social-engine">
       					<h3>Directory Listings</h3>
       					<table>
	    		 		<?php foreach($directory_listing as $key=>$value) {?>
			      				<tr>
			      				 <?php $mn= $value['SocialMedia']['mediasitename'];?>
			      				<td class="hometic-style">
			      				<div class="socil-img">
				                <img src="/repmgsys/img/social-icons/<?php echo $value['SocialMedia']['mediasitename'];?>.png" alt="<?php echo $mn?> icon">
				              </div><?php echo $mn;?><!--<p><a href="">Notes |</a><a style="cursor:pointer;" data-toggle="modal" data-target="#<?php echo str_replace(' ', '', str_replace('.','', $mn))?>-model" ><?php echo in_array($mn, $media) && isset($media[$mn]) && $media[$mn]?'Edit Account Url':'Add Account Url'?> | </a><a href="">Dismiss</a></p> --></td>
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
					                    echo 'We found one or more listing on '.$mn.' that might be you.';
					                  }else{
					                    echo 'You are not listed on '.$mn;
					                  }
					                }else{
					                  echo 'You are not listed on '.$mn;
					                }
					              ?>
					             </td>
					             <div class="modal fade" id="<?php echo str_replace(' ', '', str_replace('.','', $mn))?>-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				                            <div class="modal-dialog">
				                              <div class="modal-content">
				                                <div class="modal-header">
				                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				                                  <h4 class="modal-title" id="exampleModalLabel">Enter <?php echo $mn;?> Url</h4>
				                                </div>
				                                <div class="modal-body">
				                                  <form id="<?php echo str_replace(' ', '', str_replace('.','', $mn))?>" method="post" action="<?php echo HTTP_ROOT?>dashboard/visibility/<?php echo str_replace(' ', '', str_replace('.','', $mn))?>/<?php echo $busid?>">
				                                    <?php if(in_array($mn, $media)){?>
				                                      <input type="hidden" name="data[Visibility][id]" value="<?php echo array_search($mn, $media)?>"/>  
				                                      <input type="hidden" name="data[Visibility][checker_type]" value="<?php echo $media[$mn.'checker']=='SocialSite'?'socialchecker':'visibilitychecker'?>"/>
				                                    <?php } ?> 
				                                      
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
			      			<?php }?>
	    				</table>

       			   </section>

	
	</div>
	
</div>
</div>
	
</div>
</div>	

