<div id="card-stats" class="container">
    <div class="row">
        <!--card stats start-->

        <div id="card-stats">
            <div class="row">
                <div class="col m12 s12 center m-t-20">
                    <input type="radio" name="FilterType" id="Daily" value="Daily" checked="checked">
                    <label for="Daily">Daily</label>
                    <input type="radio" name="FilterType" id="Weekly" value="Weekly">
                    <label for="Weekly">Weekly</label>
                    <input type="radio" name="FilterType" id="Monthly" value="Monthly">
                    <label for="Monthly">Monthly</label>
                    <input type="radio" name="FilterType" id="Yearly" value="Yearly">
                    <label for="Yearly">Yearly</label>
                    <input type="radio" name="FilterType" id="Total" value="Total">
                    <label for="Total">Total</label>
                </div>
                <div id="dashboard_listing">
                </div>
            </div>
        </div>

        <!--card stats end-->
    </div>
</div>

<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/sparkline/sparkline-script.js"></script>
<form id="dashboardfrm" action="<?php echo site_url('admin/report/report'); ?>" method="post">
    <input type="hidden" name="FilterType" id="FilterType" value="">
    <input type="hidden" name="FilterDiv" id="FilterDiv" value="">
</form>