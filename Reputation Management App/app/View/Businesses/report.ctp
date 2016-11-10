
<?php if(isset($rating) || isset($ratingStatus) || isset($searchText))
         { 
        ?>
            <script type="text/javascript">
             var scrolled=0;
             scrolled=scrolled+1000;
             $(window).load(function() {
            $("html, body").animate({ scrollTop: scrolled }, 1000);
             });
           </script>        
         <?php } if(isset($business_report_id))
         {
          ?>
         <script type="text/javascript">
             var scrolled=0;
             scrolled=scrolled+500;
             $(window).load(function() {
            $("html, body").animate({ scrollTop: scrolled }, 1000);
             });
           </script> 
          <?php
        }
        ?>
<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php echo $this->element('nav')?>
<!-- BEGIN CONTENT -->

<div class="page-content-wrapper">
<div class="page-content">
        <!-- BEGIN PAGE HEADER-->
      <h3 class="page-title">
      <?php echo $design['AgencysiteSetting']['sitetitle']; ?> - Reporting
      </h3>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo HTTP_ROOT?>">Home</a>
            <i class="fa fa-angle-right"></i>
          </li>
          <li>
            <a href="#">Reporting</a>
          </li>
        </ul>
        <div class="page-toolbar">
           <div class="wrapTab">
    <?php if(count($customersReviews) > 0) { ?>
    <a style="cursor:pointer;" class="btn adNew" data-toggle="modal" data-target="#csv_export-model" >
       <img style="width:20px;height:20px;" src="<?php echo $this->webroot; ?>img/export.jpeg">
    </a> 
  <form method='post' id='savePDFForm' action="<?php echo HTTP_ROOT?>businesses/pdf" target="_blank">
      <input type='hidden' id='htmlContentHidden' name='htmlContent' value=''>
      <input type='button' id="downloadBtn" value='Export PDF' class='serasubmit btn btn-primary'>
  </form>        
   <?php } ?>        
   <form id="chosebusiness" method="post" action="<?php echo HTTP_ROOT?>businesses/report">
   <div class="show-report">
      <label>Show Report:</label>   
    <select onchange="this.form.submit()" name="data[Business][id]">
      <option value="">All Business</option>
      <?php foreach ($allbusiness as $key => $value) { ?>
           <option value="<?php echo $value['Business']['id']?>" 
           <?php if($value['Business']['id']==@$selectedId){?>selected="selected"<?php } ?>><?php echo $value['Business']['businessname'];?></option>
      <?php }?>
      
    </select>
    </div>
  </form>
 </div>  
        </div>
      </div>
      <!-- END PAGE HEADER-->

<div class="row">
 <div class="col-sm-10">
 <div id="content-wrapper">
 
   <div class="row">

 <div class="col-lg-6">
 <div class="portlet box yellow">
    <div class="portlet-title">
      <div class="caption">
          <i class="fa fa-bar-chart"></i>Reviews by Rating
      </div>
        <div class="tools">
          <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
          </a>
          <a href="javascript:;" class="reload" data-original-title="" title="">
          </a>
        </div>
    </div>


<div class="portlet-body">
 <div id="ex0"></div>
 </div>
 </div>
</div>

  <div class="col-lg-6">
  <div class="portlet box yellow">
    <div class="portlet-title">
      <div class="caption">
          <i class="fa fa-pie-chart"></i>Customer Response Rate
      </div>
        <div class="tools">
          <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
          </a>
          <a href="javascript:;" class="reload" data-original-title="" title="">
          </a>
        </div>
        
    </div>
      <div class="portlet-body">
           <div id="piechart" style="height: 300px;"></div>
               <?php
$totalReview=$onestar+$twostar+$threestar+$fourstar+$fivestar;
$ratingData = array(
        '0' => array('Element','Number Of Customers'),
        '1' => array('One Star', $onestar),
        '2' => array('Two Star', $twostar),
        '3' => array('Three Star',$threestar),
        '4' => array('Four Star', $fourstar),
        '5' => array('Five Star', $fivestar)
);
$feedbackData=array();
if($success){
  $feedbackData = array(
        '0' => array('Feedback Customers','Number Of Customers'),
        '1' => array('Feedback', $success),
        '2' => array('No Feedback Customers Yet', $notFeed));

}else{
  $feedbackData = array(
        '0' => array('Feedback Customers','Number Of Customers'),
        '1' => array('Feedback', 0),
        '2' => array('No Feedback Customers Yet', 0));
        
}


