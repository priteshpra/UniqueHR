<?php foreach ($visitor as $visitor) { ?>
    <tr class="gradeX" id="row_<?php echo $visitor->VisitorID; ?>">
        <td><a class="txt-underline bold" href="<?php echo site_url("admin/user/visitor/details/" . $visitor->VisitorID); ?>"><?php echo $visitor->FirstName . " " . $visitor->LastName; ?></a></td>
        <td><?php echo $visitor->CreatedDate; ?></td>
        <td><?php echo $visitor->EmployeeFirstName . " " . $visitor->EmployeeLastName; ?></td>
        <td><a href="mailto:<?php echo $visitor->EmailID; ?>"><?php echo $visitor->EmailID; ?></a> </td>
        <td><?php echo $visitor->MobileNo; ?></td>
        <td><?php echo $visitor->Address; ?></td>
        <td><?php echo $visitor->CompanyName; ?></td>
        <td><?php echo $visitor->SitesCount; ?></td>
        <td><?php echo $visitor->Requirement; ?></td>
        <td><?php echo $visitor->Budget; ?></td>
        <td><?php echo $visitor->PropertyInterest; ?></td>
        <?php
        if ($visitor->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        if (@$this->cur_module->is_status == 1) {
            $status = CHANGE_STATUS;
        }
        ?>
        <td class="status action center status-box-th hide">
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status . ' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $visitor->VisitorID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $visitor->VisitorID; ?>"></i>
            <i title="Active" class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status . ' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $visitor->VisitorID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
        <td class="action center action-box-th">
            <a href="javascript:void(0);" data-target="FeedbackModal" class="feedbackinfo modal-trigger btn-floating waves-effect waves-light brown" data-id="<?php echo $visitor->VisitorID; ?>" data-name="<?php echo $visitor->FirstName . " " . $visitor->LastName; ?>">
                <i title="View Feedback" class="mdi-communication-textsms"></i>
            </a>
            &nbsp;&nbsp;
            <a href="javascript:void(0);" class="addfeedback modal-trigger btn-floating waves-effect waves-light teal darken-1" data-id="<?php echo $visitor->VisitorID; ?>">
                <i title="Add Feedback" class="mdi-maps-rate-review"></i>
            </a>
        </td>
        <td class="action center action-box-th">

            <?php if (@$this->cur_module->is_edit == 1) { ?>

                <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/user/visitor/edit/<?php echo $visitor->VisitorID; ?>" style="cursor:pointer;">
                    <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                    </i>
                </a>
                &nbsp;&nbsp;
            <?php } ?>
            <a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $visitor->VisitorID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
            <a target="_blank" title="whatsapp" href="https://wa.me/+91<?php echo $visitor->MobileNo; ?>" class=" modal-trigger btn-floating waves-effect waves-light teal darken-1" data-id="<?php echo $visitor->VisitorID; ?>" data-type="<?php echo $data->Type; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                    <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                </svg>
            </a>
        </td>
    </tr>
<?php } ?>