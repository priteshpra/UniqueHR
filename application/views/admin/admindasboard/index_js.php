<script>
window.PageSize = 10;
window.CurrentPage = 1;
window.ReportType='Followup';
window.CustomStartDate='';
window.CustomEndDate='';

$(document).ready(function () {
    <?php
    if (isset($this->session->userdata['posterror'])) {
        echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
    }?>
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>
    ajax_dashboard($("input[name='FilterType']:checked").val());
    ajax_listing(PageSize,CurrentPage);
});

$(document).on("change","input[type='radio']",function(){
	ajax_dashboard($(this).val());
    ajax_listing(PageSize,CurrentPage);
});
function ajax_dashboard(_FilterType){
	$.ajax({
            type: "post",
            url: base_url + "admin/admindashboard/ajax_dashboard",
            data: {
            	FilterType:_FilterType,
                },
            success: function (data){
                $('#dashboard_listing').html(data);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
}

function ajax_listing(PageSize, CurrentPage){

    var tmp = "( " + ReportType + " - " + FilterType + " )";
    if(ReportType == "Followup"){
        tmp = "( Visitor Follow up - " + FilterType + " )";
    }
    $("#reportlabel").html(tmp);
    $.ajax({
        type: "post",
        url: base_url + "admin/report/report/ajax_listing/"+PageSize+"/"+ CurrentPage,
        data: {
            FilterType:($("input[name='FilterType']:checked").val()),
            ReportType:ReportType,
            CustomStartDate:CustomStartDate,
            CustomEndDate:CustomEndDate,
            },
        success: function (data){
            var obj = JSON.parse(data);
            $('#table_body').html(obj.a);
            $(' #table_paging_div').html(obj.b);
        },error: function (data){
            console.log(data);
            alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
        }
    })
}

$('.table_paging_div').on('click', '.pagination_buttons', function () {
        var page = $(this).attr('data-page-number');
        ajax_listing(PageSize, page);
    })

$('.select-dropdown').on('change', function () {
        PageSize = $(this).val();
        ajax_listing(PageSize,CurrentPage);
    })
    
$(document).on("click",".moreinfo",function(){
    var filter = $(this).attr('data-filter');
    var div=$(this).attr('data-type');
    $("#FilterType").val(filter);
    $("#FilterDiv").val(div);
    $("#dashboardfrm").submit();
});

</script>