?>
      </div>
  </div>
</div>
</div>

<div class="row">
 <div class="col-lg-12">
 <div class="portlet box green">
 <div class="portlet-title">
      <div class="caption">
          <i class="fa fa-star"></i>Amount of Reviews for Each Rating
      </div>
        <div class="tools">
          <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
          </a>
          <a href="javascript:;" class="reload" data-original-title="" title="">
          </a>
        </div>
    </div>
      <div class="portlet-body">
 <div class="apped">
    <?php if($totalReview==0)$totalReview=1;?>

   <table class="table table-bordered table-striped">
                  <thead class="tbleHead">
                  <tr>
                     <!-- <th class="report-serial">Sr. N.</th> -->
             <th></td>
                      <th>1 Star</th>
                      <th>2 Star</th>
                      <th>3 Star</th>
              <th>4 Star</th>
              <th>5 Star</th>
                                         </tr>
                  </thead>
                  <tbody>
                    <tr>
                        
              <td>Reviews:</td>
              <td><?php echo $onestar?></td>
              <td><?php echo $twostar?></td>
              <td><?php echo $threestar?></td>
              <td><?php echo $fourstar?></td>
              <td><?php echo $fivestar?></td>
                     </tr>
             <tr>
              <td>Percentage:</td>
              <td><?php echo number_format((float)(($onestar/$totalReview)*100), 2, '.', '').'%'?></td>
              <td><?php echo number_format((float)(($twostar/$totalReview)*100), 2, '.', '').'%'?></td>
              <td><?php echo number_format((float)(($threestar/$totalReview)*100), 2, '.', '').'%'?></td>
              <td><?php echo number_format((float)(($fourstar/$totalReview)*100), 2, '.', '').'%'?></td>
              <td><?php echo number_format((float)(($fivestar/$totalReview)*100), 2, '.', '').'%'?></td>
             </tr>
                 
                  </tbody>
              </table>
</div>
</div>
</div>
</div>
</div>
<div class="row">
 <div class="col-lg-12">
 <div class="portlet box blue">
 <div class="portlet-title">
      <div class="caption">
          <i class="fa fa-user"></i>Customer Reviews
      </div>
        <div class="tools">
          <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
          </a>
          <a href="javascript:;" class="reload" data-original-title="" title="">
          </a>
        </div>
    </div>
      <div class="portlet-body">
          <div class="table-toolbar">
              
                <div class="row nonprintonpdf">
                
                  <div class="col-md-6 col-xs-6">
                    <form method="post" id="search-reviews" class="form-inline" action="<?php echo HTTP_ROOT?>businesses/report">
                    <input type="hidden" name="data[Business][id]" value="<?php echo @$selectedId;?>">
                    
                    <div class="input-group">
                    <label class="sr-only" for="inputPassword2"> </label>
                    <input type="text" name="data[searchForm][search]" placeholder="Search Customers or Reviews" id="searchname" class="form-control fieldtext input-large input-inline">
                    
                    <div class="errorTxt" style="margin-left: 0px;color:#bb0000"></div>
                    <span class="input-group-btn">
                    <input type="submit" value="Search" class="serasubmit btn blue btn-primary">
                    </span>
                    </div>
                    </form>
                  </div>
                  <div class="col-md-6 col-xs-6">
                    <div class="btn-group pull-right">
                                <form method="post" id="filterBy" class="form-inline" action="<?php echo HTTP_ROOT?>businesses/report">
                            <input type="hidden" name="data[Business][id]" value="<?php echo @$selectedId;?>">
                              
                                Filter By
                                
                                 <label class="checkbox-inline">
                                
                                <input type="checkbox" value="1" name="data[BusinessReview][starrating]" <?php if(@$rating==1){ ?>checked="checked"<?php } ?>/>One Star</label>
                                
                                  <label class="checkbox-inline">
                              
                                <input type="checkbox" value="2" name="data[BusinessReview][starrating]" <?php if(@$rating==2){ ?>checked="checked"<?php } ?> />Two Star</label>
                                 
                                <label class="checkbox-inline">
                                
                                <input type="checkbox" value="3" name="data[BusinessReview][starrating]" <?php if(@$rating==3){ ?>checked="checked"<?php } ?> />Three Star</label>
                                
                                <label class="checkbox-inline">
                              
                                <input type="checkbox" value="4" name="data[BusinessReview][starrating]" <?php if(@$rating==4){ ?>checked="checked"<?php } ?> />Four Star</label>
                                
                                <label class="checkbox-inline">
                              
                                <input type="checkbox" value="5" name="data[BusinessReview][starrating]" <?php if(@$rating==5){ ?>checked="checked"<?php } ?> />Five Star</label>  
                                
                                
                          </form>
                    </div>
                  </div>
                                
                </div>
              </div>
