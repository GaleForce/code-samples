<a id="reviewdModel" style="cursor:pointer;display:none" data-toggle="modal" data-target="#customer-history">
                   
</a>   
<div class="modal fade" id="customer-history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <h4 id="revby">Reviewed by...</h4>   
          </div>
           <div class="modal-body add_cc">
              <table cellspacing="0" cellpadding="0" border="0" class="recent-feedback">
                    <tbody id="tbodycontent">
                         
                    </tbody>
                </table>    
          </div>  
          <div class="modal-footer">
            <button type="button" class="btn btn-default buttonclose close_modal" data-dismiss="modal">Close</button>
          </div>


        </div>
      </div>
</div>

<script type="text/javascript">
$(document).on("click", ".showtxt", function() {
   $(this).parent().hide();
   $(this).parent().next().show();
});
$(document).ready(function(){

    $('.cust-history').on('click', function(){
       var url=$(this).attr('rel');
       $("#loading").show();
       $.ajax({                   
                url: url,
                type: 'POST',
                cache: false,
                dataType: 'json',
                success: function (response) {
                   console.log(response);
                  if(response[0]=='success'){
                     $("#loading").hide();
                     $("#revby").html(response[3]);
                     $('#tbodycontent').html(response[1]);                  
                     $('#reviewdModel').click();
                  }else{
                    $("#loading").hide();
                    alert("!Oops there is something wrong with server.Please try again.");
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