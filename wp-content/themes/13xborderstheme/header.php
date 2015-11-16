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

        <script>
            urlHome = "<?php bloginfo('template_url'); ?>";
        </script>

        <?php wp_head(); ?>
        <style type="text/css">
            #top-home{
               
            }
.catchCopyArea{
	position: relative;
	color: white;
	text-shadow: rgb(50, 50, 20) 0px 2px 3px;
	
	font-family: 'Noto Sans Japanese', serif;
	font-weight: bold;
	height: 570px;	
	background-image: url(<?php echo get_option('13xborders_sitelogo') ?>);
	background-size: cover;

}
        </style>
    </head>
    <body <?php body_class(); ?>>

        <!-- wrapper -->
        <div id="nav-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <nav class="navbar navbar-fixed-top navbar-inverse" id="mmenu">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top_menu">
                                    <span class="sr-only">Toggle Nav</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse text-uppercase" id="top_menu">
                                <?php html5blank_nav(); ?>
                            </div>
                        </nav><!--End #mmenu-->                                 
                    </div>
                </div>
            </div>
        </div><!--End #nav-main-->
        