<div class="wrapTab">
            <div class="bodyTaab">
      
 
            <div data-example-id="bordered-table " class="bs-example nonprintonpdf">
              <table class="table table-bordered table-striped">
                  <thead class="tbleHead">
                  <tr>
                     <!-- <th class="report-serial">Sr. N.</th> -->
                      <th><?php echo $this->Paginator->sort('Customer.firstname','First Name'); ?></th>
                      <th class="last-serial acuupied"><?php echo $this->Paginator->sort('Customer.firstname','Last Name'); ?></th>
                      <th class="fed-back"><?php echo $this->Paginator->sort('BusinessReview.ratingdate','Feedback Date'); ?></a></th>
                      <th class="last-serial fed-phn"><?php echo $this->Paginator->sort('Customer.phonenumber','Phone'); ?></th>
                      <th><?php echo $this->Paginator->sort('Customer.email','Email'); ?></th>
                    <!--  <th class="employee-serial"><?php echo $this->Paginator->sort('Business.businessname','Employee'); ?></th> -->
                      <th class="fed_rating"><?php echo $this->Paginator->sort('BusinessReview.ratingstar','Rating'); ?></th>
                      <th class="dash-serial">Action</th>                  
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($customersReviews)){?>
                  <?php foreach ($customersReviews as $key => $review) {?>
                    <tr>
                        <!--<td><?php echo h($key+1); ?></td> -->
                        <td><?php echo $review['Customer']['firstname']; ?></td>
                        <td><?php echo $review['Customer']['lastname']; ?></td>
                        <td>
                          <?php 
                            $date = strtotime($review['BusinessReview']['ratingdate']);
                                    $dat = date('Y-m-d', $date);
                                    $tme = date('H:m:s A',$date);
                                    echo $dat;
                          ?>
                        </td>
                        <td><?php echo $review['Customer']['phonenumber']; ?></td>
                        <td><?php echo $review['Customer']['email']; ?></td>
                        <td>
                        <?php 
                            for($i=1;$i<=5;$i++){ 
                        ?>    
                              <?php if($i<=$review['BusinessReview']['ratingstar']){ ?>
                                <img src="<?php echo HTTP_ROOT?>/img/star.png">
                              <?php } else {?>
                                 <img src="<?php echo HTTP_ROOT?>img/small.png">
                              <?php }?>
                            
                        <?php }?>
                          
                           
                        </td>
                        <td><a href="<?php echo HTTP_ROOT.'businesses/customerView/'.$review['BusinessReview']['id']?>">View</a></td>
                      </tr>
                  <?php } ?>    
                  <?php } else{?>   
                    <tr><th colspan="7" style="text-align:center;"> <?php echo "No record found.";?></th></td></tr>
                  <?php }?>
                  </tbody>
              </table>
               <?php //if(count($customersReviews)>0){?>
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
                <?php //}?>  
               
      </div> 
       <div data-example-id="bordered-table " class="bs-example onlypdfdisplay" style="display:none;">
              <table class="table table-bordered table-striped">
                  <thead class="tbleHead">
                  <tr>
                     <!-- <th class="report-serial">Sr. N.</th> -->
                      <th><?php echo $this->Paginator->sort('Customer.firstname','First Name'); ?></th>
                      <th class="last-serial acuupied"><?php echo $this->Paginator->sort('Customer.firstname','Last Name'); ?></th>
                      <th class="fed-back"><?php echo $this->Paginator->sort('BusinessReview.ratingdate','Feedback Date'); ?></a></th>
                      <th class="last-serial fed-phn"><?php echo $this->Paginator->sort('Customer.phonenumber','Phone'); ?></th>
                      <th><?php echo $this->Paginator->sort('Customer.email','Email'); ?></th>
                    <!--  <th class="employee-serial"><?php echo $this->Paginator->sort('Business.businessname','Employee'); ?></th> -->
                      <th class="fed_rating"><?php echo $this->Paginator->sort('BusinessReview.ratingstar','Rating'); ?></th>
                                       
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($customersReviews)){?>
                  <?php foreach ($customersReviews as $key => $review) {?>
                    <tr>
                        <!--<td><?php echo h($key+1); ?></td> -->
                        <td><?php echo $review['Customer']['firstname']; ?></td>
                        <td><?php echo $review['Customer']['lastname']; ?></td>
                        <td>
                          <?php 
                            $date = strtotime($review['BusinessReview']['ratingdate']);
                                    $dat = date('Y-m-d', $date);
                                    $tme = date('H:m:s A',$date);
                                    echo $dat;
                          ?>
                        </td>
                        <?php if(!empty($review['Customer']['phonenumber'])) { ?>
                        <td><?php echo $review['Customer']['phonenumber']; ?></td><?php } else {?>
                        <td><?php echo "N/A" ?><?php } ?></td>
                        <td><?php echo $review['Customer']['email']; ?></td>
                         <td>
                      <?php echo $review['BusinessReview']['ratingstar']?>
                         </td>
                        
                        
                      </tr>
                  <?php } ?>    
                  <?php } else{?>   
                    <tr><th colspan="7" style="text-align:center;"> <?php echo "No record found.";?></th></td></tr>
                  <?php }?>
                  </tbody>
              </table> 
        </div>  

        </div>    
        </div>   
    </div>
        </div>
    </div>
        </div>   
    
   
