

 <form id="formSetup" method="POST" enctype="multipart/form-data" action="<?php echo HTTP_ROOT?>businesses/setup">
 	
 <input type="hidden" name="data[Business][id]" value="<?php echo $bus_data['Business']['id']?>">	
 <input type="hidden" name="data[Business][user_Id]" value="<?php echo $bus_data['Business']['user_Id']?>">
 <input type="hidden" name="data[Business][business_logo1]" value="<?php echo $bus_data['Business']['business_logo']?>">
 	<div class="form-group">
 		<label class="control-label col-sm-4">Profile picture or logo</label>
 		 <input type="file" name="data[Business][business_logo]" />
 	</div>

 	<div class="form-group">
 		 <label class="control-label col-sm-4">Current image</label>
 		<?php if(!empty($bus_data['Business']['business_logo'])){?>
 		 <img style="width:250px;height:70px" src="<?php echo HTTP_ROOT ?>img/<?php echo $bus_data['Business']['business_logo']?>"/>		
		<?php }else{ ?>
 			</br>
		<?php	} ?> 		
 	</div>
	
   <div class="form-group">
      <label class="control-label col-sm-4">Email</label>
      <div class="col-sm-8">
        <input type="text" readonly="readonly" class="form-control form-back" value="<?php echo $bus_data['User']['email']?>">
      </div>
    </div>

     <div class="form-group">
       <label class="control-label col-sm-4" for="email">Main Business Category:</label>
         <div class="col-sm-8">
            <select class="form-selected" required="required" id="BusinessBusinessCategoryId" name="data[Business][business_category_id]">
                            <option value=""><?php echo "Select Bussiness Category"?></option>
                                <?php foreach($businessCategories as $key=>$val){?>
                                    <option value="<?php echo $key?>" <?php if($key == $bus_data['Business']['business_category_id']) {?>selected="selected" <?php } ?> ><?php echo $val?></option>
                                <?php } ?>
             </select></br>
         </div>
     </div>


	<div class="form-group">
	  <label class="control-label col-sm-4">Business Description</label>
	  <div class="col-sm-8">
	    <input type="textarea" value="<?php echo $bus_data['Business']['business_description']?>" name="data[Business][business_description]" >
	  </div>
    </div>

    <div class="form-group">
	  <label class="control-label col-sm-4">Business Hours</label>
	  <div class="col-sm-8">
		 	  <?php  $debus = json_decode($bus_data['Business']['business_hours']);
		 	  	 for ($i=0; $i <count($debus) ; $i++) { 
                    $str[] = explode('=>',$debus[$i]);
                 }
                 
               // pr($str);die;
             /*   if($str[0][1] == "6:30am"){
                	echo $str[0][1];die;
                }else{
                	echo "Try again";die;
                }*/
		 	  ?>
		    <p id="datepairExample" class="time_hour">
		     <label class="control-label col-sm-4">Monday</label>
	  				<select id="toselect" name="to[]">
                	<option value='12:00am'<?php if(@$str[0][0]=='12:00am ') {?>selected="selected" <?php } ?> >12:00am</option>
					<option value='12:30am'<?php if('12:30am ' == @$str[0][0]) {?>selected="selected" <?php } ?>>12:30am</option>
					<option value='1:00am'<?php if('1:00am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >1:00am</option>
					<option value='1:30am'<?php if('1:30am ' == @$str[0][0]) {?>selected="selected" <?php } ?>>1:30am</option>
					<option value='2:00am'<?php if('2:00am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >2:00am</option>
					<option value='2:30am'<?php if('2:30am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >2:30am</option>
					<option value='3:00am'<?php if('3:00am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >3:00am</option>
					<option value='3:30am'<?php if('3:30am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >3:30am</option>
					<option value='4:00am'<?php if('4:00am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >4:00am</option>
					<option value='4:30am'<?php if('4:30am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >4:30am</option>
					<option value='5:00am'<?php if('5:00am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >5:00am</option>
					<option value='5:30am'<?php if('5:30am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >5:30am</option>
					<option value='6:00am'<?php if('6:00am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >6:00am</option>
					<option value='6:30am'<?php if('6:30am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >6:30am</option>
					<option value='7:00am'<?php if('7:00am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >7:00am</option>
					<option value='7:30am'<?php if('7:30am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >7:30am</option>
					<option value='8:00am'<?php if('8:00am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >8:00am</option>
					<option value='8:30am'<?php if('8:30am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >8:30am</option>
					<option value='9:00am'<?php if('9:00am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >9:00am</option>
					<option value='9:30am'<?php if('9:30am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >9:30am</option>
					<option value='10:00am'<?php if('10:00am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >10:00am</option>
					<option value='10:30am'<?php if('10:30am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >10:30am</option>
					<option value='11:00am'<?php if('11:00am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >11:00am</option>
					<option value='11:30am'<?php if('11:30am ' == @$str[0][0]) {?>selected="selected" <?php } ?> >11:30am</option>
					<option value='12:00pm'<?php if('12:00pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >12:00pm</option>
					<option value='12:30pm'<?php if('12:30pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >12:30pm</option>
					<option value='1:00pm'<?php if('1:00pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >1:00pm</option>
					<option value='1:30pm'<?php if('1:30pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >1:30pm</option>
					<option value='2:00pm'<?php if('2:00pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >2:00pm</option>
					<option value='2:30pm'<?php if('2:30pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >2:30pm</option>
					<option value='3:00pm'<?php if('3:00pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >3:00pm</option>
					<option value='3:30pm'<?php if('3:30pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >3:30pm</option>
					<option value='4:00pm'<?php if('4:00pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >4:00pm</option>
					<option value='4:30pm'<?php if('4:30pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >4:30pm</option>
					<option value='5:00pm'<?php if('5:00pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >5:00pm</option>
					<option value='5:30pm'<?php if('5:30pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >5:30pm</option>
					<option value='6:00pm'<?php if('6:00pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >6:00pm</option>
					<option value='6:30pm'<?php if('6:30pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >6:30pm</option>
					<option value='7:00pm'<?php if('7:00pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >7:00pm</option>
					<option value='7:30pm'<?php if('7:30pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >7:30pm</option>
					<option value='8:00pm'<?php if('8:00pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >8:00pm</option>
					<option value='8:30pm'<?php if('8:30pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >8:30pm</option>
					<option value='9:00pm'<?php if('9:00pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >9:00pm</option>
					<option value='9:30pm'<?php if('9:30pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >9:30pm</option>
					<option value='10:00pm'<?php if('10:00pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >10:00pm</option>
					<option value='10:30pm'<?php if('10:30pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >10:30pm</option>
					<option value='11:00pm'<?php if('11:00pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >11:00pm</option>
					<option value='11:30pm'<?php if('11:30pm ' == @$str[0][0]) {?>selected="selected" <?php } ?> >11:30pm</option>
					<option value='closed'<?php if($str[0][0] == 'closed ') {?>selected="selected" <?php } ?> >Closed</option>
              </select>
	  		 to
			   <select id="fromselect" name="from[]">
               
                	<option value='12:00am'<?php if(@$str[0][1]==' 12:00am') {?>selected="selected" <?php } ?> >12:00am</option>
					<option value='12:30am'<?php if(' 12:30am' == @$str[0][1]) {?>selected="selected" <?php } ?>>12:30am</option>
					<option value='1:00am'<?php if(' 1:00am' == @$str[0][1]) {?>selected="selected" <?php } ?> >1:00am</option>
					<option value='1:30am'<?php if(' 1:30am' == @$str[0][1]) {?>selected="selected" <?php } ?>>1:30am</option>
					<option value='2:00am'<?php if(' 2:00am' == @$str[0][1]) {?>selected="selected" <?php } ?> >2:00am</option>
					<option value='2:30am'<?php if(' 2:30am' == @$str[0][1]) {?>selected="selected" <?php } ?> >2:30am</option>
					<option value='3:00am'<?php if(' 3:00am' == @$str[0][1]) {?>selected="selected" <?php } ?> >3:00am</option>
					<option value='3:30am'<?php if(' 3:30am' == @$str[0][1]) {?>selected="selected" <?php } ?> >3:30am</option>
					<option value='4:00am'<?php if(' 4:00am' == @$str[0][1]) {?>selected="selected" <?php } ?> >4:00am</option>
					<option value='4:30am'<?php if(' 4:30am' == @$str[0][1]) {?>selected="selected" <?php } ?> >4:30am</option>
					<option value='5:00am'<?php if(' 5:00am' == @$str[0][1]) {?>selected="selected" <?php } ?> >5:00am</option>
					<option value='5:30am'<?php if(' 5:30am' == @$str[0][1]) {?>selected="selected" <?php } ?> >5:30am</option>
					<option value='6:00am'<?php if(' 6:00am' == @$str[0][1]) {?>selected="selected" <?php } ?> >6:00am</option>
					<option value='6:30am'<?php if(' 6:30am' == @$str[0][1]) {?>selected="selected" <?php } ?> >6:30am</option>
					<option value='7:00am'<?php if(' 7:00am' == @$str[0][1]) {?>selected="selected" <?php } ?> >7:00am</option>
					<option value='7:30am'<?php if(' 7:30am' == @$str[0][1]) {?>selected="selected" <?php } ?> >7:30am</option>
					<option value='8:00am'<?php if(' 8:00am' == @$str[0][1]) {?>selected="selected" <?php } ?> >8:00am</option>
					<option value='8:30am'<?php if(' 8:30am' == @$str[0][1]) {?>selected="selected" <?php } ?> >8:30am</option>
					<option value='9:00am'<?php if(' 9:00am' == @$str[0][1]) {?>selected="selected" <?php } ?> >9:00am</option>
					<option value='9:30am'<?php if(' 9:30am' == @$str[0][1]) {?>selected="selected" <?php } ?> >9:30am</option>
					<option value='10:00am'<?php if(' 10:00am' == @$str[0][1]) {?>selected="selected" <?php } ?> >10:00am</option>
					<option value='10:30am'<?php if(' 10:30am' == @$str[0][1]) {?>selected="selected" <?php } ?> >10:30am</option>
					<option value='11:00am'<?php if(' 11:00am' == @$str[0][1]) {?>selected="selected" <?php } ?> >11:00am</option>
					<option value='11:30am'<?php if(' 11:30am' == @$str[0][1]) {?>selected="selected" <?php } ?> >11:30am</option>
					<option value='12:00pm'<?php if(' 12:00pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >12:00pm</option>
					<option value='12:30pm'<?php if(' 12:30pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >12:30pm</option>
					<option value='1:00pm'<?php if(' 1:00pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >1:00pm</option>
					<option value='1:30pm'<?php if(' 1:30pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >1:30pm</option>
					<option value='2:00pm'<?php if(' 2:00pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >2:00pm</option>
					<option value='2:30pm'<?php if(' 2:30pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >2:30pm</option>
					<option value='3:00pm'<?php if(' 3:00pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >3:00pm</option>
					<option value='3:30pm'<?php if(' 3:30pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >3:30pm</option>
					<option value='4:00pm'<?php if(' 4:00pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >4:00pm</option>
					<option value='4:30pm'<?php if(' 4:30pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >4:30pm</option>
					<option value='5:00pm'<?php if(' 5:00pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >5:00pm</option>
					<option value='5:30pm'<?php if(' 5:30pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >5:30pm</option>
					<option value='6:00pm'<?php if(' 6:00pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >6:00pm</option>
					<option value='6:30pm'<?php if(' 6:30pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >6:30pm</option>
					<option value='7:00pm'<?php if(' 7:00pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >7:00pm</option>
					<option value='7:30pm'<?php if(' 7:30pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >7:30pm</option>
					<option value='8:00pm'<?php if(' 8:00pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >8:00pm</option>
					<option value='8:30pm'<?php if(' 8:30pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >8:30pm</option>
					<option value='9:00pm'<?php if(' 9:00pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >9:00pm</option>
					<option value='9:30pm'<?php if(' 9:30pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >9:30pm</option>
					<option value='10:00pm'<?php if(' 10:00pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >10:00pm</option>
					<option value='10:30pm'<?php if(' 10:30pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >10:30pm</option>
					<option value='11:00pm'<?php if(' 11:00pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >11:00pm</option>
					<option value='11:30pm'<?php if(' 11:30pm' == @$str[0][1]) {?>selected="selected" <?php } ?> >11:30pm</option>
					<option value='closed'<?php if(@$str[0][1] == ' closed') {?>selected="selected" <?php } ?> >Closed</option>
              </select>
			    <a style="cursor:pointer;" id="apply">Apply to All</a>
   			</p>

   			 <p class="time_hour">
		     <label class="control-label col-sm-4">Tuesday</label>
	  				<select class="start" name="to[]">
                    	<option value='12:00am'<?php if(@$str[0][0]=='12:00am ') {?>selected="selected" <?php } ?> >12:00am</option>
					<option value='12:30am'<?php if('12:30am ' == @$str[1][0]) {?>selected="selected" <?php } ?>>12:30am</option>
					<option value='1:00am'<?php if('1:00am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >1:00am</option>
					<option value='1:30am'<?php if('1:30am ' == @$str[1][0]) {?>selected="selected" <?php } ?>>1:30am</option>
					<option value='2:00am'<?php if('2:00am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >2:00am</option>
					<option value='2:30am'<?php if('2:30am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >2:30am</option>
					<option value='3:00am'<?php if('3:00am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >3:00am</option>
					<option value='3:30am'<?php if('3:30am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >3:30am</option>
					<option value='4:00am'<?php if('4:00am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >4:00am</option>
					<option value='4:30am'<?php if('4:30am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >4:30am</option>
					<option value='5:00am'<?php if('5:00am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >5:00am</option>
					<option value='5:30am'<?php if('5:30am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >5:30am</option>
					<option value='6:00am'<?php if('6:00am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >6:00am</option>
					<option value='6:30am'<?php if('6:30am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >6:30am</option>
					<option value='7:00am'<?php if('7:00am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >7:00am</option>
					<option value='7:30am'<?php if('7:30am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >7:30am</option>
					<option value='8:00am'<?php if('8:00am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >8:00am</option>
					<option value='8:30am'<?php if('8:30am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >8:30am</option>
					<option value='9:00am'<?php if('9:00am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >9:00am</option>
					<option value='9:30am'<?php if('9:30am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >9:30am</option>
					<option value='10:00am'<?php if('10:00am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >10:00am</option>
					<option value='10:30am'<?php if('10:30am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >10:30am</option>
					<option value='11:00am'<?php if('11:00am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >11:00am</option>
					<option value='11:30am'<?php if('11:30am ' == @$str[1][0]) {?>selected="selected" <?php } ?> >11:30am</option>
					<option value='12:00pm'<?php if('12:00pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >12:00pm</option>
					<option value='12:30pm'<?php if('12:30pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >12:30pm</option>
					<option value='1:00pm'<?php if('1:00pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >1:00pm</option>
					<option value='1:30pm'<?php if('1:30pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >1:30pm</option>
					<option value='2:00pm'<?php if('2:00pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >2:00pm</option>
					<option value='2:30pm'<?php if('2:30pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >2:30pm</option>
					<option value='3:00pm'<?php if('3:00pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >3:00pm</option>
					<option value='3:30pm'<?php if('3:30pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >3:30pm</option>
					<option value='4:00pm'<?php if('4:00pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >4:00pm</option>
					<option value='4:30pm'<?php if('4:30pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >4:30pm</option>
					<option value='5:00pm'<?php if('5:00pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >5:00pm</option>
					<option value='5:30pm'<?php if('5:30pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >5:30pm</option>
					<option value='6:00pm'<?php if('6:00pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >6:00pm</option>
					<option value='6:30pm'<?php if('6:30pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >6:30pm</option>
					<option value='7:00pm'<?php if('7:00pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >7:00pm</option>
					<option value='7:30pm'<?php if('7:30pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >7:30pm</option>
					<option value='8:00pm'<?php if('8:00pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >8:00pm</option>
					<option value='8:30pm'<?php if('8:30pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >8:30pm</option>
					<option value='9:00pm'<?php if('9:00pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >9:00pm</option>
					<option value='9:30pm'<?php if('9:30pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >9:30pm</option>
					<option value='10:00pm'<?php if('10:00pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >10:00pm</option>
					<option value='10:30pm'<?php if('10:30pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >10:30pm</option>
					<option value='11:00pm'<?php if('11:00pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >11:00pm</option>
					<option value='11:30pm'<?php if('11:30pm ' == @$str[1][0]) {?>selected="selected" <?php } ?> >11:30pm</option>
					<option value='closed'<?php if(@$str[1][0] == 'closed ') {?>selected="selected" <?php } ?> >Closed</option>
              </select>
	  		 to
			   <select class="end" name="from[]">
               
                	<option value='12:00am'<?php if(@$str[1][1]==' 12:00am') {?>selected="selected" <?php } ?> >12:00am</option>
					<option value='12:30am'<?php if(' 12:30am' == @$str[1][1]) {?>selected="selected" <?php } ?>>12:30am</option>
					<option value='1:00am'<?php if(' 1:00am' == @$str[1][1]) {?>selected="selected" <?php } ?> >1:00am</option>
					<option value='1:30am'<?php if(' 1:30am' == @$str[1][1]) {?>selected="selected" <?php } ?>>1:30am</option>
					<option value='2:00am'<?php if(' 2:00am' == @$str[1][1]) {?>selected="selected" <?php } ?> >2:00am</option>
					<option value='2:30am'<?php if(' 2:30am' == @$str[1][1]) {?>selected="selected" <?php } ?> >2:30am</option>
					<option value='3:00am'<?php if(' 3:00am' == @$str[1][1]) {?>selected="selected" <?php } ?> >3:00am</option>
					<option value='3:30am'<?php if(' 3:30am' == @$str[1][1]) {?>selected="selected" <?php } ?> >3:30am</option>
					<option value='4:00am'<?php if(' 4:00am' == @$str[1][1]) {?>selected="selected" <?php } ?> >4:00am</option>
					<option value='4:30am'<?php if(' 4:30am' == @$str[1][1]) {?>selected="selected" <?php } ?> >4:30am</option>
					<option value='5:00am'<?php if(' 5:00am' == @$str[1][1]) {?>selected="selected" <?php } ?> >5:00am</option>
					<option value='5:30am'<?php if(' 5:30am' == @$str[1][1]) {?>selected="selected" <?php } ?> >5:30am</option>
					<option value='6:00am'<?php if(' 6:00am' == @$str[1][1]) {?>selected="selected" <?php } ?> >6:00am</option>
					<option value='6:30am'<?php if(' 6:30am' == @$str[1][1]) {?>selected="selected" <?php } ?> >6:30am</option>
					<option value='7:00am'<?php if(' 7:00am' == @$str[1][1]) {?>selected="selected" <?php } ?> >7:00am</option>
					<option value='7:30am'<?php if(' 7:30am' == @$str[1][1]) {?>selected="selected" <?php } ?> >7:30am</option>
					<option value='8:00am'<?php if(' 8:00am' == @$str[1][1]) {?>selected="selected" <?php } ?> >8:00am</option>
					<option value='8:30am'<?php if(' 8:30am' == @$str[1][1]) {?>selected="selected" <?php } ?> >8:30am</option>
					<option value='9:00am'<?php if(' 9:00am' == @$str[1][1]) {?>selected="selected" <?php } ?> >9:00am</option>
					<option value='9:30am'<?php if(' 9:30am' == @$str[1][1]) {?>selected="selected" <?php } ?> >9:30am</option>
					<option value='10:00am'<?php if(' 10:00am' == @$str[1][1]) {?>selected="selected" <?php } ?> >10:00am</option>
					<option value='10:30am'<?php if(' 10:30am' == @$str[1][1]) {?>selected="selected" <?php } ?> >10:30am</option>
					<option value='11:00am'<?php if(' 11:00am' == @$str[1][1]) {?>selected="selected" <?php } ?> >11:00am</option>
					<option value='11:30am'<?php if(' 11:30am' == @$str[1][1]) {?>selected="selected" <?php } ?> >11:30am</option>
					<option value='12:00pm'<?php if(' 12:00pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >12:00pm</option>
					<option value='12:30pm'<?php if(' 12:30pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >12:30pm</option>
					<option value='1:00pm'<?php if(' 1:00pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >1:00pm</option>
					<option value='1:30pm'<?php if(' 1:30pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >1:30pm</option>
					<option value='2:00pm'<?php if(' 2:00pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >2:00pm</option>
					<option value='2:30pm'<?php if(' 2:30pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >2:30pm</option>
					<option value='3:00pm'<?php if(' 3:00pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >3:00pm</option>
					<option value='3:30pm'<?php if(' 3:30pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >3:30pm</option>
					<option value='4:00pm'<?php if(' 4:00pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >4:00pm</option>
					<option value='4:30pm'<?php if(' 4:30pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >4:30pm</option>
					<option value='5:00pm'<?php if(' 5:00pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >5:00pm</option>
					<option value='5:30pm'<?php if(' 5:30pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >5:30pm</option>
					<option value='6:00pm'<?php if(' 6:00pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >6:00pm</option>
					<option value='6:30pm'<?php if(' 6:30pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >6:30pm</option>
					<option value='7:00pm'<?php if(' 7:00pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >7:00pm</option>
					<option value='7:30pm'<?php if(' 7:30pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >7:30pm</option>
					<option value='8:00pm'<?php if(' 8:00pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >8:00pm</option>
					<option value='8:30pm'<?php if(' 8:30pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >8:30pm</option>
					<option value='9:00pm'<?php if(' 9:00pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >9:00pm</option>
					<option value='9:30pm'<?php if(' 9:30pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >9:30pm</option>
					<option value='10:00pm'<?php if(' 10:00pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >10:00pm</option>
					<option value='10:30pm'<?php if(' 10:30pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >10:30pm</option>
					<option value='11:00pm'<?php if(' 11:00pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >11:00pm</option>
					<option value='11:30pm'<?php if(' 11:30pm' == @$str[1][1]) {?>selected="selected" <?php } ?> >11:30pm</option>
					<option value='closed'<?php if(@$str[1][1] == ' closed') {?>selected="selected" <?php } ?> >Closed</option>
              </select>
   			</p>

   			<p class="time_hour">
		     <label class="control-label col-sm-4">Wednesday</label>
	  			 <select class="start" name="to[]">
                <option value='12:00am'<?php if(@$str[2][0]=='12:00am ') {?>selected="selected" <?php } ?> >12:00am</option>
					<option value='12:30am'<?php if('12:30am ' == @$str[2][0]) {?>selected="selected" <?php } ?>>12:30am</option>
					<option value='1:00am'<?php if('1:00am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >1:00am</option>
					<option value='1:30am'<?php if('1:30am ' == @$str[2][0]) {?>selected="selected" <?php } ?>>1:30am</option>
					<option value='2:00am'<?php if('2:00am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >2:00am</option>
					<option value='2:30am'<?php if('2:30am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >2:30am</option>
					<option value='3:00am'<?php if('3:00am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >3:00am</option>
					<option value='3:30am'<?php if('3:30am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >3:30am</option>
					<option value='4:00am'<?php if('4:00am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >4:00am</option>
					<option value='4:30am'<?php if('4:30am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >4:30am</option>
					<option value='5:00am'<?php if('5:00am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >5:00am</option>
					<option value='5:30am'<?php if('5:30am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >5:30am</option>
					<option value='6:00am'<?php if('6:00am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >6:00am</option>
					<option value='6:30am'<?php if('6:30am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >6:30am</option>
					<option value='7:00am'<?php if('7:00am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >7:00am</option>
					<option value='7:30am'<?php if('7:30am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >7:30am</option>
					<option value='8:00am'<?php if('8:00am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >8:00am</option>
					<option value='8:30am'<?php if('8:30am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >8:30am</option>
					<option value='9:00am'<?php if('9:00am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >9:00am</option>
					<option value='9:30am'<?php if('9:30am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >9:30am</option>
					<option value='10:00am'<?php if('10:00am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >10:00am</option>
					<option value='10:30am'<?php if('10:30am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >10:30am</option>
					<option value='11:00am'<?php if('11:00am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >11:00am</option>
					<option value='11:30am'<?php if('11:30am ' == @$str[2][0]) {?>selected="selected" <?php } ?> >11:30am</option>
					<option value='12:00pm'<?php if('12:00pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >12:00pm</option>
					<option value='12:30pm'<?php if('12:30pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >12:30pm</option>
					<option value='1:00pm'<?php if('1:00pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >1:00pm</option>
					<option value='1:30pm'<?php if('1:30pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >1:30pm</option>
					<option value='2:00pm'<?php if('2:00pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >2:00pm</option>
					<option value='2:30pm'<?php if('2:30pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >2:30pm</option>
					<option value='3:00pm'<?php if('3:00pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >3:00pm</option>
					<option value='3:30pm'<?php if('3:30pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >3:30pm</option>
					<option value='4:00pm'<?php if('4:00pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >4:00pm</option>
					<option value='4:30pm'<?php if('4:30pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >4:30pm</option>
					<option value='5:00pm'<?php if('5:00pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >5:00pm</option>
					<option value='5:30pm'<?php if('5:30pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >5:30pm</option>
					<option value='6:00pm'<?php if('6:00pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >6:00pm</option>
					<option value='6:30pm'<?php if('6:30pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >6:30pm</option>
					<option value='7:00pm'<?php if('7:00pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >7:00pm</option>
					<option value='7:30pm'<?php if('7:30pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >7:30pm</option>
					<option value='8:00pm'<?php if('8:00pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >8:00pm</option>
					<option value='8:30pm'<?php if('8:30pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >8:30pm</option>
					<option value='9:00pm'<?php if('9:00pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >9:00pm</option>
					<option value='9:30pm'<?php if('9:30pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >9:30pm</option>
					<option value='10:00pm'<?php if('10:00pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >10:00pm</option>
					<option value='10:30pm'<?php if('10:30pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >10:30pm</option>
					<option value='11:00pm'<?php if('11:00pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >11:00pm</option>
					<option value='11:30pm'<?php if('11:30pm ' == @$str[2][0]) {?>selected="selected" <?php } ?> >11:30pm</option>
					<option value='closed'<?php if(@$str[2][0] == 'closed ') {?>selected="selected" <?php } ?> >Closed</option>
              </select>
	  		 to
			   <select class="end" name="from[]">
               
					<option value='12:00am'<?php if(@$str[2][1]==' 12:00am') {?>selected="selected" <?php } ?> >12:00am</option>
					<option value='12:30am'<?php if(' 12:30am' == @$str[2][1]) {?>selected="selected" <?php } ?>>12:30am</option>
					<option value='1:00am'<?php if(' 1:00am' == @$str[2][1]) {?>selected="selected" <?php } ?> >1:00am</option>
					<option value='1:30am'<?php if(' 1:30am' == @$str[2][1]) {?>selected="selected" <?php } ?>>1:30am</option>
					<option value='2:00am'<?php if(' 2:00am' == @$str[2][1]) {?>selected="selected" <?php } ?> >2:00am</option>
					<option value='2:30am'<?php if(' 2:30am' == @$str[2][1]) {?>selected="selected" <?php } ?> >2:30am</option>
					<option value='3:00am'<?php if(' 3:00am' == @$str[2][1]) {?>selected="selected" <?php } ?> >3:00am</option>
					<option value='3:30am'<?php if(' 3:30am' == @$str[2][1]) {?>selected="selected" <?php } ?> >3:30am</option>
					<option value='4:00am'<?php if(' 4:00am' == @$str[2][1]) {?>selected="selected" <?php } ?> >4:00am</option>
					<option value='4:30am'<?php if(' 4:30am' == @$str[2][1]) {?>selected="selected" <?php } ?> >4:30am</option>
					<option value='5:00am'<?php if(' 5:00am' == @$str[2][1]) {?>selected="selected" <?php } ?> >5:00am</option>
					<option value='5:30am'<?php if(' 5:30am' == @$str[2][1]) {?>selected="selected" <?php } ?> >5:30am</option>
					<option value='6:00am'<?php if(' 6:00am' == @$str[2][1]) {?>selected="selected" <?php } ?> >6:00am</option>
					<option value='6:30am'<?php if(' 6:30am' == @$str[2][1]) {?>selected="selected" <?php } ?> >6:30am</option>
					<option value='7:00am'<?php if(' 7:00am' == @$str[2][1]) {?>selected="selected" <?php } ?> >7:00am</option>
					<option value='7:30am'<?php if(' 7:30am' == @$str[2][1]) {?>selected="selected" <?php } ?> >7:30am</option>
					<option value='8:00am'<?php if(' 8:00am' == @$str[2][1]) {?>selected="selected" <?php } ?> >8:00am</option>
					<option value='8:30am'<?php if(' 8:30am' == @$str[2][1]) {?>selected="selected" <?php } ?> >8:30am</option>
					<option value='9:00am'<?php if(' 9:00am' == @$str[2][1]) {?>selected="selected" <?php } ?> >9:00am</option>
					<option value='9:30am'<?php if(' 9:30am' == @$str[2][1]) {?>selected="selected" <?php } ?> >9:30am</option>
					<option value='10:00am'<?php if(' 10:00am' == @$str[2][1]) {?>selected="selected" <?php } ?> >10:00am</option>
					<option value='10:30am'<?php if(' 10:30am' == @$str[2][1]) {?>selected="selected" <?php } ?> >10:30am</option>
					<option value='11:00am'<?php if(' 11:00am' == @$str[2][1]) {?>selected="selected" <?php } ?> >11:00am</option>
					<option value='11:30am'<?php if(' 11:30am' == @$str[2][1]) {?>selected="selected" <?php } ?> >11:30am</option>
					<option value='12:00pm'<?php if(' 12:00pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >12:00pm</option>
					<option value='12:30pm'<?php if(' 12:30pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >12:30pm</option>
					<option value='1:00pm'<?php if(' 1:00pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >1:00pm</option>
					<option value='1:30pm'<?php if(' 1:30pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >1:30pm</option>
					<option value='2:00pm'<?php if(' 2:00pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >2:00pm</option>
					<option value='2:30pm'<?php if(' 2:30pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >2:30pm</option>
					<option value='3:00pm'<?php if(' 3:00pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >3:00pm</option>
					<option value='3:30pm'<?php if(' 3:30pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >3:30pm</option>
					<option value='4:00pm'<?php if(' 4:00pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >4:00pm</option>
					<option value='4:30pm'<?php if(' 4:30pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >4:30pm</option>
					<option value='5:00pm'<?php if(' 5:00pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >5:00pm</option>
					<option value='5:30pm'<?php if(' 5:30pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >5:30pm</option>
					<option value='6:00pm'<?php if(' 6:00pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >6:00pm</option>
					<option value='6:30pm'<?php if(' 6:30pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >6:30pm</option>
					<option value='7:00pm'<?php if(' 7:00pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >7:00pm</option>
					<option value='7:30pm'<?php if(' 7:30pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >7:30pm</option>
					<option value='8:00pm'<?php if(' 8:00pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >8:00pm</option>
					<option value='8:30pm'<?php if(' 8:30pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >8:30pm</option>
					<option value='9:00pm'<?php if(' 9:00pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >9:00pm</option>
					<option value='9:30pm'<?php if(' 9:30pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >9:30pm</option>
					<option value='10:00pm'<?php if(' 10:00pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >10:00pm</option>
					<option value='10:30pm'<?php if(' 10:30pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >10:30pm</option>
					<option value='11:00pm'<?php if(' 11:00pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >11:00pm</option>
					<option value='11:30pm'<?php if(' 11:30pm' == @$str[2][1]) {?>selected="selected" <?php } ?> >11:30pm</option>
					<option value='closed'<?php if(@$str[2][1] == ' closed') {?>selected="selected" <?php } ?> >Closed</option>
              </select>
   			</p>

   			 <p class="time_hour">
		     <label class="control-label col-sm-4">Thrusday</label>
	  				 <select class="start" name="to[]">
                	<option value='12:00am'<?php if(@$str[3][0]=='12:00am ') {?>selected="selected" <?php } ?> >12:00am</option>
					<option value='12:30am'<?php if('12:30am ' == @$str[3][0]) {?>selected="selected" <?php } ?>>12:30am</option>
					<option value='1:00am'<?php if('1:00am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >1:00am</option>
					<option value='1:30am'<?php if('1:30am ' == @$str[3][0]) {?>selected="selected" <?php } ?>>1:30am</option>
					<option value='2:00am'<?php if('2:00am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >2:00am</option>
					<option value='2:30am'<?php if('2:30am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >2:30am</option>
					<option value='3:00am'<?php if('3:00am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >3:00am</option>
					<option value='3:30am'<?php if('3:30am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >3:30am</option>
					<option value='4:00am'<?php if('4:00am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >4:00am</option>
					<option value='4:30am'<?php if('4:30am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >4:30am</option>
					<option value='5:00am'<?php if('5:00am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >5:00am</option>
					<option value='5:30am'<?php if('5:30am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >5:30am</option>
					<option value='6:00am'<?php if('6:00am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >6:00am</option>
					<option value='6:30am'<?php if('6:30am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >6:30am</option>
					<option value='7:00am'<?php if('7:00am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >7:00am</option>
					<option value='7:30am'<?php if('7:30am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >7:30am</option>
					<option value='8:00am'<?php if('8:00am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >8:00am</option>
					<option value='8:30am'<?php if('8:30am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >8:30am</option>
					<option value='9:00am'<?php if('9:00am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >9:00am</option>
					<option value='9:30am'<?php if('9:30am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >9:30am</option>
					<option value='10:00am'<?php if('10:00am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >10:00am</option>
					<option value='10:30am'<?php if('10:30am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >10:30am</option>
					<option value='11:00am'<?php if('11:00am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >11:00am</option>
					<option value='11:30am'<?php if('11:30am ' == @$str[3][0]) {?>selected="selected" <?php } ?> >11:30am</option>
					<option value='12:00pm'<?php if('12:00pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >12:00pm</option>
					<option value='12:30pm'<?php if('12:30pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >12:30pm</option>
					<option value='1:00pm'<?php if('1:00pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >1:00pm</option>
					<option value='1:30pm'<?php if('1:30pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >1:30pm</option>
					<option value='2:00pm'<?php if('2:00pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >2:00pm</option>
					<option value='2:30pm'<?php if('2:30pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >2:30pm</option>
					<option value='3:00pm'<?php if('3:00pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >3:00pm</option>
					<option value='3:30pm'<?php if('3:30pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >3:30pm</option>
					<option value='4:00pm'<?php if('4:00pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >4:00pm</option>
					<option value='4:30pm'<?php if('4:30pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >4:30pm</option>
					<option value='5:00pm'<?php if('5:00pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >5:00pm</option>
					<option value='5:30pm'<?php if('5:30pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >5:30pm</option>
					<option value='6:00pm'<?php if('6:00pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >6:00pm</option>
					<option value='6:30pm'<?php if('6:30pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >6:30pm</option>
					<option value='7:00pm'<?php if('7:00pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >7:00pm</option>
					<option value='7:30pm'<?php if('7:30pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >7:30pm</option>
					<option value='8:00pm'<?php if('8:00pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >8:00pm</option>
					<option value='8:30pm'<?php if('8:30pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >8:30pm</option>
					<option value='9:00pm'<?php if('9:00pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >9:00pm</option>
					<option value='9:30pm'<?php if('9:30pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >9:30pm</option>
					<option value='10:00pm'<?php if('10:00pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >10:00pm</option>
					<option value='10:30pm'<?php if('10:30pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >10:30pm</option>
					<option value='11:00pm'<?php if('11:00pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >11:00pm</option>
					<option value='11:30pm'<?php if('11:30pm ' == @$str[3][0]) {?>selected="selected" <?php } ?> >11:30pm</option>
					<option value='closed'<?php if(@$str[3][0] == 'closed ') {?>selected="selected" <?php } ?> >Closed</option>
              </select>
	  		 to
			   <select class="end" name="from[]">
               
                	<option value='12:00am'<?php if($str[0][1]==' 12:00am') {?>selected="selected" <?php } ?> >12:00am</option>
					<option value='12:30am'<?php if(' 12:30am' == @$str[3][1]) {?>selected="selected" <?php } ?>>12:30am</option>
					<option value='1:00am'<?php if(' 1:00am' == @$str[3][1]) {?>selected="selected" <?php } ?> >1:00am</option>
					<option value='1:30am'<?php if(' 1:30am' == @$str[3][1]) {?>selected="selected" <?php } ?>>1:30am</option>
					<option value='2:00am'<?php if(' 2:00am' == @$str[3][1]) {?>selected="selected" <?php } ?> >2:00am</option>
					<option value='2:30am'<?php if(' 2:30am' == @$str[3][1]) {?>selected="selected" <?php } ?> >2:30am</option>
					<option value='3:00am'<?php if(' 3:00am' == @$str[3][1]) {?>selected="selected" <?php } ?> >3:00am</option>
					<option value='3:30am'<?php if(' 3:30am' == @$str[3][1]) {?>selected="selected" <?php } ?> >3:30am</option>
					<option value='4:00am'<?php if(' 4:00am' == @$str[3][1]) {?>selected="selected" <?php } ?> >4:00am</option>
					<option value='4:30am'<?php if(' 4:30am' == @$str[3][1]) {?>selected="selected" <?php } ?> >4:30am</option>
					<option value='5:00am'<?php if(' 5:00am' == @$str[3][1]) {?>selected="selected" <?php } ?> >5:00am</option>
					<option value='5:30am'<?php if(' 5:30am' == @$str[3][1]) {?>selected="selected" <?php } ?> >5:30am</option>
					<option value='6:00am'<?php if(' 6:00am' == @$str[3][1]) {?>selected="selected" <?php } ?> >6:00am</option>
					<option value='6:30am'<?php if(' 6:30am' == @$str[3][1]) {?>selected="selected" <?php } ?> >6:30am</option>
					<option value='7:00am'<?php if(' 7:00am' == @$str[3][1]) {?>selected="selected" <?php } ?> >7:00am</option>
					<option value='7:30am'<?php if(' 7:30am' == @$str[3][1]) {?>selected="selected" <?php } ?> >7:30am</option>
					<option value='8:00am'<?php if(' 8:00am' == @$str[3][1]) {?>selected="selected" <?php } ?> >8:00am</option>
					<option value='8:30am'<?php if(' 8:30am' == @$str[3][1]) {?>selected="selected" <?php } ?> >8:30am</option>
					<option value='9:00am'<?php if(' 9:00am' == @$str[3][1]) {?>selected="selected" <?php } ?> >9:00am</option>
					<option value='9:30am'<?php if(' 9:30am' == @$str[3][1]) {?>selected="selected" <?php } ?> >9:30am</option>
					<option value='10:00am'<?php if(' 10:00am' == @$str[3][1]) {?>selected="selected" <?php } ?> >10:00am</option>
					<option value='10:30am'<?php if(' 10:30am' == @$str[3][1]) {?>selected="selected" <?php } ?> >10:30am</option>
					<option value='11:00am'<?php if(' 11:00am' == @$str[3][1]) {?>selected="selected" <?php } ?> >11:00am</option>
					<option value='11:30am'<?php if(' 11:30am' == @$str[3][1]) {?>selected="selected" <?php } ?> >11:30am</option>
					<option value='12:00pm'<?php if(' 12:00pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >12:00pm</option>
					<option value='12:30pm'<?php if(' 12:30pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >12:30pm</option>
					<option value='1:00pm'<?php if(' 1:00pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >1:00pm</option>
					<option value='1:30pm'<?php if(' 1:30pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >1:30pm</option>
					<option value='2:00pm'<?php if(' 2:00pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >2:00pm</option>
					<option value='2:30pm'<?php if(' 2:30pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >2:30pm</option>
					<option value='3:00pm'<?php if(' 3:00pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >3:00pm</option>
					<option value='3:30pm'<?php if(' 3:30pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >3:30pm</option>
					<option value='4:00pm'<?php if(' 4:00pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >4:00pm</option>
					<option value='4:30pm'<?php if(' 4:30pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >4:30pm</option>
					<option value='5:00pm'<?php if(' 5:00pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >5:00pm</option>
					<option value='5:30pm'<?php if(' 5:30pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >5:30pm</option>
					<option value='6:00pm'<?php if(' 6:00pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >6:00pm</option>
					<option value='6:30pm'<?php if(' 6:30pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >6:30pm</option>
					<option value='7:00pm'<?php if(' 7:00pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >7:00pm</option>
					<option value='7:30pm'<?php if(' 7:30pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >7:30pm</option>
					<option value='8:00pm'<?php if(' 8:00pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >8:00pm</option>
					<option value='8:30pm'<?php if(' 8:30pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >8:30pm</option>
					<option value='9:00pm'<?php if(' 9:00pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >9:00pm</option>
					<option value='9:30pm'<?php if(' 9:30pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >9:30pm</option>
					<option value='10:00pm'<?php if(' 10:00pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >10:00pm</option>
					<option value='10:30pm'<?php if(' 10:30pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >10:30pm</option>
					<option value='11:00pm'<?php if(' 11:00pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >11:00pm</option>
					<option value='11:30pm'<?php if(' 11:30pm' == @$str[3][1]) {?>selected="selected" <?php } ?> >11:30pm</option>
					<option value='closed'<?php if(@$str[3][1] == ' closed') {?>selected="selected" <?php } ?> >Closed</option>
              </select>
   			</p>

   			<p class="time_hour">
		     <label class="control-label col-sm-4">Friday</label>
	  				 <select class="start" name="to[]">
                <option value='12:00am'<?php if(@$str[4][0]=='12:00am ') {?>selected="selected" <?php } ?> >12:00am</option>
					<option value='12:30am'<?php if('12:30am ' == @$str[4][0]) {?>selected="selected" <?php } ?>>12:30am</option>
					<option value='1:00am'<?php if('1:00am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >1:00am</option>
					<option value='1:30am'<?php if('1:30am ' == @$str[4][0]) {?>selected="selected" <?php } ?>>1:30am</option>
					<option value='2:00am'<?php if('2:00am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >2:00am</option>
					<option value='2:30am'<?php if('2:30am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >2:30am</option>
					<option value='3:00am'<?php if('3:00am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >3:00am</option>
					<option value='3:30am'<?php if('3:30am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >3:30am</option>
					<option value='4:00am'<?php if('4:00am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >4:00am</option>
					<option value='4:30am'<?php if('4:30am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >4:30am</option>
					<option value='5:00am'<?php if('5:00am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >5:00am</option>
					<option value='5:30am'<?php if('5:30am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >5:30am</option>
					<option value='6:00am'<?php if('6:00am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >6:00am</option>
					<option value='6:30am'<?php if('6:30am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >6:30am</option>
					<option value='7:00am'<?php if('7:00am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >7:00am</option>
					<option value='7:30am'<?php if('7:30am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >7:30am</option>
					<option value='8:00am'<?php if('8:00am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >8:00am</option>
					<option value='8:30am'<?php if('8:30am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >8:30am</option>
					<option value='9:00am'<?php if('9:00am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >9:00am</option>
					<option value='9:30am'<?php if('9:30am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >9:30am</option>
					<option value='10:00am'<?php if('10:00am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >10:00am</option>
					<option value='10:30am'<?php if('10:30am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >10:30am</option>
					<option value='11:00am'<?php if('11:00am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >11:00am</option>
					<option value='11:30am'<?php if('11:30am ' == @$str[4][0]) {?>selected="selected" <?php } ?> >11:30am</option>
					<option value='12:00pm'<?php if('12:00pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >12:00pm</option>
					<option value='12:30pm'<?php if('12:30pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >12:30pm</option>
					<option value='1:00pm'<?php if('1:00pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >1:00pm</option>
					<option value='1:30pm'<?php if('1:30pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >1:30pm</option>
					<option value='2:00pm'<?php if('2:00pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >2:00pm</option>
					<option value='2:30pm'<?php if('2:30pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >2:30pm</option>
					<option value='3:00pm'<?php if('3:00pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >3:00pm</option>
					<option value='3:30pm'<?php if('3:30pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >3:30pm</option>
					<option value='4:00pm'<?php if('4:00pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >4:00pm</option>
					<option value='4:30pm'<?php if('4:30pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >4:30pm</option>
					<option value='5:00pm'<?php if('5:00pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >5:00pm</option>
					<option value='5:30pm'<?php if('5:30pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >5:30pm</option>
					<option value='6:00pm'<?php if('6:00pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >6:00pm</option>
					<option value='6:30pm'<?php if('6:30pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >6:30pm</option>
					<option value='7:00pm'<?php if('7:00pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >7:00pm</option>
					<option value='7:30pm'<?php if('7:30pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >7:30pm</option>
					<option value='8:00pm'<?php if('8:00pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >8:00pm</option>
					<option value='8:30pm'<?php if('8:30pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >8:30pm</option>
					<option value='9:00pm'<?php if('9:00pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >9:00pm</option>
					<option value='9:30pm'<?php if('9:30pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >9:30pm</option>
					<option value='10:00pm'<?php if('10:00pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >10:00pm</option>
					<option value='10:30pm'<?php if('10:30pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >10:30pm</option>
					<option value='11:00pm'<?php if('11:00pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >11:00pm</option>
					<option value='11:30pm'<?php if('11:30pm ' == @$str[4][0]) {?>selected="selected" <?php } ?> >11:30pm</option>
					<option value='closed'<?php if(@$str[4][0] == 'closed ') {?>selected="selected" <?php } ?> >Closed</option>
              </select>
	  		 to
			   <select class="end" name="from[]">
               
	                	<option value='12:00am'<?php if(@$str[4][1]==' 12:00am') {?>selected="selected" <?php } ?> >12:00am</option>
					<option value='12:30am'<?php if(' 12:30am' == @$str[4][1]) {?>selected="selected" <?php } ?>>12:30am</option>
					<option value='1:00am'<?php if(' 1:00am' == @$str[4][1]) {?>selected="selected" <?php } ?> >1:00am</option>
					<option value='1:30am'<?php if(' 1:30am' == @$str[4][1]) {?>selected="selected" <?php } ?>>1:30am</option>
					<option value='2:00am'<?php if(' 2:00am' == @$str[4][1]) {?>selected="selected" <?php } ?> >2:00am</option>
					<option value='2:30am'<?php if(' 2:30am' == @$str[4][1]) {?>selected="selected" <?php } ?> >2:30am</option>
					<option value='3:00am'<?php if(' 3:00am' == @$str[4][1]) {?>selected="selected" <?php } ?> >3:00am</option>
					<option value='3:30am'<?php if(' 3:30am' == @$str[4][1]) {?>selected="selected" <?php } ?> >3:30am</option>
					<option value='4:00am'<?php if(' 4:00am' == @$str[4][1]) {?>selected="selected" <?php } ?> >4:00am</option>
					<option value='4:30am'<?php if(' 4:30am' == @$str[4][1]) {?>selected="selected" <?php } ?> >4:30am</option>
					<option value='5:00am'<?php if(' 5:00am' == @$str[4][1]) {?>selected="selected" <?php } ?> >5:00am</option>
					<option value='5:30am'<?php if(' 5:30am' == @$str[4][1]) {?>selected="selected" <?php } ?> >5:30am</option>
					<option value='6:00am'<?php if(' 6:00am' == @$str[4][1]) {?>selected="selected" <?php } ?> >6:00am</option>
					<option value='6:30am'<?php if(' 6:30am' == @$str[4][1]) {?>selected="selected" <?php } ?> >6:30am</option>
					<option value='7:00am'<?php if(' 7:00am' == @$str[4][1]) {?>selected="selected" <?php } ?> >7:00am</option>
					<option value='7:30am'<?php if(' 7:30am' == @$str[4][1]) {?>selected="selected" <?php } ?> >7:30am</option>
					<option value='8:00am'<?php if(' 8:00am' == @$str[4][1]) {?>selected="selected" <?php } ?> >8:00am</option>
					<option value='8:30am'<?php if(' 8:30am' == @$str[4][1]) {?>selected="selected" <?php } ?> >8:30am</option>
					<option value='9:00am'<?php if(' 9:00am' == @$str[4][1]) {?>selected="selected" <?php } ?> >9:00am</option>
					<option value='9:30am'<?php if(' 9:30am' == @$str[4][1]) {?>selected="selected" <?php } ?> >9:30am</option>
					<option value='10:00am'<?php if(' 10:00am' == @$str[4][1]) {?>selected="selected" <?php } ?> >10:00am</option>
					<option value='10:30am'<?php if(' 10:30am' == @$str[4][1]) {?>selected="selected" <?php } ?> >10:30am</option>
					<option value='11:00am'<?php if(' 11:00am' == @$str[4][1]) {?>selected="selected" <?php } ?> >11:00am</option>
					<option value='11:30am'<?php if(' 11:30am' == @$str[4][1]) {?>selected="selected" <?php } ?> >11:30am</option>
					<option value='12:00pm'<?php if(' 12:00pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >12:00pm</option>
					<option value='12:30pm'<?php if(' 12:30pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >12:30pm</option>
					<option value='1:00pm'<?php if(' 1:00pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >1:00pm</option>
					<option value='1:30pm'<?php if(' 1:30pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >1:30pm</option>
					<option value='2:00pm'<?php if(' 2:00pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >2:00pm</option>
					<option value='2:30pm'<?php if(' 2:30pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >2:30pm</option>
					<option value='3:00pm'<?php if(' 3:00pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >3:00pm</option>
					<option value='3:30pm'<?php if(' 3:30pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >3:30pm</option>
					<option value='4:00pm'<?php if(' 4:00pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >4:00pm</option>
					<option value='4:30pm'<?php if(' 4:30pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >4:30pm</option>
					<option value='5:00pm'<?php if(' 5:00pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >5:00pm</option>
					<option value='5:30pm'<?php if(' 5:30pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >5:30pm</option>
					<option value='6:00pm'<?php if(' 6:00pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >6:00pm</option>
					<option value='6:30pm'<?php if(' 6:30pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >6:30pm</option>
					<option value='7:00pm'<?php if(' 7:00pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >7:00pm</option>
					<option value='7:30pm'<?php if(' 7:30pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >7:30pm</option>
					<option value='8:00pm'<?php if(' 8:00pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >8:00pm</option>
					<option value='8:30pm'<?php if(' 8:30pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >8:30pm</option>
					<option value='9:00pm'<?php if(' 9:00pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >9:00pm</option>
					<option value='9:30pm'<?php if(' 9:30pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >9:30pm</option>
					<option value='10:00pm'<?php if(' 10:00pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >10:00pm</option>
					<option value='10:30pm'<?php if(' 10:30pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >10:30pm</option>
					<option value='11:00pm'<?php if(' 11:00pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >11:00pm</option>
					<option value='11:30pm'<?php if(' 11:30pm' == @$str[4][1]) {?>selected="selected" <?php } ?> >11:30pm</option>
					<option value='closed'<?php if(@$str[4][1] == ' closed') {?>selected="selected" <?php } ?> >Closed</option>
              </select>
   			</p>

   			<p class="time_hour">
		     <label class="control-label col-sm-4">Saturday</label>
	  				 <select class="start" name="to[]">
                	<option value='12:00am'<?php if(@$str[5][0]=='12:00am ') {?>selected="selected" <?php } ?> >12:00am</option>
					<option value='12:30am'<?php if('12:30am ' == @$str[5][0]) {?>selected="selected" <?php } ?>>12:30am</option>
					<option value='1:00am'<?php if('1:00am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >1:00am</option>
					<option value='1:30am'<?php if('1:30am ' == @$str[5][0]) {?>selected="selected" <?php } ?>>1:30am</option>
					<option value='2:00am'<?php if('2:00am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >2:00am</option>
					<option value='2:30am'<?php if('2:30am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >2:30am</option>
					<option value='3:00am'<?php if('3:00am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >3:00am</option>
					<option value='3:30am'<?php if('3:30am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >3:30am</option>
					<option value='4:00am'<?php if('4:00am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >4:00am</option>
					<option value='4:30am'<?php if('4:30am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >4:30am</option>
					<option value='5:00am'<?php if('5:00am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >5:00am</option>
					<option value='5:30am'<?php if('5:30am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >5:30am</option>
					<option value='6:00am'<?php if('6:00am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >6:00am</option>
					<option value='6:30am'<?php if('6:30am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >6:30am</option>
					<option value='7:00am'<?php if('7:00am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >7:00am</option>
					<option value='7:30am'<?php if('7:30am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >7:30am</option>
					<option value='8:00am'<?php if('8:00am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >8:00am</option>
					<option value='8:30am'<?php if('8:30am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >8:30am</option>
					<option value='9:00am'<?php if('9:00am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >9:00am</option>
					<option value='9:30am'<?php if('9:30am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >9:30am</option>
					<option value='10:00am'<?php if('10:00am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >10:00am</option>
					<option value='10:30am'<?php if('10:30am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >10:30am</option>
					<option value='11:00am'<?php if('11:00am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >11:00am</option>
					<option value='11:30am'<?php if('11:30am ' == @$str[5][0]) {?>selected="selected" <?php } ?> >11:30am</option>
					<option value='12:00pm'<?php if('12:00pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >12:00pm</option>
					<option value='12:30pm'<?php if('12:30pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >12:30pm</option>
					<option value='1:00pm'<?php if('1:00pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >1:00pm</option>
					<option value='1:30pm'<?php if('1:30pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >1:30pm</option>
					<option value='2:00pm'<?php if('2:00pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >2:00pm</option>
					<option value='2:30pm'<?php if('2:30pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >2:30pm</option>
					<option value='3:00pm'<?php if('3:00pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >3:00pm</option>
					<option value='3:30pm'<?php if('3:30pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >3:30pm</option>
					<option value='4:00pm'<?php if('4:00pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >4:00pm</option>
					<option value='4:30pm'<?php if('4:30pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >4:30pm</option>
					<option value='5:00pm'<?php if('5:00pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >5:00pm</option>
					<option value='5:30pm'<?php if('5:30pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >5:30pm</option>
					<option value='6:00pm'<?php if('6:00pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >6:00pm</option>
					<option value='6:30pm'<?php if('6:30pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >6:30pm</option>
					<option value='7:00pm'<?php if('7:00pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >7:00pm</option>
					<option value='7:30pm'<?php if('7:30pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >7:30pm</option>
					<option value='8:00pm'<?php if('8:00pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >8:00pm</option>
					<option value='8:30pm'<?php if('8:30pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >8:30pm</option>
					<option value='9:00pm'<?php if('9:00pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >9:00pm</option>
					<option value='9:30pm'<?php if('9:30pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >9:30pm</option>
					<option value='10:00pm'<?php if('10:00pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >10:00pm</option>
					<option value='10:30pm'<?php if('10:30pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >10:30pm</option>
					<option value='11:00pm'<?php if('11:00pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >11:00pm</option>
					<option value='11:30pm'<?php if('11:30pm ' == @$str[5][0]) {?>selected="selected" <?php } ?> >11:30pm</option>
					<option value='closed'<?php if(@$str[5][0] == 'closed ') {?>selected="selected" <?php } ?> >Closed</option>
              </select>
	  		 to
			   <select class="end" name="from[]">
               
					<option value='12:00am'<?php if(@$str[5][1]==' 12:00am') {?>selected="selected" <?php } ?> >12:00am</option>
					<option value='12:30am'<?php if(' 12:30am' == @$str[5][1]) {?>selected="selected" <?php } ?>>12:30am</option>
					<option value='1:00am'<?php if(' 1:00am' == @$str[5][1]) {?>selected="selected" <?php } ?> >1:00am</option>
					<option value='1:30am'<?php if(' 1:30am' == @$str[5][1]) {?>selected="selected" <?php } ?>>1:30am</option>
					<option value='2:00am'<?php if(' 2:00am' == @$str[5][1]) {?>selected="selected" <?php } ?> >2:00am</option>
					<option value='2:30am'<?php if(' 2:30am' == @$str[5][1]) {?>selected="selected" <?php } ?> >2:30am</option>
					<option value='3:00am'<?php if(' 3:00am' == @$str[5][1]) {?>selected="selected" <?php } ?> >3:00am</option>
					<option value='3:30am'<?php if(' 3:30am' == @$str[5][1]) {?>selected="selected" <?php } ?> >3:30am</option>
					<option value='4:00am'<?php if(' 4:00am' == @$str[5][1]) {?>selected="selected" <?php } ?> >4:00am</option>
					<option value='4:30am'<?php if(' 4:30am' == @$str[5][1]) {?>selected="selected" <?php } ?> >4:30am</option>
					<option value='5:00am'<?php if(' 5:00am' == @$str[5][1]) {?>selected="selected" <?php } ?> >5:00am</option>
					<option value='5:30am'<?php if(' 5:30am' == @$str[5][1]) {?>selected="selected" <?php } ?> >5:30am</option>
					<option value='6:00am'<?php if(' 6:00am' == @$str[5][1]) {?>selected="selected" <?php } ?> >6:00am</option>
					<option value='6:30am'<?php if(' 6:30am' == @$str[5][1]) {?>selected="selected" <?php } ?> >6:30am</option>
					<option value='7:00am'<?php if(' 7:00am' == @$str[5][1]) {?>selected="selected" <?php } ?> >7:00am</option>
					<option value='7:30am'<?php if(' 7:30am' == @$str[5][1]) {?>selected="selected" <?php } ?> >7:30am</option>
					<option value='8:00am'<?php if(' 8:00am' == @$str[5][1]) {?>selected="selected" <?php } ?> >8:00am</option>
					<option value='8:30am'<?php if(' 8:30am' == @$str[5][1]) {?>selected="selected" <?php } ?> >8:30am</option>
					<option value='9:00am'<?php if(' 9:00am' == @$str[5][1]) {?>selected="selected" <?php } ?> >9:00am</option>
					<option value='9:30am'<?php if(' 9:30am' == @$str[5][1]) {?>selected="selected" <?php } ?> >9:30am</option>
					<option value='10:00am'<?php if(' 10:00am' == @$str[5][1]) {?>selected="selected" <?php } ?> >10:00am</option>
					<option value='10:30am'<?php if(' 10:30am' == @$str[5][1]) {?>selected="selected" <?php } ?> >10:30am</option>
					<option value='11:00am'<?php if(' 11:00am' == @$str[5][1]) {?>selected="selected" <?php } ?> >11:00am</option>
					<option value='11:30am'<?php if(' 11:30am' == @$str[5][1]) {?>selected="selected" <?php } ?> >11:30am</option>
					<option value='12:00pm'<?php if(' 12:00pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >12:00pm</option>
					<option value='12:30pm'<?php if(' 12:30pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >12:30pm</option>
					<option value='1:00pm'<?php if(' 1:00pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >1:00pm</option>
					<option value='1:30pm'<?php if(' 1:30pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >1:30pm</option>
					<option value='2:00pm'<?php if(' 2:00pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >2:00pm</option>
					<option value='2:30pm'<?php if(' 2:30pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >2:30pm</option>
					<option value='3:00pm'<?php if(' 3:00pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >3:00pm</option>
					<option value='3:30pm'<?php if(' 3:30pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >3:30pm</option>
					<option value='4:00pm'<?php if(' 4:00pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >4:00pm</option>
					<option value='4:30pm'<?php if(' 4:30pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >4:30pm</option>
					<option value='5:00pm'<?php if(' 5:00pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >5:00pm</option>
					<option value='5:30pm'<?php if(' 5:30pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >5:30pm</option>
					<option value='6:00pm'<?php if(' 6:00pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >6:00pm</option>
					<option value='6:30pm'<?php if(' 6:30pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >6:30pm</option>
					<option value='7:00pm'<?php if(' 7:00pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >7:00pm</option>
					<option value='7:30pm'<?php if(' 7:30pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >7:30pm</option>
					<option value='8:00pm'<?php if(' 8:00pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >8:00pm</option>
					<option value='8:30pm'<?php if(' 8:30pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >8:30pm</option>
					<option value='9:00pm'<?php if(' 9:00pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >9:00pm</option>
					<option value='9:30pm'<?php if(' 9:30pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >9:30pm</option>
					<option value='10:00pm'<?php if(' 10:00pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >10:00pm</option>
					<option value='10:30pm'<?php if(' 10:30pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >10:30pm</option>
					<option value='11:00pm'<?php if(' 11:00pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >11:00pm</option>
					<option value='11:30pm'<?php if(' 11:30pm' == @$str[5][1]) {?>selected="selected" <?php } ?> >11:30pm</option>
					<option value='closed'<?php if(@$str[5][1] == ' closed') {?>selected="selected" <?php } ?> >Closed</option>
              </select>
   			</p>

   			 <p class="time_hour">
		     <label class="control-label col-sm-4">Sunday</label>
	  		 <select class="start" name="to[]">
                <option value='12:00am'<?php if(@$str[6][0]=='12:00am ') {?>selected="selected" <?php } ?> >12:00am</option>
					<option value='12:30am'<?php if('12:30am ' == @$str[6][0]) {?>selected="selected" <?php } ?>>12:30am</option>
					<option value='1:00am'<?php if('1:00am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >1:00am</option>
					<option value='1:30am'<?php if('1:30am ' == @$str[6][0]) {?>selected="selected" <?php } ?>>1:30am</option>
					<option value='2:00am'<?php if('2:00am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >2:00am</option>
					<option value='2:30am'<?php if('2:30am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >2:30am</option>
					<option value='3:00am'<?php if('3:00am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >3:00am</option>
					<option value='3:30am'<?php if('3:30am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >3:30am</option>
					<option value='4:00am'<?php if('4:00am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >4:00am</option>
					<option value='4:30am'<?php if('4:30am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >4:30am</option>
					<option value='5:00am'<?php if('5:00am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >5:00am</option>
					<option value='5:30am'<?php if('5:30am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >5:30am</option>
					<option value='6:00am'<?php if('6:00am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >6:00am</option>
					<option value='6:30am'<?php if('6:30am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >6:30am</option>
					<option value='7:00am'<?php if('7:00am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >7:00am</option>
					<option value='7:30am'<?php if('7:30am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >7:30am</option>
					<option value='8:00am'<?php if('8:00am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >8:00am</option>
					<option value='8:30am'<?php if('8:30am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >8:30am</option>
					<option value='9:00am'<?php if('9:00am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >9:00am</option>
					<option value='9:30am'<?php if('9:30am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >9:30am</option>
					<option value='10:00am'<?php if('10:00am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >10:00am</option>
					<option value='10:30am'<?php if('10:30am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >10:30am</option>
					<option value='11:00am'<?php if('11:00am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >11:00am</option>
					<option value='11:30am'<?php if('11:30am ' == @$str[6][0]) {?>selected="selected" <?php } ?> >11:30am</option>
					<option value='12:00pm'<?php if('12:00pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >12:00pm</option>
					<option value='12:30pm'<?php if('12:30pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >12:30pm</option>
					<option value='1:00pm'<?php if('1:00pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >1:00pm</option>
					<option value='1:30pm'<?php if('1:30pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >1:30pm</option>
					<option value='2:00pm'<?php if('2:00pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >2:00pm</option>
					<option value='2:30pm'<?php if('2:30pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >2:30pm</option>
					<option value='3:00pm'<?php if('3:00pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >3:00pm</option>
					<option value='3:30pm'<?php if('3:30pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >3:30pm</option>
					<option value='4:00pm'<?php if('4:00pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >4:00pm</option>
					<option value='4:30pm'<?php if('4:30pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >4:30pm</option>
					<option value='5:00pm'<?php if('5:00pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >5:00pm</option>
					<option value='5:30pm'<?php if('5:30pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >5:30pm</option>
					<option value='6:00pm'<?php if('6:00pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >6:00pm</option>
					<option value='6:30pm'<?php if('6:30pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >6:30pm</option>
					<option value='7:00pm'<?php if('7:00pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >7:00pm</option>
					<option value='7:30pm'<?php if('7:30pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >7:30pm</option>
					<option value='8:00pm'<?php if('8:00pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >8:00pm</option>
					<option value='8:30pm'<?php if('8:30pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >8:30pm</option>
					<option value='9:00pm'<?php if('9:00pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >9:00pm</option>
					<option value='9:30pm'<?php if('9:30pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >9:30pm</option>
					<option value='10:00pm'<?php if('10:00pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >10:00pm</option>
					<option value='10:30pm'<?php if('10:30pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >10:30pm</option>
					<option value='11:00pm'<?php if('11:00pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >11:00pm</option>
					<option value='11:30pm'<?php if('11:30pm ' == @$str[6][0]) {?>selected="selected" <?php } ?> >11:30pm</option>
					<option value='closed'<?php if(@$str[6][0] == 'closed ') {?>selected="selected" <?php } ?> >Closed</option>
              </select>
	  		 to
			   <select class="end" name="from[]">
               
                	<option value='12:00am'<?php if(@$str[6][1]==' 12:00am') {?>selected="selected" <?php } ?> >12:00am</option>
					<option value='12:30am'<?php if(' 12:30am' == @$str[6][1]) {?>selected="selected" <?php } ?>>12:30am</option>
					<option value='1:00am'<?php if(' 1:00am' == @$str[6][1]) {?>selected="selected" <?php } ?> >1:00am</option>
					<option value='1:30am'<?php if(' 1:30am' == @$str[6][1]) {?>selected="selected" <?php } ?>>1:30am</option>
					<option value='2:00am'<?php if(' 2:00am' == @$str[6][1]) {?>selected="selected" <?php } ?> >2:00am</option>
					<option value='2:30am'<?php if(' 2:30am' == @$str[6][1]) {?>selected="selected" <?php } ?> >2:30am</option>
					<option value='3:00am'<?php if(' 3:00am' == @$str[6][1]) {?>selected="selected" <?php } ?> >3:00am</option>
					<option value='3:30am'<?php if(' 3:30am' == @$str[6][1]) {?>selected="selected" <?php } ?> >3:30am</option>
					<option value='4:00am'<?php if(' 4:00am' == @$str[6][1]) {?>selected="selected" <?php } ?> >4:00am</option>
					<option value='4:30am'<?php if(' 4:30am' == @$str[6][1]) {?>selected="selected" <?php } ?> >4:30am</option>
					<option value='5:00am'<?php if(' 5:00am' == @$str[6][1]) {?>selected="selected" <?php } ?> >5:00am</option>
					<option value='5:30am'<?php if(' 5:30am' == @$str[6][1]) {?>selected="selected" <?php } ?> >5:30am</option>
					<option value='6:00am'<?php if(' 6:00am' == @$str[6][1]) {?>selected="selected" <?php } ?> >6:00am</option>
					<option value='6:30am'<?php if(' 6:30am' == @$str[6][1]) {?>selected="selected" <?php } ?> >6:30am</option>
					<option value='7:00am'<?php if(' 7:00am' == @$str[6][1]) {?>selected="selected" <?php } ?> >7:00am</option>
					<option value='7:30am'<?php if(' 7:30am' == @$str[6][1]) {?>selected="selected" <?php } ?> >7:30am</option>
					<option value='8:00am'<?php if(' 8:00am' == @$str[6][1]) {?>selected="selected" <?php } ?> >8:00am</option>
					<option value='8:30am'<?php if(' 8:30am' == @$str[6][1]) {?>selected="selected" <?php } ?> >8:30am</option>
					<option value='9:00am'<?php if(' 9:00am' == @$str[6][1]) {?>selected="selected" <?php } ?> >9:00am</option>
					<option value='9:30am'<?php if(' 9:30am' == @$str[6][1]) {?>selected="selected" <?php } ?> >9:30am</option>
					<option value='10:00am'<?php if(' 10:00am' == @$str[6][1]) {?>selected="selected" <?php } ?> >10:00am</option>
					<option value='10:30am'<?php if(' 10:30am' == @$str[6][1]) {?>selected="selected" <?php } ?> >10:30am</option>
					<option value='11:00am'<?php if(' 11:00am' == @$str[6][1]) {?>selected="selected" <?php } ?> >11:00am</option>
					<option value='11:30am'<?php if(' 11:30am' == @$str[6][1]) {?>selected="selected" <?php } ?> >11:30am</option>
					<option value='12:00pm'<?php if(' 12:00pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >12:00pm</option>
					<option value='12:30pm'<?php if(' 12:30pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >12:30pm</option>
					<option value='1:00pm'<?php if(' 1:00pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >1:00pm</option>
					<option value='1:30pm'<?php if(' 1:30pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >1:30pm</option>
					<option value='2:00pm'<?php if(' 2:00pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >2:00pm</option>
					<option value='2:30pm'<?php if(' 2:30pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >2:30pm</option>
					<option value='3:00pm'<?php if(' 3:00pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >3:00pm</option>
					<option value='3:30pm'<?php if(' 3:30pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >3:30pm</option>
					<option value='4:00pm'<?php if(' 4:00pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >4:00pm</option>
					<option value='4:30pm'<?php if(' 4:30pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >4:30pm</option>
					<option value='5:00pm'<?php if(' 5:00pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >5:00pm</option>
					<option value='5:30pm'<?php if(' 5:30pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >5:30pm</option>
					<option value='6:00pm'<?php if(' 6:00pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >6:00pm</option>
					<option value='6:30pm'<?php if(' 6:30pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >6:30pm</option>
					<option value='7:00pm'<?php if(' 7:00pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >7:00pm</option>
					<option value='7:30pm'<?php if(' 7:30pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >7:30pm</option>
					<option value='8:00pm'<?php if(' 8:00pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >8:00pm</option>
					<option value='8:30pm'<?php if(' 8:30pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >8:30pm</option>
					<option value='9:00pm'<?php if(' 9:00pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >9:00pm</option>
					<option value='9:30pm'<?php if(' 9:30pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >9:30pm</option>
					<option value='10:00pm'<?php if(' 10:00pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >10:00pm</option>
					<option value='10:30pm'<?php if(' 10:30pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >10:30pm</option>
					<option value='11:00pm'<?php if(' 11:00pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >11:00pm</option>
					<option value='11:30pm'<?php if(' 11:30pm' == @$str[6][1]) {?>selected="selected" <?php } ?> >11:30pm</option>
					<option value='closed'<?php if(@$str[6][1] == ' closed') {?>selected="selected" <?php } ?> >Closed</option>
              </select>
   			</p>

	  </div>
    </div>

    <div class="form-group">
	    	<label class="control-label col-sm-4" for="email">&nbsp;</label>  
	    	<div class="col-sm-8 submitting"> 
		        <input type="submit" class="submit btn btn-primary" value="Submit">
			</div> 
	</div>

</form>


<script>
    // initialize input widgets first
    $('.time_hour .time').timepicker({
        'showDuration': true,
        'timeFormat': 'g:ia'
    });
    // initialize datepair
    $('#datepairExample').datepair();
</script>
<script>
	$(document).ready(function(){
		$('#apply').click(function(){
			var start_time = $("#toselect option:selected" ).text();
			var end_time = $("#fromselect option:selected" ).text();
			
			$('.start').val(start_time);
			$('.end').val(end_time);
		});

	});
</script>
