    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="description" content="Unique HR">
        <meta name="keywords" content="Unique HR">
        <title>Unique HR</title>

        <!-- Favicons-->
        <link rel="icon" href="<?php echo $this->config->item('admin_assets'); ?>img/login-logos.png" sizes="32x32">
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/font-awesome.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
        <!-- Favicons-->
        <!-- CORE CSS-->
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/materialize.clockpicker.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
        <!-- Custome CSS-->
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/custom-style.css" type="text/css" rel="stylesheet" media="screen,projection">
        <!-- CSS for full screen (Layout-2)-->
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/style-fullscreen.css" type="text/css" rel="stylesheet" media="screen,projection">
        <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="<?php echo $this->config->item('admin_assets'); ?>js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="<?php echo $this->config->item('admin_assets'); ?>js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <!-- alertify CSS -->
        <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.core.css" />
        <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.default.css" />
        <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.default.css" />
        <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>js/plugins/morris-chart/morris.css" />
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/select2.css" rel="stylesheet" />
        <!-- jQuery Library -->
        <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/jquery-1.11.2.min.js"></script>

    </head>

    <!-- <body oncopy="return false" oncut="return false" onpaste="return false"> -->

    <body>
        <!-- Start Page Loading -->
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
        <!-- End Page Loading -->

        <!-- START HEADER -->
        <header id="header" class="page-topbar">
            <!-- start header nav-->
            <div class="navbar-fixed">
                <nav class="cyan">
                    <div class="nav-wrapper">

                        <ul class="left">
                            <li class="no-hover"><a href="#" tabindex="997" data-activates="slide-out" class="menu-sidebar-collapse btn-floating btn-flat btn-medium waves-effect waves-light cyan"><i class="mdi-navigation-menu"></i></a></li>
                            <li>
                                <h1 class="logo-wrapper"><a tabindex="998" href="<?php echo site_url('admin-dashboard'); ?>" class="brand-logo darken-1">
                                        <!-- <img class="img-responsive" src="<?php echo $this->config->item('admin_assets'); ?>img/logo_01.png"> -->
                                        Unique HR
                                        <!-- <span class="logo-text">Unique HR</span> --></a> </h1>
                            </li>
                        </ul>

                        <ul class="right hide-on-med-and-down">
                            <li><a tabindex='999' href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i title="Fullscreen" class="mdi-action-settings-overscan"></i></a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>admin/notification" class="waves-effect waves-block waves-light"><i class="mdi-social-notifications"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- end header nav-->
        </header>
        <!-- END HEADER -->

        <!-- START MAIN -->
        <div id="main">
            <!-- START WRAPPER -->
            <div class="wrapper">

                <!-- START LEFT SIDEBAR NAV-->
                <aside id="left-sidebar-nav">
                    <ul id="slide-out" class="side-nav leftside-navigation">
                        <li class="user-details cyan darken-2">
                            <div class="row">
                                <div class="col col s4 m4 l4">
                                    <h3 class="user-h3"><?php echo substr($this->session->userdata['FirstName'], 0, 1); ?></h3>
                                </div>
                                <div class="col col s8 m8 l8 p-0">
                                    <ul id="profile-dropdown" class="dropdown-content">
                                        <li><a href="<?php echo $this->config->item('base_url'); ?>my-profile"><i class="mdi-action-face-unlock"></i>My Profile</a>
                                        </li>

                                        <li><a href="<?php echo $this->config->item('base_url'); ?>change-password"><i class="mdi-communication-vpn-key"></i>Change Password</a>
                                        </li>
                                        <li><a href="<?php echo $this->config->item('base_url'); ?>logout"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                                        </li>
                                    </ul>

                                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">
                                        <p class="wrap_content_header"><?php echo $this->session->userdata['FirstName']; ?></p><i class="mdi-navigation-arrow-drop-down right"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <?php if (in_array("1", $this->module_data)) { ?>
                            <li class="bold"><a href="<?php echo $this->config->item('base_url'); ?>admin-dashboard" class="waves-effect waves-cyan"><i class="mdi-action-home"></i> Dashboard</a>
                            </li>
                        <?php }
                        ?>
                        <li class="no-padding">
                            <ul class="collapsible collapsible-accordion">
                                <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-list"></i>Masters</a>
                                    <div class="collapsible-body">
                                        <ul>
                                            <li><a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/banner">
                                                    Banners
                                                </a>
                                            </li>
                                            <li><a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/brand">
                                                    Brands
                                                </a>
                                            </li>
                                            <li><a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/category">
                                                    Category
                                                </a>
                                            </li>
                                            <li><a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/subcategory">
                                                    Sub Categories
                                                </a>
                                            </li>

                                            <li class=""> <a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/pagemaster">Page Master</a></li>
                                            <li><a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/cms">
                                                    Content Management System
                                                </a>
                                            </li>
                                            <li><a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/section">
                                                    Section Content
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="bold"><a href="<?php echo $this->config->item('base_url'); ?>admin/blog" class="waves-effect waves-cyan"><i class="mdi-notification-play-install"></i> Blogs</a>
                                </li>
                                <li class="bold"><a href="<?php echo $this->config->item('base_url'); ?>admin/jobposting" class="waves-effect waves-cyan"><i class="mdi-communication-business"></i> Job Posting</a>
                                </li>
                                <li class="bold"><a href="<?php echo $this->config->item('base_url'); ?>admin/testimonial" class="waves-effect waves-cyan"><i class="mdi-communication-business"></i> Testimonial</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </aside>
                <!-- END LEFT SIDEBAR NAV-->