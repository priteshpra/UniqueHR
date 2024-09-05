<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo ($page_name) ? $page_name . ' - ' : ' ' ?>Unique HR Consultancy</title>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo isset($metaKey[0]->MetaDescription) ? $metaKey[0]->MetaDescription : '' ?>">
    <meta name="keywords" content="<?php echo isset($metaKey[0]->MetaKeyword) ? $metaKey[0]->MetaKeyword : '' ?>">
    <meta name="viewport" content="width=device-width">

    <!-- Start Include All CSS -->
    <link rel="stylesheet" href="<?php echo $this->config->item('front_assets'); ?>css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('front_assets'); ?>css/animate.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('front_assets'); ?>css/themewar-font.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('front_assets'); ?>css/quera-icon.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('front_assets'); ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('front_assets'); ?>css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('front_assets'); ?>css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('front_assets'); ?>css/nice-select.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('front_assets'); ?>css/lightcase.css">

    <!-- Revolution Slider Setting CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('front_assets'); ?>css/settings.css">

    <link rel="stylesheet" href="<?php echo $this->config->item('front_assets'); ?>css/preset.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('front_assets'); ?>css/ignore_for_wp.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('front_assets'); ?>css/theme.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('front_assets'); ?>css/responsive.css" />
    <!-- End Include All CSS -->

    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="<?php echo $this->config->item('front_assets'); ?>images/favicon.png">
    <!-- Favicon Icon -->
</head>

<body>
    <!-- Preloading -->
    <div class="preloader clock text-center">
        <div class="queraLoader">
            <div class="loaderO">
            </div>
        </div>
    </div>
    <!-- Preloading -->

    <!-- Header Start -->
    <header class="header03 isSticky">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="navbar01">
                        <div class="logo">
                            <a href="<?php echo base_url('home') ?>"><img src="<?php echo $this->config->item('front_assets'); ?>images/logo2.png" alt="Unique "></a>
                        </div>
                        <nav class="mainMenu">
                            <ul>
                                <?php if ($menu['menus']) {
                                    foreach ($menu['menus'] as $key => $value) {

                                        if ($key == 0) {
                                            $Url = 'home';
                                            $class = 'current-menu-item';
                                        } else {
                                            $class = 'current-menu-item';
                                            $Url = '/' . strtolower($value->CategoryName);
                                            if ($key == 2 || $key == 3) {
                                                $Url = 'javascript:void(0);';
                                                $class = 'menu-item-has-children';
                                            }
                                        }
                                        if ($value->CategoryName != 'Contact') {
                                ?>
                                            <li class="<?php echo $class ?>">
                                                <a href="<?php echo base_url($Url) ?>">
                                                    <?php echo $value->CategoryName ?>
                                                    <?php if (isset($menu['Submenus'][$value->CategoryName])) { ?>
                                                        <ul class="sub-menu">
                                                            <?php foreach ($menu['Submenus'][$value->CategoryName] as $key => $values) { ?>
                                                                <li><a href="<?php echo base_url('/' .  str_replace(' ', '-', strtolower($values['SubCategoryName']))) ?>"><?php echo $values['SubCategoryName'] ?></a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    <?php } ?>
                                                </a>
                                            </li>
                                <?php }
                                    }
                                } ?>

                            </ul>
                        </nav>
                        <div class="accessNav">
                            <a href="javascript:void(0);" class="menuToggler"><i class="twi-bars1"></i></a>
                            <a href="<?php echo base_url('contact') ?>" class="qu_btn">Contact Us</a>
                        </div>

                        <div class="navleft">
                            <div class="icon_box_04">
                                <p>Have any Questions?</p>
                                <h3>info@unique-hr.com</h3>
                                <div>
                                    <a href="https://api.whatsapp.com/send?phone=+7069690700&text=Hello" target="_blank" class="whatsapp-icon "> <i class="twi-whatsapp"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Begin:: Popup Menu -->
    <section class="sidebarMenu">
        <div class="sidebarMenuOverlay"></div>
        <div class="SMArea">
            <div class="SMAHeader">
                <h3>
                    <i class="twi-bars1"></i> Menu
                </h3>
                <a href="javascript:void(0);" class="SMACloser"><i class="twi-times2"></i></a>
            </div>
            <div class="SMABody">
                <ul>
                    <?php if ($menu['menus']) {
                        foreach ($menu['menus'] as $key => $value) {

                            if ($key == 0) {
                                $Url = 'home';
                                $class = 'current-menu-item';
                            } else {
                                $class = 'current-menu-item';
                                $Url = '/' . strtolower($value->CategoryName);
                                if ($key == 2 || $key == 3) {
                                    $Url = 'javascript:void(0);';
                                    $class = 'menu-item-has-children';
                                }
                            }
                    ?>
                            <li class="<?php echo $class ?>">
                                <a href="<?php echo base_url($Url) ?>">
                                    <?php echo $value->CategoryName ?>
                                    <?php if (isset($menu['Submenus'][$value->CategoryName])) { ?>
                                        <ul class="sub-menu">
                                            <?php foreach ($menu['Submenus'][$value->CategoryName] as $key => $values) { ?>
                                                <li><a href="<?php echo base_url('/' .  str_replace(' ', '-', strtolower($values['SubCategoryName']))) ?>"><?php echo $values['SubCategoryName'] ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </a>
                            </li>
                    <?php
                        }
                    } ?>
                    <!-- <li class="current-menu-item"><a href="<?php echo base_url('home') ?>">Home</a></li>
                    <li><a href="<?php echo base_url('about') ?>">About</a></li>
                    <li class="menu-item-has-children">
                        <a href="javascript:void(0);">Services</a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url('services/recruitment') ?>">Recruitment</a></li>
                            <li><a href="<?php echo base_url('services/candidatescreening') ?>">Candidate Screening</a></li>
                            <li><a href="<?php echo base_url('services/shortlisting') ?>">Shortlisting</a></li>
                            <li><a href="<?php echo base_url('services/referencechecks') ?>">Reference Checks</a></li>
                            <li><a href="<?php echo base_url('services/interviewcoordination') ?>">Interview Coordination</a></li>
                            <li><a href="<?php echo base_url('services/postplacementsupport') ?>">Post Placement Support</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="javascript:void(0);">Industries</a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url('industries/manufacturer') ?>">Manufacturer</a></li>
                            <li><a href="<?php echo base_url('industries/engineering') ?>">Engineering</a></li>
                            <li><a href="<?php echo base_url('industries/automation') ?>">Automation</a></li>
                            <li><a href="<?php echo base_url('industries/software') ?>">IT Software - Hardware</a></li>
                            <li><a href="<?php echo base_url('industries/bifs') ?>">Banking,Finance, Insurance </a></li>
                            <li><a href="<?php echo base_url('industries/bpo') ?>">BPO/KPO</a></li>
                            <li><a href="<?php echo base_url('industries/healthcare') ?>">Healthcare</a></li>
                            <li><a href="<?php echo base_url('industries/realestate') ?>">Real Estate</a></li>
                        </ul>
                    </li>
                    <li><a href="blogs.html">Blogs</a></li>
                    <li><a href="blogs.html">Contact Us</a></li> -->
                </ul>
            </div>
        </div>
    </section>
    <!-- End:: Popup Menu -->