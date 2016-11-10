
<?php
 // pr($businessuserreview);die;
  if(!empty($customers))
  {
    ?>
      <table class="table table-bordered table-striped">
        <thead class="tbleHead">
        <tr>
          <th class="report-serial">Option</th>
          <th class="report-serial"><?php echo $this->Paginator->sort('Customer.firstname','First Name'); ?></th>
          <th class="report-serial"><?php echo $this->Paginator->sort('Customer.lastname','Last Name'); ?></th>
          <th class="report-serial"><?php echo $this->Paginator->sort('Customer.email','Email'); ?></th>
          <th class="report-serial"><?php echo $this->Paginator->sort('Customer.phonenumber','Phone'); ?></th>
          <th class="report-serial"><?php echo $this->Paginator->sort('Customer.status','Status'); ?></th>
          <!--<th class="report-serial"><?php //echo $this->Paginator->sort('Customer.employee_id','Employee'); ?></th>-->
         <th class="report-serial"><a href="javascript:void(0)">Action</a></th>

        </tr>
         </thead>
         <tbody>
      <?php 
      foreach ($customers as $key => $value) {
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
 
             <td><div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                  Action
                                  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="">Edit</a></li>
                                  
                                  <li role="presentation"><a role="menuitem" tabindex="-1" 
                                  onclick="if(!confirm('Do you want to delete this record?')){return false;}" title="Delete" href="">Delete</a></li>
                                 
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

