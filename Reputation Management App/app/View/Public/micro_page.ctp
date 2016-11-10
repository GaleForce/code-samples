
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	

<div class="container">
<div class="micro-inner-strt">

<div class="row">
<div class="col-md-8">
<div class="micro-infor">

<div class="row">
<div class="col-md-9">
<div class="micro-co">
<?php foreach ($business_rec as $business) {?>

<h3><?php echo $business['Business']['businessname']?></h3>
<p><?php echo $business['Business']['business_description']?></p>

</div>
</div>
<div class="col-md-3">
<div class="micro-rating">
<ul>
<?php for($i=0;$i<round($ratstar['Business']['averageRating']);$i++){?>
<li><span aria-hidden="true" class="glyphicon glyphicon-star"></span></li>
<?php }?>
</ul>
<div class="reviews-status"><?php echo count($client_rev)?> Reviews</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-9">
<div class="co-address">
<ul>
  <li><span aria-hidden="true" class="glyphicon glyphicon-globe"></span><em><?php echo $business['Business']['addressline1']?></em></li>
  <li><span aria-hidden="true" class="glyphicon glyphicon-phone"></span><em><?php echo $business['Business']['phone']?></em></li>
  <?php  $debus = json_decode($business['Business']['business_hours']);
      $con = array();
      for ($i=0; $i <count($debus) ; $i++) { 
          $str = explode('=>',$debus[$i]);
         // $conHour[] = $str[0]. "".$str[1];
	  if(in_array(' closed', $str)){
            $conHour[] = $str[0];
          }else{
            $conHour[] = $str[0]. "".$str[1];
          }
      }
      ?>
  <?php $now = time();
    $day = date("l",$now);
    if($day == 'Monday') {?>
  <li>Today's Hour: <?php echo @$conHour[0] ?></li>
  <?php }elseif ($day == 'Tuesday') { ?>
  <li>Today's Hour: <?php echo @$conHour[1] ?></li>
  <?php }elseif ($day == 'Wednesday') { ?>
  <li>Today's Hour: <?php echo @$conHour[2] ?></li>
  <?php }elseif ($day == 'Thursday') { ?>
  <li>Today's Hour: <?php echo @$conHour[3] ?></li>
  <?php }elseif ($day == 'Friday') { ?>
  <li>Today's Hour: <?php echo @$conHour[4] ?></li>
  <?php }elseif ($day == 'Saturday') { ?>
  <li>Today's Hour: <?php echo @$conHour[5] ?></li>
  <?php }elseif ($day == 'Sunday') { ?>
   <li>Today's Hour: <?php echo @$conHour[6] ?></li>
  <?php }?>    
  <li><span aria-hidden="true" class="glyphicon glyphicon-envelope"></span><em><?php echo $business['User']['email']?></em></li>
  <li><span aria-hidden="true" class="glyphicon glyphicon-calendar"></span><em><?php echo $business['Business']['companywebaddress']?></em></li>
</ul>
</div>
<div class="micro-social">
<ul>
<li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Facebook"><img src="<?php echo $this->webroot; ?>img/facebook.jpg"></a></li>
<li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Twitter"><img src="<?php echo $this->webroot; ?>img/twitter.jpg"></a></li>
<li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Google+"><img src="<?php echo $this->webroot; ?>img/google+.jpg"></a></li>
<li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Linkedin"><img src="<?php echo $this->webroot; ?>img/linkedn.jpg"></a></li>
<li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Yelp"><img src="<?php echo $this->webroot; ?>img/yelp-2.jpg"></a></li>
<li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="You Tube"><img src="<?php echo $this->webroot; ?>img/you-tube.jpg"></a></li>
</ul>
</div>

</div>

<div class="col-md-3">
<div class="businee-part-logo">
<?php if(!empty($business['Business']['business_logo'])){?>
<img style="height:100px; width:100%;"  src="<?php echo HTTP_ROOT.'img/'.$business['Business']['business_logo']?>"/>
<?php }else{ ?>
      </br>
    <?php } ?> 
</div>
</div>
</div>


</div>
</div>

<div class="col-md-4">
<div id="map_canvas" style="width:100%; height:312px;"></div>
</div>


</div>

<div class="row">
<div class="col-md-8">
<div class="main-client-style">

    <div class="client-heading">
      <div class="col-sm-4"><h4>Client Reviews:</h4></div>
      <div class="col-sm-8">
      <div class="write-review">
       <a href="<?php echo HTTP_ROOT.'Public/review/'.base64_encode($business['Business']['id']).'/'.base64_encode($business['Business']['user_Id'])?>" class="expressed"><span aria-hidden="true" class="glyphicon glyphicon-pencil"></span> <em>Write a Review</em></a>
      </div>
      </div>
    </div>

     <div class="user-feedback">
       <?php $i=1;$j=1; 
        foreach ($client_rev as $review) { ?>
       <div class="main-micro-user">
        <div class="micro-user">
          <img style="height:70px;" src="<?php echo HTTP_ROOT.'img/generic-avatar.png'?>">
        </div>  

        <div class="micro-user-right">
          <h6><?php echo $review['Customer']['firstname']?></h6>
           <em><?php echo $review['BusinessReview']['ratingdate']?></em>
           <p id='abc<?php echo $i; ?>' class="rf-subject"><?php echo $this->Text->truncate(
                      $review['BusinessReview']['ratingdescription'],
                      128,
                      array(
                        'ending' =>'...',
                        'exact' => false 
                        )
                      );
                  ?></p>
                 <p class="<?php echo $j; ?>" style="display:none; font-size: 1.1em;font-weight: normal;margin: -3px 0 0;"><?php echo $review['BusinessReview']['ratingdescription'] ;?></p>
                  <?php if(strlen($review['BusinessReview']['ratingdescription']) >127){ ?>
                  <a href="javascript:void();" id="<?php echo $i; ?>" class="show"><span  class="pqr<?php echo $i; ?>"></span><lable class='pqr<?php echo $i; ?>' >Read More</lable></a>
                  <?php } ?>
        </div> 
       </div>   
      
      <?php $i++;
      $j++; 
    }?>
      </div>


<?php //pr($ratstar);die;?>
      </div>
    </div>

    <div class="col-md-4">
    <div class="fed_rate">
    <p>Overall Feedback Rating</p>

    <?php if($ratstar['Business']['averageRating']>0){?>
            <span><?php echo number_format((float)$ratstar['Business']['averageRating'], 2, '.', '');?></span>
            <?php } else {?>
               <span><?php echo number_format((float)0, 2, '.', '');?></span>
            <?php }?>
            <p class="fed_rating_amnt">Based Out of <?php echo $ratstar['Business']['totalReviews']?></p>






    </div>
    




     

  <div class="based-sidebar">
    <div class="form-group">
     
      <div class="office-content">
      
      <ul class="office-content-1">
        <li>
        <label><img src="<?php echo HTTP_ROOT?>app/webroot/img/5stars.png"></label>
        <span><?php echo $ratstar['Business']['fivestarCount'].' Reviews'?></span></li>
        <li>
        <label><img src="<?php echo HTTP_ROOT?>app/webroot/img/4stars.png"></label>
        <span><?php echo $ratstar['Business']['fourstarCount'].' Reviews'?></span></li>
        <li>
        <label><img src="<?php echo HTTP_ROOT?>app/webroot/img/3stars.png"></label>
        <span><?php echo $ratstar['Business']['threestarCount'].' Reviews'?></span></li>
        <li>
        <label><img src="<?php echo HTTP_ROOT?>app/webroot/img/2stars.png"></label>
        <span><?php echo $ratstar['Business']['twostarCount'].' Reviews'?></span></li>
        <li>
        <label><img src="<?php echo HTTP_ROOT?>app/webroot/img/1star.png"></label>
        <span><?php echo $ratstar['Business']['onestarCount'].' Reviews'?></span></li>
      </ul>

     
      </div>
   


    </div>
    </div>

     

  <div class="overall-sidebar">
    <div class="form-group">
      <div class="office-hour">Office Hours:</div>
      <div class="office-content">
      
      <ul>
      <li><label>Monday</label><span><?php echo @$conHour[0] ?></span></li>
      <li><label>Tuesday</label><span><?php echo @$conHour[1] ?></span></li>
      <li><label>wednesday</label><span><?php echo @$conHour[2] ?></span></li>
      <li><label>Thrusday</label><span><?php echo @$conHour[3] ?></span></li>
      <li><label>Friday</label><span><?php echo @$conHour[4] ?></span></li>
      <li><label>Saturday</label><span><?php echo @$conHour[5] ?></span></li>
      <li><label>Sunday</label><span><?php echo @$conHour[6] ?></span></li>
      </ul>

     
      </div>
    </div>


    </div>
    </div><!--==sidebar close here==--> 


    <?php } ?>
  </div>




</div>
</div>

<script>
var geocoder;
var map;
var address = '<?php echo $business['Business']['addressline1'] ?>';

function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var myOptions = {
    zoom: 5,
    center: latlng,
    mapTypeControl: true,
    mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
    },
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  if (geocoder) {
    geocoder.geocode({
      'address': address
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
          map.setCenter(results[0].geometry.location);

          var infowindow = new google.maps.InfoWindow({
            content: '<b>' + address + '</b>',
            size: new google.maps.Size(150, 50)
          });

          var marker = new google.maps.Marker({
            position: results[0].geometry.location,
            map: map,
            title: address
          });
          google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
          });

        } else {
          alert("No results found");
        }
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<script>
  $(document).ready(function(){
    $('.show').click(function(){
    var id=this.id;
    $('#abc'+id).hide();
    $('.'+id).show();
    $('.pqr'+id).hide();
  });
  })
</script>