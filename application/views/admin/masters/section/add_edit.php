<div class="section">
  <div class="container">
    <div class="card-panel col s12">
      <h4 class="header m-t-0">
        <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/section"><strong><?php echo label('msg_lbl_title_section'); ?></strong></a>
      </h4>
      <form class="col s12" id="edit_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/section/<?php echo $page_name; ?>">
        <div class="row">
          <div class="input-field col s12">
            <?= $pagenames ?>
          </div>
          <div class="input-field col s12 ">
            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_category'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
            <input id="SequenceNo" name="SequenceNo" type="text" class="empty_validation_class" value="<?php echo @$cms->SequenceNo; ?>" maxlength="100" />
            <label for="Title"><?php echo label('msg_lbl_sequence') ?></label>
          </div>
          <div class="input-field col s12">
            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_content'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
            <div style="padding-top:40px;"></div>
            <label for="Content"><?php echo label('msg_lbl_content') ?></label>
            <textarea name="Content" id="Content" class="materialize-textarea"><?php echo @$cms->Content; ?></textarea>
          </div>

        </div>

        <div class="row">
          <div class="input-field col s12 m6">
            <input type="checkbox" class="" name="Status" id="Status" <?php if (isset($cms->Status) && $cms->Status == INACTIVE) {
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
            <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/section" class="right close-button"><?php echo label('msg_lbl_cancel'); ?></a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>