</div> 
</div> 
        <?php echo $this->element('reviewsidebar')?>  
      
     </div> 
  
   </div>
   </div>
   
  <script type="text/javascript">
$(document).ready(function(){
    $('#search-reviews').validate({
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
<script>
    google.load('visualization', '1.0', {'packages':['corechart']});
       google.setOnLoadCallback(drawChart);
       function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', '<?php echo $ratingData[0][0]?>');
        data.addColumn('number', '<?php echo $ratingData[0][1]?>');
        data.addRows([
          ['<?php echo $ratingData[1][0]?>',parseInt("<?php echo $ratingData[1][1]?>")],
          ['<?php echo $ratingData[2][0]?>',parseInt("<?php echo $ratingData[2][1]?>")],
          ['<?php echo $ratingData[3][0]?>',parseInt("<?php echo $ratingData[3][1]?>")],
          ['<?php echo $ratingData[4][0]?>',parseInt("<?php echo $ratingData[4][1]?>")],
          ['<?php echo $ratingData[5][0]?>',parseInt("<?php echo $ratingData[5][1]?>")],
        ]);
     var options = {
        width: 600,
        height:300,
        hAxis: {
          title: 'Rating',
          gridlines: {count: 5},
         chartArea:{left:50,top:60,width:'100%',height:'80%'},
        },
        vAxis: {
          title: 'Customers (scale of 1-10)'
        },
         titleTextStyle: {fontName: 'Lato', fontSize: 18, bold: true},
        colors:['#0F4F8D','#2B85C1','#8DA9BF','#F2C38D','#E6AC03'],
         
        };
        var chart_div = document.getElementById('ex0');
        var chart = new google.visualization.ColumnChart(chart_div);
       /*google.visualization.events.addListener(chart, 'ready', function ()      {
         chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
        });*/
 
        chart.draw(data, options);
      }
</script>
 
    <script type="text/javascript">
    google.load('visualization', '1.0', {'packages':['corechart']});
       google.setOnLoadCallback(drawChart);
       function drawChart() {
      var data = new google.visualization.DataTable();
        data.addColumn('string', '<?php echo $feedbackData[0][0]?>');
        data.addColumn('number', '<?php echo $feedbackData[0][1]?>');
         data.addRows([
          ['<?php echo $feedbackData[1][0]?>',parseInt("<?php echo $feedbackData[1][1]?>")],
          ['<?php echo $feedbackData[2][0]?>',parseInt("<?php echo $feedbackData[2][1]?>")],
        ]);
     var options = {title:'Customers Feedback',
         titleTextStyle: {fontName: 'Lato', fontSize: 18, bold: true},
         colors:['#0F4F8D','#2B85C1'],
         chartArea:{left:30,top:30,width:'100%',height:'80%'}};
        var chart_div = document.getElementById('piechart');
        var chart = new google.visualization.PieChart(chart_div);
       /*google.visualization.events.addListener(chart, 'ready', function ()      {
         chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
        });*/
 
        chart.draw(data, options);
      }
</script>

 <script>
jQuery(document).ready(function() {
          jQuery("#downloadBtn").on("click", function() {
            $('.nonprintonpdf').css('display','none');
            $('.onlypdfdisplay').css('display','block');
             var htmlContent = jQuery("#mainpdfcontainer").html();
            jQuery("#htmlContentHidden").val(htmlContent);
            jQuery('#savePDFForm').submit();
            setTimeout(function(){location.reload(true);},100);

        });
      });
</script>
  <div class="modal fade" id="csv_export-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">
            &times;
          </span>
        </button>
        <h4 class="upload-title">
          Export file
        </h4>
        <h5 class="filter-title">
          Filter options
        </h5>
        
      </div>
      
      <div class="modal-body">
        <form id="frmsubmit" method="post" action="
<?php echo HTTP_ROOT?>
businesses/exportReport/
<?php echo @$business_report_id ?>
">
  
  <h5 class="export-title" id="exampleModalLabel">
    Export All (select All)
  </h5>
  
  
  <div class="main_slct">
    <input type="checkbox" value="allType" class="all" name="data[exportby][all]">
    <span>
      Select All
    </span>
  </div>
  
  <div class="main_slct">
    <input type="checkbox" value="1" class="particular" name="data[exportby][search]">
    <span>
      1 Star
    </span>
  </div>
  
  <div class="main_slct">
    <input type="checkbox" value="2" class="particular" name="data[exportby][search]">
    <span>
      2 Star
    </span>
  </div>
  
  <div class="main_slct">
    <input type="checkbox" value="3" class="particular" name="data[exportby][search]">
    <span>
      3 Star
    </span>
  </div>
  
  <div class="main_slct">
    <input type="checkbox" value="4" class="particular" name="data[exportby][search]">
    <span>
      4 Star
    </span>
  </div>
  
  <div class="main_slct">
    <input type="checkbox" value="5" class="particular" name="data[exportby][search]">
    <span>
      5 Star
    </span>
  </div>
  
  <div class="main_slcted">
    <input type="button" class="btnSubmit btn-primary btn" value="ExportFile">
  </button>
  <div id="notificationexport" style="display:none;color:red">
  </div>
  <div id="notificationexport" style="display:none;color:red">
  </div>
                                  </div>
                                  
                                </div>
                              </form>
                              
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default buttonclose close_modal" data-dismiss="modal">
                                  Close
                                </button>
                              </div>
  </div>
</div>
</div>
</div>

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
  $("input:checkbox").on('click', function() {
      var $box = $(this);
      if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);

      } else {
        $box.prop("checked", false);
      }
      $('#filterBy').submit();  
    });
</script>
<script>
    google.load('visualization', '1.0', {'packages':['corechart']});
       google.setOnLoadCallback(drawChart);
       function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', '<?php echo $ratingData[0][0]?>');
        data.addColumn('number', '<?php echo $ratingData[0][1]?>');
        data.addRows([
          ['<?php echo $ratingData[1][0]?>',parseInt("<?php echo $ratingData[1][1]?>")],
          ['<?php echo $ratingData[2][0]?>',parseInt("<?php echo $ratingData[2][1]?>")],
          ['<?php echo $ratingData[3][0]?>',parseInt("<?php echo $ratingData[3][1]?>")],
          ['<?php echo $ratingData[4][0]?>',parseInt("<?php echo $ratingData[4][1]?>")],
          ['<?php echo $ratingData[5][0]?>',parseInt("<?php echo $ratingData[5][1]?>")],
        ]);
     var options = {
        width: 600,
        height:300,
        hAxis: {
          title: 'Rating',
          gridlines: {count: 5},
         chartArea:{left:50,top:60,width:'100%',height:'80%'},
        },
        vAxis: {
          title: 'Customers (scale of 1-10)'
        },
         titleTextStyle: {fontName: 'Lato', fontSize: 18, bold: true},
        colors:['#0F4F8D','#2B85C1','#8DA9BF','#F2C38D','#E6AC03'],
         
        };
        var chart_div = document.getElementById('ex1');
        var chart = new google.visualization.ColumnChart(chart_div);
       google.visualization.events.addListener(chart, 'ready', function ()      {
         chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
        });
 
        chart.draw(data, options);
      }
