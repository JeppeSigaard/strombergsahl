<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
    <hr class="pyntestreg"/>
	<footer id="colophon" role="contentinfo">
		<!-- .site-info -->
		<?php if ( dynamic_sidebar('page_widget_footer') ) : endif ?>
        <!-- .site-info -->
	<div class="footer-socials">
    <a href="https://www.facebook.com/1460996654128029" id="facebook" target="_blank"><img src="http://enss.dk/wp-content/uploads/2013/10/facebook.png"/></a>
    <a href="http://www.linkedin.com/company/strombergsahl" target="_blank"><img src="http://enss.dk/wp-content/uploads/2013/10/linkedin.png"/></a>
    </div>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<div id="outdated">
	<h6>Din browser er forældet</h6>
	<p>Du skal opdatere din internetbrowser for at få vist denne hjemmeside korrekt<a id="btnUpdateBrowser" href="https://browser-update.org/update-outdated.html">Opdater nu</a></p>
	<p class="last"> <a href="#" id="btnCloseUpdateBrowser" title="Close"> × </a> </p>
</div>


<script src="<?php bloginfo('template_directory');?>/ob/outdatedBrowser.min.js"></script>
<script>

outdatedBrowser({
		bgColor: '#006b52',
		color: '#FFF',
		lowerThan: 'IE10'
	});

</script>
</body>
</html>