<!--START CONTENT -->
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/ChanelPartner"><?php echo label('msg_lbl_chanel_partners');?></a></h5>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->
    <!--start container-->
    <div class="container">
        <div class="section">
            <div class="listing-page">
                <div class="card-panel">
                    <div class="row">
                        <div class="col s12">
                            <div class="row m-b-0">
                                <div class="input-field col m2 s12">
                                    <select id="select-dropdown">
                                        <option value="10"  selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col m6 s12 center m-t-20">
                                    <span><label><?php echo label('msg_lbl_data_display');?> :</label></span> &nbsp;&nbsp;
									<input name="data_display" type="radio" id="All" value="All" onclick="return changeFilter(this.value);" checked="checked">
									<label for="All"><?php echo label('msg_lbl_all');?></label>
									<input name="data_display" type="radio" id="Filter" value="Filter" onclick="return changeFilter(this.value);">
									<label for="Filter"><?php echo label('msg_lbl_filter');?></label>  &nbsp;&nbsp;    
                                </div>  
                                <div class="col s12 m4 right-align list-page-right-top-icon">
                                  <?php if(@$this->cur_module->is_insert == 1){?>
                                  <button class="btn waves-effect waves-light Compose waves-effect waves-light btn modal-trigger" style="display:none;" href="#modal3">
                                      SMS
                                  </button>
                                  <?php } ?>
                                  <a class="btn-floating waves-effect waves-light grey right">
								  <i id="display_action" onClick="field_display();" class="mdi-hardware-keyboard-arrow-down tooltipped" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
								  <?php if(@$this->cur_module->is_export == 1){?>
								  <a href="<?php echo site_url('admin/masters/ChanelPartner/export_to_excel');?>" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
								  <?php }if(@$this->cur_module->is_insert == 1){?>
								  <a href="<?php echo site_url("admin/masters/ChanelPartner/add");?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
								  <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- <form id="ExportForm" action="<?php echo site_url('admin/masters/ChanelPartner/export_to_excel');?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;"> -->
                        <div class="col s12">
                            <div class="search_action card-panel" style="display:none;">    
                            <h4 class="header"><strong> <?php echo label('msg_lbl_search_value');?> </strong></h4>
								<div class="row m-b-0">
								  <div class="input-field col s12 m6">
									<input id="FirmName" name="FirmName" type="text" class="LetterOnly" value="<?php echo @$chanel->FirmName; ?>"  maxlength="250" />
                                    <label for="FirmName"><?php echo label('msg_lbl_firmname')?></label>
								  </div>
								  <div class="input-field col s12 m6">
									<input id="FullName" name="FullName" type="text" class="LetterOnly" value="<?php echo @$chanel->FirstName; ?> <?php echo @$chanel->LastName; ?>"  maxlength="250" />
                                    <label for="FullName"><?php echo label('msg_lbl_name')?></label>
								  </div>
								  <div class="input-field col s12 m6">
									<input id="Mobile" name="Mobile" type="text" class="NumberOnly" value="<?php echo @$chanel->Mobile; ?>"  maxlength="10" />
                                    <label for="Mobile"><?php echo label('msg_lbl_mobileno')?></label>
								  </div>
								  <div class="input-field search_label_radio col s12 m6">
									<div name="status" class="form-control search_div m-t-10 left"><?php echo label('msg_lbl_status');?></div>
									<input name="Status_search" type="radio" id="All_Status_search" value="-1" checked="checked">
									<label for="All_Status_search"><?php echo label('msg_lbl_all');?></label>
									<input name="Status_search" type="radio" id="Active" value="1">
									<label for="Active"><?php echo label('msg_lbl_active');?></label> 
									<input name="Status_search" type="radio" id="InActive" value="0">
									<label for="InActive"><?php echo label('msg_lbl_inactive');?></label>
								  </div>
								</div>
								<button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit"><?php echo label('msg_lbl_submit');?>
								</button>
								&nbsp;&nbsp;&nbsp;
								<a href="javascript:;" class="clear-all right" onclick="return clearAllFilter();"><?php echo label('msg_lbl_clear_all');?>
								</a> 
							</div>
                        </div>
                    </div>
                    <!-- </form> -->
                    <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo label('msg_lbl_select');?></th>
                                    <th class="width_180"><?php echo label('msg_lbl_firmname');?></th>
                                    <th class="width_180"><?php echo label('msg_lbl_name');?></th>
                                    <th class="width_180"><?php echo label('msg_lbl_emailid');?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_mobileno');?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_pancard');?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_aadharcard');?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_gstno');?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_bankaccount');?></th>
                                    <th class="width_180"><?php echo label('msg_lbl_bankname');?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_ifccode');?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_reracode');?></th>
                                    <th class="width_130"><?php echo 'Family Member Count';?></th>
    								<th class="actions center"><?php echo label('msg_lbl_status');?></th>
    								<th class="actions center"><?php echo label('msg_lbl_action');?></th>
                                </tr>
                            </thead>
                            <tbody id="country_table_body">
                            </tbody> 
                        </table>
                    </div>
                    <div id="table_paging_div"></div>
                </div>
                <?php echo @$view_modal_popup; ?>
            </div>
        </div>
    </div>
    <!--start container-->
    <!--end container-->
</section>
<!-- END CONTENT-->
<!-- Modal Structure -->
<div id="modal3" class="modal admin-table-view-pop-up">
    <div class="modal-footer gridhead1 bgglobal">      
        <h4 id="model_title"><?php echo label('msg_lbl_chanel_partners');?></h4>
        <a class="waves-effect waves-green btn-flat modal-action modal-close" style="color:white">Close</a>
    </div>
    <div class="modal-content">
        <div class="row m-b-0 SMSForm" style="display:block;">
            <div class="row m-b-0 m-t-20">
            </div>
            <div class="row m-b-0">
                <div class="input-field col s12 m12">
                    <div class = "mdl-textfield mdl-js-textfield">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_message');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <textarea placeholder="Message" id="SMS_Message" class="materialize-textarea SMS_Message msg_lbl_enter_message"></textarea>
                        <label for="SMS_Message"><?php echo label('msg_lbl_message')?></label>
                    </div>
                </div>
                <div class="row right m-b-0 "> 
                    <a href="<?php echo site_url('admin/masters/ChanelPartner'); ?>" class="modal-action modal-close waves-effect btn-flat">Cancel</a>
                    <button class="btn waves-effect waves-light  SMSFormSubmit" type="button"><?php echo label('msg_lbl_submit');?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>