</script>
 
    <script type="text/javascript">
    google.load('visualization', '1.0', {'packages':['corechart']});
       google.setOnLoadCallback(drawChart);
       function drawChart() {
      var data = new google.visualization.DataTable();
        data.addColumn('string', '<?php echo $feedbackData[0][0]?>');
        data.addColumn('number', '<?php echo $feedbackData[0][1]?>');
         data.addRows([
          ['<?php echo $feedbackData[1][0]?>',parseInt("<?php echo $feedbackData[1][1]?>")],
          ['<?php echo $feedbackData[2][0]?>',parseInt("<?php echo $feedbackData[2][1]?>")],
        ]);
     var options = {title:'Customers Feedback',
         titleTextStyle: {fontName: 'Lato', fontSize: 18, bold: true},
         colors:['#0F4F8D','#2B85C1'],
         chartArea:{left:30,top:30,width:'100%',height:'80%'}};
        var chart_div = document.getElementById('piechart1');
        var chart = new google.visualization.PieChart(chart_div);
       google.visualization.events.addListener(chart, 'ready', function ()      {
         chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
        });
 
        chart.draw(data, options);
      }
</script>




<div id="mainpdfcontainer" class="onlypdfdisplay" style="display:none;">
   <div class="row">

 <div class="col-lg-6">
 <div class="portlet box yellow">
    <div class="portlet-title">
      <div class="caption">
          <i class="fa fa-bar-chart"></i>Reviews by Rating
      </div>
        <div class="tools">
          <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
          </a>
          <a href="javascript:;" class="reload" data-original-title="" title="">
          </a>
        </div>
    </div>


