<script type="text/javascript">
$(document).ready(function(){
    $('#searchFormIndexForm').validate({
         rules:
            {
               "data[searchForm][search]":
                {
                    required:true,
                }   
            },
         messages:
            {   
               "data[searchForm][search]":
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

<div class="container">
        <div class="row">
          <div class="col-sm-3">
            <h2 class="subhead">Super Admin Dashboard</h2>
          </div>
         <!-- <div class="col-sm-3 nopad-left">
            <input type="text" name="add-new-biz" placeholder="+ Add New Agency" class="quickfield" />
            <button type="button" class="btn arrow-submit"></button>
          </div>
          <div class="col-sm-3 nopad-right">
            <input type="text" name="search-biz" placeholder="Search Agency" class="quickfield" />
            <button type="button" class="btn arrow-submit"></button>
          </div> -->
          <div class="col-sm-3">
          
          </div>
        </div>
        
        <div class="row">
          <div class="col-sm-08">
            <div id="content-wrapper">
             <?php echo $this->element('nav_admin')?>
            <div class="wrapTab">
           
            <a href="<?php echo HTTP_ROOT?>admin/add" class="btn adNew">Add New Agency</a>
             
            <div class="bodyTaab">
            <h4>Orm agencies</h4>

           <div class="srchBlock">
              <form class="form-inline" id="manage-search" method="post" action="<?php echo HTTP_ROOT?>admin/agency">
                <div class="form-group">
                
                <label class="sr-only"> </label>
                <p style="float:left;" class="form-control-static"><strong>Search:</strong></p>
                </div>
                <div class="form-group">
                <label for="inputPassword2" class="sr-only"> </label>
                <input style="float:left;width:210px;" type="text" class="form-control fieldtext" id="inputPassword2" placeholder="Type Agency Name " name="data[searchForm][search]">
    
                </div>
                <input type="submit" class="btn" value="Search"/>
                <div style="margin-left: 59px;color:#bb0000" class="errorTxt"></div>
              </form>
            </div>
            <div class="bs-example" data-example-id="bordered-table ">
              <table class="table table-bordered table-striped">
               <thead class="tbleHead">
                  <tr>
                  
                    <th><?php echo $this->Paginator->sort('User.firstname','Agency Name'); ?></th>
                    <th><?php echo $this->Paginator->sort('User.lastlogin','Last login');  ?></th>
                    <th><?php echo $this->Paginator->sort('User.email','Contact'); ?> </th>
                    <th class="dash-serial"><?php echo $this->Paginator->sort('User.status','Status');  ?></th>
                    <th class="dash-action"><?php echo 'Action'; ?></th>
                  </tr>
                </thead>
                  <tbody>
              

                <?php if(!empty($agency_data)){ ?>
                <?php foreach ($agency_data as $key => $value) { ?>
                <tr>
                    <td style="text-align:left;"><?php echo h($value['User']['firstname']); ?>&nbsp;</td>
                     <?php 
                        if($value['User']['lastlogin']){
                            $date=strtotime($value['User']['lastlogin']);
                            $dat=date('Y-m-d',$date);
                        }else{
                             $dat='---' ;
                        }
                       
                     ?>
                    <td><?php echo $dat; ?>&nbsp;</td>
                    <td><?php echo h($value['User']['email']); ?>&nbsp;</td>
                      <?php if($value['User']['status'] == 1) {?>
                    <td><?php echo 'Active'; ?>&nbsp;</td>
                    <?php }else{ ?>
                    <td><?php echo 'Inactive'; ?>&nbsp;</td>
                    <?php }?>
                    
                    <td><div class="dropdown drop_act">
                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        Action
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/editAgency/'.base64_encode($value['User']['id'])?>">Edit</a></li>
                      
                        <li role="presentation"><a role="menuitem" tabindex="-1" 
                        onclick="if(!confirm('Do you want to delete this record?')){return false;}" title="Delete" href="<?php echo HTTP_ROOT.'admin/delete/'.base64_encode($value['User']['id'])?>">Delete</a></li>
                       
                          <?php $target = array(0=>1,1=>0); ?>
                         <li role="status"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/updatestatus/'.base64_encode($value['User']['id']).'/'.$target[$value['User']['status']]?>">Status</a></li>

                         <li role="status"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/agencyBusiness/'.base64_encode($value['User']['id'])?>">Business</a></li>
                       
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php } }?>
                </tbody>
              </table>
                 <?php if(!empty($agency_data)){ ?>
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
                <?php }?> 
              </div>
 <script type="text/javascript">
$(document).ready(function(){
    $('#manage-search').validate({
         rules:
            {
               "data[searchForm][search]":
                {
                    required:true,
                }   
            },
         messages:
            {   
               "data[searchForm][search]":
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
