<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file outputs your footer content including your footer widgets and copyright info
 */
?>
<div class="clear"></div>

</div><!-- /main-content -->
	<?php
	//show widgetized footer if enabled
	if(of_get_option('widgetized_footer')) { ?>
    <footer id="footer">
        <div id="footer-widgets" class="grid-container clearfix">
            <div class="footer-box grid-4">
            	<?php dynamic_sidebar('footer-one'); ?>
            </div>
            <!-- /footer-left -->
            <div class="footer-box grid-4">
            	<?php dynamic_sidebar('footer-two'); ?>
            </div>
            <!-- /footer-middle -->
            <div class="footer-box grid-4">
            	<?php dynamic_sidebar('footer-three'); ?>
            </div>
            <!-- /footer-right -->
			<div class="footer-box grid-4">
            	<?php dynamic_sidebar('footer-four'); ?>
            </div>
            <!-- /footer-right -->
        </div>
        <!-- /footer-widgets -->
    </footer>
    <!-- /footer -->
    <?php } //widgetized footer disabled ?>
    <div id="footer-bottom">
    	<div class="grid-container clearfix">
            <div id="copyright" class="grid-2 no-btm-margin">
                &copy; <?php _e('Copyright', 'wpex'); ?> <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?>" rel="home"><?php bloginfo('name'); ?></a>
            </div><!-- /copyright -->
            <div id="footer-menu" class="grid-2 no-btm-margin">
                <?php wp_nav_menu( array(
                    'theme_location' => 'footer_menu',
                    'sort_column' => 'menu_order',
                    'fallback_cb' => ''
                )); ?>
            </div><!-- /footer-menu -->
    	</div><!-- /grid-container -->
    </div><!-- /footer-bottom --> 
</div><!-- /wrap -->
<?php
//footer hook <== DO NOT DELETE ME
wp_footer(); ?>
</body>
</html>