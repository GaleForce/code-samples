<?php echo $this->element('nav')?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<div class="page-content">
        <div class="row">
          <div class="col-sm-3">
            <h2 class="subhead">Agency Dashboard</h2>
          </div>
          <div class="col-sm-3 nopad-left">
            <input type="text" name="add-new-biz" placeholder="+ Add New Business" class="quickfield" />
            <button type="button" class="btn arrow-submit"></button>
          </div>
          <div class="col-sm-3 nopad-right">
            <input type="text" name="search-biz" placeholder="Search Clients" class="quickfield" />
            <button type="button" class="btn arrow-submit"></button>
          </div>
          <div class="col-sm-3">
          
          </div>
        </div>
        
        <div class="row">
          <div class="col-sm-10">
            <div id="content-wrapper">
           
              <div class="wrapTab">
           
           
             
            <div class="bodyTaab">
      
            <?php if(count($trainings)>0):?>
                <?php foreach ($trainings as $_training):?>
    
    <div class="row training-row">

      <h2 class="training-title"><?php echo $_training['Training']['title'];?></h2>
                  <?php if(!empty($_training['Training']['url'])):?>
                  
                  <iframe style="width:250px; height:250px; float:left " src="//<?php echo $_training['Training']['url'];?>" frameborder="0"rel=0  allowfullscreen></iframe>
          
                    <?php else:?>
                           <?php if(!empty($_training['Training']['url']));?>
                     <?php endif;?>

    </div>
                    <?php endforeach;?>
                <?php else:?>
                    There are no Video available right now.
                <?php endif;?>
            </div> 
              </div>
            </div>
          </div>
         
            <?php echo $this->element('reviewsidebar')?>
      
        </div>
      </div>
</div>
