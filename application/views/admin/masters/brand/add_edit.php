<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/brand') ?>"><strong><?php echo label('msg_lbl_title_brand') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/brand/' . $page_name) ?>" enctype="multipart/form-data">
            <input id="BrandID" name="BrandID" value="<?php echo isset($data->BrandID) ? $data->BrandID : 0; ?>" type="hidden" />
            <div class="row">
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_brand'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="BrandName" name="BrandName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->BrandName; ?>" maxlength="100" />
                    <label for="BrandName"><?php echo label('msg_lbl_brand') ?></label>
                </div>
                <div class="clearfix"></div>
                <?php
                if (isset($data->LogoFilePath) && $data->LogoFilePath != "" && (file_exists(str_replace(array('\\', '/system'), array('/', ''), BASEPATH) . BRAND_UPLOAD_PATH . $data->LogoFilePath))) {
                    $path = base_url() . BRAND_UPLOAD_PATH . $data->LogoFilePath;
                    $cross = "";
                } else {
                    $cross = "hide";
                    $path =  $this->config->item('admin_assets') . 'img/noimage.gif';
                }

                ?>

                <div class="m-t-20">

                    <label class="imageview-label">Website Brand, Enter only .jpg and .png formats and img size 150 * 150</label>
                    <div class="row">
                        <div class="input-field m-t-0 col s12 m2 imageview1">
                            <img width="150" id="ImagePreivew" src='<?php echo $path; ?>'>
                            <a id="webviewcross" class="cross1 <?= $cross ?>" data-img="ImagePreivew" data-file="userfile" data-edit="editImageURL"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                        </div>
                        <div class="file-field input-fieldcol col s12 m10 m-t-10">
                            <input tabindex="999" class="file-path validate empty_validation_class" type="text" id="editImageURL" name="editImageURL" value="<?php echo @$data->LogoFilePath; ?>" readonly />
                            <div class="btn">
                                <span>File</span>
                                <input accept="image/*" type="file" name="LogoFilePath" id="LogoFilePath" class="images" data-cross="webviewcross" data-img="ImagePreivew" data-edit="editImageURL" />
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
                    <a href="<?php echo site_url('admin/masters/brand') ?>" class="right close-button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>