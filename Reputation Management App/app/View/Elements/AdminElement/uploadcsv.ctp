 <!-- For upload CSV -->
 <div class="modal fade" id="csv-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="upload-title">Upload CSV file</h4>
                                </div>
                                <div class="modal-body imperiel">

                                  <p>Please check that your CSV has our Standerd column name.<a href="javascript:void(0)">Read More</a></p>
                                  <p>Choose a .csv file from your computer.</p>
                                  <p>You can choose to drip your feedback request over a period of time by selecting in the drop down below.</br> 
                                    for example.Uploading 30 contacts and selecting 10 days will drip 3 feedback request per day for a 10 day period</p>
                                   <!-- <select>
                                      <option value="immidiate">immidiate</option>
                                      <option value="immidiate">immidiate</option>
                                      <option value="immidiate">immidiate</option>
                                      <option value="immidiate">immidiate</option>
                                      <option value="immidiate">immidiate</option>
                                      <option value="immidiate">immidiate</option>
                                    </select> -->
                                    
                                  <!--<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> -->
                                   <form action="<?php echo HTTP_ROOT ?>Employee/importcsv" method="post" enctype="multipart/form-data" name="form1" id="csvimportform">
                                    <div class="choose_pop">
                                    <label>Choose your file: </label>
                                    <input name="csv" type="file" id="csv" class="uploaded" />
                                    </div>
                                    
                                   <!-- <input type="submit" name="Submit" value="Submit" />-->
                                    <input type="button" class="btn importcsv btn-primary" value="ImportFile"></button>
                                  </form> 
                                 <div id="notificationfile" style="display:none;color:red;"></div>                                    
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default close_modal" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                      </div>


 


 <div class="modal fade" id="csv_export-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="upload-title">Export file</h4>
                                  <h5 class="filter-title">Filter options</h5>
                                  
                                </div>
                               
                                <div class="modal-body">
                                  <form id="frmsubmit" method="post" action="<?php echo HTTP_ROOT?>Employee/export"> 
                                   <h5 class="export-title">Export All (select All)</h5>

      <div class="main_slct">
      <input type="checkbox" value="allType" class="all" name="data[exportby][all]">
      <span>Select All</span>
      </div>

      <div class="main_slct">
      <input type="checkbox" value="1" class="particular" name="data[exportby][search]">
      <span>1 Star</span>
      </div>
      
      <div class="main_slct">
      <input type="checkbox" value="2" class="particular" name="data[exportby][search]">
      <span>2 Star</span>
      </div>
      
      <div class="main_slct">
      <input type="checkbox" value="3" class="particular" name="data[exportby][search]">
      <span>3 Star</span>
      </div>
      
      <div class="main_slct">
      <input type="checkbox" value="4" class="particular" name="data[exportby][search]">
      <span>4 Star</span>
      </div>
      
      <div class="main_slct">
      <input type="checkbox" value="5" class="particular" name="data[exportby][search]">
      <span>5 Star</span>
      </div>
      
      <div class="main_slct">
      <input type="checkbox" value="NoFeedbackLeft" class="particular" name="data[exportby][search]">
      <span>No feedback left</span>
      </div>
      
      <div class="main_slct">
      <input type="checkbox" value="NotInFeedbackSequence" class="particular" name="data[exportby][search]">
      <span>Not in feedback sequence</span>
      </div>
      
      <div class="main_slct">                                
      <input type="checkbox" value="InFeedbackSequence" class="particular" name="data[exportby][search]">
      <span>in feedback sequence</span>
      </div>
                                       
      <div class="main_slct">
      <input type="checkbox" value="Opt-Out" class="particular" name="data[exportby][search]">
      <span>Opt-Out</span>
      </div>
      
      <input type="button" class="btn importcsv btn-primary btnSubmit" value="ExportFile"></button>
      
      <div id="notificationexport" style="display:none;color:red"></div>
                                   
                                 </div>
                                </form> 
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default close_modal buttonclose" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                      </div>



  <script type="text/javascript">
   $('document').ready(function(){
     $(document).on('click','.all',function() {
      $('.particular').prop('checked',true);
       $(this).addClass('uncheckAll');
        $('.btnSubmit').click(function() {
          
        $('#frmsubmit').submit();
        $('.buttonclose').trigger( "click" ); 
        }); 
    });
    $(document).on('click','.uncheckAll',function() {
      $('.particular').prop('checked',false);
       $(this).removeClass('uncheckAll');
       $('.all').removeAttr('checked'); 
    });  
      $('.particular').click(function(){
      $('.particular').removeClass('active');
      $(this).addClass('active');
      $(this).attr('checked',true);
      $('.all').removeAttr('checked');
      $('input[type=checkbox]').each(function () {
        if( $( this ).hasClass( 'active' ))
        {
          $(this).attr('checked',true);
        }
        else
        {
          $(this).removeAttr('checked');
        }

      return;

    });

     $('.btnSubmit').click(function() { 
       $('#frmsubmit').submit();
        $('.buttonclose').trigger( "click" ); 
       }); 
   });
  });
 </script>
 <script type="text/javascript">
 $(document).ready(function(){
 $('.btnSubmit').click(function(){
  var count = $("[type='checkbox']:checked").length;
  if( count > 0)
  {
        $('#frmsubmit').submit();
        $('.buttonclose').trigger( "click" );
  }else{
            $('#notificationexport').text('Pease select any option to generate the csv file');
            $('#notificationexport').show();
            $('#notificationexport').delay(2000).fadeOut();
            return false;
  }

  
 }); 
 });
 </script>
 <script type="text/javascript">
$(document).ready(function(){
  $('.importcsv').click(function(){
    var filename = $('input[type=file]').val();
    var extension = filename.substr( (filename.lastIndexOf('.') +1) );
    if( extension == 'csv' )
    {
      $('#csvimportform').submit();
      return true;
    }
    else
    {
            $('#notificationfile').text('Please select file .csv extension.');
            $('#notificationfile').show();
            $('#notificationfile').delay(2000).fadeOut();
            return false;

    }
    
  });
 

});
</script>
 <script type="text/javascript">
$(document).ready(function(){
    $('#QuickAddCustomer').validate({
           event:'blur',
            rules:
            {
             
                "data[Customer][firstname]":
                {
                    required:true,
                    minlength:5,
                    //remote:ajax_url+'users/validate_first_name'
                },
                "data[Customer][lastname]":
                {
                    //required:true,
                    //minlength:5,
                    //remote:ajax_url+'users/validate_first_name'
                },


                "data[Customer][email]":
                {
                    required:true,
                    email:true,
                    remote:ajax_url+'dashboard/checkEmail_user/<?php echo $busid?>'
                },

            },
            messages:
            { 
                "data[Customer][firstname]":
                {
                    required:"Please enter the first name."
                    //minlength: 'First Name should be atleast 5 characters long.',
                    //remote:"Only alphabets."
              },
              "data[Customer][lastname]":
              {
               // required:"Please enter the last name."
              },
             "data[Customer][email]":
                {
                    required:"Please enter the company Email address",
                    email:"Please enter a valid email.",
                    remote:"This Email already exist."
                },
                

            }
        
        
        });
        
    
    });
</script>




<style>
.modal-header {
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color: #0480be;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
 }
</style>








