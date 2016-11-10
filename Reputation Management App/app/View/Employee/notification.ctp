 <?php if(isset($searchText))
         { 
        ?>
            <script type="text/javascript">
             $(window).load(function() {
            $("html, body").animate({ scrollTop: $(document).height() }, 1000);
             });
           </script>        
         <?php } ?> 
<?php
 if(isset($searchText))
 { 
   $searchText = $searchText;
 } 
 ?>
             <div class="container">
				<div class="row">
					<div class="col-sm-3">
						<h2 class="subhead">Employee Dashboard</h2>
					</div>
				<!--	<div class="col-sm-3 nopad-left">
						<input type="text" name="add-new-biz" placeholder="+ Send Notification" class="quickfield" />
						<button type="button" class="btn arrow-submit"></button>
					</div>
					<div class="col-sm-3 nopad-right">
						<input type="text" name="search-biz" placeholder=" Feedback Notification" class="quickfield" />
						<button type="button" class="btn arrow-submit"></button>
					</div>	-->
					<div class="col-sm-3">
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-08">
						<div id="content-wrapper">
							<nav id="subnavbar" class="navbar">
								<div id="navbar" class="navbar-collapse collapse">
								 <?php echo $this->element('AdminElement/employeenav')?>
								</div>
							</nav>
							<div class="wrapTab">
							 
						 
						<div class="bodyTaab">
						<h4>my Notification</h4>

					<div class="srchBlock">
					 <form class="form-inline" id="manage-search" method="post" action="<?php echo HTTP_ROOT?>Employee/notification">
				           <div class="form-group">
				                <label class="sr-only"> </label>
				                <p class="form-control-static"><strong>Search:</strong></p>
			                </div>
			                <div class="form-group">
				                <label for="inputPassword2" class="sr-only"> </label>
				                <input type="text" class="form-control fieldtext" id="searchtext" placeholder="Type First name,Last Name,Email " name="data[searchby][text]" value="<?php echo @$searchText ?>">
				    
			                </div>
				                <input type="submit" class="serasubmit btn btn-primary" value="Search"/>
			                <div style="margin-left: 59px;color:#bb0000" class="errorTxt"></div>
             		 </form>
						</div>
						<div class="bs-example" data-example-id="bordered-table ">
							<?php
 
  if(!empty($businessuserreview))
  {
    
    ?>  
            <table class="table table-bordered table-striped">
              <thead class="tbleHead">
                   <tr>
                        <th class="report-serial apticed">Option</th>
                        <th class="report-serial firsted"><?php echo $this->Paginator->sort('Customer.firstname','First Name'); ?></th>
                        <th class="report-serial lasted"><?php echo $this->Paginator->sort('Customer.lastname','Last Name'); ?></th>
                        <th class="report-serial"><?php echo $this->Paginator->sort('Customer.email','Email'); ?></th>
                        <th class="report-serial"><?php echo $this->Paginator->sort('Customer.phonenumber','Phone'); ?></th>
                        <th class="report-serial"><?php echo $this->Paginator->sort('Customer.status','Status'); ?></th>
                        <th class="report-serial">Action</th>
                        
                  </tr>
              </thead>
              <tbody>
      <?php 
      
      foreach ($businessuserreview as $key => $value) {

                  
      ?>
      <tr>
         <td><input type="checkbox" class="inputchk" value="<?php echo $value['Customer']['id'] ?>"></td>

        <td><?php echo @$value['Customer']['firstname'] ?></td>
        <td><?php echo @$value['Customer']['lastname'] ?></td>
            <td><?php echo @$value['Customer']['email'] ?></td>
            <td><?php echo @$value['Customer']['phonenumber'] ?></td>
           

                        <?php 
                           if($value['Customer']['ratingstar'] > 0)
                           { ?>
                          <td>
                           <?php 
                            for($i=1;$i<=5;$i++){ 
                             ?>    
                              <?php if($i<=$value['Customer']['ratingstar']){ ?>
                                <img src="<?php echo HTTP_ROOT?>/img/star.png">
                              <?php } else {?>
                                 <img src="<?php echo HTTP_ROOT?>img/small.png">
                              <?php }?>
                            
                        <?php } } else { ?>
                        <td><?php echo @$value['Customer']['status'] ?></td>
                        <?php
                      }
                      ?>
 
          
                              <td><div class="dropdown low-space">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                  Action
                                  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'Employee/reEmailToCustomer/'.base64_encode($value['Customer']['id']) ?>">Reply</a></li>
                                    </ul>
                              </div>
                            </td>
 </tr>
    <?php   
    }
  }
 
  else
  {
    echo "No Record Found for this...";
  }
?>
</tbody>
</table>
<p>
                           <?php
                              echo $this->Paginator->counter(array(
                              'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                              ));
                              ?> 
                        </p>
                        <div class="paging">
                           <?php
                              echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                              echo $this->Paginator->numbers(array('separator' => ''));
                              echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                              ?>
                        </div>

              </div>      
            
            
            </div>             
          
              </div>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
$(document).ready(function(){
    $('#manage-search').validate({
         rules:
            {
               "data[searchby][text]":
                {
                    required:true,
                }   
            },
         messages:
            {   
               "data[searchby][text]":
                {
                    required:"This is required field.",
                }    
            },
             messages: {},
             errorElement : 'div',
             errorLabelContainer: '.errorTxt'  
    });
    
    });
</script>
