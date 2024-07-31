<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url('admin/user/visitor/details/' . $VisitorID . "#sites"); ?>"><strong><?php echo label('msg_lbl_title_visitorsites') ?></strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" id="addForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/user/sites/<?php echo $page_name; ?>">
                    <input id="VisitorID" name="VisitorID" value="<?php echo $VisitorID; ?>" type="hidden" />
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <?php echo @$projects; ?>
                        </div>
                        <div class="input-field radio_input_field_add_edit col s12 m6">
                            <label><?php echo label('msg_lbl_requirement'); ?></label><br />
                            <?php
                            $array = array();
                            if (isset($visitor->Requirement)) {
                                $array = explode(',', $visitor->Requirement);
                            }
                            ?>
                            <div id="ResidencyDiv" class="<?php if (@$visitor->ProjectType == "Commercial" || !@$visitor->ProjectType) {
                                                                echo "hide";
                                                            } ?>">
                                <?php
                                $requirement = $this->configdata->Requirement;
                                $requirement_array = explode(',', $requirement);
                                foreach ($requirement_array as $value) {
                                ?>
                                    <input name="Requirement[]" type="checkbox" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" <?php echo (in_array($value, $array)) ? 'checked="checked" ' : ''; ?> class="requirement">
                                    <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                                <?php
                                }
                                ?>
                            </div>
                            <div id="CommercialDiv" class="<?php if (@$visitor->ProjectType == "Residency") {
                                                                echo "hide";
                                                            } ?>">
                                <?php
                                $requirement = $this->configdata->CommercialRequirement;
                                $requirement_array = explode(',', $requirement);
                                foreach ($requirement_array as $value) {
                                ?>
                                    <input name="Requirement[]" type="checkbox" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" <?php echo (in_array($value, $array)) ? 'checked="checked" ' : ''; ?> class="requirement">
                                    <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_budget'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Budget" name="Budget" type="text" class="empty_validation_class NumberOnly" value="<?php echo @$visitor->Budget; ?>" maxlength="9" />
                            <label for="Budget"><?php echo label('msg_lbl_budget') ?></label>
                        </div>
                        <div class="input-field radio_input_field_add_edit col s12 m6 ">
                            <label><?php echo label('msg_lbl_visitsource'); ?></label><br />
                            <?php
                            $array = array();
                            if (isset($visitor->VisitSource)) {
                                $array = explode(',', $visitor->VisitSource);
                            }
                            $visitorsource = $this->configdata->VisitSource;
                            $visitorsource_array = explode(',', $visitorsource);
                            foreach ($visitorsource_array as $value) {
                            ?>
                                <input name="VisitSource[]" type="checkbox" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" <?php echo (in_array($value, $array)) ? 'checked="checked" ' : ''; ?> class="VisitSource">
                                <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_entrydate'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <label name="EntryDate" class=""><?php echo label('msg_lbl_entrydate') ?></label>
                            <!-- <input type="text" name="EntryDate" id="EntryDate" value="<?php echo isset($visitor->EntryDate) ? GetDateTimeInFormat(@$visitor->EntryDate, DATABASE_DATE_TIME_FORMAT, DATE_FORMAT) : ""; ?>" class="datepickerval empty_validation_class"> -->
                            <input type="date" name="EntryDate" id="EntryDate" value="<?php
                                                                                        if (isset($visitor->VisitorID)) {
                                                                                            echo isset($visitor->EntryDate) ? GetDateTimeInFormat(@$visitor->EntryDate, DATABASE_DATE_TIME_FORMAT, DATABASE_DATE_FORMAT) : "";
                                                                                        } else
                                                                                            echo date("d-m-Y"); ?>" class="empty_validation_class">
                        </div>
                        <div class="input-field col s12 m6 ChannelPartner hide">
                            <?php echo @$ChannelPartner; ?>
                        </div>
                        <div class="Reference hide">
                            <div class="input-field col s12 m3">
                                <input id="RefName" name="RefName" type="text" class="LetterOnly" value="<?php echo @$visitor->RefName; ?>" maxlength="30" />
                                <label for="RefName"><?php echo label('msg_lbl_refname') ?></label>
                            </div>
                            <div class="input-field col s12 m3">
                                <input id="RefMobileNo" name="RefMobileNo" type="text" class="NumberOnly" value="<?php echo @$visitor->RefMobileNo; ?>" maxlength="12" />
                                <label for="RefMobileNo"><?php echo label('msg_lbl_refmobileno') ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field radio_input_field_add_edit col s12 m6">
                            <label><?php echo label('msg_lbl_withinpremises'); ?></label><br />
                            <input name="VisitorCenter" type="radio" id="Premises" value="Premises" checked="checked" <?php echo ((isset($visitor->VisitorCenter) && @$visitor->VisitorCenter == 'Premises')) ? 'checked="checked"' : ''; ?>>
                            <label for="Premises"><?php echo label('msg_lbl_premises') ?></label>

                            <input name="VisitorCenter" type="radio" id="Outdoor" value="Outdoor" <?php echo ((isset($visitor->VisitorCenter) && @$visitor->VisitorCenter == 'Outdoor')) ? 'checked="checked"' : ''; ?>>
                            <label for="Outdoor"><?php echo label('msg_lbl_outdoor'); ?></label>
                        </div>
                        <div id="outdoordiv" class="input-field col s12 m6 <?php echo (@$visitor->VisitorCenter != 'Outdoor') ? " hide " : ''; ?>">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_outdoorlocation'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <!-- <input id="OutDoorLocation" name="OutDoorLocation" type="text" class="<?php echo (@$visitor->VisitorCenter == 'Outdoor') ? "empty_validation_class" : ''; ?> LetterOnly" value="<?php echo @$visitor->OutDoorLocation; ?>"  maxlength="10" /> -->
                            <textarea id="OutDoorLocation" name="OutDoorLocation" maxlength="100" class="materialize-textarea <?php echo (@$visitor->VisitorCenter == 'Outdoor') ? "empty_validation_class" : ''; ?>"><?= @$visitor->OutDoorLocation ?></textarea>
                            <label for="OutDoorLocation"><?php echo label('msg_lbl_outdoorlocation') ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field radio_input_field_add_edit col s12 m6">
                            <label><?php echo label('msg_lbl_finance'); ?></label><br />
                            <input name="Finance" type="radio" id="SelfFunded" value="SelfFunded" checked="checked" <?php echo ((isset($visitor->Finance) && @$visitor->Finance == 'SelfFunded')) ? 'checked="checked"' : ''; ?>>
                            <label for="SelfFunded"><?php echo label('msg_lbl_selffunded') ?></label>
                            <input name="Finance" type="radio" id="Loan" value="Loan" <?php echo ((isset($visitor->Finance) && @$visitor->Finance == 'Loan')) ? 'checked="checked"' : ''; ?>>
                            <label for="Loan"><?php echo label('msg_lbl_loan'); ?></label>
                        </div>
                        <div class="input-field radio_input_field_add_edit col s12 m6">
                            <label><?php echo label('msg_lbl_propertyinterest'); ?></label><br />
                            <input name="PropertyInterest" type="radio" id="showroom" value="showroom" checked="checked" <?php echo ((isset($visitor->PropertyInterest) && @$visitor->PropertyInterest == 'showroom')) ? 'checked="checked"' : ''; ?>>
                            <label for="showroom"><?php echo label('msg_lbl_showroomshop') ?></label>
                            <input name="PropertyInterest" type="radio" id="Office" value="Office" <?php echo ((isset($visitor->PropertyInterest) && @$visitor->PropertyInterest == 'Office')) ? 'checked="checked"' : ''; ?>>
                            <label for="Office"><?php echo label('msg_lbl_office'); ?></label>
                            <input name="PropertyInterest" type="radio" id="House" value="House" <?php echo ((isset($visitor->PropertyInterest) && @$visitor->PropertyInterest == 'House')) ? 'checked="checked"' : ''; ?>>
                            <label for="House"><?php echo label('msg_lbl_house'); ?></label>
                            <input name="PropertyInterest" type="radio" id="Lease" value="Lease" <?php echo ((isset($visitor->PropertyInterest) && @$visitor->PropertyInterest == 'Lease')) ? 'checked="checked"' : ''; ?>>
                            <label for="Lease"><?php echo "Lease" ?></label>
                            <input name="PropertyInterest" type="radio" id="Plotting" value="Plotting" <?php echo ((isset($visitor->PropertyInterest) && @$visitor->PropertyInterest == 'Plotting')) ? 'checked="checked"' : ''; ?>>
                            <label for="Plotting"><?php echo "Plotting" ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field radio_input_field_add_edit col s12 m6">
                            <label><?php echo label('msg_lbl_purposebuying'); ?></label><br />
                            <input name="buyingPurpose" type="radio" id="Investment" value="Investment" checked="checked" <?php echo ((isset($visitor->PurposeofBuying) && @$visitor->PurposeofBuying == 'Investment')) ? 'checked="checked"' : ''; ?>>
                            <label for="Investment"><?php echo label('msg_lbl_investment') ?></label>
                            <input name="buyingPurpose" type="radio" id="PersonalUse" value="PersonalUse" <?php echo ((isset($visitor->PurposeofBuying) && @$visitor->PurposeofBuying == 'PersonalUse')) ? 'checked="checked"' : ''; ?>>
                            <label for="PersonalUse"><?php echo label('msg_lbl_personaluse'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_timetocall'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="TimeToCall" name="TimeToCall" type="text" maxlength="30" class="" value="<?php echo @$visitor->PreferedTimeToCall; ?>" />
                            <label for="TimeToCall"><?php echo label('msg_lbl_timetocall'); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_passcode'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PassCode" name="PassCode" type="password" maxlength="5" class="NumberOnly empty_validation_class" autocomplete="off" />
                            <label for="PassCode"><?php echo label('msg_lbl_passcode'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <?php echo @$employee; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_inquiry'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <label name="InquiryDate" class=""><?php echo label('msg_lbl_inquiry') ?></label>
                            <input type="date" name="InquiryDate" id="InquiryDate" value="<?php
                                                                                            if (isset($visitor->VisitorID)) {
                                                                                                echo isset($visitor->InquiryDate) ? GetDateTimeInFormat(@$visitor->InquiryDate, DATE_FORMAT, DATABASE_DATE_FORMAT) : "";
                                                                                            } else
                                                                                                echo date("d-m-Y");  ?>" class="empty_validation_class">
                        </div>
                        <div class="input-field col s12 m6">
                            <label name="LeadType"><?php echo label('msg_lbl_leadtype') ?></label><br>
                            <?php
                            $leadtype = $this->configdata->LeadType;
                            $leadtype_array = explode(',', $leadtype);
                            foreach ($leadtype_array as $value) {
                            ?>
                                <input name="LeadType" type="radio" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" <?php echo ((isset($visitor->LeadType) && @$visitor->LeadType == $value)) ? 'checked="checked"' : ''; ?> <?php if (!isset($visitor->LeadType) && $value == 'Cold') {
                                                                                                                                                                                                                                                        echo 'checked="checked"';
                                                                                                                                                                                                                                                    } ?> class="leadtype">
                                <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_remarks'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="Remarks" id="Remarks" maxlength="500" class="materialize-textarea"><?= @$visitor->Remarks ?></textarea>
                            <label for="Remarks"><?php echo label('msg_lbl_remarks') ?></label>
                        </div>
                    </div>
                    <?php if (!isset($visitor->VisitorSitesID)) { ?>
                        <div class="row">
                            <div class="col s6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_reminderdate'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <label name="ReminderDate" class=""><?php echo label('msg_lbl_reminderdateonly') ?></label>
                                <input type="date" name="ReminderDate" id="ReminderDate" value="<?php
                                                                                                $date = date('d-m-Y');
                                                                                                echo date('d-m-Y', strtotime($date . ' + 5 days')); ?>" class="empty_validation_class">
                            </div>
                            <div class="input-field col s6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_remindertime'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <label class="timeplabel" for="ReminderTime"><?php echo label('msg_lbl_remindertime'); ?></label>
                                <input id="ReminderTime" name="ReminderTime" class="timep empty_validation_class" value="<?php echo date("H:i", time());  ?>" type="text">
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                        if (isset($data->Status) && @$data->Status == INACTIVE) {
                                                                                            echo "";
                                                                                        } else {
                                                                                            echo "checked='checked'";
                                                                                        }
                                                                                        ?>>
                            <label for="Status">Status</label>
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit">Submit
                            </button>
                            <?php echo $loading_button; ?>
                            <a href="<?php echo base_url('admin/user/visitor/details/' . $VisitorID); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>