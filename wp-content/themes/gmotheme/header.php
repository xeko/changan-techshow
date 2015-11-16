<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <title><?php wp_title(''); ?><?php
            if (wp_title('', false)) {
                echo ' :';
            }
            ?> <?php bloginfo('name'); ?></title>

        <link href="<?php echo get_option('13xborders_favicon') ?>" rel="shortcut icon">

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="description" content="<?php bloginfo('description'); ?>">

        <style type="text/css">
            #top-home{
                background: url(<?php echo get_option('13xborders_sitelogo') ?>) no-repeat center center;
            }
        </style>
        <?php wp_head(); ?>

        <script>
            jQuery(document).ready(function () {
//                jQuery('.sub-menu').addClass('dropdown-menu');                 
            });
        </script>
    </head>
    <body <?php body_class(); ?>>
        <!-- wrapper -->
        <div id="nav-main">
            <nav class="navbar-default navbar-fixed-top" id="menu_top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="clearfix navbar-collapse text-uppercase text-left"><?php top_nav() ?></div>
                        <div class="navbar-header clearfix">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top_menu">
                                <span class="sr-only">Toggle Nav</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse text-uppercase clearfix" id="top_menu">
                            <div class="navbar-left">
                                <div class="navbar-header" id="s-menu-logo">
                                    <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" class="navbar-brand"><img src="<?php echo get_option('13xborders_header_logo') ?>" class="img-responsive" /></a>
                                </div>
                            </div>
                            <?php html5blank_nav(); ?>                                
                        </div>
                    </div>
                </div>

            </nav><!--End #menu_top-->
        </div><!--End #nav-main-->

        
