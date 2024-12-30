<?php get_header(); ?>
	<article>      
						
			<nav id="left-menu">
      <?php wp_nav_menu( array( 'theme_location' => 'header-menu','menu_id'=>'nav','container'=>'ul')); ?>
</nav>			
				<div id="content">				
					<div class="article-header">404 ERROR！</div>					
					<div class="article-body">
						<p>对不起，你请求的页面不存在！请 <a href="<?php bloginfo('url');?>"> 返回首页 </a>或者看看下面的随机文章</p>
						<img src="<?php bloginfo('template_directory');?>/images/404.jpg" alt="404">
					</div>	
						<div class="article-footer">											
				</div>				
						
			
		 </article>
	
		<?php get_footer(); ?>
	