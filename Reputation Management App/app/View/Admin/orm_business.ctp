<script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "www.facebook.com";
    };
</script>

<div class="container">
	<div class="row">
		<div class="col-sm-3">
         <h2 class="subhead">Super Admin Dashboard</h2>
      </div>

	 <div class="col-sm-3 nopad-left">
        <form id="addnewbus" method="post" action="<?php echo HTTP_ROOT;?>businesses/add/addnew">
           <input type="text" name="data[Business][name]" placeholder="+ Add New Employee" class="quickfield" />
           <input type="submit" class="btn arrow-submit" value="">
        </form>   
      </div>

      <div class="col-sm-3 nopad-right">
         <input type="text" name="search-biz" placeholder="Search Employee" class="quickfield" />
         <input type="submit" class="btn arrow-submit" value="">
      </div>

      <div class="col-sm-3">
      </div>

	</div>

	<div class="row">
      <div class="col-sm-10">
         <div id="content-wrapper">
         	<?php echo $this->element('nav_admin')?>
           <div class="wrapTab">
           
            <a href="<?php echo HTTP_ROOT?>admin/add" class="btn adNew">Add New Business</a>
            
            <div class="bodyTaab">
            <h4>ORM BUSINESSES</h4>
             <div class="srchBlock">
            
              <form accept-charset="utf-8" method="post" id="searchFormIndexForm" action="<?php echo HTTP_ROOT?>dashboard/searchBusiness">
                <div class="form-group">
                <label class="sr-only"> </label>
                <p style="float:left;" class="form-control-static"><strong>Search:</strong></p>
                </div>
                <div class="form-group">
                <label for="inputPassword2" class="sr-only"> </label>
                <input style="float:left;width:210px;" type="text" class="form-control fieldtext" id="inputPassword2" placeholder="Type template name " name="data[searchForm][search]">
    
                </div>
                <input type="submit" class="btn btn-success" value="Search"/>
                <div style="margin-left: 59px;color:#bb0000" class="errorTxt"></div>
              </form>
            </div>
            <div class="bs-example" data-example-id="bordered-table ">
              <table class="table table-bordered table-striped">
              <thead class="tbleHead">
                  <tr>
                    <th class="report-serial">Sr. N.</th>
                    <th><?php echo $this->Paginator->sort('businessname','Business Name'); ?></th>
                    <th><?php echo $this->Paginator->sort('BusinessCategory.name','Category'); ?></th>
                    <th><?php echo $this->Paginator->sort('User.firstname','Contact Person'); ?></th>
                    <th class="dash-serial">Status</th>
                    <th class="dash-action"><?php echo 'Action'; ?></th>
                  </tr>
                </thead>
                <tbody>
                 <?php App::import('Controller', 'Admin');
                           $admin = new AdminController; ?>

                <?php if(!empty($bus_data)){ ?>
                <?php foreach ($bus_data as $key => $bus) {?>
                <tr>
                    <td><?php echo h($key+1); ?></td>
                    <td><?php echo h($bus['Business']['businessname']); ?>&nbsp;</td>
                    <td><?php echo h($bus['BusinessCategory']['name']); ?>&nbsp;</td>
                    <td><?php echo h($bus['User']['firstname']); ?>&nbsp;</td>
                    <?php if($bus['User']['AgencysiteSetting'] == 0) {?>
                    <td><?php echo 'Active'; ?>&nbsp;</td>
                    <?php }else{ ?>
                    <td><?php echo 'Inactive'; ?>&nbsp;</td>
                    <?php }?>
                    <td><div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        Action
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/editAgency/'.base64_encode($bus['User']['AgencysiteSetting']['id'])?>">Edit</a></li>
                      
                        <li role="presentation"><a role="menuitem" tabindex="-1" 
                        onclick="if(!confirm('Do you want to delete this record?')){return false;}" title="Delete" href="<?php echo HTTP_ROOT.'admin/delete/AgencysiteSetting/'.base64_encode($bus['User']['AgencysiteSetting']['id'])?>">Delete</a></li>
                       
                        <?php $target = array('0'=>'1','1'=>'0','2'=>'0'); ?>
                         <li role="status"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'admin/updatestatus/'.base64_encode($bus['User']['AgencysiteSetting']['id']).'/'.$target[$bus['User']['AgencysiteSetting']['user_type']]?>">Status</a></li>

                         <li role="status"><a role="menuitem" tabindex="-1" href="<?php echo HTTP_ROOT.'businesses/updatestatus/'.base64_encode($bus['User']['AgencysiteSetting']['id'])?>">Business</a></li>
                       
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php } }?>
                </tbody>
              </table>

                 <?php if(!empty($bus_data)){ ?>
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
            </div>
         </div>
      </div>
    </div>     
</div>