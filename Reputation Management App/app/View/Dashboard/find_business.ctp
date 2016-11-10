
<div class="container">
        <div class="row">
          <div class="col-sm-3">
            <h2 class="subhead">Agency Dashboard</h2>
          </div>
          <div class="col-sm-3">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-10">
            <div id="content-wrapper">
              <?php echo $this->element('nav')?>
              <div class="wrapTab">
            <div class="bodyTaab">
           <div  class="col-sm-10" style="background-color:darkcyan;height:50px;width:100%;"><b><font-size="30px;color:white;text-align:center;">Visibility Percentage 13.09%</font></div>
          <div class="contact_info"></div>
           <div class="col-sm-10">
              <label class="contact">Contact Information</label>
          </div></br>
          <div class="label">
            <label>Business Name:</label>
          
        <div class="bussiness_name">
            <?php echo @$user_data['Business']['businessname']; ?>
         </div>
       </div> 

         <div class="label">
            <label>Address:Street1</label>
          </div> 
        <div class="Address">   
            <?php echo @$user_data['Business']['addressline1']; ?>
        </div>
  
        <div class="label">
            <label>Street2</label>
          </div> 
        <div class="Address2">
            <?php echo @$user_data['Business']['addressline2']; ?>
        </div>
  
        <div class="label">
            <label>City</label>
          </div> 
        <div class="Address2">
            <?php echo @$user_data['City']['city_name']; ?>
        </div>
  
        <div class="label">
            <label>State/province</label>
          </div> 
        <div class="state">
            <?php echo @$user_data['State']['stateName']; ?>
        </div> 

        <div class="label">
            <label>Postal</label>
          </div> 
        <div class="postal">
            <?php echo @$user_data['Business']['zip']; ?>
        </div>

         <div class="label">
            <label>Phone</label>
          </div> 
        <div class="phone">
            <?php echo @$user_data['Business']['phone']; ?>
        </div>

        <div class="label">
            <label>Website</label>
          </div> 
        <div class="website">
            <?php echo @$user_data['Business']['companywebaddress']; ?>
        </div>

        <div class="label">
            <label>Business category</label>
          </div> 
        <div class="Business_category">
            <?php echo @$user_data['BusinessCategory']['name']; ?>
        </div>
             </div>             
            </div>
            </div>
          </div>
          <?php echo $this->element('reviewsidebar')?>
        </div>
      </div>
   <style type="text/css">
  .label
    {
      color:black;  
    }
    .wrapper_info 
    {

    }
    .contact  
  {
  font-size: 20px;
  } 
</style>