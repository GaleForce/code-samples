 <div class="modal fade" id="fb-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="exampleModalLabel">Enter Facebook Url</h4>
                                </div>
                                <div class="modal-body">
                                   <form id="fburl" method="post" action="<?php echo HTTP_ROOT?>dashboard/visibilityAgency/facebook">
                                    <?php if(in_array('Facebook', $media)){?>
                                      <input type="hidden" name="data[Visibility][id]" value="<?php echo array_search('Facebook', $media)?>"/>  
                                      <input type="hidden" name="data[Visibility][checker_type]" value="<?php echo $media['Facebookchecker']=='SocialSite'?'socialchecker':'visibilitychecker'?>"/>
                                       <input type="hidden" name="data[Business][id]" value="<?php echo $businessUser['Business']['id']?>"/>  
                                    <?php } else {?> 
                                      <input type="hidden" name="data[Business][id]" value="<?php echo $businessUser['Business']['id']?>"/>  
                                    <?php }?>
                                    <input type="text" name="data[Visibility][prefixurl]" value="https://graph.facebook.com/" id="prefixurltxt" readonly/>
                                    <input type="text" name="data[Visibility][url]" value="<?php echo in_array('Facebook', $media)?@$media['Facebook']:''?>" id="urltxt"/>
                                    <input type="submit" value="Submit"/>
                                   </form>
                                   
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                      </div>
