<script src="http://cdnjs.cloudflare.com/ajax/libs/zeroclipboard/2.1.6/ZeroClipboard.js" type="text/javascript"></script>
<a id="shareModel" style="cursor:pointer;display:none" data-toggle="modal" data-target="#shareReview">
</a>   

<div class="modal fade" id="shareReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <h4 id="revby">Share Review Online</h4>   
          </div>
           <div class="modal-body add_cc">
              <div>
                  <div id="clipboard-text" name="clipboard-text" onclick="this.select();" class="copy-comment"></div>
              </div> 
              <div>
                <label class="copy-btn">Press this button to copy your feedback</label>
                <button data-clipboard-target="clipboard-text" id="btn-To-Copy" class="btn btn-primary copied" type="button">Copy</button>
              </div>
              <div class="social-share">
                  <h6><strong>Simply follow these 3 easy steps:</strong></h6>
                  <ul>
                    <li>Copy your feedback below</li>
                    <li>Click on the logo below to write a review</li>  
                    <li>Paste your feedback</li>  
                  </ul>
                  <div id="publicSites">
                  </div>
              </div>
          </div>  
          <div class="modal-footer">
            <button type="button" class="btn btn-default buttonclose close_modal" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
</div>
   
<script type="text/javascript">
        var client = new ZeroClipboard(document.getElementById("btn-To-Copy"));
        client.on("ready", function (readyEvent) {
            client.on("aftercopy", function (event) {
              alert("Copied!");
           });
        });
</script>
<script type="text/javascript">
$(document).on("click", ".showtxt", function() {
   $(this).parent().hide();
   $(this).parent().next().show();
});
$(document).ready(function(){
    $('.share-review').on('click', function(){
       var url=$(this).attr('rel');
       $("#loading").show();
       $.ajax({                   
                url: url,
                type: 'POST',
                cache: false,
                dataType: 'json',
                success: function (response) {
                  if(response[0]=='success'){
                     $("#loading").hide();
                     $("#clipboard-text").html(response[1]);
                     $('#publicSites').html(response[2]);
                     $('#shareModel').click();
                  }else if(response[0]=='unauthorized'){
                     $("#loading").hide();
                     $('#bdycontent').html(response[1]);                  
                     $('#alert').click();
                     // alert(response[1]);
                  }else{
                    $("#loading").hide();
                     $('#bdycontent').html("!Oops there is something wrong with server.Please try again.");
                     $('#alert').click();
                  }
                  
                  }
            })
    });
});
</script>
<style>
.modal .modal-body {
    max-height: 320px;
    overflow-y: auto;
}
</style>
