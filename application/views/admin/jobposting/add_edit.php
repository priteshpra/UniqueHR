<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/jobposting') ?>"><strong><?php echo label('msg_lbl_title_brand') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/jobposting/' . $page_name) ?>" enctype="multipart/form-data">
            <input id="JobPostingID" name="JobPostingID" value="<?php echo isset($data->JobPostingID) ? $data->JobPostingID : 0; ?>" type="hidden" />
            <div class="row">
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_brand'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="Title" name="Title" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->Title; ?>" maxlength="100" />
                    <label for="Title"><?php echo label('msg_lbl_title') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_brand'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="Industry" name="Industry" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->Industry; ?>" maxlength="100" />
                    <label for="Industry">Industry</label>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_brand'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="Experience" name="Experience" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->Experience; ?>" maxlength="100" />
                    <label for="Experience">Experience</label>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_brand'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="Location" name="Location" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->Location; ?>" maxlength="100" />
                    <label for="Location">Location</label>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_brand'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="text" name="text" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->text; ?>" maxlength="100" />
                    <label for="text">Description</label>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_brand'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="PublishedDate" name="PublishedDate" type="text" class="empty_validation_class datepicker" value="<?php echo @$data->PublishedDate; ?>" maxlength="100" />
                    <label for="PublishedDate"><?php echo label('msg_lbl_publishdate') ?></label>
                </div>
                <div class="clearfix"></div>
                <?php
                if (isset($data->FilePath) && $data->FilePath != "" && (file_exists(str_replace(array('\\', '/system'), array('/', ''), BASEPATH) . JOBPOST_UPLOAD_PATH . $data->FilePath))) {
                    $path = base_url() . JOBPOST_UPLOAD_PATH . $data->FilePath;
                    $cross = "";
                } else {
                    $cross = "hide";
                    $path =  $this->config->item('admin_assets') . 'img/noimage.gif';
                }

                ?>

                <div class="m-t-20">

                    <label class="imageview-label">Job Post, Enter only .jpg and .png formats and img size 150 * 150</label>
                    <div class="row">
                        <div class="input-field m-t-0 col s12 m2 imageview1">
                            <img width="150" id="ImagePreivew" src='<?php echo $path; ?>'>
                            <a id="webviewcross" class="cross1 <?= $cross ?>" data-img="ImagePreivew" data-file="userfile" data-edit="editImageURL"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                        </div>
                        <div class="file-field input-fieldcol col s12 m10 m-t-10">
                            <input tabindex="999" class="file-path validate empty_validation_class" type="text" id="editImageURL" name="editImageURL" value="<?php echo @$data->FilePath; ?>" readonly />
                            <div class="btn">
                                <span>File</span>
                                <input accept="image/*" type="file" name="FilePath" id="FilePath" class="images" data-cross="webviewcross" data-img="ImagePreivew" data-edit="editImageURL" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-field col s12 m6">
                    <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                if (isset($data->Status) && @$data->Status == INACTIVE) {
                                                                                    echo "";
                                                                                } else {
                                                                                    echo "checked='checked'";
                                                                                }
                                                                                ?>>
                    <label for="Status"><?php echo label('msg_lbl_status'); ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/jobposting') ?>" class="right close-button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>