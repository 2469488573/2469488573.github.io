		<footer id="footer">
<div class="footer-inner">
<div id="footerinfo">
Copyright&nbsp;©&nbsp;2013&nbsp;<a href="<?php bloginfo('url');?>" title="<?php bloginfo('name');?>"><?php bloginfo('name');?></a>&nbsp;|&nbsp;总浏览量：<?php echo lo_all_view(); ?>&nbsp;|&nbsp;Theme Is <a href="http://fatesinger.com" title="By bigfa In fatesinger" target="_blank">Minimize</a>
</div>
</div><!-- end #footer -->
</footer>
 </div>
 <?php if ( is_home() ){ ?>
 <p class="link-back2top"><a href="#" title="Back to top">Back to top</a></p>
 <div class="baby"></div>	
 <?php } ?>
 <div class="statistic">
		<?php if( dopt('d_track_b') != '' ) echo dopt('d_track'); ?>
	</div>


<?php wp_footer(); ?>

    <?php if ( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/single.js"></script>
<?php } ?>
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/global.js"></script>	
	
</body>
</html>