<div class="portlet-body">
 <div id="ex1"></div>
 </div>
 </div>
</div>

  <div class="col-lg-6">
  <div class="portlet box yellow">
    <div class="portlet-title">
      <div class="caption">
          <i class="fa fa-pie-chart"></i>Customer Response Rate
      </div>
        <div class="tools">
          <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
          </a>
          <a href="javascript:;" class="reload" data-original-title="" title="">
          </a>
        </div>
        
    </div>
      <div class="portlet-body">
           <div id="piechart1" style="height: 300px;"></div>
               <?php
$totalReview=$onestar+$twostar+$threestar+$fourstar+$fivestar;
$ratingData = array(
        '0' => array('Element','Number Of Customers'),
        '1' => array('One Star', $onestar),
        '2' => array('Two Star', $twostar),
        '3' => array('Three Star',$threestar),
        '4' => array('Four Star', $fourstar),
        '5' => array('Five Star', $fivestar)
);
$feedbackData=array();
if($success){
  $feedbackData = array(
        '0' => array('Feedback Customers','Number Of Customers'),
        '1' => array('Feedback', $success),
        '2' => array('No Feedback Customers Yet', $notFeed));

}else{
  $feedbackData = array(
        '0' => array('Feedback Customers','Number Of Customers'),
        '1' => array('Feedback', 0),
        '2' => array('No Feedback Customers Yet', 0));
        
}


?>
      </div>
  </div>
</div>
</div>

<div class="row">
 <div class="col-lg-12">
 <div class="portlet box green">
 <div class="portlet-title">
      <div class="caption">
          <i class="fa fa-star"></i>Amount of Reviews for Each Rating
      </div>
        <div class="tools">
          <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
          </a>
          <a href="javascript:;" class="reload" data-original-title="" title="">
          </a>
        </div>
    </div>
      <div class="portlet-body">
 <div class="apped">
    <?php if($totalReview==0)$totalReview=1;?>

   <table class="table table-bordered table-striped">
                  <thead class="tbleHead">
                  <tr>
                     <!-- <th class="report-serial">Sr. N.</th> -->
             <th></td>
                      <th>1 Star</th>
                      <th>2 Star</th>
                      <th>3 Star</th>
              <th>4 Star</th>
              <th>5 Star</th>
                                         </tr>
                  </thead>
                  <tbody>
                    <tr>
                        
              <td>Reviews:</td>
              <td><?php echo $onestar?></td>
              <td><?php echo $twostar?></td>
              <td><?php echo $threestar?></td>
              <td><?php echo $fourstar?></td>
              <td><?php echo $fivestar?></td>
                     </tr>
             <tr>
              <td>Percentage:</td>
              <td><?php echo number_format((float)(($onestar/$totalReview)*100), 2, '.', '').'%'?></td>
              <td><?php echo number_format((float)(($twostar/$totalReview)*100), 2, '.', '').'%'?></td>
              <td><?php echo number_format((float)(($threestar/$totalReview)*100), 2, '.', '').'%'?></td>
              <td><?php echo number_format((float)(($fourstar/$totalReview)*100), 2, '.', '').'%'?></td>
              <td><?php echo number_format((float)(($fivestar/$totalReview)*100), 2, '.', '').'%'?></td>
             </tr>
                 
                  </tbody>
              </table>
