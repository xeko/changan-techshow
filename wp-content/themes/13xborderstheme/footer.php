<!-- footer -->
<div id="f_arrow"><span title="TOPへ戻る"></span></div>
<footer class="footer" role="contentinfo">

    <!-- copyright -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div id="fmenu" class="text-center clearfix">
                    <?php // footer_nav()?>

                </div>
<div id="b_logo" style="padding: 20px 0;">
                <div class="col-md-3"></div>	
                <div class="col-md-6" style="position: relative;" class="clearfix">
                    <div class="cus1"><a href="#" title="<?php bloginfo('name'); ?>" class="clearfix"><img src="<?php echo get_option('13xborders_header_logo') ?>" /></a>	
                    <?php echo date('Y'); ?> &copy; SLG & Partners, Inc.
			</div>
<div class="cus2" style="position: absolute; right: 0; top: 0;"><img src="<?php bloginfo('stylesheet_directory')?>/img/nks_logo.gif" /></div>
		</div>
                <div class="col-md-3"></div>	
</div>
                </div>                         
              
            </div>
        </div>
    </div>
    <!-- /copyright -->

</footer>
<!-- /footer -->

</div>
<!-- /wrapper -->
<?php
    $form1 = get_option('13xborders_form1_field');
    $form2 = get_option('13xborders_form2_field');
    $form3 = get_option('13xborders_form3_field');
    $form4 = get_option('13xborders_form4_field');
    $form5 = get_option('13xborders_form5_field');
    if(!empty($form1)) {
        echo do_shortcode($form1);
    }
    if(!empty($form2)) echo do_shortcode($form2);
    if(!empty($form3)) echo do_shortcode($form3);
    if(!empty($form4)) echo do_shortcode($form4);
    if(!empty($form5)) echo do_shortcode($form5);
?>
<?php wp_footer(); ?>
</body>
</html>