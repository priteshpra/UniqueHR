<div class="section">
  <div class="container">
    <div class="card-panel col s12">
      <h4 class="header m-t-0">
        <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/pagemaster"><strong><?php echo label('msg_lbl_title_pagemaster'); ?></strong></a>
      </h4>
      <form class="col s12" id="edit_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/pagemaster/<?php echo $page_name; ?>">
        <input type="hidden" name="PageID" id="PageID" value="<?php echo isset($pagemaster->PageID) ? $pagemaster->PageID : 0; ?>">
        <div class="row">
          <div class="input-field col s12 m6">
            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_pagename'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
            <input id="PageName" name="PageName" value="<?php echo @$pagemaster->PageName; ?>" type="text" maxlength="100" class="LetterOnly empty_validation_class" />
            <label for="PageName"><?php echo label('msg_lbl_pagename'); ?></label>
          </div>
          <div class="input-field col s12 m6">
            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_category'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
            <select name="CategoryID" id="CategoryID">
              <option>Select Category</option>
              <?php if ($catData) {
                foreach ($catData as $key => $value) { ?>
                  <option value="<?php echo $value->CategoryID ?>" <?php echo ($value->CategoryID == @$pagemaster->CategoryID) ? 'Selected' : '' ?>><?php echo $value->CategoryName ?></option>
              <?php }
              } ?>
            </select>
            <label for="CategoryID"><?php echo label('msg_lbl_category') ?></label>

          </div>
          <div class="input-field col s12 m6">
            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_subcategory'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
            <select name="SubCategoryID" id="SubCategoryID">
              <option>Select Sub Category</option>
              <?php if ($subCatData) {
                foreach ($subCatData as $key => $value) { ?>
                  <option value="<?php echo $value->SubCategoryID ?>" <?php echo ($value->SubCategoryID == @$pagemaster->SubCategoryID) ? 'Selected' : '' ?>><?php echo $value->SubCategoryName ?></option>
              <?php }
              } ?>
            </select>
            <label for="SubCategoryID"><?php echo label('msg_lbl_subcategory') ?></label>

          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m6">
            <input type="checkbox" class="" name="Status" id="Status" <?php if (isset($pagemaster->Status) && $pagemaster->Status == INACTIVE) {
                                                                        echo "";
                                                                      } else {
                                                                        echo "checked='checked'";
                                                                      } ?> />
            <label for="Status"><?php echo label('msg_lbl_status'); ?></label>
          </div>
          <div class="input-field col s12 m6">
            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit"><?php echo label('msg_lbl_submit'); ?>
            </button>
            <?php echo $loading_button; ?>
            <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/pagemaster" class="right close-button"><?php echo label('msg_lbl_cancel'); ?></a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>