</div>
</div>
</div>
</div>
</div>
<div class="row">
 <div class="col-lg-12">
 <div class="portlet box blue">
 <div class="portlet-title">
      <div class="caption">
          <i class="fa fa-user"></i>Customer Reviews
      </div>
        <div class="tools">
          <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
          </a>
          <a href="javascript:;" class="reload" data-original-title="" title="">
          </a>
        </div>
    </div>
      <div class="portlet-body">
          <div class="table-toolbar">
              
                <div class="row nonprintonpdf">
                
                  <div class="col-md-6 col-xs-6">
                    <form method="post" id="search-reviews" class="form-inline" action="<?php echo HTTP_ROOT?>businesses/report">
                    <input type="hidden" name="data[Business][id]" value="<?php echo @$selectedId;?>">
                    
                    <div class="input-group">
                    <label class="sr-only" for="inputPassword2"> </label>
                    <input type="text" name="data[searchForm][search]" placeholder="Search Customers or Reviews" id="searchname" class="form-control fieldtext input-large input-inline">
                    
                    <div class="errorTxt" style="margin-left: 0px;color:#bb0000"></div>
                    <span class="input-group-btn">
                    <input type="submit" value="Search" class="serasubmit btn blue btn-primary">
                    </span>
                    </div>
                    </form>
                  </div>
                  <div class="col-md-6 col-xs-6">
                    <div class="btn-group pull-right">
                                <form method="post" id="filterBy" class="form-inline" action="<?php echo HTTP_ROOT?>businesses/report">
                            <input type="hidden" name="data[Business][id]" value="<?php echo @$selectedId;?>">
                              
                                Filter By
                                
                                 <label class="checkbox-inline">
                                
                                <input type="checkbox" value="1" name="data[BusinessReview][starrating]" <?php if(@$rating==1){ ?>checked="checked"<?php } ?>/>One Star</label>
                                
                                  <label class="checkbox-inline">
                              
                                <input type="checkbox" value="2" name="data[BusinessReview][starrating]" <?php if(@$rating==2){ ?>checked="checked"<?php } ?> />Two Star</label>
                                 
                                <label class="checkbox-inline">
                                
                                <input type="checkbox" value="3" name="data[BusinessReview][starrating]" <?php if(@$rating==3){ ?>checked="checked"<?php } ?> />Three Star</label>
                                
                                <label class="checkbox-inline">
                              
                                <input type="checkbox" value="4" name="data[BusinessReview][starrating]" <?php if(@$rating==4){ ?>checked="checked"<?php } ?> />Four Star</label>
                                
                                <label class="checkbox-inline">
                              
                                <input type="checkbox" value="5" name="data[BusinessReview][starrating]" <?php if(@$rating==5){ ?>checked="checked"<?php } ?> />Five Star</label>  
                                
                                
                          </form>
                    </div>
                  </div>
                                
                </div>
              </div>
