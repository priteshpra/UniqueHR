<?php
if ($FilterType == "Daily") {
    $Str = "Today";
} else if ($FilterType == "Weekly") {
    $Str = "Current Week";
} else if ($FilterType == "Monthly") {
    $Str = "Current Month";
} else if ($FilterType == "Yearly") {
    $Str = "Current Year";
} else {
    $Str = "";
}
?>
<div class="col s12 m6 l4">
    <div class="card">
        <div class="card-content  green white-text">
            <p class="card-stats-title"><i class="mdi-social-group-add"></i> Number Of Brands</p>
            <h4 class="card-stats-number"><?php echo ($Dashboard['TotalBrands']['Count'] == -1) ? 0 : $Dashboard['TotalBrands']['Count']; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  green darken-2">
            <!-- <div class="center"><a class="moreinfo" data-type="Visitor" data-Filter="<?php echo $FilterType; ?>" href="javascript:void(0)">More Info</a></div> -->
        </div>
    </div>
</div>
<div class="col s12 m6 l4">
    <div class="card">
        <div class="card-content purple white-text">
            <p class="card-stats-title"><i class="mdi-action-alarm-add "></i>Number Of Category</p>
            <h4 class="card-stats-number"><?php echo ($Dashboard['TotalCategory']['Count'] == -1) ? 0 : $Dashboard['TotalCategory']['Count']; ?></h4>
            <p class="card-stats-compare"><span class="purple-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action purple darken-2">
            <!-- <div class="center"><a class="moreinfo" data-type="Followup" data-Filter="<?php echo $FilterType; ?>" href="javascript:void(0)">More Info</a></div> -->
        </div>
    </div>
</div>

<div class="col s12 m6 l4">
    <div class="card">
        <div class="card-content pink lighten-2 white-text">
            <p class="card-stats-title"><i class="mdi-action-trending-up"></i> Total Blogs</p>
            <h4 class="card-stats-number"><?php echo ($Dashboard['TotalBlogs']['Count'] == -1) ? 0 : $Dashboard['TotalBlogs']['Count']; ?></h4>
            <p class="card-stats-compare"><span class="deep-purple-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  pink darken-2">
            <!-- <div class="center"><a class="moreinfo" data-type="Booking" data-Filter="<?php echo $FilterType; ?>" href="javascript:void(0)">More Info</a></div> -->
        </div>
    </div>
</div>


<div class="col s12 m6 l4">
    <div class="card">
        <div class="card-content  indigo white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total Job Posting</p>
            <h4 class="card-stats-number"><?php echo ($Dashboard['TotalJobs']['Count'] == -1) ? 0 : $Dashboard['TotalJobs']['Count']; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  indigo darken-1 darken-2">
            <!-- <div class="center"><a class="moreinfo" data-type="Refund" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/CustomerProperty/'); ?>">More Info</a></div> -->
        </div>
    </div>
</div>

<div class="col s12 m6 l4">
    <div class="card">
        <div class="card-content  grey white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total Sub Category</p>
            <h4 class="card-stats-number"><?php echo ($Dashboard['TotalSubCat']['Count'] == -1) ? 0 : $Dashboard['TotalSubCat']['Count']; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  grey darken-1 darken-2">
            <!-- <div class="center"><a class="moreinfo" data-type="Refund" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/CustomerProperty/'); ?>">More Info</a></div> -->
        </div>
    </div>
</div>