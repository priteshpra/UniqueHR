<!-- test save -->
<script>
    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        min: new Date(),
        onSet: function(arg) {
            if ('select' in arg) { //prevent closing on selecting month/year
                this.close();
            }
        }
    })

    // $('.timep').clockpicker({
    //     placement: 'bottom',
    //     align: 'left',
    //     darktheme: false,
    //     autoclose: true,
    //     twelvehour: false
    // });

    $('.timep').on('change', function() {
        $('.timeplabel').addClass('active');
    });
    $('#ReminderDate').change(function() {
        $('#ReminderTime').val('');
    });
    $('#ReminderTime').change(function() {
        var dt = new Date();
        var ct = dt.getDate() + "-" + (dt.getMonth() + 1) + "-" + (dt.getFullYear());
        dtm = dt.getHours() + ':' + dt.getMinutes();
        rtime = $('#ReminderTime').val();
        rdate = $('#ReminderDate').val();
        /*if(rdate <= ct){
            if(rtime < dtm){
                alertify.error("<?php echo label('future_time'); ?>");
                $('#ReminderTime').val('');
                return false;
            }
        }*/
    });
    // This is for the active textbox
    $(document).ready(function() {
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
        <?php if (isset($this->session->userdata['postsuccess'])) {
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);";
        }
        ?>
    });

    window.submitflag = 1;
    $('#button_submit').on('click', function() {
        var error_combo = checkComboBox(['ProjectID', 'EmployeeID']);
        var error = checkValidations();
        if (error === 'yes' || error_combo === 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            if (submitflag == 0) {
                return false;
            }

            var req = 0;
            var source = 0;
            $('.requirement').each(function(k, v) {
                if ($(this).is(":checked")) {
                    req = 1;
                }
            });

            $('.VisitSource').each(function(k, v) {
                if ($(this).is(":checked")) {
                    source = 1;
                }
            });

            if (req == 0) {
                alertify.error("<?php echo label('enter_requirement'); ?>");
                return false;
            }

            if (source == 0) {
                alertify.error("Visit Source is Required");
                return false;
            }

            submitflag == 0;
            $.ajax({
                type: "post",
                url: base_url + "common/CheckPassCode",
                data: {
                    PassCode: $("#PassCode").val(),
                },
                success: function(data) {
                    submitflag = 1;
                    var obj = JSON.parse(data);
                    if (obj.Result == 'Success') {
                        submitflag = 0;
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait'); ?>");
                        $('form').submit();
                    } else {
                        alertify.error(obj.Message);
                        if (obj.Logout == 1) {
                            setTimeout(function() {
                                window.location = "<?php site_url('logout'); ?>";
                            });
                        }
                    }
                },
                error: function(data) {
                    alertify.error("<?php echo label('Something_went_wrong_contact_to_admin'); ?>");
                }
            })
        }
        return false;
    });
    $(document).keypress(function(e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });

    function LoadPropertyBasedProject() {
        var val = $("#ProjectID").val();
        var type = $("#ProjectID option[value='" + val + "']").attr('data-type');
        if (type == "Commercial") {
            $("#ResidencyDiv").addClass('hide');
            $("#CommercialDiv").removeClass('hide');
        } else {
            $("#ResidencyDiv").removeClass('hide');
            $("#CommercialDiv").addClass('hide');
        }
    }

    $('input[name=VisitorCenter]').on('change', function() {
        if ($(this).val() == 'Premises') {
            $('#outdoordiv').addClass('hide');
            $('#OutDoorLocation').removeClass('empty_validation_class');
            $('#OutDoorLocation').val('');
        } else {
            $('#outdoordiv').removeClass('hide');
            $('#OutDoorLocation').addClass('empty_validation_class');
        }
    });

    $('#ProjectID').on('change', function() {});

    $('.VisitSource').on('change', function() {
        var selectedLanguage = new Array();
        $('input[name="VisitSource[]"]:checked').each(function() {
            selectedLanguage.push(this.value);
        });
        if (selectedLanguage.length > 0) {
            for (var i = 0; i < selectedLanguage.length; i++) {
                if (selectedLanguage[i] == "Chanel Partners") {
                    $("#Chanel_Partners").attr('checked', true);
                    $(".ChannelPartner").removeClass("hide");
                    $(".ChannelPartner").addClass("show");
                    $("#Reference").attr('checked', false);
                    $(".Reference").removeClass("show");
                    $(".Reference").addClass("hide");
                } else if (selectedLanguage[i] == "Reference") {
                    $("#Chanel_Partners").attr('checked', false);
                    $("#Reference").attr('checked', true);
                    $(".Reference").removeClass("hide");
                    $(".Reference").addClass("show");
                    $(".ChannelPartner").removeClass("show");
                    $(".ChannelPartner").addClass("hide");
                } else {
                    $("#Reference").attr('checked', false);
                    $("#Chanel_Partners").attr('checked', false);
                    $(".ChannelPartner").removeClass("show");
                    $(".ChannelPartner").addClass("hide");
                    $(".Reference").removeClass("show");
                    $(".Reference").addClass("hide");
                }
            }
        } else {
            $(".Reference").removeClass("show");
            $(".Reference").addClass("hide");
            $(".ChannelPartner").removeClass("show");
            $(".ChannelPartner").addClass("hide");
        }
    });

    $(document).ready(function() {
        var selectedLanguage = new Array();
        $('input[name="VisitSource[]"]:checked').each(function() {
            selectedLanguage.push(this.value);
        });
        for (var i = 0; i < selectedLanguage.length; i++) {
            if (selectedLanguage[i] == "Chanel Partners") {
                $("#Chanel_Partners").attr('checked', true);
                $(".ChannelPartner").removeClass("hide");
                $(".ChannelPartner").addClass("show");
                $("#Reference").attr('checked', false);
                $(".Reference").removeClass("show");
                $(".Reference").addClass("hide");
            } else if (selectedLanguage[i] == "Reference") {
                $("#Chanel_Partners").attr('checked', false);
                $("#Reference").attr('checked', true);
                $(".Reference").removeClass("hide");
                $(".Reference").addClass("show");
                $(".ChannelPartner").removeClass("show");
                $(".ChannelPartner").addClass("hide");
            } else {
                $("#Reference").attr('checked', false);
                $("#Chanel_Partners").attr('checked', false);
                $(".ChannelPartner").removeClass("show");
                $(".ChannelPartner").addClass("hide");
                $(".Reference").removeClass("show");
                $(".Reference").addClass("hide");
            }
        }
    });

    $('#ProjectID').on('change', function() {
        var ProjectType = $('option:selected', '#ProjectID').attr('data-type');
        if (ProjectType == 'Residency') {
            $("#House").prop("checked", true);
        } else if (ProjectType == 'Commercial') {
            $("#showroom").prop("checked", true);
        }
    });
</script>