<div class="wrapTab">
            <div class="bodyTaab">
      
 
            <div data-example-id="bordered-table " class="bs-example nonprintonpdf">
              <table class="table table-bordered table-striped">
                  <thead class="tbleHead">
                  <tr>
                     <!-- <th class="report-serial">Sr. N.</th> -->
                      <th><?php echo $this->Paginator->sort('Customer.firstname','First Name'); ?></th>
                      <th class="last-serial acuupied"><?php echo $this->Paginator->sort('Customer.firstname','Last Name'); ?></th>
                      <th class="fed-back"><?php echo $this->Paginator->sort('BusinessReview.ratingdate','Feedback Date'); ?></a></th>
                      <th class="last-serial fed-phn"><?php echo $this->Paginator->sort('Customer.phonenumber','Phone'); ?></th>
                      <th><?php echo $this->Paginator->sort('Customer.email','Email'); ?></th>
                    <!--  <th class="employee-serial"><?php echo $this->Paginator->sort('Business.businessname','Employee'); ?></th> -->
                      <th class="fed_rating"><?php echo $this->Paginator->sort('BusinessReview.ratingstar','Rating'); ?></th>
                      <th class="dash-serial">Action</th>                  
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($customersReviews)){?>
                  <?php foreach ($customersReviews as $key => $review) {?>
                    <tr>
                        <!--<td><?php echo h($key+1); ?></td> -->
                        <td><?php echo $review['Customer']['firstname']; ?></td>
                        <td><?php echo $review['Customer']['lastname']; ?></td>
                        <td>
                          <?php 
                            $date = strtotime($review['BusinessReview']['ratingdate']);
                                    $dat = date('Y-m-d', $date);
                                    $tme = date('H:m:s A',$date);
                                    echo $dat;
                          ?>
                        </td>
                        <td><?php echo $review['Customer']['phonenumber']; ?></td>
                        <td><?php echo $review['Customer']['email']; ?></td>
                        <td>
                        <?php 
                            for($i=1;$i<=5;$i++){ 
                        ?>    
                              <?php if($i<=$review['BusinessReview']['ratingstar']){ ?>
                                <img src="<?php echo HTTP_ROOT?>/img/star.png">
                              <?php } else {?>
                                 <img src="<?php echo HTTP_ROOT?>img/small.png">
                              <?php }?>
                            
                        <?php }?>
                          
                           
                        </td>
                        <td><a href="<?php echo HTTP_ROOT.'businesses/customerView/'.$review['BusinessReview']['id']?>">View</a></td>
                      </tr>
                  <?php } ?>    
                  <?php } else{?>   
                    <tr><th colspan="7" style="text-align:center;"> <?php echo "No record found.";?></th></td></tr>
                  <?php }?>
                  </tbody>
              </table>
               <?php //if(count($customersReviews)>0){?>
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
                <?php //}?>  
               
      </div> 
       <div data-example-id="bordered-table " class="bs-example onlypdfdisplay" style="display:none;">
              <table class="table table-bordered table-striped">
                  <thead class="tbleHead">
                  <tr>
                     <!-- <th class="report-serial">Sr. N.</th> -->
                      <th><?php echo $this->Paginator->sort('Customer.firstname','First Name'); ?></th>
                      <th class="last-serial acuupied"><?php echo $this->Paginator->sort('Customer.firstname','Last Name'); ?></th>
                      <th class="fed-back"><?php echo $this->Paginator->sort('BusinessReview.ratingdate','Feedback Date'); ?></a></th>
                      <th class="last-serial fed-phn"><?php echo $this->Paginator->sort('Customer.phonenumber','Phone'); ?></th>
                      <th><?php echo $this->Paginator->sort('Customer.email','Email'); ?></th>
                    <!--  <th class="employee-serial"><?php echo $this->Paginator->sort('Business.businessname','Employee'); ?></th> -->
                      <th class="fed_rating"><?php echo $this->Paginator->sort('BusinessReview.ratingstar','Rating'); ?></th>
                                       
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($customersReviews)){?>
                  <?php foreach ($customersReviews as $key => $review) {?>
                    <tr>
                        <!--<td><?php echo h($key+1); ?></td> -->
                        <td><?php echo $review['Customer']['firstname']; ?></td>
                        <td><?php echo $review['Customer']['lastname']; ?></td>
                        <td>
                          <?php 
                            $date = strtotime($review['BusinessReview']['ratingdate']);
                                    $dat = date('Y-m-d', $date);
                                    $tme = date('H:m:s A',$date);
                                    echo $dat;
                          ?>
                        </td>
                        <?php if(!empty($review['Customer']['phonenumber'])) { ?>
                        <td><?php echo $review['Customer']['phonenumber']; ?></td><?php } else {?>
                        <td><?php echo "N/A" ?><?php } ?></td>
                        <td><?php echo $review['Customer']['email']; ?></td>
                         <td>
                      <?php echo $review['BusinessReview']['ratingstar']?>
                         </td>
                        
                        
                      </tr>
                  <?php } ?>    
                  <?php } else{?>   
                    <tr><th colspan="7" style="text-align:center;"> <?php echo "No record found.";?></th></td></tr>
                  <?php }?>
                  </tbody>
              </table> 
        </div>  

        </div>    
        </div>   
    </div>
        </div>
    </div>
        </div>   
    
</div>   
</div> 
</div> 
</div>
</div>
