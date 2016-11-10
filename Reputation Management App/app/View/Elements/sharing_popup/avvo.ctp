<div class="modal fade" id="Avvo-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="exampleModalLabel">Enter Google Plus Local Url</h4>
                                </div>
                                <div class="modal-body">
                                   <form id="fburl" method="post" action="<?php echo HTTP_ROOT?>dashboard/visibilityAgency/gplus">
                                    <?php if(in_array('Google Plus Local', $media)){?>
                                      <input type="hidden" name="data[Visibility][id]" value="<?php echo array_search('Google Plus Local', $media)?>"/>  
                                      <input type="hidden" name="data[Visibility][checker_type]" value="<?php echo $media['Google Plus Localchecker']=='SocialSite'?'socialchecker':'visibilitychecker'?>"/>
                                      <input type="hidden" name="data[Business][id]" value="<?php echo $businessUser['Business']['id']?>"/>  
                                    <?php } else {?> 
                                      <input type="hidden" name="data[Business][id]" value="<?php echo $businessUser['Business']['id']?>"/>  
                                    <?php }?>
                                    <input class="visibility-back" type="text" name="data[Visibility][prefixurl]" value="https://maps.googleapis.com/maps/api/place/details/json?" id="prefixurltxt" readonly/>
                                    <input class="visibility-back" type="text" name="data[Visibility][url]" value="<?php echo in_array('Google Plus Local', $media)?@$media['Google Plus Local']:''?>" id="urltxt"/>
                                    <div class="togg-btn">
                                    <input class="btn btn-primary visibility-submit" type="submit" value="Submit"/>
                                    </div>
                                   </form>
                                   
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default closness" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                    </div>

