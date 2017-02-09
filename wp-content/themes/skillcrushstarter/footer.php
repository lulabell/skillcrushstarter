<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Skillcrush_Starter
 * @since Skillcrush Starter 1.0
 */
?>


		</div><!-- #main -->
	</div><!-- #page -->

<section class="footer">
		<div id="footer-widgets">

				<div id="footer-widget1">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1') ) : ?>
				<?php endif; ?>
				</div>

				<div id="footer-widget2">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-2') ) : ?>
				<?php endif; ?>
				</div>

				<div id="footer-widget3">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-3') ) : ?>
				<?php endif; ?>
				</div>
			
				<div id="footer-widget4">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-4') ) : ?>
				<?php endif; ?>
				</div>
			
			</div>
			<div style="clear-both"></div>

		<footer id="colophon" class="site-footer">
					<div class="site-info">
						<div class="site-description">
							<p><a class="sitename" href="<?php echo home_url(); ?>"><span class="main-color"><?php bloginfo('name'); ?>&nbsp - </span></a><?php bloginfo('description'); ?></p>
							<p>&copy; 2016 - <?php echo date('Y '); ?><?php bloginfo('title'); ?> Theme by Skillcrush.com 
						</div>
					</div><!-- .site-info -->
		</footer><!-- #colophon -->
</section><!-- .footer -->
<?php wp_footer(); ?>

</body>
</html>