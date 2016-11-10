<?php

  if(!empty($businessuserreview))
  {
    ?>
    	<table>
    		<tr>
    			<th>Option</th>
    			<th>First Name</th>
    			<th>Last Name</th>
    			<th>Email</th>
    			<th>Phone</th> 
    			<th>Status</th>
    			<th>Employee</th>
    			<th>Action</th>

    		</tr>
    	<?php foreach ($businessuserreview as $key => $value) {
       
    	?>
    	<tr>
    		<td><input type="checkbox"></td>
    		<td><?php echo $value['Customer']['firstname'] ?></td>
    		<td><?php echo $value['Customer']['lastname'] ?></td>
            <td><?php echo $value['Customer']['email'] ?></td>
            <td><?php echo $value['Customer']['phonenumber'] ?></td>
<?php if($value['BusinessReview']['ratingstar'] == 5) { ?> <td><img src="<?php echo HTTP_ROOT?>app/webroot/img/5stars.png"></td>
<?php } ?>
<?php if($value['BusinessReview']['ratingstar'] == 4) { ?> <td><img src="<?php echo HTTP_ROOT?>app/webroot/img/4stars.png"></td>
<?php } ?>
<?php if($value['BusinessReview']['ratingstar'] == 3) { ?> <td><img src="<?php echo HTTP_ROOT?>app/webroot/img/3stars.png"></td>
<?php } ?>
<?php if($value['BusinessReview']['ratingstar'] == 2) { ?> <td><img src="<?php echo HTTP_ROOT?>app/webroot/img/2stars.png"></td>
<?php } ?>
<?php if($value['BusinessReview']['ratingstar'] == 1) { ?> <td><img src="<?php echo HTTP_ROOT?>app/webroot/img/1stars.png"></td>
<?php } ?>
<?php if($value['BusinessReview']['ratingstar'] == 0) { ?> <td>Not feedback Yet</td>
<?php } ?>
 
           <td>Employee</td>

          <td><div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                  Action
                                  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'dashboard/editCustomer/'.base64_encode($value['Customer']['id'])?>">Edit</a></li>
                                  
                                  <li role="presentation"><a role="menuitem" tabindex="-1" 
                                  onclick="if(!confirm('Do you want to delete this record?')){return false;}" title="Delete" href="<?php echo HTTP_ROOT.'dashboard/deleteCustomer/'.base64_encode($value['Customer']['id'])?>">Delete</a></li>
                                 
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