<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/ChanelPartner"><strong><?php echo label('msg_lbl_chanel_partners')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addCountryForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/chanelPartner/familymember_<?php echo $page_name; ?>/<?php echo @$ChanelPartnerID; ?>">
                    <input id="cid" name="cid" value="<?php echo @$chanel->FamilyMemberID; ?>" type="hidden"  /> 
                    <input id="ChanelPartnerID" name="ChanelPartnerID" value="<?php echo $chanel->ChanelPartnerID ?? $ChanelPartnerID; ?>" type="hidden"  /> 
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_firstname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="FirstName" name="FirstName" type="text" class="LetterOnly empty_validation_class" value="<?php echo @$chanel->FirstName; ?>"  maxlength="250" />
                            <label for="FirstName"><?php echo label('msg_lbl_firstname')?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_lastname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="LastName" name="LastName" type="text" class="LetterOnly empty_validation_class" value="<?php echo @$chanel->LastName; ?>"  maxlength="250" />
                            <label for="LastName"><?php echo label('msg_lbl_lastname')?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_emailid');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="EmailID" name="EmailID" type="text" class="" value="<?php echo @$chanel->EmailID; ?>"  maxlength="250" />
                            <label for="EmailID"><?php echo label('msg_lbl_emailid')?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_mobileno');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="MobileNo" name="MobileNo" type="text" class="NumberOnly empty_validation_class" value="<?php echo @$chanel->MobileNo; ?>"  maxlength="250" />
                            <label for="MobileNo"><?php echo label('msg_lbl_mobileno')?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo 'Relationship';?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Relationship" name="Relationship" type="text" class="empty_validation_class" value="<?php echo @$chanel->Relationship; ?>"  maxlength="250" />
                            <label for="Relationship">Relationship</label>
                        </div>
                    </div>        
                    <div class="row">.
                        <div class="col s12 m3">
                            <label name="BirthDate" class=""><?php echo label('msg_lbl_birthdate')?></label>
                            <input type="date" name="BirthDate" id="BirthDate" value="<?php  echo @$chanel->BirthDate ; ?>">
                        </div>
                        <div class="input-field col s12 m3">
                        </div>
                        <div class="col s12 m3">
                            <label name="AnniversaryDate" class=""><?php echo label('msg_lbl_anniversarydate')?></label>
                            <input type="date" name="AnniversaryDate" id="AnniversaryDate" value="<?php  echo @$chanel->AnniversaryDate ; ?>">
                        </div>
                        <div class="input-field col s12 m1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($chanel->Status) && @$chanel->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status">Status</label>     
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" ><?php echo label('msg_lbl_submit');?>
                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/ChanelPartner" class="right close-button"><?php echo label('msg_lbl_cancel');?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>