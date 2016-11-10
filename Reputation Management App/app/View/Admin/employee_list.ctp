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
           
            <div class="bodyTaab">
            <h4>Business List</h4>
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
                    <th><?php echo $this->Paginator->sort('emp_name','Employee Name'); ?></th>
                    <th><?php echo $this->Paginator->sort('User.lastlogin','Last login');  ?></th>
                    <th><?php echo $this->Paginator->sort('User.firstname','Contact Person'); ?> </th>
                  </tr>
                </thead>
                <tbody>
                 <?php App::import('Controller', 'Admin');
                           $admin = new AdminController; ?>

                <?php if(!empty($emp_list)){ ?>
                <?php foreach ($emp_list as $key => $agency) { ?>
                <tr>
                    <td><?php echo h($key+1); ?></td>
                    <td><?php echo h($agency['BusinessEmployee']['emp_name']); ?>&nbsp;</td>
                    <td><?php echo h($agency['User']['lastlogin']); ?>&nbsp;</td>
                    <td><?php echo h($agency['User']['firstname']); ?>&nbsp;</td>

                </tr>
                <?php } } ?>
                
                </tbody>
              </table>

                 <?php if(!empty($emp_list)){ ?>
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